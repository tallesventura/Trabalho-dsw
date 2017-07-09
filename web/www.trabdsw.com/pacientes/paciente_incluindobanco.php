<?php

if (!isset($_SESSION)) { session_start(); }

include_once '../config.php';
require '../login/verifica_sessao.php';


$nome = $_POST['nome'];
$rg = $_POST['rg'];
$cpf = $_POST['cpf'];
$nascimento = $_POST['nascimento'];
$nascimento = explode("/", $nascimento);
$nascimento = $nascimento[2]."-".$nascimento[1]."-".$nascimento[0];

$observacoes = $_POST['info'];
$sexo = $_POST['sexo'];
$telefone = $_POST['telefone'];
$estado = $_POST['estado'];
$cidade = $_POST['cidade'];
$bairro = $_POST['bairro'];
$rua = $_POST['rua'];
$numero = $_POST['numero'];


$conn = mysqli_connect(  DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME );
$sql = "INSERT INTO pacientes VALUES (null,'$nome','$rg','$cpf','$nascimento','$observacoes','$sexo','$telefone','$estado','$cidade','$bairro','$rua','$numero')";
 //$sql_exec = mysqli_query($sql) or die("Erro: " .mysqli_error());
 $sql_exec = mysqli_query($conn,$sql) or die("Erro de Execução: " .mysqli_error($conn));

mysqli_close($conn);

  //Verifica se o comando foi executado com sucesso
 if(!$sql_exec){
   die("Falha ao executar o comando: " . mysqli_error());
 }else {
 }
 ?>



<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>PACIENTE INCLUIDO</title>

<link rel="stylesheet" type="text/css" href="../estilos/styles.css">
<link href="ESTILOS/estrutura.css" rel="stylesheet" type="text/css" />


</head>

<body>


 <table width="420" cellpadding="5"  border="2" bordercolor="black" >
                <tr>  <th colspan="6" bgcolor = #BEBEBE ><center>
                      Informações Cadastradas
                </center></th>  </tr>

                <tr>  <td> Nome Completo </td> <td>  <?php echo "$nome"; ?></td></tr>
                <tr>  <td> RG </td> <td> <?php echo "$rg";  ?> </td></tr>
                <tr>  <td> CPF  </td> <td><?php echo "$cpf"; ?> </td></tr>
                <tr>  <td> Data de Nascimento </td> <td><?php echo "$nascimento"; ?></td></tr>
                <tr>  <td> Sexo </td> <td><?php echo "$sexo"; ?></td></tr>
               <tr>  <td> Informações </td> <td><textarea cols=40 rows=2><?php echo "$observacoes"; ?></textarea> </td></tr>
				<tr>  <td> Telefone </td> <td><?php echo "$telefone"; ?></td></tr>
                <tr>  <td> Endereço </td><td>Estado: <?php echo "$estado"; ?><br>
                                              Cidade: <?php echo "$cidade"; ?><br>
				                              Bairro: <?php echo "$bairro"; ?> <br>
					                            Rua:  <?php echo "$rua"; ?><br>
					                          Numero: <?php echo "$numero"; ?>
					                         
</table>
<br>
<script>alert("Paciente cadastrado com sucesso!");</script>
  <center><a href="paciente_exibir.php">Voltar</a></center>
</div>

</body>
</html>
