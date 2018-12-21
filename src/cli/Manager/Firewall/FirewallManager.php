<?php
namespace Mora\Core\cli\Manager\Firewall;

use Mora\Core\cli\Console\CliStrings;
use Mora\Core\cli\Helpers\ArgParser;
use Mora\Core\Config\JsonConfigManager;
use Mora\Core\cli\Console\Output;
use Mora\Core\cli\Helpers\SkeletonLoader;

class FirewallManager{
    
    public  static $configpath = CONFIG . "/Firewalls.json";
    private static $mapping = [
        "list" => "listFirewall",
        "delete" => "unsetFirewall",
        "rename" => "renameFirewall",
        "create" => "setFirewall"
    ];
    public static $default = "Interactive";

    use ArgParser;

    public static function unsetFirewall($param){
        $conf = new JsonConfigManager(self::$configpath);
        foreach($param as $p){
            $p = ucfirst(strtolower($p));
            $conf->unsetConfig($p);
            $conf->writeConfig();
            unlink(FIREWALL . "/" . $p . "Firewall.php");
            
        }
    }
    public static function setFirewall($param){
        $conf = new JsonConfigManager(self::$configpath);
        $fname = ucfirst(strtolower($param[0]));
        $fvalue = [];
        $values = explode(",",$param[1]);
        foreach ($values as $value) {
            $fvalue [] = $value;
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
        }
        if($conf->writeConfig()){
            $message = "<green>". CliStrings::get('firewall_add_success',["name" => $fname]) . "<nc>\r\n";
            printf(Output::style($message));

        }
    }

    public static function renameFirewall($params){
        if(isset($params[1])){
            FirewallEdit::rename($params[0],$params[1]);
        }
        else{
            Output::printError(CliStrings::get("rename_required_names"));
        }
    }
}