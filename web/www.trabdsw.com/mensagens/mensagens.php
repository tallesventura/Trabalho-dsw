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

    $c->addExtra(
        "<script type='text/javascript'>
            $(function(){
                $('#sair').click(function(){
                    if(confirm('Tem certeza de que deseja se deslogar?')){
                        $.get('../login/deslogar.php',function(data){
                            window.location.replace('".ROOTDIR."index.php');
                        });
                    }
                });
            });
        </script>"
    );

    echo Constructor::getInstance()->getHead();
?>

<body>

<div class="cabecalho">
    <div class="lin caixa-titulo">
        <p id="titulo">Sistema de gerenciamento de pacientes</p>
    </div>
</div>

<div class="barra-nav">
    <ul>
        <li><a href="../pacientes/home-pacientes.php">Página inicial</a></li>
        <li><a href="../pacientes/cadastro-pacientes.php">Cadastrar pacientes</a></li>
        <li><a href="../pacientes/paciente_exibir.php">Exibir pacientes</a></li>
        <li><a href="mensagens.php">Mensagens</a></li>
        <li id="sair" style="float:right"><a href="#">Sair</a></li>
    </ul>
</div>

<div id="container">

    <div id="container-mensagens">
        <div id="barra-acoes-msg">
            <button id="btn-nova-msg">Nova mensagem</button>
        </div>
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
                <div id="caixa-acoes-msg">
                    <button title="Excluir mensagem"><img src="http://via.placeholder.com/40x40" alt=""></button>
                </div>
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