<?php

include_once '../config.php';

session_start();

// destrói o cookie
setcookie('auth_key', "", time() - 3600);

$randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
$cookie_auth= $randomString . $_SESSION['user_id'];
$key = sha1($cookie_auth);

$con = mysqli_connect(  DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME );
//inserindo o token do cookie no BD
$auth_query = mysqli_query($con, "UPDATE usuarios SET auth_key = '". $key. "' WHERE id = '".$_SESSION['user_id']."'");

if($auth_query){
    // limpa a sessão
    unset($_SESSION['user_id']);
    unset($_SESSION['user_name']);
    session_unset();
    // destrói a sessão
    session_destroy();
}

exit;

?>