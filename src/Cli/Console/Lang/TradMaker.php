<?php
namespace Mora\Core\Cli\Console\Lang;

use Mora\Core\Cli\Console\Output;
use Mora\Core\Config\JsonConfigManager;

class TradMaker{

    public static function get(){
        Output::printRequest("Lang:");
        $lang = trim(fgets(STDIN));
        Output::printRequest("Key:");
        $key = trim(fgets(STDIN));
        $conf = new JsonConfigManager(__DIR__."/../Strings/$lang".".json");
        $value = $conf->getConfig($key);
        Output::printSuccess("[$lang]",$key,"=>",$value);
    }

    public  static function set(){
        Output::printRequest("Lang:");
        $lang = trim(fgets(STDIN));
        Output::printRequest("Key:");
        $key = trim(fgets(STDIN));
        Output::printRequest("Value:");
        $value = trim(fgets(STDIN));
        self::writeTrad($lang,$key,$value);
        Output::printSuccess("[$lang]",$key,"=>",$value);
    }
    public static function writeTrad($lang,$key,$value){
        
        $conf = new JsonConfigManager(__DIR__."/../Strings/$lang".".json");
        $conf->setConfig($key,$value);
        $conf->writeConfig();
    }
}