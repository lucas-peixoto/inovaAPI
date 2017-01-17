<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
spl_autoload_register(function ($classname) {
    require ("../classes/" . $classname . ".php");
});

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$config['db']['host']   = "localhost";
$config['db']['user']   = "root";
$config['db']['pass']   = "";
$config['db']['dbname'] = "inova";

$app = new \Slim\App(["settings" => $config]);
$container = $app->getContainer();

$container['view'] = new \Slim\Views\PhpRenderer("../templates/");

$container['logger'] = function($c) {
    $logger = new \Monolog\Logger('my_logger');
    $file_handler = new \Monolog\Handler\StreamHandler("../logs/app.log");
    $logger->pushHandler($file_handler);
    return $logger;
};

$container['db'] = function ($c) {
    $db = $c['settings']['db'];
    $pdo = new PDO("mysql:host=" . $db['host'] . ";dbname=" . $db['dbname'],
    $db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};

$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");
    $this->logger->addInfo("Name: $name");

    return $response;
});

$app->post('/add', function (Request $request, Response $response) {
    $this->logger->addInfo("entering /add route");

    $data = $request->getParsedBody();

    $aluno_data = [];
    $aluno_data['nome'] = filter_var($data['nome'], FILTER_SANITIZE_STRING);
    $aluno_data['turno'] = filter_var($data['turno'], FILTER_SANITIZE_STRING);
    $aluno_data['email'] = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
    $aluno_data['curso'] = filter_var($data['curso'], FILTER_SANITIZE_STRING);

    $cursoMapper = new CursoMapper($this->db);

    if ($cursoMapper->checkName($curso->getNome()) == -1) {
        $this->logger->addInfo("Saving curso " . $aluno_data['curso']);

        $curso = new CursoEntity($aluno_data['curso']);
        $cursoMapper->save($curso);
    }

    $aluno = new AlunoEntity($aluno_data);
    $alunoMapper = new AlunoMapper($this->db);

    $this->logger->addInfo("Saving aluno " . $aluno->getNome());
    $alunoMapper->save($aluno);

    $response->getBody()->write("Ok");
    return $response;
});

$app->run();