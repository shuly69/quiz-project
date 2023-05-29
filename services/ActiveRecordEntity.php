<?php
namespace Services;
use PDO;
Abstract class ActiveRecordEntity {
    protected array $arrayProperty = [];
    protected static function getNameTable() : string {
        $pathTableArray = explode('\\', static::class);
        return strtolower($pathTableArray[count($pathTableArray) - 1]) . 's';
    }

    public function findAll() {
        $db = Db::getInstance();
        $sql = 'SELECT * from ' . static::getNameTable();
        $result = $db->query($sql, []);
        return $result->fetchAll(PDO::FETCH_CLASS, static::class);
    }

    public function findAllOrder(string $name) {
        $db = Db::getInstance();
        $sql = 'SELECT * from ' . static::getNameTable() . ' ORDER BY ' . $name . ' DESC';
        $result = $db->query($sql, []);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById(int $id) {
        $db = Db::getInstance();
        $sql = 'SELECT * FROM ' . static::getNameTable() . ' WHERE id_test=:id';
        $result = $db->query($sql, ['id' => $id]);
        return $result->fetch();
    }

    public function update(int $id) : void {
        $values = $this->getArrayProperty();
        $db = Db::getInstance();
        $changeArrayKey = array_map(function($key){
            return ':' . $key;
        }, array_keys($values));
        $sql = 'UPDATE ' . static::getNameTable() . ' SET body_test=? WHERE id_test=?';
        $db->query($sql, [$values['body_test'], $id]);
    }

    public function countLine() {
        $db = Db::getInstance();
        $sql = 'SELECT COUNT(id_test) FROM ' . static::getNameTable();
        $result = $db->query($sql, []);
        return $result->fetch();
    }

    public function save() : void {
        $values = $this->getArrayProperty();
        $db = Db::getInstance();
        $changeArrayKey = array_map(function($key){
            return ':' . $key;
        }, array_keys($values));
        $sql = 'INSERT INTO ' . static::getNameTable() . '(' . implode(", ", array_keys($values)) . ') VALUES (' . implode(", ", $changeArrayKey) . ')';
        $db->query($sql, $values);
    }

    public function __set(string $name, mixed $value) : void {
        if(property_exists(static::class, $name)) {
            $this->$name = $value;
        }
    }

   abstract protected function getArrayProperty() : array;

}