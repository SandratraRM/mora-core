<?php
namespace Mora\Core\cli\Manager\Firewall;

use Mora\Core\cli\Console\Output;
use Mora\Core\cli\Console\CliStrings;
use Mora\Core\Config\ArrayConfigManager;
use Mora\Core\cli\Helpers\SkeletonLoader;

class FirewallNew  
{
    public  static $configpath = CONFIG . "/Firewalls.php";
    public static function create($name,$actions){
        $conf = new ArrayConfigManager(self::$configpath);
        $fname = ucfirst(strtolower($name));
        $fvalue = [];
        $values = $actions;
        foreach ($values as $value) {
            $fvalue [] = ucfirst(strtolower($value));
        }
        $conf->setConfig($fname,$fvalue);
        if(!file_exists(FIREWALL)){
            mkdir(FIREWALL);
        }
        $path = FIREWALL . "/$fname" . "Firewall.php";
        if(!file_exists($path)){
            $data = [
                "name" => $fname,
                "check" => CliStrings::get('firewall_check_comment'),
                "failed" => CliStrings::get('firewall_onfailed_comment'),
                "condition" => CliStrings::get('condition')
            ];
            $file = SkeletonLoader::get("firewall",$data);
            file_put_contents($path,$file);
            if($conf->writeConfig()){
            $message = "<green>". CliStrings::get('firewall_add_success',["name" => $fname]) . "<nc>\r\n";
            printf(Output::style($message));
        }
        }else {
            FirewallMessage::name_conflict_error($name);
        }
        
    }
}
