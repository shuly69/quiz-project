<?php
namespace Routing;

use App\Exception\Exception404;

Class Route {

    protected static array $accessPath = ['', 'account', 'registration', 'auth', 'logout', 'new-test', 'add-test', 'control-test', 'select', 'edit', 'update-test', 'api-test'];
   public static function addRoute(string $method, string $url, array $class) :void {
       $accessPath = ['', 'account', 'registration', 'auth', 'logout', 'new-test', 'add-test', 'control-test', 'select', 'edit', 'update-test', 'api-test'];
        $queryParams = $_GET['queryparams'] ?? '';
        if(strtoupper($method) === $_SERVER['REQUEST_METHOD'] && $url === $queryParams) {

            $controllerName = $class[0];
            $methodName = $class[1];
            if(file_exists($controllerName . '.php')) {
                $controller = new $controllerName;
                $controller->$methodName();
            }

        }elseif(!in_array($queryParams, $accessPath)) {
            $error = new \App\Controllers\ErrorController();
            $error->index();
        }


}

}