<?php
namespace Mora\Core\Cli\Interactive;

use Mora\Core\Cli\Helpers\Input;
use Mora\Core\Cli\Console\CliStrings;
use Mora\Core\Cli\Console\Output;

class InteractiveLang 
{
    public static function set(&$code){
        if ($code != null) {
            return;
        }
        Output::printWarning(CliStrings::get("lang_choice"));
        print("\r\n");
        $code = Input::ask("lang_code");
    }
}
