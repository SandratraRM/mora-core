<?php
namespace Mora\Core\cli\Manager\Controller;

use Mora\Core\cli\Console\Output;
use Mora\Core\cli\Console\CliStrings;

class ControllerMessage
{
    public static function create_success($name, $actions)
    {
        $filename = CONTROLLER . "/{$name}Controller.php";
        if (empty($actions)) {
            Output::printSuccess(CliStrings::get("controller_create_succes", ["name" => $name, "path" => $filename]));
        } else {
            Output::printSuccess(CliStrings::get("controller_action_create", ["name" => $name, "actions" => implode(",", $actions), "path" => $filename]));
        }
    }
    public static function names_required()
    {
        Output::printError(CliStrings::get("rename_required_names"));
    }
    public static function delete_success($name)
    {
        Output::printSuccess(CliStrings::get("controller_delete_succes", ["name" => $name]));
    }

    public static function rename_success($old, $new)
    {
        Output::printSuccess(CliStrings::get("controller_rename_success", ["old" => $old, "new" => $new]));
    }

    public static function method_exists($method)
    {
        Output::printError(CliStrings::get("method_exists",["name"=>$method]));
    }

    public static function add_actions_success($controller, $actions)
    {
        Output::printSuccess(CliStrings::get("controller_add_actions", ["name" => $controller, "actions" => implode(",", $actions)]));
    }
    public static function controller_not_found($name)
    {
        Output::printError(CliStrings::get("controller_not_found", ["name" => $name]));
    }
}