<?php

namespace Mora\Core\config;

abstract class ConfigManager
{
    protected $configs = [];
    protected $path;

    protected function fileExists(){
        return file_exists($this->path);
    }

    public function getConfigsArray(){
        return $this->configs;
    }
    public function setConfigsArray($configs)
    {
        $this->configs = $configs;
    }
    public function setConfigOrder($key,$order){
        $length = count($this->configs);
        $order = ($length - 1 < $order) ? $length - 1 : $order;
        $order = (0 > $order)? 0 : $order;
        $conf = $this->getConfigsArray();
        $value = $this->getConfig($key);
        unset($conf[$key]);
        $keys = array_keys($conf);
        $values = array_values($conf);
        $newKeys = $newValues = [];
        $hasPassed = false;
        for ($i=0; $i < $length; $i++) { 
            if ($hasPassed) {
                $newKeys []= $keys[$i - 1];
                $newValues []= $values[$i - 1];
            }elseif (!$hasPassed && $order != $i) {
                $newKeys []= $keys[$i];
                $newValues []= $values[$i];
            }elseif ($order == $i) {
                $newKeys []= $key;
                $newValues []= $value;
                $hasPassed = true;
            }
        }
        $conf = array_combine($newKeys,$newValues);
        $this->setConfigsArray($conf);
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
}