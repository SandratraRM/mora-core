<?php

namespace Mora\core\files;

class Arrays
{
    public static function fromArrayFileToArray($path){
        return require $path;
    }

    public static function ToArrayFile($filename,$array){
        return file_put_contents($filename,"<?php\r\nreturn " . var_export($array,true) . ";");
    }
}