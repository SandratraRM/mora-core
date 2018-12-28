<?php 

namespace Mora\Core\cli\Manager\Firewall;

use Mora\Core\cli\Console\Output;
use Mora\Core\cli\Console\CliStrings;
use Mora\Core\Config\JsonConfigManager;

class FirewallList{

    private static $path = CONFIG . "/Firewalls.json";
    
    public static function all(){
        Output::printWarning("",CliStrings::get("firewall_list"));
        Output::print("\r\n");
        if (!file_exists(FIREWALL)) {
            exit();
        }
        $files = scandir(FIREWALL);
        foreach ($files as $file) {
            if (is_file(FIREWALL . "/$file") && preg_match("/\w+Firewall\.php/", $file)) {
                $file = "-".str_replace("Firewall.php", "", $file);
                Output::print($file,"\r\n");
            }
        }
        print("\r\n");
    }

    public static function targets($firewall){
        $firewall = ucfirst(strtolower($firewall));
        if (!file_exists(FIREWALL . "/{$firewall}Firewall.php")) {
            FirewallMessage::firewall_not_found($firewall);
            exit();
        }
        Output::printWarning("",CliStrings::get("firewall_targets_list",['name'=>$firewall]),"");
        $conf = new JsonConfigManager(self::$path);
        $targets = $conf->getConfig($firewall);
        foreach ($targets as $target) {
            Output::print('-',$target,"\r\n");
        }
        print("\r\n");
    }
}