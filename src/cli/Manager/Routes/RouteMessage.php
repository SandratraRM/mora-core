<?php
namespace Mora\Core\cli\Manager\Routes;

use Mora\Core\cli\Console\Output;
use Mora\Core\cli\Console\CliStrings;

class RouteMessage
{
    public static function set_success($a,$b){
        Output::printSuccess(CliStrings::get("route_set_success",["a"=>$a,"b"=>$b]));
    }
    public static function wrong_format(){
        Output::printError(CliStrings::get("route_wrong_format"));
    }
    public static function list(){
        Output::printWarning(CliStrings::get("show_route_list"));
    }
}
