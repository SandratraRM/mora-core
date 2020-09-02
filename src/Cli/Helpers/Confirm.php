<?php

namespace Mora\Core\Cli\Helpers;

class Confirm
{
    public static function delete(){
        $answer = Input::ask("confirm_delete");
        return ($answer == "" || $answer == "yes");
    }
}