<?php

/**
 * Options (mysql, sqlite)
 */

return [
    'baseModel' => 'illuminate',
    'driver' => 'mysql',
    'sqlite' => [
        'host' => 'database.db',
    ],
    'mysql' => [
        'host' => 'localhost',
        'database' => 'framework',
        'user' => 'root',
        'pass' => '',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci'
    ]
];
