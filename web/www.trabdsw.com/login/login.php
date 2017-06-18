<?php

include_once '../config.php';

$logado = false;
$usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_SPECIAL_CHARS);
$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);

// removendo caracteres especiais para evitar SQL Injection
$usuario = htmlspecialchars( str_replace( "'", "", str_replace('"', '', $usuario) ) , ENT_QUOTES );
$senha = htmlspecialchars( str_replace( "'", "", str_replace('"', '', $senha) ) , ENT_QUOTES );

if($usuario != "" && $senha != ""){
    $senha = hash('sha256',$senha);
    session_start();

    $con = mysqli_connect(  DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME );
    $query = "SELECT * FROM usuarios WHERE login = '". $usuario. "' AND senha = '".$senha."' LIMIT 1";
    $sql = mysqli_query($con, $query);

    if($sql){
        while ($u = mysqli_fetch_array($sql)) {

            $uID = $u['id'];
            $nome = $u['nome'];
            //echo "mysql<br>";
            //echo $uID."<br>";
            //echo $nome;

            session_start();
            $_SESSION['user_id'] = $uID;
            $_SESSION['user_name'] = $nome;
            mysqli_close($con);

            $logado = true;
        }
    }

    if($logado){
        header("location: ../pacientes/home-pacientes.php");
    }else{
        header("location: ../index.php");
    }

    mysqli_close($con);

    //echo 'sessao'."<br>";
    //echo $_SESSION['user_id']."<br>";
    //echo $_SESSION['user_name'];
    //PASSWORD('".$senha."')
}

?>