<?php
namespace Mora\Core\cli\Helpers;

use Mora\Core\cli\Console\Output;
use Mora\Core\cli\Console\CliStrings;

class Methods
{
    public static function ask($key){
        
        Output::printRequest(CliStrings::get($key));
        return trim(fgets(STDIN));
    }
}
