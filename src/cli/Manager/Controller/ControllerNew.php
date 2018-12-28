<?php
namespace Mora\Core\cli\Manager\Controller;
use Mora\Core\cli\Console\Output;
use Mora\Core\cli\Helpers\Methods;
use Mora\Core\cli\Console\CliStrings;
use Mora\Core\cli\Helpers\SkeletonLoader;

class ControllerNew{
    public static function new($name,$actions){
        $name = ucfirst(strtolower($name));
        if(!file_exists(CONTROLLER)){
            mkdir(CONTROLLER);
        }
        $filename = CONTROLLER . "/$name" . "Controller.php";
        if (file_exists($filename)) {
            $answer = Methods::ask("controller_exists_prompt",["name"=>$name]);
            if ($answer != "yes") {
                exit();
            }
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