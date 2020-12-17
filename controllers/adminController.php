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
        if($_POST) {
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
        Permissions::check("admin");
        $router->render("pages/components/invoiceForm");
    }


}