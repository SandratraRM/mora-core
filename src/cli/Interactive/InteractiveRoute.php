<?php
namespace Mora\Core\Cli\Interactive;

class InteractiveRoute{
    public static function set(&$routes){
        if (is_null($routes)) {
            goto ASK;
        }else {
            goto SET;
        }
        ASK:
            
        SET:
            
    }
}