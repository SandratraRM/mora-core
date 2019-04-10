<?php
namespace Mora\Core\cli\CommandControllers;

use Mora\Core\cli\Console\Output;
use Mora\Core\Control\Controller;
use Mora\Core\Cli\Helpers\Confirm;
use Mora\Core\cli\Manager\Routes\RouteNew;
use Mora\Core\cli\Manager\Routes\RouteList;
use Mora\Core\cli\Console\Commands\CommandHelp;
use Mora\Core\Cli\Interactive\InteractiveRoute;
use Mora\Core\cli\Manager\Routes\CustomRoutesManager;
use Mora\Core\cli\Manager\Routes\RouteDelete;

class RouteCli extends Controller
{

    public function index($params)
    {
        
        Output::print("\r\n");
        CommandHelp::printCommand("route");
        Output::print("\r\n");
    }

    public function ActionNotFound($actionName, $params)
    {
        
    }

    public function set($params)
    {
        InteractiveRoute::set($params);
        RouteNew::set($params);
        
    }

    public function list($params)
    {
        RouteList::all();
    }

    public function delete($params)
    {
        InteractiveRoute::delete($params[0]);
        if (Confirm::delete()) {
        RouteDelete::unset($params[0]);
        }
    }

}