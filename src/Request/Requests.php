<?php

namespace Mora\Core\Request;

class Requests
{
    /**
     * post
     *
     * @param mixed $key
     * @param mixed $htmlspecialchars Apply the htmlspecialchars function on the value
     * @return string
     */
    public static function post($key,$htmlspecialchars = false){
        if (self::hasPost($key)) {
            if ($htmlspecialchars) {
                return htmlspecialchars($_POST["key"]);
            }else {
                return $_POST["key"];
            }
        }else {
            return null;
        }
    }

    public static function hasPost($key){
        return isset($_POST[$key]);
    }

    public static function get($key,$htmlspecialchars = false){
        if (self::hasPost($key)) {
            if ($htmlspecialchars) {
                return htmlspecialchars($_GET["key"]);
            }else {
                return $_GET["key"];
            }
        }else {
            return null;
        }
    }

    public static function hasGet($key){
        return isset($_GET[$key]);
    }

}