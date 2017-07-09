$(function(){
    $('#nomePaciente').keyup(function(){
        var query = $("#nomePaciente").val();
        $("#coluna-pacientes").empty();
        $.get('carrega-pacientes.php', {"name": query}, function(data){
            //alert(data);
            $("#coluna-pacientes").html(data);
        });
    });
});

function excluir_paciente(elemento){

    var div_paciente = $(elemento).parent().parent().parent().parent();
    var id = $(div_paciente).find(".id_paciente").text();

    if(confirm("Tem certeza que deseja excluir o paciente?")){
        $.get("paciente_excluir.php", {"id": id}, function(data,status){
            $("#coluna-pacientes").empty();
            $("#coluna-pacientes").load('carrega-pacientes.php');
        });
    }
}

function editar_paciente(elemento){

    var div_paciente = $(elemento).parent().parent().parent().parent();
    var id = $(div_paciente).find(".id_paciente").text();
    window.location.replace("paciente_alterar.php?id="+id);
}

function visualizar_paciente(elemento){

    var div_nome = $(elemento).parent().parent().find(".caixa-nome-paciente");
    var nome = $(div_nome).find("label").text();
    window.location.replace("paciente_exibir.php?txtBusca="+nome);
}
