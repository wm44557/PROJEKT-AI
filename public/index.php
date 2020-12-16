<?php

session_start();

require_once realpath("../vendor/autoload.php");
require_once ("../config/config.php");
require_once ("../utility/debug.php");

use app\utility\Router;
use app\controllers\Controller;

$router = new Router();

$router->get('/', [Controller::class, 'login']);
$router->post('/', [Controller::class, 'login']);

$router->get('/admin', [Controller::class, 'admin']);
$router->get("/admin/register", [Controller::class, 'register_user']);

$router->get('/user', [Controller::class, 'user']);
$router->get('/user/edit', [Controller::class, 'user_edit']);
$router->post('/user/edit', [Controller::class, 'user_edit']);

$router->post('/logout', [Controller::class, 'logout']);


$router->resolve();
