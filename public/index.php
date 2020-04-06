<?php
require_once __DIR__ . "/../vendor/autoload.php";

require_once __DIR__ . "/../core/bootstrap.php";

$url  = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
