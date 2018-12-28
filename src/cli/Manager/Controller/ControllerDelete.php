<?php
namespace Mora\Core\cli\Manager\Controller;

use Mora\Core\cli\Manager\Routes\CustomRoutesManager;
use Mora\Core\Config\JsonConfigManager;
use Mora\Core\cli\Manager\Firewall\FirewallManager;
use Mora\Core\cli\Helpers\Methods;

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
        if(self::confirmDelete()){
            foreach ($names as $name) {
                self::execdelete($name);
            }
        }
    }
    private static function confirmDelete(){
        $answer = Methods::ask("confirm_delete");
        return ($answer == "" || $answer == "yes");
    }

    private static function deleteRoute($name){
        $path = CustomRoutesManager::$path;
        $conf = new JsonConfigManager($path);
        while ($key = array_search($name,$conf->getConfigsArray())) {
            $conf->unsetConfig($key);
        }
        $conf->writeConfig();
    }
    
    private static function deleteFirewallTarget($controller){
        $path = FirewallManager::$configpath;
        $conf = new JsonConfigManager($path);
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