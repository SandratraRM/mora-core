<?php
namespace Mora\Core\Data;
use PDO;
class Database{
    
    public static function setConnex($conf = []) {
        $conf = (empty($conf))? require CONFIG . "/DatabaseConf.php": $conf;
        $type = $conf["driver"];
        $host = $conf["host"];
        $port = $conf["port"];
        $dbname = $conf["dbname"];
        $user = $conf["user"];
        $pass = $conf["pass"];
        $charset = $conf["charset"];
        $dsn = "$type:host=$host;dbname=$dbname;port=$port;charset=$charset";
        $options = $conf["options"];
        try{
            $GLOBALS["PDOConnexion"] = new PDO($dsn,$user,$pass,$options);
        } catch(\PDOException $e){
            echo $e->getMessage();
        }
    }

    public static function getConnex()
    {
        if(!isset($GLOBALS["PDOConnexion"] )){
            self::setConnex();
        }
        return $GLOBALS["PDOConnexion"];
    }

    public static function close(){
        unset($GLOBALS["PDOConnexion"]);
    }
}