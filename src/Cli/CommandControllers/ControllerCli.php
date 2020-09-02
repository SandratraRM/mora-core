<?php
namespace Mora\Core\Cli\CommandControllers;

use Mora\Core\Control\Controller;
use Mora\Core\Cli\Manager\Controller\ControllerNew;
use Mora\Core\Cli\Manager\Controller\ControllerDelete;
use Mora\Core\Cli\Manager\Controller\ControllerEdit;
use Mora\Core\Cli\Manager\Controller\ControllerList;
use Mora\Core\Cli\Manager\Firewall\FirewallMessage;
use Mora\Core\Cli\Manager\Controller\ControllerMessage;
use Mora\Core\Cli\Helpers\Methods;
use Mora\Core\Cli\Interactive\InteractiveController;
use Mora\Core\Cli\Console\Commands\CommandHelp;
use Mora\Core\Cli\Console\Output;
use Mora\Core\Cli\Console\CliStrings;
use Mora\Core\Cli\Helpers\Confirm;

class ControllerCli extends Controller
{

    public function index($params)
    {
        Output::print("\r\n");
        CommandHelp::printCommand("controller");
        Output::print("\r\n");
    }

    public function ActionNotFound($actionName, $params)
    {

    }

    public function create($params)
    {
        InteractiveController::create($params[0],$params[1]);
        ControllerNew::new($params[0],$params[1]);
    }

    public function delete($params)
    {
        InteractiveController::delete($params[0]);
        if (Confirm::delete()) {
            ControllerDelete::delete($params[0]);
        }
    }

    public function rename($params)
    {
        InteractiveController::rename($params[0],$params[1]);
        ControllerEdit::rename($params[0],$params[1]);
    }

    public function list($params)
    {
        if(isset($params[0])){
            ControllerList::Action($params[0]);
        }else{
            ControllerList::all();
        }
    }

    public function add_actions($params)
    {
        InteractiveController::add_actions($params[0],$params[1]);
        ControllerEdit::add_actions($params[0],$params[1]);
    }

}