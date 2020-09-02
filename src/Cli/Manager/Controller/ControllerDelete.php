<?php
namespace Mora\Core\Cli\Manager\Controller;

use Mora\Core\Cli\Manager\Routes\CustomRoutesManager;
use Mora\Core\Config\ArrayConfigManager;
use Mora\Core\Cli\Manager\Firewall\FirewallManager;
use Mora\Core\Cli\Helpers\Input;

class ControllerDelete{

    private static function execdelete($name){
        $path = CONTROLLER . "/$name" . "Controller.php";
        if(file_exists($path)){
            unlink($path);
            self::deleteRoute($name);
            self::deleteFirewallTarget($name);
            ControllerMessage::delete_success($name);
        }else {
            ControllerMessage::controller_not_found($name);
        }
    }

    public static function delete($names){
        foreach ($names as $name) {
            self::execdelete($name);
        }
    }

    private static function deleteRoute($name){
        $path = CustomRoutesManager::$path;
        $conf = new ArrayConfigManager($path);
        while ($key = array_search($name,$conf->getConfigsArray())) {
            $conf->unsetConfig($key);
        }
        $conf->writeConfig();
    }
    
    private static function deleteFirewallTarget($controller){
        $path = FirewallManager::$path;
        $conf = new ArrayConfigManager($path);
        $firewalls = $conf->getConfigsArray();
        foreach ($firewalls as $firewall => $targets) {
            if(in_array($controller,$targets)){
                $key = array_search($controller,$targets);
                unset($targets[$key]);
                $targets = array_values($targets);
                $firewalls[$firewall] = $targets;
            }
            
        }
        $conf->setConfigsArray($firewalls);
        $conf->writeConfig();
    }
}