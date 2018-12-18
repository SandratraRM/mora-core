<?php
namespace Mora\Core\Config;

use Mora\Core\files\Jsons;
class JsonConfigManager{
    private $configs = [];
    protected $path;

    public function __construct($path = "") {
        if ($path != "") {
            $this->path = $path;
        }
        if ($this->fileExists()) {
            $this->configs = Jsons::fromJsonFileToArray($this->path);
        }
    }
    
    private function fileExists(){
        return file_exists($this->path);
    }

    public function getConfigsArray(){
        return $this->configs;
    }
    public function setConfigsArray($configs)
    {
        $this->configs = $configs;
    }
    public function hasConfig($key){
        return isset($this->configs[$key]);
    }

    public function setConfig($key,$value){
        $this->configs[$key] = $value;
    }

    public function getConfig($key){
        if($this->hasConfig($key))
        return $this->configs[$key];
        else return false;
    }
    public function unsetConfig($key){
        unset($this->configs[$key]);
    }
    public function writeConfig(){
        return Jsons::toJsonFile($this->configs,$this->path);
    }
}