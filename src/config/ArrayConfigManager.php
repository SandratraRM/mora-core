<?php

namespace Mora\Core\Config;

use Mora\Core\files\Arrays;


class ArrayConfigManager extends ConfigManager
{
    public function __construct($path = "") {
        if ($path != "") {
            $this->path = $path;
        }
        if ($this->fileExists()) {
            $this->configs = Arrays::fromArrayFileToArray($this->path);
        }
    }
    
 
    public function writeConfig(){
        return Arrays::ToArrayFile($this->path,$this->configs);
    }
}