<?php 
namespace Mora\Core\Cli\Console;
class Output{
    private static $map = [
        "<b>" => "\033[1m",
        "<u>" => "\033[1m",
        "<black>" => "\033[30m",
        "<red>" => "\033[31m",
        "<green>" => "\033[32m",
        "<yellow>" => "\033[33m",
        "<blue>" => "\033[34m",
        "<magenta>" => "\033[35m",
        "<cyan>" => "\033[36m",
        "<white>" => "\033[37m",
        "<Bblack>" => "\033[40m",
        "<Bred>" => "\033[41m",
        "<Bgreen>" => "\033[42m",
        "<Byellow>" => "\033[43m",
        "<Bblue>" => "\033[44m",
        "<Bmagenta>" => "\033[45m",
        "<Bcyan>" => "\033[46m",
        "<Bwhite>" => "\033[47m",
        "<nc>" => "\033[0m",
        "<lb>" => "\r\n"
    ];
    public static function style($text){

        return str_replace(array_keys(self::$map),USE_CLI_COLORS ? array_values(self::$map) : "",$text);
    }
    public static function print(...$texts){
        foreach($texts as $text){
            printf(self::style($text));
        }
    }
    public static function printError(...$texts){
        foreach ($texts as $text ) {
            self::print(
                "<red>",
                $text,
                "<nc>\r\n"
            );
        }
    }
    public static function printSuccess(...$texts){
        foreach ($texts as $text ) {
            self::print(
                "<green>",
                $text,
                "<nc>\r\n"
            );
        }
    }
    public static function printWarning(...$texts){
        foreach ($texts as $text ) {
            self::print(
                "<yellow>",
                $text,
                "<nc>\r\n"
            );
        }
    }
    
    public static function printRequest(...$texts){
        foreach ($texts as $text ) {
            self::print(
                "<blue>",
                $text,
                "<nc>"
            );
        }
    }
    public static function table($rows,$head = []){
        $tbl = new \Console_Table();
        if (!empty($head)) {
            $tbl->setHeaders($head);
        } 
        foreach ($rows as $key => $row) {
            $tbl->addRow($row);
            if($key < count($rows) - 1)
            $tbl->addSeparator();
        }
        $tbl->setBorder(CONSOLE_TABLE_BORDER_ASCII);
        return $tbl->getTable();
    }
}