<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
spl_autoload_register(function ($classname) {
    require ("../classes/" . $classname . ".php");
});

date_default_timezone_set('America/Fortaleza');

$config['displayErrorDetails'] = true;
// $config['addContentLengthHeader'] = false;

$config['db']['host']   = "localhost";
$config['db']['user']   = "root";
$config['db']['pass']   = "";
$config['db']['dbname'] = "inova";

$app = new \Slim\App(["settings" => $config]);
$container = $app->getContainer();

$container['view'] = new \Slim\Views\PhpRenderer("../templates/");

$container['logger'] = function($c) {
    $logger = new \Monolog\Logger('logger');
    $file_handler = new \Monolog\Handler\StreamHandler("../logs/app.log");
    $logger->pushHandler($file_handler);
    return $logger;
};

$container['db'] = function ($c) {
    $db = $c['settings']['db'];
    $pdo = new PDO("mysql:host=" . $db['host'] . ";dbname=" . $db['dbname'] . ";charset=utf8",
        $db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");
    $this->logger->addInfo("Name: $name");

    return $response;
});

$app->get('/tmp', function (Request $request, Response $response) {
    $userMapper = new UserMapper($this->db);
    $user = $userMapper->getUserByCredentials('jgerente', '1234');

    // var_dump($user);

    if ($user) {
        $resp = array( 'success' => 'true', 'token' => $user->getToken() );
    } else {
        $resp = array( 'success' => 'false', 'msg' => 'Credenciais inválidas' );
    }

    return $this->view->render($response, 'json.php', ["data" => $resp]);
});

$app->post('/authenticate', function (Request $request, Response $response) {
    $data = $request->getParsedBody();

    $username = $data['username'];
    $password = $data['password'];

    $this->logger->addInfo("/authenticate $username@$password");

    $userMapper = new UserMapper($this->db);
    $user = $userMapper->getUserByCredentials($username, $password);

    if ($user !== false) {
        $resp = array( 'success' => true, 'token' => $user->getToken() );
    } else {
        $resp = array( 'success' => false, 'msg' => 'Credenciais inválidas' );
    }

    return $this->view->render($response, 'json.php', ["data" => $resp]);
});

$app->group('/get', function () use ($app) {
    $app->get('/all/{token}', function ($request, $response) {
        $token = $request->getAttribute('token');
        $userMapper = new UserMapper($this->db);

        if ($userMapper->checkToken($token)) {
            $this->logger->addInfo("Token validado: $token");
            $cursoMapper = new CursoMapper($this->db);
            $cursos = $cursoMapper->getCursos('ARRAY');
            return $this->view->render($response, 'json.php', ["data" => $cursos]);
        } else {
            $this->logger->addInfo("Token invalidado: $token");
            $data = array('success' => false, 'msg' => 'token inválido');
            return $this->view->render($response, 'json.php', ["data" => $data]);
        }
    });
    $app->get('/{id}/{token}', function ($request, $response, $args) {
        $curso_id = (int) $args['id'];
        $token = $request->getAttribute('token');
        $userMapper = new UserMapper($this->db);

        if ($userMapper->checkToken($token)) {
            $this->logger->addInfo("Token $token validado");
            $this->logger->addInfo("Geting curso $curso_id for $token");
            $cursoMapper = new CursoMapper($this->db);
            $curso = $cursoMapper->getCursoById($curso_id, 'ARRAY');
            return $this->view->render($response, 'json.php', ["data" => $curso]);
        } else {
            $data = array('success' => false, 'msg' => 'token inválido');
            return $this->view->render($response, 'json.php', ["data" => $data]);
        }
    });
    $app->get('/{id}/alunos/{token}', function ($request, $response, $args) {
        $curso_id = (int) $args['id'];
        $token = $request->getAttribute('token');
        $userMapper = new UserMapper($this->db);

        if ($userMapper->checkToken($token)) {
            $this->logger->addInfo("Token $token validado");
            $this->logger->addInfo("Geting alunos from $curso_id for $token");
            $alunoMapper = new AlunoMapper($this->db);
            $alunos = $alunoMapper->getAlunosByCurso($curso_id, 'ARRAY');
            return $this->view->render($response, 'json.php', ["data" => $alunos]);
        } else {
            $data = array('success' => false, 'msg' => 'token inválido');
            return $this->view->render($response, 'json.php', ["data" => $data]);
        }
    });
});

$app->post('/add', function (Request $request, Response $response) {
    $data = $request->getParsedBody();

    $userMapper = new UserMapper($this->db);

    if (!$userMapper->checkToken($token)) {
        $this->logger->addInfo("Token $token invalidado");
        $data = array('success' => false, 'msg' => 'token inválido');
        return $this->view->render($response, 'json.php', ["data" => $data]);
    }

    $this->logger->addInfo("Token $token validado");

    $aluno_data = [];
    $aluno_data['nome'] = filter_var($data['nome'], FILTER_SANITIZE_STRING);
    $aluno_data['cpf'] = filter_var($data['cpf'], FILTER_SANITIZE_STRING);
    $aluno_data['email'] = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
    $aluno_data['telefone'] = filter_var($data['telefone'], FILTER_SANITIZE_STRING);
    $aluno_data['curso'] = filter_var($data['curso'], FILTER_SANITIZE_STRING);
    $aluno_data['turno'] = filter_var($data['turno'], FILTER_SANITIZE_STRING);
    $endereco_data = [];
    $endereco_data['rua'] = filter_var($data['rua'], FILTER_SANITIZE_STRING);
    $endereco_data['numero'] = $data['numero'];
    $endereco_data['bairro'] = filter_var($data['bairro'], FILTER_SANITIZE_STRING);
    $endereco_data['cidade'] = filter_var($data['cidade'], FILTER_SANITIZE_STRING);
    $endereco_data['estado'] = filter_var($data['estado'], FILTER_SANITIZE_STRING);
    $endereco_data['cep'] = filter_var($data['cep'], FILTER_SANITIZE_STRING);

    $cursoMapper = new CursoMapper($this->db);
    if ($cursoMapper->checkName($aluno_data['curso']) == -1) {
        $this->logger->addInfo("Saving curso " . $aluno_data['curso']);

        $curso = new CursoEntity(["nome" => $aluno_data['curso']]);
        $cursoMapper->save($curso);
    }

    $endereco = new EnderecoEntity($endereco_data);
    $enderecoMapper = new EnderecoMapper($this->db);
    $this->logger->addInfo("Saving endereco " . $endereco->toString());
    $endereco_id = $enderecoMapper->save($endereco);

    $aluno_data['endereco_id'] = $endereco_id;

    $aluno = new AlunoEntity($aluno_data);
    $alunoMapper = new AlunoMapper($this->db);
    $this->logger->addInfo("Saving aluno " . $aluno->getNome());
    $alunoMapper->save($aluno);

    $response->getBody()->write("Ok");
    return $response;
});

$app->get('/test', function (Request $request, Response $response) {
    $aluno_data = [];
    $aluno_data['nome'] = "Alexandra";
    $aluno_data['cpf'] = "555.000.109-01";
    $aluno_data['email'] = "alexandra2k17@yahoo.com.br";
    $aluno_data['telefone'] = "(88) 111227564";
    $aluno_data['curso'] = "Engenharia Aero-Espacial";
    $aluno_data['turno'] = "noite";
    $endereco_data = [];
    $endereco_data['rua'] = "Beco Diagonal";
    $endereco_data['numero'] = "403";
    $endereco_data['bairro'] = "Centro";
    $endereco_data['cidade'] = "Diagonal City";
    $endereco_data['estado'] = "HG";
    $endereco_data['cep'] = "63180-000";
    $usuario_data = [];
    $usuario_data['nome'] = 'João Gerente';
    $usuario_data['nivel'] = '4';
    $usuario_data['username'] = 'jgerente';
    $usuario_data['password'] = '1234';

    $cursoMapper = new CursoMapper($this->db);
    if ($cursoMapper->checkName($aluno_data['curso']) == -1) {
        $this->logger->addInfo("Saving curso " . $aluno_data['curso']);

        $curso = new CursoEntity(["nome" => $aluno_data['curso']]);
        $cursoMapper->save($curso);
    }

    $endereco = new EnderecoEntity($endereco_data);
    $enderecoMapper = new EnderecoMapper($this->db);
    $this->logger->addInfo("Saving endereco " . $endereco->toString());
    $endereco_id = $enderecoMapper->save($endereco);

    $aluno_data['endereco_id'] = $endereco_id;

    $aluno = new AlunoEntity($aluno_data);
    $alunoMapper = new AlunoMapper($this->db);
    $this->logger->addInfo("Saving aluno " . $aluno->getNome());
    $alunoMapper->save($aluno);

    $usuario = new UserEntity($usuario_data);
    $usuarioMapper = new UserMapper($this->db);
    $this->logger->addInfo("Saving usuário " . $usuario->getNome());
    $usuarioMapper->save($usuario);

    $response->getBody()->write("Ok, I guess.");

    return $response;
});

$app->run();
