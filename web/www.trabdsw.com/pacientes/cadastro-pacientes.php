
<?php
if (!isset($_SESSION)) { session_start(); }

require '../login/verifica_sessao.php'
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />


    <title>Paciente</title>

    <link href="ESTILOS/estrutura.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="../estilos/styles.css">

    <style type="text/css">
        body {
           background-color: #66B9BF;
           background-image: url();
       }
   </style>

   <script type="text/javascript" src="../libs/jquery/jquery-3.2.1.min.js"></script>
   <script type="text/javascript">
      $(function(){
        $('#sair').click(function(){
          $.get('../login/deslogar.php',function(data){
            window.location.replace(<?php ROOTDIR.'index.php' ?>);
          });
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
            <li id="sair" style="float:right"><a href="#">Sair</a></li>
        </ul>
    </div>

    <div id="todas">

        <script src="cliente.js" type="text/javascript" > </script>


        <script src="js/cidades-estados.js" type="text/javascript"></script>
        <script type="text/javascript">
            window.onload = function() {
                new dgCidadesEstados(
                    document.getElementById('estado'),
                    document.getElementById('cidade'),
                    true
                    );
            }
        </script>


        <form name ="cadastro_cliente" method ="POST" action ="Paciente_incluindobanco.php" >
          <p>&nbsp;</p>

      </table>

      <p>&nbsp;</p>
      <table width="500" cellpadding="5"  border="1" bordercolor="black" align="center" >
        <tr>  <th colspan="6"  ><center>Cadastro de Paciente</center></th>  </tr>

        <tr>  <td><label> Nome Completo </label></td> <td><input type="text" name="nome" size="60" value=""></td></tr>
        <tr>  <td><label> RG </label></td> <td align="left"><input type="text" name="rg"  size = "10"  value=""></td></tr>
        <tr>  <td> CPF  </td> <td align="left"><input type="text" name="cpf" value="" maxlength="14" onKeyUp="mascararCpf(this);"> (Somente números) </td></tr>
        <tr>  <td> Data de Nascimento </td> <td align="left"><input type="text" name="nascimento"  placeholder="dd/mm/aaaa" maxlength="10" onKeyUp="mascararData(this);"  ></td></tr>
        <tr>  <td> Informações </td > <td><textarea name="info" cols=40 rows=2></textarea></td></tr>
        <tr>  <td> Sexo </td> <td><INPUT TYPE="RADIO" NAME="sexo" VALUE="masculino"> Masculino <INPUT TYPE="RADIO" NAME="sexo" VALUE="feminino"> Feminino</td></tr>
        <tr> <td>Telefone: </td> <td> <input type = "text" name="telefone" value="" maxlength="14" onKeyUp="mascararTelefone(this);"  >(somente numeros)</td> </tr>
        <tr><td> Endereço</td> <th colspan="6" ALIGN="left">
           <p>
             <label>Estado</label>
             :
             <select id="estado" name="estado">
             </select>
             <br>
             <label>Cidade</label>
             :
             <select id="cidade" name="cidade">
             </select>


             <p>

              Bairro: <input name="bairro" type = "text" size = "30"  value=""><br>
              Rua:  <input name="rua" type = "text" size = "50"  value=""><br>
              Número: <input name="numero" type = "text" size = "5"  value="">
          </p>
      </th>
  </tr>

  <tr><th colspan="6"> <p align ="center"><input type="button" name="enviar" value="Confirmar" onClick="validarCadastro(this.form);"/>
    <input type="reset" name="limpar" value="Limpar Dados"/></p></th></tr>

</table>

</form>


</div>
<!-- InstanceEndEditable -->
</div>
</body>
<!-- InstanceEnd --></html>
