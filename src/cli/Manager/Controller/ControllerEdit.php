<?php
namespace Mora\Core\cli\Manager\Controller;

use Mora\Core\cli\Helpers\SkeletonLoader;
use Mora\Core\Cli\Helpers\Refactor;
use Mora\Core\cli\Manager\Firewall\FirewallManager;
use Mora\Core\Config\JsonConfigManager;
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
            foreach ($actions as $action) {
                $file .= str_replace("{action}", $action, $action_sk);
            }
            $file .= "\n}";
            file_put_contents($filename, $file);
        }
    }
    public static function InteractiveRename(){
        $oldname = Methods::ask("enter_old_name");
        $newname = Methods::ask("enter_new_name");
        self::rename($oldname,$newname);
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
            # code...
        }
        
    }
    // TODO Rename Refactors
    private static function refactorRoute($old, $new)
    {
        $confPath = CustomRoutesManager::$path;
        $conf = new JsonConfigManager($confPath);
        $routes = $conf->getConfigsArray();
        while($key = array_search($old,$routes)){
            $routes[$key] = $new;
        }
        $conf->setConfigsArray($routes);
        $conf->writeConfig();
    }
    private static function refactorFirewall($old, $new)
    {
        $confPath = FirewallManager::$configpath;
        $conf = new JsonConfigManager($confPath);
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