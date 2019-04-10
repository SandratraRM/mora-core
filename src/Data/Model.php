<?php
namespace Mora\Core\Data;

use PDO;

abstract class Model
{

    /**
     * @var PDO $connexion
     */
    protected $table;
    /**
     * Model constructor.
     * @param null|PDO $connexion
     */
    public function __construct($connexion = null)
    {
        $namespaces = explode("\\",get_class($this));
        $this->table = str_ireplace("Model","",$namespaces[count($namespaces) -1 ]);
    }

    /**
     * @return mixed
     */
    protected function getTable()
    {
        return $this->table;
    }

    /**
     * @param mixed $table
     */
    protected function setTable($table): void
    {
        $this->table = $table;
    }

    /**
     * Return the PDO object to reuse for other model
     * @return null|PDO
     */
    protected function getConnexion(){
        return Database::getConnex();
    }


    /**
     * Shortcut for Counting
     * @param string $cond
     * @param array $params
     * @return mixed
     */
    protected function Count($cond = '', $params = []){
        return $this->readColumn('COUNT(*)',$cond,$params);
    }

    /**
     * @param string $col
     * @param string $cond
     * @param array $params
     * @return mixed
     */
    protected function ReadColumn($col, $cond = "", $params = []){
        $res = $this->Select($col,$cond,$params);
        return $res->fetchColumn();
    }

    /**
     * @param string $cond
     * @param array $params
     * @param string $col
     * @return array
     */
    protected function ReadAll($cond = '', $params = [], $col = '*'){
        $res = $this->Select($col,$cond,$params);
        return $res->fetchAll();
    }

    /**
     * @param string $cond
     * @param array $params
     * @param string $col
     * @return mixed
     */
    protected function ReadFirst($cond = '', $params = [], $col = '*'){

        $res = $this->Select($col,$cond,$params);
        return $res->fetch();
    }
    private function execute($sql, $params){
        $res = Database::getConnex()->prepare($sql);
        $res->execute($params);
        return $res;
    }

    private function Select($col,$cond,$params){
        $sql = "SELECT $col FROM $this->table $cond";
        $res = $this->execute($sql,$params);
        return $res;
    }

    /**
     * @param string $set
     * @param string $condition
     * @param array $paramss
     * @return bool|\PDOStatement
     */
    protected function Update($set, $condition, $params)
    {
        $sql = "UPDATE $this->table SET $set $condition";
        return $this->execute($sql,$params);
    }

    /**
     * @param string $constraint
     * @param array $paramss
     * @return bool|\PDOStatement
     */
    protected function Delete($constraint, $params)
    {
        $sql = "DELETE FROM $this->table ". $constraint;
        return $this->execute($sql,$params);
    }


    /**
     * @param array $values
     * @param string $fields
     * @return bool|\PDOStatement
     */
    protected function Insert($values, $fields  = "")
    {
        $fields = ($fields == '')? "" : "($fields)";
        $placeholders = "?" . str_repeat(",?",count($values) - 1);
        $sql = "INSERT INTO $this->table $fields VALUES ($placeholders)";
        return $this->execute($sql,$values);

    }

    /**
     * @return string
     */
    protected function lastId(){
        return Database::getConnex()->lastInsertId();
    }

    


}