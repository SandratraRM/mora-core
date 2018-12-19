<?php
namespace Mora\Core\cli\Manager\Routes;

use Mora\Core\cli\Helpers\ArgParser;
use Mora\Core\Config\JsonConfigManager;

class CustomRoutesManager{
    public  static $path = CONFIG . "/CustomRoutes.json";

    private static $mapping = [
        "list" => "list",
        "delete" => "unsetRoutes"
    ];

    private static $default = "setRoutes";

    use ArgParser;

    public static function Interactive()
    {
        echo "interactive mode \r\n";
    }

    public static function setRoutes($args = []){
        $config = new JsonConfigManager(self::$path);
        foreach($args as $arg){
            $keyvalue = explode(":",$arg);
            if(count($keyvalue) == 2){
               $config->setConfig($keyvalue[0],ucfirst(strtolower($keyvalue[1])));
            }
        }
        $config->writeConfig();
    }

    public static function unsetRoutes($args = []){
        $config = new JsonConfigManager(self::$path);
        foreach($args as $key){
            if($config->hasConfig($key))
            $config->unsetConfig($key);
        }
        $config->writeConfig();
    }

    public static function list(){
        $config = new JsonConfigManager(self::$path);
    
        foreach($config->getConfigsArray() as $key => $value){
            echo $key . " => " . $value ."\r\n";
        }
    }
}