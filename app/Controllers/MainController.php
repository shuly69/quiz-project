<?php
namespace App\Controllers;

use App\Models\User;
use Services\View;

Class MainController {
    public function index() : void {
        if(isset($_SESSION['user'])) {
            View::redirect('account');
        }
        View::render('Home');
    }
}