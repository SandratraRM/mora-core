<?php
namespace Mora\Core\cli\CommandControllers;

use Mora\Core\Control\Controller;
use Mora\Core\cli\Manager\Controller\ControllerNew;
use Mora\Core\cli\Manager\Controller\ControllerDelete;
use Mora\Core\cli\Manager\Controller\ControllerEdit;
use Mora\Core\cli\Manager\Controller\ControllerList;
use Mora\Core\cli\Manager\Firewall\FirewallMessage;
use Mora\Core\cli\Manager\Controller\ControllerMessage;
use Mora\Core\cli\Helpers\Methods;
use Mora\Core\Cli\Interactive\InteractiveController;
use Mora\Core\cli\Console\Commands\CommandHelp;
use Mora\Core\cli\Console\Output;
use Mora\Core\cli\Console\CliStrings;
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