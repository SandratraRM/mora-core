<?php
namespace Mora\Core\Files;
class Jsons{
    public static function fromJsonFileToArray($path){
        return \json_decode(\file_get_contents($path),true);
    }
    public static function fromJsonFileToObject($path){
        return \json_decode(\file_get_contents($path));
    }
    public static function toJsonFile($data,$path){
        return file_put_contents($path,json_encode($data));
    }
}