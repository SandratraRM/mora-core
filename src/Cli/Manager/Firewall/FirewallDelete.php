<?php 
namespace Mora\Core\Cli\Manager\Firewall;

use Mora\Core\Config\ArrayConfigManager;
class FirewallDelete{
    private static $path = CONFIG . "/Firewalls.php";

    private static function execfirewall($firewall){
        $firewall = ucfirst(strtolower($firewall));
        $config = new ArrayConfigManager(self::$path);
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

        $config = new ArrayConfigManager(self::$path);
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