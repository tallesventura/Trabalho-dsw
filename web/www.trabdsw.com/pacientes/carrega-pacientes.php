<?php
if (!isset($_SESSION)) { session_start(); }

include_once '../config.php';

// abrindo a conexão com o banco
$con = mysqli_connect(  DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME );
if(isset($_GET["name"])){
    $nome_pesq = $_GET["name"];
    $query = "SELECT * FROM `pacientes` WHERE `nome` LIKE '%$nome_pesq%' ORDER BY `nome`";
}else{
    $query = "SELECT * FROM `pacientes` ORDER BY `nome`";
}
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
                    <label><?php echo $paciente["nome"]; ?></label>
                </div>
                <!-- ações -->
                <div class="barra-acoes-paciente" draggable="false">
                    <button class="btn-paciente" onclick="editar_paciente(this)" title="Editar" draggable="false"> <img src="../imagens/editar.svg" alt="Editar" draggable="false"></button>
                    <button class="btn-paciente" onclick="excluir_paciente(this)" title="Excluir" draggable="false"> <img src="../imagens/remover.svg" alt="Excluir" draggable="false"></button>
                    <button class="btn-paciente" onclick="visualizar_paciente(this)" title="Visualizar" draggable="false"> <img src="../imagens/visualizar.svg" alt="Visualizar" draggable="false"></button>
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
            <label>ID: </label><label class="id_paciente"><?php echo $paciente["id"] ?></label><br>
            <label>Sexo: </label><label><?php echo $paciente["sexo"] ?></label><br>
            <label>Nascimento: </label><label><?php echo $paciente["nascimento"] ?></label><br>
            <label>Telefone: </label><label><?php echo $paciente["telefone"] ?></label><br>
            <label>Endereço: </label><label><?php echo $paciente["endereco"] ?></label><br>
            <label>Observações: </label><label><?php echo $paciente["observacoes"] ?></label><br>
        </div>
    </div>

<?php endforeach; ?>