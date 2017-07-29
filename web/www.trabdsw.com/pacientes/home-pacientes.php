<?php
if (!isset($_SESSION)) { session_start(); }

include_once '../constructor.php';
include_once '../config.php';
require '../login/verifica_sessao.php';

?>

<html>

<?php
    $c = Constructor::getInstance();
    $c->addJavaScript('../libs/jquery/jquery-3.2.1.min.js');
    $c->addJavaScript('js/acoes_paciente.js');
    $c->addCSS('../libs/css/normalize.css');
    $c->addCSS('../estilos/styles.css');

    // Adicionando o script de deslogar e  de arrastar e soltar
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

                // carregando os pacientes
                $('#coluna-pacientes').load('carrega-pacientes.php');


            });

            function allowDrop(ev) {
                ev.preventDefault();
                ev.dataTransfer.dropEffetc = 'move';
            }

            function drag(ev) {
                ev.dataTransfer.setData('text', ev.target.id);
                ev.dropEffetc = 'move';
            }

            function drop(ev, element) {
                ev.preventDefault();
                var data = ev.dataTransfer.getData('text');
                element.before(document.getElementById(data));
            }
        </script>"
    );

    // gerando a <head>
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
            <li><a href="home-pacientes.php">Página inicial</a></li>
            <li><a href="cadastro-pacientes.php">Cadastrar pacientes</a></li>
            <li><a href="paciente_exibir.php">Exibir pacientes</a></li>
            <!-- <li><a href="../mensagens/mensagens.php">Mensagens</a></li> -->
            <li id="sair" style="float:right"><a href="#">Sair</a></li>
        </ul>
    </div>

    <div id="corpo-pagina">

        <div id="barra-lateral">

            <div id="cabecalho-barra-lateral">
                <p>Bem vindo, <?php echo $_SESSION['user_name'] ?>.</p>
                <p id="data"><?php echo date("l, d/m/Y") ?></p>
            </div>
            <div id="caixa-pesquisa">
                <label for="nomePaciente">Pesquisar:</label>
                <input id="nomePaciente" type="text" name="nomePaciente" placeholder="Nome do Paciente">
                <input id="icone-buscar" type="image" src="../imagens/buscar.svg" alt="Pesquisar">
            </div>
        </div>

        <div id="coluna-pacientes">

        </div>

    </div>
</body>
</html>
