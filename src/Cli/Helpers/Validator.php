<?php
namespace Mora\Core\Cli\Helpers;

class Validator
{
    public static function validClassname($name){
        return preg_match("/^[A-z][\w_]*$/",$name);
    }
}
