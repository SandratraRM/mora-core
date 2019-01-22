<?php
namespace Mora\Core\cli\CommandControllers;

use Mora\Core\Control\Controller;
use Mora\Core\Cli\Interactive\InteractiveRoute;

class RouteCli extends Controller
{

    public function index($params)
    {

    }

    public function ActionNotFound($actionName, $params)
    {
        
    }

    public function set($params)
    {
        InteractiveRoute::set($params);
        
    }

    public function list($params)
    {

    }

    public function delete($params)
    {

    }

}