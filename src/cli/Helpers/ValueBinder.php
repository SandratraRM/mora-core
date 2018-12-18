<?php
namespace Mora\Core\cli\Helpers;
class ValueBinder{
    public static function replace($text,$data){
        
        $search = [];
        $replace = [];
        foreach($data as $k => $v){
            $search [] = "{".$k."}";
            $replace [] = $v;
        }
        return str_ireplace($search,$replace,$text);
    }
}