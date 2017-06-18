<?php

include_once 'config.php';

class Constructor
{

    private static $instance;
    private $logged_in,
            $charset,
            $title,
            $extra,
            $js,
            $css;

    private function __construct()
    {
        $this->logged_in = false;
        $this->charset = CHARSET;
        $this->title = '';
        $this->extra = array();
        $this->js = array();
        $this->css = array();
    }

    // Utilizando o padrão de projeto Singleton
    public static function getInstance()
    {
        if (!isset(self::$instance))
        {
            $c = __CLASS__;
            self::$instance = new $c;
        }

        return self::$instance;
    }

    public function __clone()
    {trigger_error('Clone is not allowed.', E_USER_ERROR);}

    public function getHead()
    {
        return '<head>'             ."\n".
                $this->getCharset() ."\n".
                $this->getTitle()   ."\n".
                $this->getJavaScript()."\n".
                $this->getCSS()       ."\n".
                $this->getExtra()   ."\n".
               "</head>\n";
    }

    private function getCharset()
    {
        if ($this->charset == NULL)
        {
            return "<meta charset='".CHARSET."' />";
        } else {
            return "<meta charset='".$this->charset."'/>";
        }
    }

    private function getTitle()
    {
        return '<title>'.
                $this->title.
               '</title>';
    }

    private function getExtra()
    {
        $retorno = '';
        foreach ($this->extra as $s) {
            $retorno.= $s;
        }

        return $retorno;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function addJavaScript( $javaScript ) {
        array_push($this->js, $javaScript);
    }

    private function getJavaScript() {

        $retorno = '';
        foreach ($this->js as $s) {
            $retorno.="<script src=\"$s\"></script>\n";
        }
        return $retorno;
    }

    public function addCSS( $stylesheet ) {
        array_push($this->css, $stylesheet);
    }

    private function getCSS() {

        $retorno = '';
        foreach ($this->css as $s) {
            $retorno.="<link rel=\"stylesheet\" href=\"$s\">\n";
        }
        return $retorno;
    }

    public function addExtra($ex){
        array_push($this->extra, $ex);
    }

    public function setCharset($ch){
        $this->charset = $ch;
    }

    public function resetCSS(){
        $this->css = array();
    }

    // Crie as funções:
    // setCharset, addJavaScript, addCSS, addExtra
}
