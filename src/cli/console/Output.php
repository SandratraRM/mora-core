<?php 
namespace Mora\Core\cli\Console;
class Output{
    private static $map = [
        "<black>" => "\x1b[30m",
        "<red>" => "\x1b[31m",
        "<green>" => "\x1b[32m",
        "<yellow>" => "\x1b[33m",
        "<blue>" => "\x1b[34m",
        "<magenta>" => "\x1b[35m",
        "<cyan>" => "\x1b[36m",
        "<white>" => "\x1b[37m",
        "<Bblack>" => "\x1b[40m",
        "<Bred>" => "\x1b[41m",
        "<Bgreen>" => "\x1b[42m",
        "<Byellow>" => "\x1b[43m",
        "<Bblue>" => "\x1b[44m",
        "<Bmagenta>" => "\x1b[45m",
        "<Bcyan>" => "\x1b[46m",
        "<Bwhite>" => "\x1b[47m",
        "<nc>" => "\x1b[0m",
        "<lb>" => "\r\n"
    ];
    public static function style($text){
        return str_replace(array_keys(self::$map),array_values(self::$map),$text);
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
                "<nc>\r\n"
            );
        }
    }
}