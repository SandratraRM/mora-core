<?php
namespace Mora\Core\cli\Manager\Controller;

use Mora\Core\cli\Helpers\ArgParser;

class ControllerManager{
    public static $mapping = [
        "create" => "createController",
        "delete" => "deleteController",
        "rename" => "renameController",
        "add_actions" => "add_Action"
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
    public static function add_Action($params = []){
        if (isset($params[1])) {
            $path = CONTROLLER . "/" . ucfirst(strtolower($params[0])) . "Controller.php";
            ControllerEdit::add_actions($path,explode(",",$params[1]));
        }
        else{

        }
    }
    public static function deleteController($params){
        if (isset($params[0])) {
            $name = ucfirst(strtolower($params[0]));
            ControllerDelete::delete($name);
        }else {
            ControllerDelete::Interactive();
        }
    }
}
