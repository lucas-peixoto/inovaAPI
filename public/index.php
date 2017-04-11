<?php require '../templates/header.php'; ?>
<?php
// $data = file_get_contents('<url of that website>');
// $data = json_decode($data, true);

?>

<section id="signup-form" class="signup-form">
    <div class="ui container">

        <div class="ui header">
            <h1>Faça já sua escolha!</h1>
        </div>
        <form action="inserir.php" method="post" data-type="user" class="ui form">
            <h4 class="ui header">
                Produto
                <span class="sub header">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                </span>
            </h4>
            <input type="text" class="live-search-box" placeholder="search here" required=""/>
            <ul class="ui grid horizontal list live-search-list" style="width: 100%">
                <li class="item four wide column" value="Lorem">Lorem</li>
                <li class="item four wide column" value="ipsum">ipsum</li>
                <li class="item four wide column" value="dolor">dolor</li>
                <li class="item four wide column" value="sit">sit</li>
                <li class="item four wide column" value="amet">amet</li>
            </ul>

            <h4 class="ui header">
                Dados pessoais
                <span class="sub header">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                </span>
            </h4>
            <div class="two fields">
                <div class="field">
                    <label for="name">Nome completo:</label>
                    <input type="text" placeholder="Ex: José Carlos Saraiva Neto" name="nome" id="name" required="">
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
            <div class="one field">
                <div class="field">
                    <button type="submit" class="ui right floated green button" name="action" value="cad_user">Enviar</button>
                </div>
            </div>
        </form>

    </div>
</section>

<?php require '../templates/footer.php'; ?>
