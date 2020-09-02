<?php
namespace Mora\Core\Cli\Manager\Routes;

use Mora\Core\config\ArrayConfigManager;
use Mora\Core\Cli\Manager\Controller\ControllerMessage;

class RouteNew
{
    public static function set($args){
        $config = new ArrayConfigManager(CustomRoutesManager::$path);
        foreach($args as $arg){
            $keyvalue = explode(":",$arg);
            if(count($keyvalue) == 2){
                $controller = CONTROLLER . "/".$keyvalue[1]."Controller.php";
                if (!file_exists($controller)) {
                    ControllerMessage::controller_not_found($keyvalue[1]);
                }else {
                    $config->setConfig(ucfirst(strtolower($keyvalue[0])),ucfirst(strtolower($keyvalue[1])));
                    RouteMessage::set_success($keyvalue[0],$keyvalue[1]);
                }
            }else {
                RouteMessage::wrong_format();
            }
        }
        $config->writeConfig();
    }
}
