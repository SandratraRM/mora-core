<?php
namespace Mora\Core\cli\Console\Lang;

use Mora\Core\cli\Console\CliConfig;
use Mora\Core\cli\Console\Output;
use Mora\Core\cli\Console\CliStrings;

class Lang{
    public static function Interactive(){
        
    }
    public static function changeLang($lang){
        CliConfig::setConfig('lang',$lang);
        Output::print("<green>",CliStrings::get("lang_changed_success"),"<nc>\r\n");
    }
    public static function parseArgs($params){
        if(empty($params)){
            self::Interactive();
        }else{
           self::changeLang($params[0]);
        }
    }

}