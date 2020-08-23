<?php

namespace Mora\Core\cli\Console\Commands;

use Mora\Core\cli\Console\Output;
use Mora\Core\cli\Console\CliStrings;
use Mora\Core\Config\JsonConfigManager;

class CommandHelp
{
    private static $path = __DIR__ . "/CommandList.json";

    public static function printAll(){
        $conf = new JsonConfigManager(self::$path);
        $commands = $conf->getConfigsArray();
        foreach ($commands as $command => $subcommands) {
            Output::print("\r\n<blue>$command<nc>","\r\n");
            foreach ($subcommands as $subcommand => $details) {
                Output::print(CliStrings::replace("\r\n  <green>$subcommand <cyan>".$details["args"]."<nc>\r\n"));
                Output::print(CliStrings::get($details["desc"]),"\r\n");
            }
        }
    }
    public static function printCommand($command){
        $conf = new JsonConfigManager(self::$path);
        Output::printWarning("",CliStrings::get("sub_command_list",["name"=>$command]));
        $subcommands = $conf->getConfig($command);
        foreach ($subcommands as $subcommand => $details) {
            Output::print(CliStrings::replace("\r\n  <green>$subcommand <cyan>".$details["args"]."<nc>\r\n"));
            Output::print(CliStrings::get($details["desc"]),"\r\n");
        }
        print("\r\n");
    }
}