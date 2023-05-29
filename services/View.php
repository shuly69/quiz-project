<?php
namespace Services;

class View {
    public static function render(string $view, array $vars = []) : void {
        extract($vars);

        $pathToView = $_SERVER['DOCUMENT_ROOT'] . '/quiz-project/app/Views/' . $view . '.php';
        ob_start();
        if(file_exists($pathToView)) {
            require($pathToView);
        }
        ob_get_flush();
    }

    public static function redirect(string $url) : void {
        header('Location: ' . $url, true);
    }
}