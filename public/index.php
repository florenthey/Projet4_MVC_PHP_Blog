<?php

use blog\config\Router;

if ($_SERVER['SERVER_NAME'] == 'localhost') {
    require '../config/dev.php';
} else {
    require '../config/prod.php';
}

require '../vendor/autoload.php';

session_start();

$router = new Router();
$router->run();


