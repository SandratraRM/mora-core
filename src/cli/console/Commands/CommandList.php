<?php
namespace Mora\Core\cli\Console\Commands;

use Mora\Core\cli\Console\CliConfig;
use Mora\Core\cli\Console\Lang\Lang;
use Mora\Core\cli\Manager\Firewall\FirewallManager;
use Mora\Core\cli\Manager\Routes\CustomRoutesManager;
use Mora\Core\cli\Console\Lang\TradMaker;


class CommandList{
    public static function welcome(){
        if(CliConfig::fileExists()){
            Welcome::regular();
        }
        else{
            Welcome::firstTime();
        }
    }
    public static function lang($params = [],$option = null){
        Lang::parseArgs($params);
    }
    public static function controller($params = [],$option = null){

    }
    public static function model(){
        
    }
    public static function firewall($params = [],$option = null){
        FirewallManager::parseArgs($params);
    }
    public static function route($params = [],$option = null){
        CustomRoutesManager::parseArgs($params);
    }
    public static function database(){
        
    }
    public static function view(){
        
    }
    public static function tradset($params = []){
        TradMaker::set();
    }
    public static function tradget($params = []){
        TradMaker::get();
    }
}