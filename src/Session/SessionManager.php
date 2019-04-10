<?php
namespace Mora\Core\Session;
class SessionManager
{
    private static function start(){
        if (!isset($GLOBALS["SESSION_STARTED"]) || $GLOBALS["SESSION_STARTED"] != true) {
            session_start();
            $GLOBALS["SESSION_STARTED"] = true;
        }
    }

    public static function has($key){
        self::start();
        return isset($_SESSION[$key]);
    }

    public static function get($key){
        self::start();
        if (self::has($key)) {
            return $_SESSION[$key];
        }else {
            return null;
        }
    }

    public static function set($key,$value){
        self::start();
        $_SESSION[$key] = $value;
    }

    public static function close(){
        $GLOBALS["SESSION_STARTED"] = false;
        session_destroy();
    }
}
