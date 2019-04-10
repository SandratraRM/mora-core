<?php
namespace Mora\Core\Cli\Interactive;

use Mora\Core\cli\Helpers\Input;


class InteractiveRoute{
    public static function set(&$routes){
        if ($routes == null) {
            goto ASK;
        }else {
            return;
        }
        ASK:
            $routes =  Input::ask("set_routes");
            $routes = explode(" ",$routes);
    }
    public static function delete(&$routes){
        if ($routes == null) {
            goto ASK;
        }else {
            goto SET;
        }
        ASK:
            $routes = Input::ask("unset_routes");
        SET:
            $routes = explode(",",$routes);
    }
}