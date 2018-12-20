<?php
namespace Mora\Core\cli\Console\Commands;

use Mora\Core\cli\Console\Output;
use Mora\Core\cli\Console\CliConfig;
use Mora\Core\cli\Console\CliStrings;
use Mora\Core\cli\Helpers\SkeletonLoader;

class Welcome{
    public static function firstTime()
    {
        CliConfig::init();
        self::WelcomeMessage();
    }
    private static function getLogo(){
        return Output::style("<green>".SkeletonLoader::get("logo")."<nc>\r\n");
    }
    public static function regular()
    {
        self::WelcomeMessage();
        self::printCommandList();
    }
    private static function WelcomeMessage(){
        $welcome = "\r\n<yellow>".CliStrings::get("welcome")."<nc>\r\n";
        $usage = "\r\n<yellow>".CliStrings::get("usage")."<nc>\r\n";
        $command = "    php mora <blue><".CliStrings::get("command")."> <green>[".CliStrings::get("subcommand")."]<nc>\r\n\r\n";
        Output::print($welcome,self::getLogo(),$usage,$command);
    }
    private static function printCommandList(){
        Output::printWarning(CliStrings::get("command_list"));
        Output::print(CliStrings::replace(
            SkeletonLoader::get("commandlist")
        ));
    }
}