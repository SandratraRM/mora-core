<?php 

namespace Mora\Core\Cli\Manager\Firewall;

use Mora\Core\Cli\Console\Output;
use Mora\Core\Cli\Console\CliStrings;
use Mora\Core\Config\ArrayConfigManager;

class FirewallList{

    private static $path = CONFIG . "/Firewalls.php";
    
    public static function all(){
        Output::printWarning("",CliStrings::get("firewall_list"));
        Output::print("\r\n");
        if (!file_exists(FIREWALL)) {
            exit();
        }
        $conf = new ArrayConfigManager(self::$path);
        $firewalls = array_keys($conf->getConfigsArray());
        $priority = 1;
        foreach ($firewalls as $firewall) {
            if (file_exists(FIREWALL . "/$firewall"."Firewall.php")) {
                $firewall  = $priority . "-" . $firewall;
                Output::print($firewall,"\r\n");
                $priority ++;
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
        $conf = new ArrayConfigManager(self::$path);
        $targets = $conf->getConfig($firewall);
        $targets = ($targets === false)? [] : $targets;
        foreach ($targets as $target) {
            Output::print('-',$target,"\r\n");
        }
        print("\r\n");
    }
}