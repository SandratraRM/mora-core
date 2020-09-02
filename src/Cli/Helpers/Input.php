<?php
namespace Mora\Core\Cli\Helpers;

use Mora\Core\Cli\Console\Output;
use Mora\Core\Cli\Console\CliStrings;

class Input
{
    public static function ask($key,$data = []){
        Output::printRequest(CliStrings::get($key,$data));
        return trim(fgets(STDIN));
    }
}
