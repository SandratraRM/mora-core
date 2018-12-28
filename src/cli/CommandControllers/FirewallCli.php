<?php
namespace Mora\Core\cli\CommandControllers;

use Mora\Core\Control\Controller;
use Mora\Core\Cli\Interactive\InteractiveFirewall;
use Mora\Core\cli\Manager\Firewall\FirewallNew;
use Mora\Core\cli\Console\Commands\CommandHelp;
use Mora\Core\cli\Manager\Firewall\FirewallList;
use Mora\Core\cli\Manager\Firewall\Firewalldelete;
use Mora\Core\Cli\Helpers\Confirm;

class FirewallCli extends Controller
{

    public function index($params)
    {
        CommandHelp::printCommand("firewall");
    }

    public function ActionNotFound($actionName, $params)
    {
        
    }

    public function create($params)
    {
        InteractiveFirewall::create($params[0],$params[1]);
        FirewallNew::create($params[0],$params[1]);
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
        Firewalldelete::firewall($params[0]);
    }

    public function rename($params)
    {

    }

    public function add_targets($params)
    {

    }

    public function delete_targets($params)
    {

    }

}