<?php
namespace App\Models;

use Services\ActiveRecordEntity;
use Services\Db;

Class Test extends ActiveRecordEntity {
    protected int $id_test;
    protected mixed $body_test;
    protected int $id_user;
    protected string $dt_add;

    protected function getArrayProperty(): array
    {
        $this->arrayProperty['body_test'] = $this->body_test;
        $this->arrayProperty['id_user'] = $this->id_user;
        return $this->arrayProperty;
    }

    public function getTest() {
        return $this->body_test;
    }

    public function getIdTest() : int {
        return $this->id_test;
    }

    public function getIdUser() : string {
        return $this->id_user;
    }


}