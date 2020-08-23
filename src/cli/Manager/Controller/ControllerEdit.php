<?php
namespace Mora\Core\cli\Manager\Controller;

use Mora\Core\cli\Helpers\SkeletonLoader;
use Mora\Core\Cli\Helpers\Refactor;
use Mora\Core\cli\Manager\Firewall\FirewallManager;
use Mora\Core\Config\ArrayConfigManager;
use Mora\Core\cli\Manager\Routes\CustomRoutesManager;
use Mora\Core\cli\Console\Output;
use Mora\Core\cli\Console\CliStrings;
use Mora\Core\cli\Helpers\Methods;

class ControllerEdit
{
    public static function add_actions($controller, $actions)
    {
        $filename = CONTROLLER . "/{$controller}Controller.php";
        if (file_exists($filename)) {
            $file = file_get_contents($filename);
            $file = trim($file);
            $file = rtrim($file, "}");
            $action_sk = SkeletonLoader::get("action");

            $methods = get_class_methods(PROJECT_NAME . "\\Controller\\{$controller}Controller");

            array_walk($methods,function(&$value,$key){
                $value = strtolower($value);
            });
            $added = [];

            foreach ($actions as $action) {
                if(!in_array(strtolower($action),$methods) && $action != ""){
                    $added []= $action;
                    $file .= str_replace("{action}", $action, $action_sk);
                }elseif(in_array(strtolower($action),$methods)) {
                    ControllerMessage::method_exists($action);
                }
            }

            $file .= "\n}";
            if(file_put_contents($filename, $file)){
                if(!empty($added)){
                    ControllerMessage::add_actions_success($controller,$added);
                }
            }


        }else {
            ControllerMessage::controller_not_found($controller);
        }
    }
    public static function rename($old, $new)
    {
        $old = ucfirst(strtolower($old));
        $new = ucfirst(strtolower($new));
        $oldPath = CONTROLLER . "/{$old}Controller.php";
        $newPath = CONTROLLER . "/{$new}Controller.php";
        if (file_exists($oldPath) && !file_exists($newPath)) {
            rename($oldPath,$newPath);
            self::refactorFileContents($old,$new);
            self::refactorRoute($old,$new);
            self::refactorFirewall($old,$new);
            ControllerMessage::rename_success($old,$new);
        } elseif (!file_exists($oldPath)) {
            ControllerMessage::controller_not_found($old);
        }elseif (file_exists($newPath)) {
            ControllerMessage::controller_exists($new);
        }
        
    }
    // TODO Rename Refactors
    private static function refactorRoute($old, $new)
    {
        $confPath = CustomRoutesManager::$path;
        $conf = new ArrayConfigManager($confPath);
        $routes = $conf->getConfigsArray();
        while($key = array_search($old,$routes)){
            $routes[$key] = $new;
        }
        $conf->setConfigsArray($routes);
        $conf->writeConfig();
    }
    private static function refactorFirewall($old, $new)
    {
        $confPath = FirewallManager::$path;
        $conf = new ArrayConfigManager($confPath);
        $firewalls = $conf->getConfigsArray();
        foreach ($firewalls as $firewall => $targets) {
            $key = array_search($old,$targets);
            $targets[$key] = $new;
            $conf->setConfig($firewall,$targets);
        }
        $conf->writeConfig();
    }
    private static function refactorFileContents($old, $new)
    {
        $old = $old."Controller";
        $new = $new."Controller";
        Refactor::files_str_replace(APP,$old,$new,false);
    }
}