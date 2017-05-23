
<?php
    $pacientes = array(
                        array("nome"=>"Talles", "foto"=>"http://placehold.it/100x100"),
                        array("nome"=>"Fulano", "foto"=>"http://placehold.it/100x100"),
                        array("nome"=>"Ciclano", "foto"=>"http://placehold.it/100x100"));
?>

<?php foreach($pacientes as $paciente): ?>
    <!-- Paciente -->
    <div class="caixa-paciente">
        <!-- cabeçalho -->
        <div class="cabecalho">
            <!-- menu -->
            <div class="menu-paciente">
                <!-- nome -->
                <div>
                    <p> <?php echo $paciente["nome"]; ?> </p>
                </div>
                <!-- ações -->
                <div>
                    <button> <img src="http://placehold.it/15x15" alt="botão 1"> </button>
                    <button> <img src="http://placehold.it/15x15" alt="botão 2"> </button>
                    <button> <img src="http://placehold.it/15x15" alt="botão 3"> </button>
                </div>
            </div>
            <!-- foto -->
            <div class="caixa-foto">
                <img src="<?php echo $paciente['foto'] ?>" alt="Foto do paciente">
            </div>
        </div>
        <!-- corpo -->
        <div>
            <p>Dados: <br> </p>
        </div>
    </div>

<?php endforeach; ?>