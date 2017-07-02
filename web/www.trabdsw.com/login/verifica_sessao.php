<?php
if (!isset($_SESSION)) { session_start(); }

include_once '../config.php';

$logado = false;
if(!isset($_SESSION['user_name'])){

    if(isset($_COOKIE['auth_key'])){
        $key = $_COOKIE['auth_key'];

        $con = mysqli_connect(  DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME );
        $query = "SELECT id, nome FROM usuarios WHERE auth_key = '". $key."' LIMIT 1";
        $sql = mysqli_query($con, $query);
        mysqli_close($con);

        if($sql){
            $u = mysqli_fetch_array($sql);
            if(count($u) > 0){
                $_SESSION['user_id'] = $u['id'];
                $_SESSION['user_name'] = $u['nome'];
            }else{
                header("location: ". ROOTDIR. "index.php");
                exit;
            }
        }else{
            header("location: ". ROOTDIR. "index.php");
            exit;
        }
    }else{
        header("location: ". ROOTDIR. "index.php");
        exit;
    }
}

?>