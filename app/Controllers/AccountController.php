<?php
namespace App\Controllers;

use App\Models\Test;
use App\Models\User;
use Services\Request;
use Services\View;

class AccountController {

    public function index() : void {
        $model = new Test();
        $tests = $model->findAll();

         View::render('Account', ['quizzes' => $tests]);
    }

    public function showFormTest() :void {

        View::render('Account-add');
    }

    public function addFormTest() :void {
        $test = new Test();
        $request = new Request($test);
        $validated = $request->validation(['answer' => 'ane', 'answer-true' => 'required|control-true-answer', 'title' => 'required|min:10', 'question' => 'required|min:3']);
        if(!empty($validated['errors'])) {
            $responseArray = ['status' => false, 'errors' => $validated['errors']];
        }else {
            $test->body_test = json_encode($validated);
            $test->id_user = $_SESSION['id'];
            $test->save();
            $responseArray = ['status' => true, 'message' => 'Test added', 'path' => 'account'];
        }
        echo json_encode($responseArray);
    }

    public function updateFormTest() :void {
        $test = new Test();
        $request = new Request($test);
        $validated = $request->validation(['answer' => 'ane', 'answer-true' => 'required|control-true-answer', 'title' => 'required|min:10', 'question' => 'required|min:3']);
        if(!empty($validated['errors'])) {
            $responseArray = ['status' => false, 'errors' => $validated['errors']];
        }else {
            $id = $validated['id'];
            unset($validated['id']);
            $test->body_test = json_encode($validated);
            $test->id_user = $_SESSION['id'];
            $test->update((int)$validated);
            $responseArray = ['status' => true, 'message' => 'Test updated', 'path' => 'account'];
        }
        echo json_encode($responseArray);
    }

    public function controlTest() :void {
        $test = new Test();
        $request = new Request($test);
        $message = json_encode(['message' => $request->resultTest(), 'status' => true]);
        echo $message;
    }

    public function editTestById() : void {
        $test = new Test();
        $request = new Request($test);
        $validate = $request->validation([]);
        $testById = $test->findById($validate['id']);
        echo json_encode(['status' => true, 'test' => $testById]);

    }



}