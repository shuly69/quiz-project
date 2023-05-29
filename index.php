<?php

use App\Models\Test;

session_start();
require_once __DIR__ . '/vendor/autoload.php';



try {
    Routing\Route::addRoute('get', '', [App\Controllers\MainController::class, 'index']);
    Routing\Route::addRoute('get', 'account', [App\Controllers\AccountController::class, 'index']);
    Routing\Route::addRoute('get', 'registration', [App\Controllers\RegistrationController::class, 'index']);
    Routing\Route::addRoute('post', 'registration', [\App\Controllers\RegistrationController::class, 'newUser']);
    Routing\Route::addRoute('get', 'auth', [App\Controllers\AuthController::class, 'index']);
    Routing\Route::addRoute('post', 'auth', [App\Controllers\AuthController::class, 'auth']);
    Routing\Route::addRoute('get', 'logout', [App\Controllers\AuthController::class, 'logout']);
    Routing\Route::addRoute('get', 'new-test', [App\Controllers\AccountController::class, 'showFormTest']);
    Routing\Route::addRoute('post', 'add-test', [App\Controllers\AccountController::class, 'addFormTest']);
    Routing\Route::addRoute('post', 'control-test', [App\Controllers\AccountController::class, 'controlTest']);
    Routing\Route::addRoute('post', 'select', [App\Controllers\SortingController::class, 'select']);
    Routing\Route::addRoute('post', 'edit', [App\Controllers\AccountController::class, 'editTestById']);
    Routing\Route::addRoute('post', 'update-test', [App\Controllers\AccountController::class, 'updateFormTest']);
    Routing\Route::addRoute('get', 'api-test', [App\Controllers\ApiController::class, 'index']);
} catch(Exception $e) {
    $error = new \App\Controllers\ErrorController();
    $error->index();
}



