<?php
namespace Mora\Core\Config;

use Mora\Core\files\Jsons;
class JsonConfigManager extends ConfigManager{

    public function __construct($path = "") {
        if ($path != "") {
            $this->path = $path;
        }
        if ($this->fileExists()) {
            $this->configs = Jsons::fromJsonFileToArray($this->path);
        }
    }
    
    public function writeConfig(){
        return Jsons::toJsonFile($this->configs,$this->path);
    }
}