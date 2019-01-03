<?php

namespace Mora\Core\Control ;

class Redirect
{
    public static function local($path){
        header("location:".WEBROOT.$path);
    }
    
    public static function external($path){
        header("location:".$path);
    }

}