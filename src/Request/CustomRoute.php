<?php

namespace Mora\Core\Request;

use Mora\Core\Config\JsonConfigManager;

/**
 * Class CustomRoute
 * @package Mora\Core\Http
 */
class CustomRoute
{
    private static $path = CONFIG . "/CustomRoutes.json";

    /**
     * @return mixed
     */

    /**
     * @param $route
     * @return bool
     */
    public static function routeExists($route){
        $conf = new JsonConfigManager(self::$path);
        return $conf->hasConfig($route);
    }

    /**
     * @param $route
     * @return bool|string
     */
    public static function getControllerName($route){
       $conf = new JsonConfigManager(self::$path);
       return $conf->getConfig($route);
    }
}