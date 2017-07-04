<?php
if (!isset($_SESSION)) { session_start(); }

include_once '../constructor.php';
include_once '../config.php';
require '../login/verifica_sessao.php';

// abrindo a conexão com o banco
$con = mysqli_connect(  DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME );
$query = "SELECT * FROM `pacientes` ORDER BY `nome`";
$result = mysqli_query($con, $query);

$pacientes = array();

// pegando a lista de pacientes no banco
while( $p = mysqli_fetch_array($result)){
    $endr = $p["rua"] . ', ' . $p["numero"] . ', ' . $p["bairro"] .
        ', ' . $p["cidade"] . ' - ' . $p["estado"];
    array_push($pacientes, array(
            "id" => $p["id"],
            "nome" => $p["nome"],
            "sexo" => $p["sexo"],
            "nascimento" => $p["nascimento"],
            "telefone" => $p["telefone"],
            "endereco" => $endr,
            "observacoes" => $p["observacoes"]
            ));
}

// fechando a conexão com o banco
mysqli_close($con);

$count = 0;

?>

<html>

<?php
    $c = Constructor::getInstance();
    $c->addJavaScript('../libs/jquery/jquery-3.2.1.min.js');
    $c->addCSS('../libs/css/normalize.css');
    $c->addCSS('../estilos/styles.css');

    // Adicionando o script de deslogar
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
            <?php foreach($pacientes as $paciente): ?>
                <!-- Paciente -->
                <div id="<?php echo $count++ ?>" class="caixa-paciente" draggable="true" ondragstart="drag(event)"
                    ondrop="drop(event, this)" ondragover="allowDrop(event)">
                    <!-- cabeçalho -->
                    <div class="cabecalho-paciente" draggable="false">
                        <!-- menu -->
                        <div class="menu-paciente" draggable="false">
                            <!-- nome -->
                            <div class="caixa-nome-paciente" draggable="false">
                                <label> <?php echo $paciente["nome"]; ?> </label>
                            </div>
                            <!-- ações -->
                            <div class="barra-acoes-paciente" draggable="false">
                                <button class="btn-paciente" title="Editar" draggable="false"> <img src="../imagens/editar.svg" alt="Editar" draggable="false"></button>
                                <button class="btn-paciente" title="Excluir" draggable="false"> <img src="../imagens/remover.svg" alt="Excluir" draggable="false"></button>
                                <button class="btn-paciente" title="Visualizar" draggable="false"> <img src="../imagens/visualizar.svg" alt="Visualizar" draggable="false"></button>
                            </div>
                        </div>
                        <!-- foto
                        <div>
                            <img class="foto-paciente" src="<?php echo $paciente['foto'] ?>" alt="Foto do paciente">
                        </div>
                        -->
                    </div>
                    <!-- corpo -->
                    <div class="corpo-paciente">
                        <label id="id_paciente">ID: <?php echo $paciente["id"] ?></label><br>
                        <label id="sexo">Sexo: <?php echo $paciente["sexo"] ?></label><br>
                        <label id="nascimento">Nascimento: <?php echo $paciente["nascimento"] ?></label><br>
                        <label id="telefone">Telefone: <?php echo $paciente["telefone"] ?></label><br>
                        <label id="endereco">Endereço: <?php echo $paciente["endereco"] ?></label><br>
                        <label id="observacoes">Observações: <?php echo $paciente["observacoes"] ?></label><br>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>

    </div>
</body>
</html>
