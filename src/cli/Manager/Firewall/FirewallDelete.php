<?php 
namespace Mora\Core\cli\Manager\Firewall;

use Mora\Core\Config\JsonConfigManager;
use Mora\Core\cli\Helpers\Input;
use Mora\Core\cli\Manager\Controller\ControllerMessage;
use Mora\Core\Control\Firewall;

class Firewalldelete{
    private static $path = CONFIG . "/Firewalls.json";

    private static function execfirewall($firewall){
        $firewall = ucfirst(strtolower($firewall));
        $config = new JsonConfigManager(self::$path);
        $path = FIREWALL . "/".$firewall."Firewall.php";
        if(file_exists($path)){
            unlink($path);
            FirewallMessage::firewall_delete_success($firewall);
        }else {
            FirewallMessage::firewall_not_found($firewall);
        }
        if($config->hasConfig($firewall)){
            $config->unsetConfig($firewall);
            $config->writeConfig();
        }
    }

    public static function firewall($names){
            foreach ($names as $name) {
                self::execfirewall($name);
        }
    }

    public static function target($from,$targets){
        $from = ucfirst(strtolower($from));
        $config = new JsonConfigManager(self::$path);
        $firewallArray = $config->getConfig($from);
        foreach ($firawallArray as $key => $value) {
            if(in_array($value,$targets)){
                unset($firawallArray[$key]);
            }
        } 
        $config->setConfig($from,$firawallArray);
        $config->writeConfig();
    }
}