<?php
namespace Mora\Core\Cli\CommandControllers;

use Mora\Core\Control\Controller;
use Mora\Core\Cli\Console\Commands\CommandHelp;
use Mora\Core\Cli\Console\Commands\Welcome;
use Mora\Core\Cli\Manager\Welcome\WelcomeList;

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