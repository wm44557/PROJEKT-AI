<?php

session_start();

require_once realpath("../vendor/autoload.php");
require_once("../config/config.php");
require_once("../utility/debug.php");



use app\utility\Router;
use app\controllers\loginController;
use app\controllers\adminController;
use app\controllers\userController;
use app\controllers\invoices\deviceController;
use app\controllers\invoices\invoiceController;
use app\controllers\invoices\licenceController;
use app\controllers\invoices\statisticsController;

$router = new Router();

$router->get('/', [loginController::class, 'login']);
$router->post('/', [loginController::class, 'login']);
$router->get('/admin', [loginController::class, 'admin']);
$router->get('/user', [loginController::class, 'user']);
$router->get('/auditor', [loginController::class, 'auditor']);
$router->post('/logout', [loginController::class, 'logout']);

$router->get("/admin/register", [adminController::class, 'registerUser']);
$router->post("/admin/register", [adminController::class, 'registerUser']);

$router->get("/admin/settings", [adminController::class, 'settingsUser']);
$router->post("/admin/settings", [adminController::class, 'settingsUser']);


$router->get("/admin/users-list", [adminController::class, 'usersList']);
$router->post("/admin/users-list", [adminController::class, 'usersList']);

$router->get("/admin/user-delete", [adminController::class, 'deleteUser']);
$router->post("/admin/user-delete", [adminController::class, 'deleteUser']);

$router->get("/admin/users-list/user-edit", [adminController::class, 'userEdit']);
$router->post("/admin/users-list/user-edit", [adminController::class, 'userEdit']);

$router->get("/admin/users-list/user-edited", [adminController::class, 'userEdited']);
$router->post("/admin/users-list/user-edited", [adminController::class, 'userEdited']);



$router->get('/admin', [statisticsController::class, 'showStatsAdmin']);

$router->get('/admin/add-invoice', [adminController::class, 'addInvoice']);
$router->post('/admin/add-invoice', [invoiceController::class, 'addInvoice']);
$router->get('/admin/list-invoice', [invoiceController::class, 'listInvoice']);
$router->get('/admin/show-invoice', [invoiceController::class, 'showInvoice']);
$router->get('/admin/list-licence', [licenceController::class, 'listLicence']);
$router->get('/admin/list-device', [deviceController::class, 'listDevice']);

//$router->get('/user/edit', [userController::class, 'user_edit']);
//$router->post('/user/edit', [userController::class, 'user_edit']);
$router->get('/user', [statisticsController::class, 'showStats']);

$router->get("/user/settings", [userController::class, 'settingsUser']);
$router->post("/user/settings", [userController::class, 'settingsUser']);


$router->get('/user/add-invoice', [userController::class, 'addInvoice']);
$router->post('/user/add-invoice', [invoiceController::class, 'addInvoice']);
$router->get('/user/list-invoice', [invoiceController::class, 'listInvoice']);
$router->get('/user/show-invoice', [invoiceController::class, 'showInvoice']);
$router->get('/user/list-licence', [licenceController::class, 'listLicence']);
$router->get('/user/list-device', [deviceController::class, 'listDevice']);

$router->post('/user/addfile', [invoiceController::class, 'addFile']);
$router->post('/user/deletefile', [invoiceController::class, 'deleteFile']);


// Auditor urls
$router->get('/auditor', [statisticsController::class, 'showStats']);

$router->get("/auditor/settings", [userController::class, 'settingsUser']);
$router->post("/auditor/settings", [userController::class, 'settingsUser']);

$router->get('/auditor/list-invoice', [invoiceController::class, 'listInvoice']);
$router->post('/auditor/list-invoice', [invoiceController::class, 'showInvoice']);
$router->get('/auditor/show-invoice', [invoiceController::class, 'showInvoice']);
$router->get('/auditor/list-licence', [licenceController::class, 'listLicence']);
$router->get('/auditor/list-device', [deviceController::class, 'listDevice']);


$router->resolve();
