<?php
namespace Mora\Core\cli\Console;

use Mora\Core\Config\JsonConfigManager;

class CliConfig{
    private $configs = [];
    private static $path = ROOT . "/MoraCliData.json";
    public static function getConfig($key){
        $conf = new JsonConfigManager(self::$path);
        return $conf->getConfig($key);
    }
    public static function setConfig($key,$value){
        $conf = new JsonConfigManager(self::$path);
        $conf->setConfig($key,$value);
        return $conf->writeConfig();
    }
    public static function fileExists()
    {
        return file_exists(self::$path);
    }
    public static function init()
    {
        $conf = new JsonConfigManager(self::$path);
        $conf->setConfig("lang","en");
        $conf->writeConfig();
    }
}