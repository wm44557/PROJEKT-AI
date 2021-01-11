<?php

session_start();

require_once realpath("../vendor/autoload.php");
require_once("../config/config.php");
require_once("../utility/debug.php");

use app\utility\Router;
use app\controllers\loginController;
use app\controllers\adminController;
use app\controllers\userController;
use app\controllers\invoices\invoiceController;

$router = new Router();

$router->get('/', [loginController::class, 'login']);
$router->post('/', [loginController::class, 'login']);
$router->get('/admin', [loginController::class, 'admin']);
$router->get('/user', [loginController::class, 'user']);
$router->get('/auditor', [loginController::class, 'auditor']);
$router->post('/logout', [loginController::class, 'logout']);

$router->get("/admin/register", [adminController::class, 'registerUser']);
$router->post("/admin/register", [adminController::class, 'registerUser']);

$router->get('/admin/add-invoice', [adminController::class, 'addInvoice']);
$router->post('/admin/add-invoice', [invoiceController::class, 'addInvoice']);
$router->get('/admin/list-invoice', [invoiceController::class, 'listInvoice']);
$router->post('/admin/list-invoice', [invoiceController::class, 'showInvoice']);

//$router->get('/user/edit', [userController::class, 'user_edit']);
//$router->post('/user/edit', [userController::class, 'user_edit']);
$router->get('/user/add-invoice', [userController::class, 'addInvoice']);
$router->post('/user/add-invoice', [invoiceController::class, 'addInvoice']);
$router->get('/user/list-invoice', [invoiceController::class, 'listInvoice']);
$router->post('/user/list-invoice', [invoiceController::class, 'showInvoice']);

$router->get('/auditor/list-invoice', [invoiceController::class, 'listInvoice']);
$router->post('/auditor/list-invoice', [invoiceController::class, 'showInvoice']);

$router->resolve();
