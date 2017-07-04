<?php

if (!isset($_SESSION)) { session_start(); }

include_once '../config.php';
require '../login/verifica_sessao.php';

?>


<HTML>
<HEAD>
 <TITLE>:: Apagando um Paciente ::</TITLE>
</HEAD>
<BODY>
<?php

 $id = $_GET['id'];
 include("conexao.php");

 $conn = mysqli_connect(  DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME );
 $sql = "DELETE FROM pacientes WHERE id = $id";
 $sql_exec = mysqli_query($conn,$sql) or die("Erro: " .mysqli_error($conn));
?>
   <script type="text/javascript">
  alert(" Paciente Excluido com Sucesso!");

  window.location="paciente_exibir.php";
  </script>

</BODY>
</HTML>
