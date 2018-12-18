<?php
namespace Mora\Core\Control;


interface FirewallActions
{
    public static function check();
    public static function onFailed();
}