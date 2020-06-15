
<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$conf = require_once __DIR__ . "/../app/database.php";

if ($conf['baseModel'] == 'illuminate') {

    $capsule = new Capsule();

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
    $capsule->setAsGlobal();
    $capsule->bootEloquent();
}
