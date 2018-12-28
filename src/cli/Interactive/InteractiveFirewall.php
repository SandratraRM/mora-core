<?php
namespace Mora\Core\Cli\Interactive;

use Mora\Core\cli\Helpers\Input;
use Mora\Core\cli\Console\CliStrings;
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
            $targets =  explode(",",$targets);
    }
    public static function delete(&$name){
        if ($name != null) {
            goto SET;
        }
        $name = Input::ask("ask_element_to_delete",["element"=>CliStrings::get("firewall")]);
        SET:
            $name = explode(",",$name);
    }
}
