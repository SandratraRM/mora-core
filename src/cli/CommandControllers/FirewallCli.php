<?php
namespace Mora\Core\cli\CommandControllers;

use Mora\Core\Control\Controller;
use Mora\Core\Cli\Interactive\InteractiveFirewall;
use Mora\Core\cli\Manager\Firewall\FirewallNew;

class FirewallCli extends Controller
{

    public function index($params)
    {

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

    }

    public function delete($params)
    {

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