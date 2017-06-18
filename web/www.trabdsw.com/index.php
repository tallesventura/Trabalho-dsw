<?php

    include_once 'config.php';
    include_once 'constructor.php';

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
