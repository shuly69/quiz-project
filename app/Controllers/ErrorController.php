<?php
namespace App\Controllers;

class ErrorController {
    public function index() : void {
        \Services\View::render('404');
    }
}