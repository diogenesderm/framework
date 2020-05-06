<?php

/**
 * Options (mysql, sqlite)
 */

return [
    'driver' => 'sqlite',
    'sqlite' => [
        'host' => 'database.db',
    ],
    'mysql' => [
        'host' => 'localhost',
        'database' => 'curso_microframework',
        'user' => 'root',
        'pass' => '123',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci'
    ]
]