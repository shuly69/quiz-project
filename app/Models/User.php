<?php
namespace App\Models;

use Services\ActiveRecordEntity;
use Services\Db;

class User extends ActiveRecordEntity {
    protected int $id;
    protected int $admin;
    protected string $email;
    protected string $name;
    protected string $password;
    protected  string $dt_add;

    public function getEmail() : string {
        return $this->email;
    }

    public function getName() : string {
        return $this->name;
    }

    public function getId() : int {
        return $this->id;
    }

    public function getUser(string $email) {

        $db = Db::getInstance();
        $sql = 'SELECT * FROM ' . static::getNameTable() . ' WHERE email=:email';
        $stmt = $db->query($sql, ['email' => $email]);
        return $stmt->fetchObject(static::class);
    }


    protected function getArrayProperty(): array
    {
        $this->arrayProperty['admin'] = $this->admin;
        $this->arrayProperty['email'] = $this->email;
        $this->arrayProperty['name'] = $this->name;
        $this->arrayProperty['password'] = $this->password;
        return $this->arrayProperty;
    }

    public  function getUniqueElem(string $nameField) : array {
        $db = Db::getInstance();
        $sql = 'SELECT ' . $nameField . ' FROM ' . static::getNameTable();
        $result = $db->query($sql, []);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function passwordControl(string $email, $password) : bool {

        $user = $this->getUser($email);
        if ($user) {
            return password_verify($password, $user->password);
        }
        return false;
    }

    public function isAdmin() :bool {
        if($this->admin === 1) {
            return true;
        }
        return false;
    }

}