<?php
namespace Mora\Core\cli\Manager\Firewall;

use Mora\Core\cli\Console\Output;
use Mora\Core\cli\Console\CliStrings;

class FirewallMessage{
    
    public static function create_success($name,$targets){
        Output::printSuccess(CliStrings::get(
            "firewall_create_success",
            [
                "name"=>$name,
                "targets"=>implode(",",$targets)
            ]
        ));
    }

    public static function rename_success($old,$new){
        Output::printSuccess(CliStrings::get(
            "firewall_rename_success", 
            [
                "old"=>$old,
                "new"=>$new
            ]
        ));
    }
    public static function name_conflict_error($name){
        Output::printError(CliStrings::get(
            "firewall_name_conflict",
            ["name"=>$name]
        ));
    }
    public static function firewall_not_found($name){
        Output::printError(CliStrings::get(
            "firewall_not_found",
            ["name"=>$name]
        ));
    }
    public static function targets_delete_success($targets){

    }
    public static function firewall_delete_success($name){

    }

}