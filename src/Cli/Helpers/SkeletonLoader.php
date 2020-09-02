<?php
namespace Mora\Core\Cli\Helpers;
class SkeletonLoader{
    public static function get($name,$data = []){
        $file = file_get_contents(__DIR__."/../Skeletons/$name.txt");
        $data["Project_Name"] = PROJECT_NAME;
        return ValueBinder::replace($file,$data);
    }
}