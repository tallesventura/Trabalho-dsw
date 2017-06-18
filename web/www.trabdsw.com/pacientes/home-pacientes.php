
<?php

include_once '../constructor.php';

session_start();
if(!isset($_SESSION['user_name'])){
    header('location: ../index.php');
    exit;
}

$pacientes = array(
    array("nome"=>"Talles", "foto"=>"http://via.placeholder.com/75x75"),
    array("nome"=>"Fulano", "foto"=>"http://via.placeholder.com/75x75"),
    array("nome"=>"Ciclano", "foto"=>"http://via.placeholder.com/75x75"),
    array("nome"=>"Josiclano", "foto"=>"http://via.placeholder.com/75x75"),
    array("nome"=>"João", "foto"=>"http://via.placeholder.com/75x75"),
    array("nome"=>"José", "foto"=>"http://via.placeholder.com/75x75"));
?>

<html>

<?php
    $c = Constructor::getInstance();
    $c->addJavaScript('../libs/jquery/jquery-3.2.1.min.js');
    $c->addCSS('../libs/css/normalize.css');
    $c->addCSS('../estilos/styles.css');
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
            <li><a href="index.php">Página inicial</a></li>
            <li><a href="cadastro-pacientes.php">Cadastrar pacientes</a></li>
            <li style="float:right"><a href="#">Sair</a></li>
        </ul>
    </div>

    <div id="corpo-pagina">

        <div id="barra-lateral">

            <div id="cabecalho-barra-lateral">
                <p>Bem vindo, Fulano.</p>
                <p id="data">Quinta-feira, 1 de Junho de 2017</p>
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
                <div class="caixa-paciente">
                    <!-- cabeçalho -->
                    <div class="cabecalho-paciente">
                        <!-- menu -->
                        <div class="menu-paciente">
                            <!-- nome -->
                            <div class="caixa-nome-paciente">
                                <label> <?php echo $paciente["nome"]; ?> </label>
                            </div>
                            <!-- ações -->
                            <div class="barra-acoes-paciente">
                                <button class="btn-paciente"> <img src="../imagens/editar.svg" alt="Editar"></button>
                                <button class="btn-paciente"> <img src="../imagens/remover.svg" alt="Excluir"></button>
                            </div>
                        </div>
                        <!-- foto -->
                        <div>
                            <img class="foto-paciente" src="<?php echo $paciente['foto'] ?>" alt="Foto do paciente">
                        </div>
                    </div>
                    <!-- corpo -->
                    <div class="corpo-paciente">
                        <label>Telefone:</label><br>
                        <label>Endereço:</label><br>
                        <label>Email:</label><br>
                        <label>Observações:</label><br>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>

    </div>
</body>
</html>
