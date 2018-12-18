<?php
namespace Mora\Core\cli;

use Mora\Core\cli\Helpers\ArgsInterpreter;
use Mora\Core\cli\Console\Commands\Welcome;
use Mora\Core\cli\Console\Commands\CommandList;
use Mora\Core\cli\Console\Commands\SingleCliOptionManager;

class Mora_cli{
    private  $args;
    
    private function __construct($args = [])
    {
        $this->args = $args;
    }

    public static function exec($args = []){
        $args = array_slice($args,1);
        $cli = new self($args);
        $cli->dispatch();
    }

    

    private function dispatch(){
        $i = new ArgsInterpreter($this->args);
        switch (count($this->args)) {
            case 0:
                CommandList::welcome();
                break;
            case 1:
                if($i->isOption($this->args[0])){
                    SingleCliOptionManager($this->args[0]);
                }else{
                    $this->executor($this->args[0]);
                }
                break;
            default:
                if($i->isOption($this->args[0])){
                    $method = $this->args[1];
                    $params = array_slice($this->args,2);
                    $option = $this->args[0];
                }else{
                    $method = $this->args[0];
                    $params = array_slice($this->args,1);
                    $option = null;
                }
                $this->executor($method,$params,$option);
                break;
        }
    }
    private function executor($method,$parms = [],$option = null){
        if(method_exists(CommandList::class,$method)){
            CommandList::$method($parms,$option);
        }
        else{
            CommandList::welcome();
        }
    }
}