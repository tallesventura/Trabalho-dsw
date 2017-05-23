
<?php include "templates/header.php" ?>

<!-- Cabeçalho -->
<div>
    <div>
        <p> Desenvolvimento de Sistemas para WEB - Programar para aprender a programar </p>
    </div>
    <div>
        <div>
            <label>Pesquisar por paciente: </label>
            <input type="text" name="txtPesquisa">
            <button> <img src="http://placehold.it/15x15" alt="Pesquisar"> </button>
        </div>
        <div>
            <button> <img src="http://placehold.it/15x15" alt="Sair"> </button>
        </div>
    </div>
    <div>
        <p>Domingo, 14 de Maio de 2017</p>
        <img src="http://placehold.it/20x20" alt="Calendário">
    </div>
</div>

<!-- Corpo -->
<div>
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
    <div>
        <?php include "templates/template_paciente.php" ?>
    </div>
</div>

<?php include "templates/footer.php" ?>
