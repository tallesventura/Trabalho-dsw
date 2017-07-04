<?php

if (!isset($_SESSION)) { session_start(); }

include_once '../config.php';
require '../login/verifica_sessao.php';

?>


<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"  />


  <title>Listar Pacientes</title>


  <style type="text/css">
    body {
      background-color: #66B9BF;
      background-image: url();
    }
  </style>

  <link rel="stylesheet" type="text/css" href="../estilos/styles.css">

  <script type="text/javascript" src="../libs/jquery/jquery-3.2.1.min.js"></script>
  <script type="text/javascript">
     $(function(){
       $('#sair').click(function(){
         //alert("Entrou no click");
         if(confirm('Tem certeza de que deseja se deslogar?')){
           $.get('../login/deslogar.php',function(data){
             //alert("entrou no get");
             window.location.replace("<?php echo ROOTDIR.'index.php' ?>");
           });
         }
       })
     })
  </script>

</head>

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

  <form name="formBusca" action="" method="get" >
   <p>&nbsp;	</p>

   <p>&nbsp;</p>
   <table align="center">
     <tr>
       <td>Pesquisa: </td>
       <td><input name="txtBusca" type="text" value="" /></td>
       <td><input type="submit" name="enviar" value="Pesquisar Paciente"></td>
     </tr>
   </table>
 </form>



 <table border="1" width="100%" align="center">

  <tr  bgcolor = "gray">
    <th>ID</th>
    <th>NOME</th>
    <th>RG</th>
    <th>CPF</th>
    <th>Data nascimento</th>
    <th>Informações</th>
    <th>Sexo</th>
    <th>Telefone</th>
    <th>Ações</th>


  </tr>

  <?php
  if (isset($_GET['txtBusca'])){
    $busca = $_GET['txtBusca'];
    $sql = "SELECT * FROM pacientes WHERE NOME like '%$busca%'";
  }else{
    $sql = "SELECT * FROM pacientes";
  }

  $conn = mysqli_connect(  DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME );
  $resultado = mysqli_query($conn,$sql);
  $num_paciente = mysqli_num_rows($resultado);
  while($linha = mysqli_fetch_array($resultado)){

   $data_nascimento = $linha[4];
   $data_nascimento = explode("-", $data_nascimento);
   $data_nascimento = $data_nascimento[2]."/".$data_nascimento[1]."/".$data_nascimento[0];



   ?>
   <tr>
    <td bgcolor="#D3D3D3">&nbsp;<?php echo $linha[0]; ?></td>
    <td>&nbsp;<?php echo $linha[1]; ?></td>
    <td>&nbsp;<?php echo $linha[2]; ?></td>
    <td>&nbsp;<?php echo $linha[3]; ?></td>
    <td>&nbsp;<?php echo $data_nascimento ?></td>
    <td>&nbsp;<?php echo $linha[5]; ?></td>
    <td>&nbsp;<?php echo $linha[6]; ?></td>
    <td>&nbsp;<?php echo $linha[7]; ?></td>


    <td align="center"><a href="paciente_alterar.php?id=<?php echo $linha[0]; ?>">Alterar</a> | <a href="paciente_excluir.php?id=<?php echo $linha[0]; ?>">Excluir</a>
    </tr>
    <?php
  // fim da estrutura de repetiÃ§Ã£o
  }
  ?>

</table><br>
<?php
echo "<center>Foram encontrados $num_paciente Pacientes(s)</center>";
?>

</body>
</html>
