<?php
namespace Mora\Core\Cli\Manager\Firewall;

use Mora\Core\Cli\Console\Output;
use Mora\Core\Cli\Console\CliStrings;
use Mora\Core\Config\ArrayConfigManager;
use Mora\Core\Cli\Helpers\SkeletonLoader;

class FirewallNew  
{
    public  static $path = CONFIG . "/Firewalls.php";
    public static function create($name,$targets,$order){
        $conf = new ArrayConfigManager(self::$path);
        $fname = ucfirst(strtolower($name));
        $order = ($order == "")? count($conf->getConfigsArray()) : (int) $order;
        $order -= 1;
        $fvalue = [];
        $values = $targets;
        foreach ($values as $value) {
            $fvalue [] = ucfirst(strtolower($value));
        }
        $conf->setConfig($fname,$fvalue);
        $conf->setConfigOrder($fname,$order);
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
