<?php
namespace Mora\Core\View;
class Template
{
    public static function load($name,$data = []){
        foreach ($data as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include VIEW . "/Templates/" . $name . ".php";
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
    public static function print($name,$data = []){
        echo self::load($name,$data);
    }
}
