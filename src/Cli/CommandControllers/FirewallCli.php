<?php
namespace Mora\Core\Cli\CommandControllers;

use Mora\Core\Control\Controller;
use Mora\Core\Cli\Interactive\InteractiveFirewall;
use Mora\Core\Cli\Manager\Firewall\FirewallNew;
use Mora\Core\Cli\Console\Commands\CommandHelp;
use Mora\Core\Cli\Manager\Firewall\FirewallList;
use Mora\Core\Cli\Manager\Firewall\FirewallDelete;
use Mora\Core\Cli\Helpers\Confirm;
use Mora\Core\Cli\Interactive\InteractiveController;
use Mora\Core\Cli\Manager\Firewall\FirewallEdit;
use Mora\Core\Control\Firewall;

class FirewallCli extends Controller
{

    public function index($params)
    {
        CommandHelp::printCommand("firewall");
    }

    public function actionNotFound($actionName, $params)
    {
        
    }

    public function create($params)
    {
        InteractiveFirewall::create($params[0],$params[1],$params[2]);
        FirewallNew::create($params[0],$params[1],$params[2]);
    }

    public function list($params)
    {
        if (isset($params[0])) {
            FirewallList::targets($params[0]);
        }else {
            FirewallList::all();
        }
    }

    public function delete($params)
    {
        InteractiveFirewall::delete($params[0]);
        if(Confirm::delete())
        FirewallDelete::firewall($params[0]);
    }

    public function rename($params)
    {
        InteractiveController::rename($params[0],$params[1]);
        FirewallEdit::rename($params[0],$params[1]);
    }
    public function priority($params){
        InteractiveFirewall::priority($params[0],$params[1]);
        FirewallEdit::priority($params[0],$params[1]);
    }
    public function add_targets($params)
    {
        InteractiveFirewall::add_targets($params[0],$params[1]);
        FirewallEdit::addTarget($params[0],$params[1]);
    }

    public function delete_targets($params)
    {
        InteractiveFirewall::add_targets($params[0],$params[1]);
        if (Confirm::delete()) {
            FirewallDelete::target($params[0],$params[1]);
        }
    }

}