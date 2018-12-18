<?php 
namespace Mora\Core\cli\Manager\Firewall;

use Mora\Core\Config\JsonConfigManager;

class Firewalldelete{
    private static $path = CONFIG . "/Firewalls.json";

    public static function firewall($firewalls){
        $config = new JsonConfigManager(self::$path);
        foreach ($firewalls as $firewall) {
            $path = FIREWALL . "/".$firewall."Firewall.json";
            if(file_exists($path)){
                unlink($path);
            }
            if($config->hasConfig($firewall)){
                $config->unsetConfig($firewall);
                $config->writeConfig();
            }
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