<?php

namespace Mora\Core\cli\Manager\Controller;

use Mora\Core\cli\Console\Output;
use Mora\Core\cli\Console\CliStrings;

class ControllerList
{
    public static function all()
    {
        Output::printWarning("",CliStrings::get("controller_list"));
        Output::print("\r\n");
        if (!file_exists(CONTROLLER)) {
            exit();
        }
        $files = scandir(CONTROLLER);
        foreach ($files as $file) {
            if (is_file(CONTROLLER . "/$file") && preg_match("/\w+Controller\.php/", $file)) {
                $file = "-".str_replace("Controller.php", "", $file);
                Output::print($file,"\r\n");
            }
        }
        print("\r\n");
    }
    public static function Action($controller)
    {
        if (file_exists(CONTROLLER . "/{$controller}Controller.php")) {
            Output::printWarning("",CliStrings::get("controller_action_list",["name"=>$controller]));
            Output::print("\r\n");
            $controller = PROJECT_NAME . "\\Controller\\{$controller}Controller";
            $methods = get_class_methods($controller);
            foreach ($methods as $method) {
                if ($method != "doAction") {
                    Output::print("-",$method,"\r\n");
                }
            }
            print("\r\n");
        }
        else{
            ControllerMessage::controller_not_found($controller);
        }
    }
}