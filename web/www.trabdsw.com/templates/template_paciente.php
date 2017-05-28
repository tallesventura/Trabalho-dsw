
<?php
$pacientes = array(
    array("nome"=>"Talles", "foto"=>"http://placehold.it/75x75"),
    array("nome"=>"Fulano", "foto"=>"http://placehold.it/75x75"),
    array("nome"=>"Ciclano", "foto"=>"http://placehold.it/75x75"));
    ?>

    <?php foreach($pacientes as $paciente): ?>
        <!-- Paciente -->
        <div class="caixa-paciente">
            <!-- cabeçalho -->
            <div id="cabecalho-paciente" class="caixa-flex">
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
                <div class="caixa-foto caixa-flex">
                    <img id="foto-paciente" src="<?php echo $paciente['foto'] ?>" alt="Foto do paciente">
                </div>
            </div>
            <!-- corpo -->
            <div id="corpo-paciente">
                <labe>Dados: <br></labe>
                <div>

                </div>
            </div>
        </div>

    <?php endforeach; ?>