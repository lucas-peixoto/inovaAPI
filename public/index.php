<?php require '../templates/header.php'; ?>
<?php
$token = 'web-access';

$data = file_get_contents('http://localhost/inovaAPI/public/api.php/get/all/' . $token);
$data = json_decode($data, true);
//var_dump($data);die;
?>

<section id="signup-form" class="signup-form">
    <div class="ui container">

        <div class="ui header">
            <h1>Faça já sua escolha!</h1>
        </div>
        <form id="form" action="api.php/add" method="post" data-type="user" class="ui form">
            <h4 class="ui header">
                Produto
                <span class="sub header">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                </span>
            </h4>
            <input id="curso" name="curso" type="text" class="live-search-box" placeholder="Nome do Produto" required=""/>
            <div class="ui segment grid" style="padding-left: 14px;">
                <ul class="ui horizontal bulleted list live-search-list" style="width: 100%">
                    <?php foreach ($data as $p) { ?>
                    <li class="item four wide column"><?= $p['nome']; ?></li>
                    <?php } ?>
                </ul>
            </div>

            <h4 class="ui header">
                Dados pessoais
                <span class="sub header">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                </span>
            </h4>
            <div class="two fields">
                <div class="field">
                    <label for="name">Nome completo:</label>
                    <input type="text" placeholder="Ex: José Carlos Saraiva Neto" name="nome" id="nome" required="">
                </div>
                <div class="field">
                    <label for="cpf">CPF:</label>
                    <input type="text" placeholder="Ex: 000.000.000-00" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" name="cpf" id="cpf" required="">
                </div>
            </div>
            <div class="two fields">
                <div class="field">
                    <label for="email">Email:</label>
                    <input type="email" placeholder="Ex: josecarlos@gmail.com" name="email" id="email" required="">
                </div>
                <div class="field">
                    <label for="tel">Telefone:</label>
                    <input type="tel" placeholder="Ex: (88) 91231-3123" name="telefone" id="telefone">
                </div>
            </div>
			<input id="token" type="hidden" value="<?= $token; ?>" name="token">
            <div class="one field">
                <div class="field">
                    <button type="submit" id="go" class="ui right floated green button" name="action">Enviar</button>
                </div>
            </div>
        </form>

    </div>
</section>

<?php require '../templates/footer.php'; ?>
