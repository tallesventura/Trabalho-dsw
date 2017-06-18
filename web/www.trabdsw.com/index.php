<?php

    include_once 'config.php';
    include_once 'constructor.php';

    session_start();
    if(isset($_COOKIE['auth_key'])){
        $key = $_COOKIE['auth_key'];

        $con = mysqli_connect(  DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME );
        $query = "SELECT id, nome FROM usuarios WHERE auth_key = '". $key."' LIMIT 1";
        $sql = mysqli_query($con, $query);
        mysqli_close($con);

        if($sql){

            while ($u = mysqli_fetch_array($sql)) {
                $_SESSION['user_id'] = $u['id'];
                $_SESSION['user_name'] = $u['nome'];

                header("location: ". ROOTDIR. "pacientes/home-pacientes.php");
                exit;
            }
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
