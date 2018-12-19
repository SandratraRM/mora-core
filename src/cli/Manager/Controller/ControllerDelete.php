<?php
namespace Mora\Core\cli\Manager\Controller;

use Mora\Core\cli\Manager\Routes\CustomRoutesManager;
use Mora\Core\Config\JsonConfigManager;
use Mora\Core\cli\Manager\Firewall\FirewallManager;
use Mora\Core\cli\Helpers\Methods;

class ControllerDelete{
    public static function delete($name){
        $path = CONTROLLER . "/$name" . "Controller.php";
        if(file_exists($path)){
            if(self::confirmDelete()){
                unlink($path);
                self::deleteRoute($name);
                self::deleteFirewallTarget($name);
                ControllerMessage::delete_success($name);
            }
        }else {
            ControllerMessage::controller_not_found($name);
        }
    }
    public static function Interactive(){
        $name = Methods::ask("ask_controller_name");
        $name = ucfirst(strtolower($name));
        self::delete($name);
    }
    public static function confirmDelete(){
        $answer = Methods::ask("controller_confirm_delete");
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