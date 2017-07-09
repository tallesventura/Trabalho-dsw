<?php
if (!isset($_SESSION)) { session_start(); }

include_once '../config.php';
require '../login/verifica_sessao.php'
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


  <title>Paciente Alterando Banco</title>


  <style type="text/css">
    body {


      background-color: #66B9BF;
      background-image: url();
    }
  </style>

</head>

<body>


  <?php

  $id = $_POST['id'];
  $nome = $_POST['nome'];
  $rg = $_POST['rg'];
  $cpf = $_POST['cpf'];
  $data_nascimento = $_POST['nascimento'];
  $data_nascimento = explode("/", $data_nascimento);
  $data_nascimento = $data_nascimento[2]."-".$data_nascimento[1]."-".$data_nascimento[0];
  $info = $_POST['info'];
  $sexo = $_POST['sexo'];
  $estado = $_POST['estado2'];
  $cidade = $_POST['cidade2'];
  $bairro = $_POST['bairro'];
  $rua = $_POST['rua'];
  $numero = $_POST['numero'];
  $telefone = $_POST['telefone'];

  $conn = mysqli_connect(  DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME );
  $sql = " UPDATE pacientes SET NOME = '$nome', RG='$rg', CPF='$cpf' , NASCIMENTO='$data_nascimento', observacoes ='$info', SEXO='$sexo', ESTADO ='$estado', CIDADE='$cidade', BAIRRO='$bairro', RUA='$rua', NUMERO='$numero', TELEFONE='$telefone' WHERE id= '$id'";
 // Executa o comando SQL
  $result = mysqli_query($conn,$sql);

  // Verifica se o comando foi executado com sucesso
  if(!$result){
    die("Falha ao executar o comando: " . mysqli_error());
  }
  else{


    ?>
    <script>alert("Paciente alterado com sucesso!");
     window.location="paciente_exibir.php";
   </script>

   <?php
 }

 ?>



</body>
<!-- InstanceEnd -->
</html>
