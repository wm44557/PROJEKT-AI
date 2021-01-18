<?php

declare(strict_types=1);

namespace app\controllers;

use app\Router;
use app\models\User;
use app\utility\Redirect;
use app\utility\Permissions;

class userController
{

    public function addInvoice($router)
    {

        Permissions::check("user");
        $router->render("pages/components/invoiceForm", [
            'page_name' => 'add-invoice'
        ]);
    }
    public function settingsUser($router)
    {
        Permissions::check(["user"]);
        $user = new User();
        $results = $user->getUser($_SESSION["user_id"]);

        if ($_POST) {
            $user->editUser($_POST);
            $settingsInfo = 'Pomyślnie zmieniono dane konta';
        }
        $results = $user->getUser($_SESSION["user_id"]);

        $router->render("pages/components/settings", [
            'page_name' => 'settings',
            $results,
            'settingsInfo' => $settingsInfo ?? null
        ]);
    }
}
