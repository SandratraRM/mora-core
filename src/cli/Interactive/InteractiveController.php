<?php

namespace Mora\Core\Cli\Interactive;

use Mora\Core\cli\Helpers\Methods;

class InteractiveController
{
    public static function create(&$name,&$actions){
        if ($name == null) {
            goto ASK;
        }else{
            goto SET;
        }
        ASK:
        $name = Methods::ask("ask_controller_name");
        $actions = Methods::ask("ask_controller_actions");
        SET:
        $actions = ($actions == "")? [] : explode(",",$actions);
    }
    public static function delete(&$name){
        if ($name != null) {
            goto SET;
        }
        $name = Methods::ask("ask_controller_name");
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
        $old = Methods::ask("enter_old_name");
        NEWNAME:
        $new = Methods::ask("enter_new_name");
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
            $name = Methods::ask("ask_controller_name");
        ASKACTIONS:
            $actions = Methods::ask("ask_controller_actions");
        SET:
            $actions = explode(",",$actions);
    }
}