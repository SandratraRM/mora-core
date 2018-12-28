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

        if (!file_exists(FIREWALL . "/{$from}Firewall.php")) {
            FirewallMessage::firewall_not_found($from);
            exit();
        }

        $config = new JsonConfigManager(self::$path);
        $firewallArray = $config->getConfig($from);
        $firewallArray = ($firewallArray === false)? [] : $firewallArray;

        foreach ($targets as $key => $value) {
            $targets[$key] = ucfirst(strtolower($value));
        }

        foreach ($firewallArray as $key => $value) {
            if(in_array($value,$targets)){
                unset($firewallArray[$key]);
                FirewallMessage::target_delete_success($from,$value);
            }
        } 
        $config->setConfig($from,array_values($firewallArray));
        $config->writeConfig();

    }
}