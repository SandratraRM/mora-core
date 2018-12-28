<?php

namespace Mora\Core\Cli\Interactive;

use Mora\Core\cli\Helpers\Input;
use Mora\Core\cli\Console\CliStrings;

class InteractiveController
{
    public static function create(&$name,&$actions){
        if ($name == null) {
            goto ASK;
        }else{
            goto SET;
        }
        ASK:
        $name = Input::ask("ask_controller_name");
        $actions = Input::ask("ask_controller_actions");
        SET:
        $actions = ($actions == "")? [] : explode(",",$actions);
    }
    public static function delete(&$name){
        if ($name != null) {
            goto SET;
        }
        $name = Input::ask("ask_element_to_delete",["element"=>CliStrings::get("controller")]);
        SET:
            $name = explode(",",$name);
    }
    public static function rename(&$old,&$new){
        if ($old == null) {
            goto OLDNAME;
        }elseif($old != null && $new == null){
            goto NEWNAME;
        }else{
            return;
        }
        OLDNAME:
        $old = Input::ask("enter_old_name");
        NEWNAME:
        $new = Input::ask("enter_new_name");
    }
    public static function add_actions(&$name,&$actions){
        if ($name == null) {
            goto ASKNAME;
        }elseif($actions == null){
            goto ASKACTIONS;
        }else{
            goto SET;
        }
        ASKNAME:
            $name = Input::ask("ask_controller_name");
        ASKACTIONS:
            $actions = Input::ask("ask_controller_actions");
        SET:
            $actions = explode(",",$actions);
    }
}