<?php
namespace Mora\Core\Cli\Helpers;
/**
 * 
 */
class ArgsInterpreter
{
    private $args;
    public $options = [];

    public function __construct($args) {
        $this->args = $args;
        $this->parseOptions();
    }
    public function noArg(){
        return empty($this->args);
    }
    public function singleArg(){
        return count($this->args) == 1;
    }
    public function multiArg()
    {
        return (!$this->singleArg() && !$this->noArg());
    }
    public function hasOption($option){
        return in_array($option,$this->options);
    }
   
    public function getOptionValue($option){
        $key = array_search("-".$option,$this->args);
        $value = (isset($this->args[$key + 1 ]))? $this->args[$key + 1] : null;
        return $value;
    }

    public function argAt($pos){
        return $this->args[$pos];
    }

    private function parseOptions()
    {   
        $option = [];
        foreach ($this->args as $key => $value) {
            if($this->isOption($value)){
                $value = ltrim($value,"-");
                $option[] = $value;
            }
        }
        $this->options = $option;
    }
    public function isOption($value){
        return substr($value,0,1) == "-";
    }
}
