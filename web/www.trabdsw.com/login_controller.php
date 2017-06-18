<?php


include_once('config.php');

define("TAM_TOKEN", 128);

class LoginController {

    private static $instance;
    private $con;
    private $logged_in;

    private function __construct() {}


    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            $c = __CLASS__;
            self::$instance = new $c;
        }

        return self::$instance;
    }


    public function __clone()
    {trigger_error('Clone is not allowed.', E_USER_ERROR);}


    private function getCon()
    {
        if (!isset($this->con))
        {
            $this->con = mysqli_connect(  DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME );
        }
        return $this->con;
    }


    private function closeCon()
    {
        if (!isset($this->con)){
            mysqli_close( $this->con );
        }
    }


    public function isLogged()
    {
        $this->checkSession();
        return $this->logged_in;
    }


    public function checkSession()
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        $this->logged_in = isset($_SESSION['user_name']);

        // Verifica se o cookie está definido
        if( isset($_COOKIE['auth_key']) )
        {
            $auth_key = $_COOKIE['auth_key'];

            if($this->logged_in === false)
            {
                $query = "SELECT user_id, password FROM users WHERE auth_key = '" . $auth_key . "' LIMIT 1";
                $auth_key_query = mysqli_query(self::getCon(), $query);
                $this->closeCon();

                if( $auth_key_query === false )
                {
                    setcookie("auth_key", "", time() - 3600);
                }
                else
                {
                    while( $u = mysqli_fetch_array($auth_key_query) )
                    {
                        $this->login($u['id'], $u['senha'], true, false);
                    }
                }
            }
            else
            {
                setcookie("auth_key", "", time() - 3600);
            }
        }
    }

    public function login($login, $password, $remember = false, $plain = true){

        $this->logged_in = false;

        if ($plain){
            $password = "PASSWORD('".$password."')";
        } else {
            $password = "'".$password."'";
        }
        $query = "SELECT * FROM `usuarios` WHERE senha = " . $password . " AND login = '" . $login ."' LIMIT 1";
        $sql = mysqli_query( self::getCon(), $query );

        // Se a Query não retornar sucesso.
        if($sql === false)
        {
            return false;
        }
        else
        {
            while($u = mysqli_fetch_array($sql))
            {
                $user_id = $u['id'];
                $session_username = $u['nome'];

                // Check if user wants account to be saved in cookie
                if($remember)
                {
                    // Generate new auth key for each log in (so old auth key can not be used multiple times in case
                    // of cookie hijacking)
                    $auth_key = random_bytes(128);
                    mysqli_query($this->getCon(), "UPDATE usuarios SET auth_key = '" . $auth_key . "' WHERE id = '" . $user_id . "'");

                    setcookie("auth_key", $auth_key, time() + (86400 * 30), "/", false, true);
                }
                // Assign variables to session
                session_regenerate_id(true);

                session_start();
                $_SESSION['user_id']    = $user_id;
                $_SESSION['user_name']  = $session_username;
                $_SESSION['user_lastactive'] = time();


                $this->closeCon();
                $this->logged_in = true;
                return true;
            }
        }
    }

    public function logout()
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        $user_id  = $_SESSION['user_id'];
        // Apagando o cookie

        setcookie("auth_key", "", time() - 3600);
        // Apagando a chave do banco de dados
        $auth_key = random_bytes(128);
        $query = "UPDATE users SET auth_key = '".$auth_key."' WHERE user_id = '" . $user_id . "'";
        $auth_query = mysqli_query(self::getCon(), $query);
        $this->closeCon();

        // Se conseguiu apagar a chave do banco de dados, então apara o restante
        if ($auth_query)
        {
            unset($_SESSION['user_id']);
            unset($_SESSION['user_name']);
            unset($_SESSION['user_lastactive']);
            $this->logged_in = false;
            session_unset();
            session_destroy();
            return true;
        }
        else
        {
            return false;
        }
    }

}


?>
