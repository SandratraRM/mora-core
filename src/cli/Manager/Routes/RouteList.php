<?php
namespace Mora\Core\cli\Manager\Routes;

use Mora\Core\config\ArrayConfigManager;

class RouteList 
{
    public static function all(){
        print("\r\n");
        RouteMessage::list();
        print("\r\n");
        $config = new ArrayConfigManager(CustomRoutesManager::$path);
    
        foreach($config->getConfigsArray() as $key => $value){
            echo $key . " => " . $value ."\r\n";
        }
        print("\r\n");

    }
}
