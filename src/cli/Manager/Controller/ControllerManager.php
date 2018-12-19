<?php
namespace Mora\Core\cli\Manager\Controller;

use Mora\Core\cli\Helpers\ArgParser;

class ControllerManager{
    public static $mapping = [
        "create" => "createController",
        "delete" => "deleteController",
        "rename" => "renameController",
        "addAction" => "add_Action"
    ];
    public static $default = "notFound";
    use ArgParser;

    public static function createController($params){
        if(count($params) >= 1){
            $action = (isset($params[1]))? explode(",",$params[1]) : [];
            $name = ucfirst(strtolower($params[0]));
            ControllerNew::new($name,$action);
        }
        else {
            ControllerNew::Interactive();
        }
    }
}
