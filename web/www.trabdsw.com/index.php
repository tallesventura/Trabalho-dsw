
<?php include "templates/header.php" ?>

<!-- Cabeçalho -->
<div class="cabecalho">
    <div id="mensagem-cabecalho">
        <p> Desenvolvimento de Sistemas para WEB - Programar para aprender a programar </p>
    </div>
    <div id="cabecalho-pesquisa" class="caixa-flex">
        <div id="caixa-pesquisa">
            <label>Pesquisar por paciente: </label>
            <input type="text" name="txtPesquisa">
            <button id="btn-pesquisar"> <img src="http://placehold.it/15x15" alt="Pesquisar"> </button>
        </div>
        <div id="caixa-sair">
            <button id="btn-sair"> <img src="http://placehold.it/15x15" alt="Sair"> </button>
        </div>
    </div>
    <div id="caixa-data" class="caixa-flex">
        Domingo, 14 de Maio de 2017
        <img id="calendario" src="http://placehold.it/20x20" alt="Calendário">
    </div>
</div>

<!-- Corpo -->
<div id="corpo">
    <!-- Caixa de mensagens -->
    <div>
        <!-- Cabeçalho -->
        <div>
            <img src="http://placehold.it/20x20" alt="Caixa de mensagens">
            <p> Mensagens </p>
        </div>
        <!-- Lista de mensagens -->
        <div>
            <!-- for num mensagens -->
            <!-- Mensagem individual -->
            <div>
                <!-- ícone da mensagem (lida ou não lida) -->
                <div>
                    <img src="http://placehold.it/30x30" alt="Ícone mensagem">
                </div>
                <!-- corpo da mensagem -->
                <div>
                    <p>Talles</p>
                    <p>aaaaaaa</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Pacientes -->
    <div class="caixa-flex">
        <?php include "templates/template_paciente.php" ?>
    </div>
</div>

<?php include "templates/footer.php" ?>
