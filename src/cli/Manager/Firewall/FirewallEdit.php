<?php 
namespace Mora\Core\cli\Manager\Firewall;

use Mora\Core\Control\Firewall;
use Mora\Core\config\ArrayConfigManager;
use Mora\Core\Cli\Helpers\Refactor;

class FirewallEdit{
    private static $confPath = CONFIG . "/Firewalls.php";

    public static function rename($old,$new){
        $conf = new ArrayConfigManager(self::$confPath);
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
                self::refactorFileContents($old,$new);
                if ($conf->writeConfig() && rename($oldPath,$newPath)) {
                    FirewallMessage::rename_success($old,$new);
                }
            }
          
        }
    }
    private static function refactorFileContents($old,$new){
        $old = $old . "Firewall";
        $new = $new . "Firewall";
        Refactor::files_str_replace(APP,$old,$new,false);
    }
    public static function addTarget($firewall,$targets){
        $conf = new ArrayConfigManager(self::$confPath);
        $key = ucfirst(strtolower($firewall));
        if (file_exists(FIREWALL. "/{$key}Firewall.php")) {
            if ($conf->hasConfig($key)) {
                $values = $conf->getConfig($key);
                $values = (is_array($values))? $values : [];
            }else {
                $values = [];
            }
            foreach ($targets as $k => $v) {
                $targets[$k] = ucfirst(strtolower($v));
            }
            $targets = array_diff($targets,$values);
            $conf->setConfig($key,array_merge($values,$targets));
            if ($conf->writeConfig()) {
                FirewallMessage::targets_add_success($key,$targets);
            }
        }
        else {
            FirewallMessage::firewall_not_found($key);
        }
    }
    public static function priority($firewall,$order){
        $conf = new ArrayConfigManager(self::$confPath);
        $length = count($conf->getConfigsArray());
        $firewall = ucfirst(strtolower($firewall));
        if (!file_exists(FIREWALL . "/{$firewall}Firewall.php")) {
            FirewallMessage::firewall_not_found($firewall);
            exit();
        }
        $order = ($order == "") ? $length : (int) $order;
        $order -= 1;
        $conf->setConfigOrder($firewall,$order);
        $conf->writeConfig();
        FirewallMessage::priority($firewall,$order + 1);
        FirewallList::all();
    }
}