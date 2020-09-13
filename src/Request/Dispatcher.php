<?php
namespace Mora\Core\Request;

use FlorianWolters\Component\Core\StringUtils;

class Dispatcher
{

    private static function sliceRequest(){
        $request = str_ireplace(WEBROOT,"",$_SERVER["REQUEST_URI"]);
        $request = trim($request,"/");
        $request = StringUtils::substringBefore($request,"?");
        $request = StringUtils::substringBefore($request,"#");
        return explode("/",$request);
    }

    public static function extractRequestParts(){
        $requests_parts = self::sliceRequest();
        $controller = $requests_parts[0];
        $action = "index";
        $args = [];
        switch (count($requests_parts)){
            case 1:
                $controller =  $controller;
                break;
            case 2:
                $action = $requests_parts[1];
                break;
            default:
                $action = $requests_parts[1];
                $args = array_slice($requests_parts,2);
                break;
        }
        return ["controller" => $controller,"action"=> $action,"args" => $args];
    }
}