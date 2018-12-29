<?php
namespace Mora\Core\Cli\Interactive;

use Mora\Core\cli\Helpers\Input;
use Mora\Core\cli\Console\CliStrings;
class InteractiveFirewall 
{
    public static function create(&$name,&$targets,&$order){
        if ($name == null) {
            goto ASK;
        }elseif ($order == null) {
            goto ASKORDER;
        }else{
            goto SET;
        }
        ASK:
            $name = Input::ask("ask_firewall_name");
            $targets = Input::ask("ask_firewall_targets");
        ASKORDER:
            $order = Input::ask("firewall_priority");
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
    public static function priority(&$name,&$order){
        if ($name == null) {
            goto ASK;
        }elseif ($order == null) {
            goto ASKORDER;
        }
        ASK:
            $name = Input::ask("ask_firewall_name");
        ASKORDER:
            $order = Input::ask("firewall_priority");
    }
    public static function add_targets(&$name,&$targets){
        
        if ($name == null) {
            goto ASKNAME;
        }elseif ($targets == null) {
            goto ASKTARGETS;
        }else{
            goto SET;
        }
        ASKNAME:
            $name = Input::ask("ask_firewall_name");
        ASKTARGETS:
            $targets = Input::ask("ask_firewall_targets");
        SET:
            $targets =  explode(",",$targets);
    }
}
