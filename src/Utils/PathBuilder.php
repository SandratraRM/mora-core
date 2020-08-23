<?php
namespace Mora\Core\Utils;

class PathBuilder {
    /**
     * @param uri String 
     */
    public static function buildPath($uri){
        return WEBROOT . $uri;
    }
}