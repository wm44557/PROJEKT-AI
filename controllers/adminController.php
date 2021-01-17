<?php

declare(strict_types=1);

namespace app\controllers;

use app\Router;
use app\models\User;
use app\utility\Redirect;
use app\utility\Permissions;

class adminController
{
    public function registerUser($router)
    {
        Permissions::check("admin");
        if ($_POST) {
            $dataRegister = $_POST;
            dump($dataRegister);
            $user = new User();
            $user->registerUser($dataRegister);
            Redirect::to("/");
        }
        $router->render("pages/admin/register");
    }

    public function addInvoice($router)
    {
        Permissions::check(["admin"]);
        $router->render("pages/components/invoiceForm", [
            'page_name' => 'add-invoice'
        ]);
    }
    public function usersList($router)
    {
        Permissions::check(["admin"]);
        $user = new User();
        $results = $user->listUsers();
        $router->render("pages/admin/usersList", [
            'page_name' => 'usersList',
            $results
        ]);
    }
    public function userEdit($router)
    {
        $user = new User();
        $results = $user->getUser($_POST["userID"]);

        Permissions::check(["admin"]);
        $router->render("pages/admin/userEdit", [
            'page_name' => 'userEdit',
            $results
        ]);
    }
}
