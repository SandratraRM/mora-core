<?php
namespace Mora\Core\cli\CommandControllers;

use Mora\Core\Control\Controller;
use Mora\Core\Cli\Interactive\InteractiveLang;
use Mora\Core\cli\Console\Lang\Lang;
use Mora\Core\cli\Console\Commands\CommandHelp;

class LangCli extends Controller
{

    public function index($params)
    {
        CommandHelp::printCommand("lang");
    }

    public function ActionNotFound($actionName, $params)
    {
        
    }

    public function list($params)
    {
        Lang::listLangs();
    }

    public function set($params){
        InteractiveLang::set($params[0]);
        Lang::changeLang($params[0]);
    }

}