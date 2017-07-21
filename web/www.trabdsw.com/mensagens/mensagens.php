<?php

if (!isset($_SESSION)) { session_start(); }

include_once '../constructor.php';
include_once '../config.php';
require '../login/verifica_sessao.php';

?>

<html>

<?php
    $c = Constructor::getInstance();
    $c->setTitle("Mensagens");
    $c->addJavaScript("../libs/jquery/jquery-3.2.1.min.js");
    $c->addCSS('../libs/css/normalize.css');
    $c->addCSS('../estilos/styles.css');
    $c->addCSS('css/estilo_mensagens.css');


    echo Constructor::getInstance()->getHead();
?>

<body>


<div id="container">

    <div id="container-mensagens">
        <div id="cabecalho-msg">
            <div id="caixa-img-cabecalho-msg">
                <img src="http://via.placeholder.com/40x40">
            </div>
            <div id="titulo-cabecalho-msg">
                Mensagens
            </div>
        </div>
        <div id="caixa-mensagens">
            <div class="mensagem">
               <!--  <div class="caixa-img-msg">
                    <img src="http://via.placeholder.com/50x40">
                </div> -->
                <div class="corpo-msg">
                    <div class="remetente"> <span>aaaaaaaa</span></div>
                    <div class="conteudo"> <p>dsdsadsdda</p></div>
                </div>
            </div>
        </div>
    </div>
    </div>

</body>
</html>