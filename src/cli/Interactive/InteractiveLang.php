<?php
namespace Mora\Core\Cli\Interactive;

use Mora\Core\cli\Helpers\Input;
use Mora\Core\cli\Console\CliStrings;
use Mora\Core\cli\Console\Output;

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
