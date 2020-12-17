<?php

declare(strict_types=1);

namespace app\controllers;

use app\Router;
use app\models\User;
use app\utility\Redirect;
use app\utility\Permissions;

class adminController
{
    public function register_user($router)
    {
        Permissions::check("admin");
        $router->render("pages/admin/register");

    }
}