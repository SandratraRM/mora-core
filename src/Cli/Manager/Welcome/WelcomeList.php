<?php
namespace Mora\Core\Cli\Manager\Welcome;

use Mora\Core\Cli\Console\Output;
use Mora\Core\Cli\Console\CliStrings;
use Mora\Core\Cli\Helpers\SkeletonLoader;
use Mora\Core\config\JsonConfigManager;
use Mora\Core\Cli\Console\Commands\CommandHelp;
use Mora\Core\Cli\CommandControllers\LangCli;

class WelcomeList{

    public static function decide(){
        if (self::isFirstTime()) {
            self::firstTime();
        }else {
            self::regular();
        }
    }

    private static function isFirstTime(){
        $conf = new JsonConfigManager(CONFIG . "/.Cli_prefs.json");
        return !$conf->hasConfig("lang");
    }
    
    private static function firstTime(){
        self::WelcomeMessage();
        $lang = new LangCli();
        $lang->list([]);
        $lang->set([]);
    }

    private static function getLogo(){
        return Output::style("<green>".SkeletonLoader::get("logo")."<nc>\r\n");
    }

    private static function regular()
    {
        self::WelcomeMessage();
        self::usage();
        CommandHelp::printAll();
    }
    private static function usage(){
        $usage = "\r\n<yellow>".CliStrings::get("usage")."<nc>\r\n";        
        $command = "    php mora \033[1;4;34m".CliStrings::get("command")."<nc> <green>[".CliStrings::get("subcommand")." <cyan>args<green>]<nc>\r\n";
        $tip = Output::style(CliStrings::get("usage_tip"))."\r\n"; 
        Output::print($usage,$command,$tip);
    }

    private static function WelcomeMessage(){
        $welcome = "\r\n<yellow>".CliStrings::get("welcome")."<nc>\r\n";
        Output::print($welcome,self::getLogo());
    }
}