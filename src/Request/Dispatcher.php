<?php
namespace Mora\Core\Request;


class Dispatcher
{

    private static function sliceRequest(){
        $request = str_ireplace(WEBROOT,"",$_SERVER["REQUEST_URI"]);
        $request = trim($request,"/");
        return explode("/",$request);
    }

    public static function extractRequestParts(){
        $requests_parts = self::sliceRequest();
        $controller = $requests_parts[0];
        $action = "index";
        $args = [];
        switch (count($requests_parts)){
            case 1:
                $controller = (!empty($_GET))? "" : $controller;
                break;
            case 2:
                $action = (!empty($_GET))? "index" : $requests_parts[1];
                break;
            default:
                $action = $requests_parts[1];
                if(!empty($_GET))
                    array_pop($requests_parts);
                $args = array_slice($requests_parts,2);
                break;
        }
        return ["controller" => $controller,"action"=> $action,"args" => $args];
    }
}