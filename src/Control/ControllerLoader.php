<?php
namespace Mora\Core\Control;



use Mora\Core\Request\CustomRoute;

/**This is the Class used to load a controller
 * Class ControllerLoader
 * @package Mora\Core\Http
 */
class ControllerLoader
{
    /**
     * @var Controller $controller the controller that will be loaded
     */
    private $controller;

    /**
     * ControllerLoader constructor.
     * @param string $controller_name
     */
    public function __construct($controller_name)
    {   $controller = $this->load($controller_name);
        $this->controller = ($controller)? $controller : null;
    }

    /**
     * @param $controller
     * @return bool
     */
    private function load($controller){
        if(static::exists($controller)){
            $controller = PROJECT_NAME . "\Controller\\" . $controller . "Controller";
            return new $controller();
        }
        else{
            return false;
        }
    }
    private  static function getDefaults(){
        return require_once CONFIG . "/DefaultControllers.php";
    }
    private static function getDefaultHomepage(){
        return self::getDefaults()["homepage"];
    }
    private static function getDefaultNotFound(){
        return self::getDefaults()["default"];
    }
    public static function guessController($controller_name){
        $controller = ($controller_name == "")? self::getDefaultHomepage() : $controller_name;
        $controller = (CustomRoute::routeExists($controller))?  CustomRoute::getControllerName($controller) : $controller;
        $controller = (ControllerLoader::exists($controller))? $controller : self::getDefaultNotFound();
        return ucfirst(strtolower($controller)) ;
    }
    /**
     * @param $controller
     * @return bool
     */
    public static function exists($controller){
        return file_exists(CONTROLLER . "/$controller"."Controller.php");
    }
    /**
     * @param $action
     * @param $args
     */
    public function execute($action, $args = []){
        if($this->controller == null)
            return false;
        else{
            $this->controller->doAction($action,$args);
        }
        return true;
    }

}