<?php

namespace Mora\Core\Cli\Helpers;

class Refactor
{
    public static function files_str_replace($searchDir, $search, $replace, $isSensitive = true)
    {
        $DirContent = scandir($searchDir);
        foreach ($DirContent as $key => $content) {
            if ($key >= 2) {
                $newPath = $searchDir . "/$content";
                if (is_dir($newPath)) {
                    self::files_str_replace($newPath, $search, $replace, $isSensitive);
                } elseif (is_file($newPath)) {
                    $str = file_get_contents($newPath);
                    $data = ($isSensitive) ? str_replace($search, $replace, $str) : str_ireplace($search, $replace, $str);
                    file_put_contents($newPath, $data);
                }
            }
        }
    }
    public static function files_find($searchDir, $search,$isSensitive = true,&$matches = []){
        
        $DirContent = scandir($searchDir);
        foreach ($DirContent as $key => $content) {
            if ($key >= 2) {
                $newPath = $searchDir . "/$content";
                if (is_dir($newPath)) {
                    self::files_find($newPath, $search,$isSensitive,$matches);
                } elseif (is_file($newPath)) {
                    $str = file_get_contents($newPath);
                    if ($isSensitive == false) {
                        $str = strtolower($str);
                        $search = strtolower($search);
                    }
                    if (substr_count($str,$search) > 0) {
                        $matches[$newPath] = substr_count($str,$search);
                    }
                }
            }
        } 
        return $matches;
    }
}