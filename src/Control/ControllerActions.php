<?php
namespace Mora\Core\Control;


/**Default actions that every Controller Class must implements
 * @package Mora\Core\Control
 */
interface ControllerActions{
    /**This is the default action that the controller will execute
     * @param array $params An array that olds the arguments part of the request
     * @return mixed
     */
    public function index($params = []);

    /**This method is used to set some come control when calling one of the actions
     * It should call the ActionNotFound method
     * @param string $action The action name
     * @param array $params An array that olds the arguments part of the request
     * @return mixed
     */
    public function doAction($action, $params = []);

    /**This is the method called when a requested action is not set
     * @param string $actionName The action name
     * @param array $params An array that olds the arguments part of the request
     * @return mixed
     */
    public function ActionNotFound($actionName, $params = []);
}