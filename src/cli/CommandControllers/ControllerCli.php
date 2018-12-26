<?php
namespace Mora\Core\cli\CommandControllers;

use Mora\Core\Control\Controller;
use Mora\Core\cli\Manager\Controller\ControllerNew;

class ControllerCli extends Controller
{

    public function index($params = [])
    {

    }

    public function ActionNotFound($actionName, $params = [])
    {

    }

    public function create($params = [])
    {
        if (count($params) >= 1) {
            $action = (isset($params[1])) ? explode(",", $params[1]) : [];
            $name = ucfirst(strtolower($params[0]));
            ControllerNew::new($name, $action);
        } else {
            ControllerNew::Interactive();
        }
    }

    public function delete($params = [])
    {

    }

    public function rename($params = [])
    {

    }

    public function list($params = [])
    {

    }

    public function add_actions($params = [])
    {

    }

}