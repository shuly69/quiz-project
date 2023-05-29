<?php
namespace App\Controllers;

use App\Models\Test;

Class ApiController {
    public function index() {
        $testModel = new Test();
        $countRow = $testModel->countLine();
        $randomNum = rand(1, (int)$countRow[0]);
        $randomTest = $testModel->findById($randomNum);
        echo $randomTest['body_test'];
    }
}