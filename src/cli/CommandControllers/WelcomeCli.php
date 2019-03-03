<?php
namespace Mora\Core\cli\CommandControllers;

use Mora\Core\Control\Controller;
use Mora\Core\cli\Console\Commands\CommandHelp;
use Mora\Core\cli\Console\Commands\Welcome;
use Mora\Core\cli\Manager\Welcome\WelcomeList;

class WelcomeCli extends Controller
{

    public function index($params)
    {
        WelcomeList::decide();
    }

    public function ActionNotFound($actionName, $params)
    {
        $this->index($params);
    }

}