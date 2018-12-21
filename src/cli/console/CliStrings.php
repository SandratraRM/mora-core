<?php
namespace Mora\Core\cli\Console;

use Mora\Core\Config\JsonConfigManager;
use Mora\Core\cli\Helpers\ValueBinder;

class CliStrings{
    private $path;
    public function __construct($lang = "") {
        if($lang == "")
            $lang = (CliConfig::getConfig('lang'))? CliConfig::getConfig('lang') : "en";
        $this->path = __DIR__ ."/Strings/$lang.json";
    }
    public function getPath()
    {
        return $this->path;
    }
    public static function get($key,$data = [])
    {
        $string = new self();
        $conf = new JsonConfigManager($string->getPath());
        if($conf->hasConfig($key)){
            $text = $conf->getConfig($key);
        }else{
            $string = new self("en");
            $conf = new JsonConfigManager($string->getPath());
            $text = $conf->getConfig($key);
        }
        return ValueBinder::replace($text,$data);
    }
    public static function replace($text){
        $string = new self();
        $conf = new JsonConfigManager($string->getPath());
        $keys = array_keys($conf->getConfigsArray());
        $search = [];
        foreach ($keys as $key) {
            $search []= "{".$key."}";
        }
        $values = array_values($conf->getConfigsArray());
        return str_replace($search,$values,$text);
    }
}