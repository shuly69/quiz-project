<?php
namespace Services;
use PDO;
class Db {
    private static  $instance;
    private PDO $db;
    private function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=test', 'root', '');
        $this->db->exec('SET NAMES UTF8');
    }

    public static function getInstance() : object {
        if(static::$instance === null) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    public function query(string $sql, array $params = []) : ?\PDOStatement {
        $sth = $this->db->prepare($sql);
        $sth->execute($params);
        return $sth;
    }
}
