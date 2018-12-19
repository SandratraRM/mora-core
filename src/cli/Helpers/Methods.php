<?php
namespace Mora\Core\cli\Helpers;

use Mora\Core\cli\Console\Output;
use Mora\Core\cli\Console\CliStrings;

class Methods
{
    public static function ask($key,$data = []){
        
        Output::printRequest(CliStrings::get($key,$data));
        return trim(fgets(STDIN));
    }
}
