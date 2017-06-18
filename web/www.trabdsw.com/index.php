<?php

    include_once 'config.php';
    include_once 'constructor.php';
    include_once 'login_controller.php';

    // recebendo os valores do POST de forma correta (PHP 5.4 ou superior)
    // Tipos: INPUT_GET, INPUT_POST, INPUT_COOKIE, INPUT_SERVER, INPUT_ENV,
    // Poém, o INPUT_SESSION e o INPUT_REQUEST ainda não foram implementados.
    $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);

    // removendo caracteres especiais para evitar SQL Injection
    $login = htmlspecialchars( str_replace( "'", "", str_replace('"', '', $login) ) , ENT_QUOTES );
    $senha = htmlspecialchars( str_replace( "'", "", str_replace('"', '', $senha) ) , ENT_QUOTES );

    if ($login != "" && $senha != "")
    {

        $remember = false;
        if(isset($_POST['remember'])){
            $remember = true;
        }

        $session = LoginController::getInstance();
        $session->login($login, $senha, $remember, false);
        if ($session->isLogged())
        {
            Header('location: pacientes/home-pacientes.php');
        }
        else
        {
            Header('location: index.php');
        }
    }

?>

<html>

<?php
    $c = Constructor::getInstance();
    $c->setTitle("Login");
    $c->addJavaScript('libs/jquery/jquery-3.2.1.min.js');
    $c->resetCSS();
    $c->addCSS('libs/css/normalize.css');
    $c->addCSS('estilos/styles.css');
    echo Constructor::getInstance()->getHead();
?>

<body>
<div id="caixa-login">
    <div id="cabecalho-login">
        <label>Login</label>
    </div>
    <form method="POST" action="login/login.php">
        <div id="caixa-usuario">
            <label for="usuario">Usuario</label>
            <input id="usuario" type="text" name="usuario" placeholder="Usuario">
        </div>
        <div id="caixa-senha">
            <label for="senha">Senha</label>
            <input id="senha" type="password" name="senha" placeholder="Senha">
        </div>
        <div id="caixa-remember">
            <input id="remember" type="checkbox" name="remember" value="remember">
            <label>Manter-se conectado</label>
        </div>
        <input type="submit" name="enviar">
    </form>
</div>

</body>
</html>
