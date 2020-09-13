<?php
namespace Mora\Core\Control;


/**
 * Class Controller
 * @package Mora\Core\Control
 */
abstract class Controller implements ControllerActions
{

    /**Execute the action if it exists, else calling actionNotFound method
     * @param string $action The action name
     * @param array $params An array that olds the arguments part of the request
     */
    public function doAction($action,$params){
        if(method_exists($this,$action)){
            $this->$action($params);
        }
        else{
            $this->actionNotFound($action,$params);
        }
    }

}