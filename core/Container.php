<?php

namespace Core;

use Core\Database;

class Container
{
    public static function newController($controller)
    {
        $objController = "App\\Controllers\\" . $controller;
        return new $objController;
    }

    public static function pageNotFound()
    {
        if (file_exists(__DIR__ . '/../app/Views/404.phtml')) {
            return require_once __DIR__ . '/../app/Views/404.phtml';
        } else {
            echo 'Pagina 404 nao encontrada';
        }
    }

    public static function getModel($model)
    {
        $objModel = "\\App\\Models\\" . $model;

        return new $objModel(Database::getDataBase());
    }
}
