<?php 
namespace Mora\Core\cli\Manager\Firewall;

use Mora\Core\Config\JsonConfigManager;

class FirewallEdit{
    private static $confPath = CONFIG . "/Firewalls.json";

    public static function rename($old,$new){
        $conf = new JsonConfigManager(self::$confPath);
        $new = ucfirst(strtolower($new));
        $old = ucfirst(strtolower($old));
        $oldPath = FIREWALL . "/$old"."Firewall.php";
        $newPath = FIREWALL . "/$new"."Firewall.php";
        if(!file_exists($oldPath) || !$conf->hasConfig($old)){
            FirewallMessage::firewall_not_found($old);
        }
        else{
            if(file_exists($newPath)|| $conf->hasConfig($new)){
                FirewallMessage::name_conflict_error($new);
            }
            else{
                $conf->setConfig($new,$conf->getConfig($old));
                $conf->unsetConfig($old);
                $oldContent = file_get_contents($oldPath);
                $newContent = str_replace($old."Firewall",$new."Firewall",$oldContent);
                file_put_contents($oldPath,$newContent);
                if ($conf->writeConfig() && rename($oldPath,$newPath)) {
                    FirewallMessage::rename_success($old,$new);
                }
            }
          
        }
    }

    public static function addTarget($firewall,$targets){
        $conf = new JsonConfigManager(self::$confPath);
        $key = ucfirst(strtolower($firewall));
        if ($conf->hasConfig($key)) {
            $values = $conf->getConfig($key);
            $conf->setConfig($key,array_merge($values,$targets));
            if ($conf->writeConfig()) {
                FirewallMessage::target_added_succes($targets);
            }
        }
    }
}