<?php
namespace Mora\Core\cli\CommandControllers;

use Mora\Core\Control\Controller;
use Mora\Core\cli\Manager\Controller\ControllerNew;
use Mora\Core\cli\Manager\Controller\ControllerDelete;
use Mora\Core\cli\Manager\Controller\ControllerEdit;
use Mora\Core\cli\Manager\Controller\ControllerList;
use Mora\Core\cli\Manager\Firewall\FirewallMessage;
use Mora\Core\cli\Manager\Controller\ControllerMessage;

class ControllerCli extends Controller
{

    public function index($params)
    {

    }

    public function ActionNotFound($actionName, $params)
    {

    }

    public function create($params)
    {
        if (count($params) >= 1) {
            $action = (isset($params[1])) ? explode(",", $params[1]) : [];
            $name = ucfirst(strtolower($params[0]));
            ControllerNew::new($name, $action);
        } else {
            ControllerNew::Interactive();
        }
    }

    public function delete($params)
    {
        if (isset($params[0])) {
            $name = ucfirst(strtolower($params[0]));
            ControllerDelete::delete($name);
        }else {
            ControllerDelete::Interactive();
        }
    }

    public function rename($params)
    {
        if(isset($params[1])){
            ControllerEdit::rename($params[0],$params[1]);
        }elseif(isset($params[0])) {
            ControllerMessage::names_required();
        }else{
            ControllerEdit::InteractiveRename();
        }
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

    }

}