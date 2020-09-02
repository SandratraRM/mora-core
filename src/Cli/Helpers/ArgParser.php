<?php

namespace Mora\Core\Cli\Helpers;


use Mora\Core\Cli\Console\Output;

trait ArgParser
{
    
    public static function Interactive(){
        printf(Output::style("<red>No interactive mode<nc>\r\n"));
    }
    public static function parseArgs($params){
        if(empty($params)){
            self::Interactive();
        }else{
            if(array_key_exists($params[0],self::$mapping)){
                self::{self::$mapping[$params[0]]}(array_slice($params,1));
            }
            else{
                self::{self::$default}($params);
            }
        }
    }
}