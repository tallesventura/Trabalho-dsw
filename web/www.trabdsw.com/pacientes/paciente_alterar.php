<?php
if (!isset($_SESSION)) { session_start(); }

include_once '../config.php';
require '../login/verifica_sessao.php'
?>


<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />


  <title>Alteração de Pacientes</title>


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


  <meta http-equiv="content-Type" content="text/html; charset=iso-8859-1" />

  <script src="js/Paciente.js" type="text/javascript"></script>
  <script src="js/cidades-estados.js" type="text/javascript"></script>

  <script type="text/javascript">
    function altEstado(vEstado) {
      if (vEstado == 0){
        new dgCidadesEstados(
          document.getElementById('estado2'),
          document.getElementById('cidade2'),
          true
          );
      }
    }
  </script>
</meta>


<?php

$id = $_GET['id'];

$conn = mysqli_connect(  DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME );
$sql = "SELECT * FROM pacientes WHERE id = '$id'";

$resultado = mysqli_query($conn,$sql) or die ("Não foi possível executar a consulta");

while ($linha = mysqli_fetch_array($resultado)) {
  $nome = $linha[1];
  $rg = $linha[2];
  $cpf = $linha[3];
  $data_nascimento = $linha[4];
  $data_nascimento = explode("-", $data_nascimento);
  $data_nascimento = $data_nascimento[2]."/".$data_nascimento[1]."/".$data_nascimento[0];
  $info = $linha[5];
  $sexo = $linha[6];
  $telefone = $linha[12];
  $estado = $linha[7];
  $cidade = $linha[8];
  $bairro = $linha[9];
  $rua = $linha[10];
  $numero = $linha[11];

  ?>

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

  <form name ="form" method ="POST" action ="paciente_alterandobanco.php" >
    <p>&nbsp;</p>
    <table width="575" height="27" border="0" align="center">
      <tr>

        <td width="261" align="center"><a href="paciente_exibir.php">Exibir</a></td>
      </tr>
    </table>

    <p>&nbsp;</p>

    <table width="500" cellpadding="5"  border="1" bordercolor="black" bgcolor = ""  align = "center">
      <tr>  <th colspan="6"  ><center>Alteração de Paciente</center></th>  </tr>

      <tr>  <td> ID </td> <td align="left"><input name="id"  READONLY type = "text"  size="6" value=" <?php  echo $id; ?>" ></td></tr>
      <tr>  <td> Nome Completo </td> <td align="left"><input name="nome" type = "text"  size="60" value=" <?php  echo $nome; ?>" ></td></tr>
      <tr>  <td> RG </td> <td align="left"><input name="rg" type = "text" size = "10"  value="<?php echo $rg; ?>" ></td></tr>
      <tr>  <td> CPF  </td> <td align="left"><input name="cpf" type = "text"  size="13" maxlength="14" value="<?php echo $cpf; ?>"   onKeyUp="mascararCpf(this);"> (Somente números) </td></tr>
      <tr>  <td> Data de Nascimento </td> <td align="left"><input type ="text" size = "11" name="nascimento" maxlength="10"  value="<?php echo  $data_nascimento; ?>"  onKeyUp="mascararData(this);" ></td></tr>
      <tr>  <td> Informações </td> <td align="left"><textarea name="info"  cols=40 rows=2><?php echo $info; ?> </textarea> </td></tr>
      <tr>  <td> Sexo </td> <td align="left"><INPUT TYPE="RADIO" NAME="sexo" VALUE="masculino" checked> Masculino <INPUT TYPE="RADIO" NAME="sexo" VALUE="feminino"> Feminino</td></tr>
      <tr> <td>Telefone: </td> <td> <input type = "text" name="telefone" value="<?php echo $telefone; ?>" maxlength="14" onKeyUp="mascararTelefone(this);"  >(somente números)</td> </tr>
      <tr><td> Endereço</td> <th colspan="6" ALIGN="left">
       <label>Estado:</label>:<select id="estado2" name="estado2" onClick="javascript:altEstado(this.selectedIndex);"> <option value="<?php echo @$estado; ?>"><?php echo @$estado; ?>
     </option></select></td>
     <br><label>Cidade:</label>:<select id="cidade2" name="cidade2"> <option value="<?php echo @$cidade; ?>"><?php echo @$cidade; ?>
   </option></select><br>
   Bairro: <input name="bairro" type = "text" size = "30"  value="<?php echo  $bairro; ?>"><br>
   Rua:  <input name="rua" type = "text" size = "50"  value="<?php echo  $rua; ?>" ><br>
   Numero: <input name="numero" type = "text" size = "5"  value="<?php echo  $numero; } ?>" >

 </th>
</tr>

<tr><th colspan="6"> <p align ="center"><input type="submit" name="enviar" value="Confirmar" onClick="validarCadastro(this.form);"/>
  <input type="reset" name="limpar" value="Limpar Dados"/></p></th></tr>

</table>

</form>

</body>
</html>
