<?php

session_start();

$conf = require_once __DIR__ . "/../app/database.php";

if ($conf['baseModel'] == 'illuminate') {

    $capsule = new Illuminate\Database\Capsule\Manager;
   
    if ($conf['driver']  == 'mysql') {
        $capsule->addConnection([
            'driver'    => 'mysql',
            'host'      => $conf['mysql']['host'],
            'database'  => $conf['mysql']['database'],
            'username'  => $conf['mysql']['user'],
            'password'  => $conf['mysql']['pass'],
            'charset'   => $conf['mysql']['charset'],
            'collation' => $conf['mysql']['collation'],
            'prefix'    => '',
        ]);
    } elseif ($conf['driver']  == 'SQlite') {
    }

    $capsule->bootEloquent();
}

$routes = require_once __DIR__ . '/../app/routes.php';
$route = new \Core\Route($routes);
