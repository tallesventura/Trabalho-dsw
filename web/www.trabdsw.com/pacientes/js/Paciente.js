function mascararCpf(campo){
 if ((campo.value.length=="3") || (campo.value.length=="7")){
   campo.value = campo.value + ".";

 } if(campo.value.length=="11"){
   campo.value = campo.value + "-";
 }
}

function mascararTelefone(campo){
 if (campo.value.length=="0")  {
   campo.value = campo.value + "(";

 } if(campo.value.length=="3"){
   campo.value = campo.value + ")";
 }
   if(campo.value.length=="4"){
   campo.value = campo.value + " ";
 }
  if(campo.value.length=="9"){
   campo.value = campo.value + "-";
 }
}

function ehData(valor){
	var tipo = /^((0?[1-9]|[12]\d)\/(0?[1-9]|1[0-2])|30\/(0?[13-9]|1[0-2])|31\/(0?[13578]|1[02]))\/(19|20)?\d{2}$/;
	return tipo.test(valor);
}

function mascararData(campo){
 if ((campo.value.length=="2") || (campo.value.length=="5")){
   campo.value = campo.value + "/";
 }
}



function validarCadastro(form){

if(form.nome.value==""){
  alert("o campo nome esta vazio");
  form.nome.focus();
  return;
}

if(form.rg.value==""){
  alert("o campo RG esta vazio");
  form.rg.focus();
  return;
}

if(form.cpf.value==""){
  alert("o campo CPF esta vazio");
  form.cpf.focus();
  return;
}

if(form.nascimento.value==""){
  alert("o campo data de nascimento esta vazio");
  form.nascimento.focus();
  return;
} else if(!ehData(form.nascimento.value)){
  alert("o campo data de nascimento esta em formato invalido");
  form.nascimento.value="";
  form.nascimento.focus();
  return;
}

if(form.info.value==""){
  alert("o campo Observações esta vazio");
  form.info.focus();
  return;
}

if(form.telefone.value==""){
  alert("o campo telefone esta vazio");
  form.telefone.focus();
  return;
}

if(form.estado.value==""){
  alert("o campo estado esta vazio");
  form.estado.focus();
  return;
}

if(form.cidade.value==""){
  alert("o campo cidade esta vazio");
  form.cidade.focus();
  return;
}

if(form.bairro.value==""){
  alert("o campo bairro esta vazio");
  form.bairro.focus();
  return;
}

if(form.rua.value==""){
  alert("o campo rua esta vazio");
  form.rua.focus();
  return;
}

if(form.numero.value==""){
  alert("o campo numero esta vazio");
  form.numero.focus();
  return;
}

 form.submit();

}
