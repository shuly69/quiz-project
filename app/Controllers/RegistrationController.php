<?php
namespace App\Controllers;

use App\Models\User;
use Services\Request;
use Services\View;

class RegistrationController {
    public function index() : void {
        if(isset($_SESSION['user'])) {
            View::redirect('account');
        }
        View::render('Registration');
    }

    public function newUser() : void {
        $user = new User();
        $validationArray = new Request($user);
        $values = $validationArray->validation(['email' => 'required|min:5|max:30|unique', 'name' => 'required|min:4|max:30|unique', 'password' => 'password-hash|required|min:8', 'password-confirm' => 'password-confirm|required']);
        $user->admin = 0;
        $user->email = $values['email'];
        $user->name = $values['name'];
        $user->password = $values['password'];
        if(!empty($values['errors'])) {
            $responseArray = ['status' => false, 'errors' => $values['errors']];
        }else {
            $user->save();
            $responseArray = ['status' => true, 'message' => 'successful', 'path' => 'auth'];
        }
        echo json_encode($responseArray);
    }
}
