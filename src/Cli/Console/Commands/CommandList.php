<?php
namespace Mora\Core\Cli\Console\Commands;

use Mora\Core\Cli\Console\CliConfig;
use Mora\Core\Cli\Console\Lang\Lang;
use Mora\Core\Cli\Manager\Firewall\FirewallManager;
use Mora\Core\Cli\Manager\Routes\CustomRoutesManager;
use Mora\Core\Cli\Console\Lang\TradMaker;
use Mora\Core\Cli\Manager\Controller\ControllerManager;


class CommandList{
    public static function welcome(){
        if(CliConfig::fileExists()){
            Welcome::regular();
        }
        else{
            Welcome::firstTime();
        }
    }
    public static function lang($params,$option = null){
        Lang::parseArgs($params);
    }
    public static function controller($params,$option = null){
        ControllerManager::parseArgs($params);
    }
    public static function model(){
        
    }
    public static function firewall($params,$option = null){
        FirewallManager::parseArgs($params);
    }
    public static function route($params,$option = null){
        CustomRoutesManager::parseArgs($params);
    }
    public static function database(){
        
    }
    public static function view(){
        
    }
    public static function tradset($params){
        TradMaker::set();
    }
    public static function tradget($params){
        TradMaker::get();
    }
}