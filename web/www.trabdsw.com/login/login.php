<?php
if (!isset($_SESSION)) { session_start(); }

include_once '../config.php';

define("TAM_AUTH_KEY", 128);

$logado = false;
$usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_SPECIAL_CHARS);
$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);

// removendo caracteres especiais para evitar SQL Injection
$usuario = htmlspecialchars( str_replace( "'", "", str_replace('"', '', $usuario) ) , ENT_QUOTES );
$senha = htmlspecialchars( str_replace( "'", "", str_replace('"', '', $senha) ) , ENT_QUOTES );
// verifica se login ou senha estão vazios
if($usuario != "" && $senha != ""){
    $senha = hash('sha256',$senha); //faz o hash da senha


    // Inicia a conexão com o banco
    $con = mysqli_connect(  DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME );
    $query = "SELECT * FROM usuarios WHERE login = '". $usuario. "' AND senha = '".$senha."' LIMIT 1";
    $sql = mysqli_query($con, $query);

    // A query funcionou
    if($sql){
        while ($u = mysqli_fetch_array($sql)) {

            $uID = $u['id'];
            $nome = $u['nome'];

            $_SESSION['user_id'] = $uID;
            $_SESSION['user_name'] = $nome;

            // Verificando se o usuário selecionou a opção de permanecer logado
            if(isset($_POST['remember'])){

                // Gerando um token para o cookie
                $randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
                $cookie_auth= $randomString . $uID;
                $key = sha1($cookie_auth);

                //inserindo o token do cookie no BD
                mysqli_query($con, "UPDATE usuarios SET auth_key = '". $key. "' WHERE id = '".$u['id']."'");
                //setando um cookie com duração de 30 dias
                setcookie('auth_key', $key, time() + (8400 * 30), "/");
                //echo $_COOKIE['auth_key'];
            }

            mysqli_close($con); //fecha a conexão com o banco

            $logado = true;
        }
    }

    //fecha a conexão com o banco

    if($logado){
        header("location: ".ROOTDIR."pacientes/home-pacientes.php");
        mysqli_close($con);
        exit;
    }else{
        header("location: ". ROOTDIR. "index.php");
    }

}

?>