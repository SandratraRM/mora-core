<?php
namespace Mora\Core\Cli\Interactive;

use Mora\Core\cli\Helpers\Input;
/**
 * undocumented class
 */
class InteractiveFirewall 
{
    public static function create(&$name,&$targets){
        if ($name == null) {
            goto ASK;
        }else{
            goto SET;
        }
        ASK:
            $name = Input::ask("ask_firewall_name");
            $targets = Input::ask("ask_firewall_targets");
        SET:
            $targets = ($targets == "")? [] : explode(",",$targets);
    }
}
