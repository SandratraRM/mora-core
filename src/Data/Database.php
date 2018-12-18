<?php
namespace Mora\Core\Data;
use PDO;
class Database{
    private $connexion;
    public function __construct() {
        $conf = require_once CONFIG . "/DatabaseConf.php";
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
            $this->connexion = new PDO($dsn,$user,$pass,$options);
        } catch(\PDOException $e){
            echo $e->getMessage();
        }
    }
    public function getConnex()
    {
        return $this->connexion;
    }

    public function close(){
        $this->connexion = null;
    }
}