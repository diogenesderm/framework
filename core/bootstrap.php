<?php

    session_start();

print_r($_SESSION);
$routes = require_once __DIR__ . '/../app/routes.php';
$route = new \Core\Route($routes);
