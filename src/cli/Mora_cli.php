<?php
namespace Mora\Core\cli;

use Mora\Core\cli\Helpers\ArgsInterpreter;
use Mora\Core\cli\Console\Commands\Welcome;
use Mora\Core\cli\Console\Commands\CommandList;
use Mora\Core\cli\Console\Commands\SingleCliOptionManager;
use Mora\Core\Control\Controller;

class Mora_cli{
    
    public static function exec($args){
        unset($args[0]);
        $args = array_values($args);
        self::ClicontrollerLoad(self::dispatch($args));
    }
    private static function dispatch($args){
        $action = "action";
        $params = [];
        switch (count($args)) {
            case 0:
                $controller = "Welcome";
                break;
            case 1:
                $controller = $args[0];
                break;
            case 2:
                $controller = $args[0];
                $action = $args[1];
            default:
                $controller = $args[0];
                $action = $args[1];
                $params = array_slice($args,2);
                break;
        }
        $controller = ucfirst(strtolower($controller));
        return ["controller"=>$controller,"action"=>$action,"args"=>$params];
    }
    private static function ClicontrollerLoad($parts){
        $path = __DIR__ . "/CommandControllers/";
        $suffix = "Cli.php";
        $controllerPath = $path.$parts["controller"].$suffix;
        if (file_exists($controllerPath)) {
            $controllerClass = "Mora\\Core\\cli\\CommandControllers\\".$parts["controller"]."Cli";
            self::execController($controllerClass,$parts["action"],$parts["args"]);
        }else{
            echo("tsy ao");
        }
    }
    /**
     * execController
     *
     * @param Controller $controller
     * @param string $action
     * @param array $ags
     * @return void
     */
    private static function execController($controller,$action,$args){
        $controller = new $controller();
        $controller->doAction($action,$args);
    }
}