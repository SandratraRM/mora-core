<?php
namespace Mora\Core\Cli\Manager\Routes;

use Mora\Core\config\ArrayConfigManager;

class RouteDelete
{
    public static function unset($args){
        
    $config = new ArrayConfigManager(CustomRoutesManager::$path);
    foreach($args as $key){
        if($config->hasConfig($key))
        $config->unsetConfig($key);
    }
    $config->writeConfig();
    }
}
