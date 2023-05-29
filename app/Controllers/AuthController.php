<?php
namespace App\Controllers;

use App\Models\User;
use Services\Request;
use Services\View;

class AuthController {
    public function index() : void {
        if(isset($_SESSION['user'])) {
            View::redirect('account');
        }
        View::render('Auth');
    }

    public function auth() : void {

        $user = new User();
        $request = new Request($user);

        $validation = $request->validation(['email' => 'required|min:5|max:30|email-verify', 'password' => 'required|min:8|password-verify']);

        $data = $user->getUser($validation['email']);

        if(!empty($validation['errors'])) {
            $responseArray = ['status' => false, 'errors' => $validation['errors']];
        }else {
            $_SESSION['user'] = $data->getName();
            $_SESSION['id'] = $data->getId();
            $_SESSION['admin'] = $data->isAdmin();
            $responseArray = ['status' => true, 'message' => 'successful', 'path' => 'account'];
        }
        echo json_encode($responseArray);
    }

    public function logout() : void {
       session_destroy();
        View::redirect('index.php');
    }
}