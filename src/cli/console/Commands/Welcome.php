<?php
namespace Mora\Core\cli\Console\Commands;

use Mora\Core\cli\Console\Output;
use Mora\Core\cli\Console\CliConfig;
use Mora\Core\cli\Console\CliStrings;
use Mora\Core\cli\Helpers\SkeletonLoader;
use Mora\Core\Config\JsonConfigManager;

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
        $command = "    php mora \033[1;4;34m".CliStrings::get("command")."<nc> <green>[".CliStrings::get("subcommand")." <cyan>args<green>]<nc>\r\n";
        $tip = Output::style(CliStrings::get("usage_tip"))."\r\n"; 
        Output::print($welcome,self::getLogo(),$usage,$command,$tip);
    }
    private static function printCommandList(){
        ob_start();
        Output::printWarning(CliStrings::get("command_list"));
        $path = __DIR__ . "/CommandList.json";
        $conf = new JsonConfigManager($path);
        $commands = $conf->getConfigsArray();
        foreach ($commands as $command => $subcommands) {
            Output::print("\r\n\033[1;4;34m$command<nc>","\r\n");
            foreach ($subcommands as $subcommand => $details) {
                Output::print(CliStrings::replace("\r\n  <green>$subcommand <cyan>".$details["args"]."<nc>\r\n"));
                Output::print(CliStrings::get($details["desc"]),"\r\n");
            }
        }
        $text = ob_get_flush();
        file_put_contents(ROOT . "/welcome.txt",$text);
    }
}