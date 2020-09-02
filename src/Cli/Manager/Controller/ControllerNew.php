<?php
namespace Mora\Core\Cli\Manager\Controller;
use Mora\Core\Cli\Console\Output;
use Mora\Core\Cli\Helpers\Methods;
use Mora\Core\Cli\Console\CliStrings;
use Mora\Core\Cli\Helpers\SkeletonLoader;

class ControllerNew{
    
    public static function new($name,$actions){
        $name = ucfirst(strtolower($name));
        if(!file_exists(CONTROLLER)){
            mkdir(CONTROLLER);
        }
        $filename = CONTROLLER . "/$name" . "Controller.php";
        if (file_exists($filename)) {
            ControllerMessage::controller_exists($name);
            exit();
        }
        $file = SkeletonLoader::get("Controller",["name" => $name]);
        file_put_contents($filename,$file);
        foreach ($actions as $key => $value) {
            if ($value == "") {
                unset($actions[$key]);
            }
        }
        $actions = array_values($actions);
        if(!empty($actions)){
            ControllerEdit::add_actions($name,$actions);
        }
        ControllerMessage::create_success($name,$actions);

    }
}