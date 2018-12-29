<?php
namespace Mora\Core\Cli\Interactive;

use Mora\Core\cli\Helpers\Input;

class InteractiveLang 
{
    public static function set(&$code){
        if ($code != null) {
            return;
        }
        $code = Input::ask("lang_code");
    }
}
