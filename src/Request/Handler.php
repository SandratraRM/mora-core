<?php
namespace Mora\Core\Request;


use Mora\Core\Control\ControllerLoader;
use Mora\Core\Control\FirewallChecker;

class Handler
{
    public static function route(){
        $parts = Dispatcher::extractRequestParts();
        $controller = ControllerLoader::guessController($parts["controller"]);
        if(FirewallChecker::passedAll($controller)){
            $loader = new ControllerLoader($controller);
            $loader->execute($parts["action"],$parts);
        }
    }
}