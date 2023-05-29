<?php
namespace App\Controllers;


use App\Models\Test;
use Services\Request;

class SortingController {
    public function select() : void {
        $test = new Test();
        $request = new Request($test);
        $value = $request->validation();
        $tests = $test->findAllOrder($value['select']);
        echo json_encode(['status' => true, 'value' => $tests]);
    }
}