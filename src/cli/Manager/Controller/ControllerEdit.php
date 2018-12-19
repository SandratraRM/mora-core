<?php
namespace Mora\Core\cli\Manager\Controller;

use Mora\Core\cli\Helpers\SkeletonLoader;

class ControllerEdit{
    public static function add_actions($filename,$actions){
        if(file_exists($filename)){
            $file = file_get_contents($filename);
            $file = trim($file);
            $file = rtrim($file,"}");
            $action_sk = SkeletonLoader::get("action");
            foreach ($actions as $action) {
                $file .= str_replace("{action}",$action,$action_sk);
            }
            $file .= "\n}";
            if(file_put_contents($filename,$file)){
                
            }
        }
    }
    public static function rename($old,$new){
        
    }
    private static function refactorRoute($old,$new){
        
    }
    private static function refactorFirewall($old,$new){
        
    }
}