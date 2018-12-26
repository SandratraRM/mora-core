<?php

namespace Mora\Core\cli\Manager\Controller;

use Mora\Core\cli\Console\Output;

class ControllerList
{
    public static function all()
    {
        $files = scandir(CONTROLLER);
        foreach ($files as $file) {
            if (is_file(CONTROLLER . "/$file") && preg_match("/\w+Controller\.php/", $file)) {
                $file = str_replace("Controller.php", "", $file);
                Output::printWarning($file);
            }
        }
    }
    public static function Action($controller)
    {
        if (file_exists(CONTROLLER . "/{$controller}Controller.php")) {
            Output::printRequest($controller, ":", "\r\n");
            $controller = PROJECT_NAME . "\\Controller\\{$controller}Controller";
            $methods = get_class_methods($controller);
            foreach ($methods as $method) {
                if ($method != "doAction") {
                    Output::printWarning($method);
                }
            }
        }
        else{
            ControllerMessage::controller_not_found();
        }
    }
}