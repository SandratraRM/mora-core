<?php
namespace Mora\Core\cli\Manager\Controller;
use Mora\Core\cli\Console\Output;
use Mora\Core\cli\Helpers\Methods;
use Mora\Core\cli\Console\CliStrings;
use Mora\Core\cli\Helpers\SkeletonLoader;

class ControllerNew{
    public static function new($name,$actions){
        if(!file_exists(CONTROLLER)){
            mkdir(CONTROLLER);
        }
        $filename = CONTROLLER . "/$name" . "Controller.php";
        if (file_exists($filename)) {
            Output::printWarning(CliStrings::get("controller_exists_prompt",["name"=>$name]));
            $answer = trim(fgets(STDIN));
            if ($answer != "yes") {
                exit();
            }
        }
        $file = SkeletonLoader::get("Controller",["name" => $name]);
        file_put_contents($filename,$file);
        if(!empty($actions)){
            ControllerEdit::add_actions($filename,$actions);
        }

    }
    public static function Interactive(){
        $name = Methods::ask("ask_controller_name");
        echo $name;
    }

}