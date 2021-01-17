<?php

declare(strict_types=1);

namespace app\controllers;

use app\Router;
use app\models\User;
use app\utility\Redirect;
use app\utility\Permissions;

class loginController
{
    public function login($router)
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = $_POST['login'];
            $password = $_POST['password'];

            $user = new User();
            $result = $user->authenticate($login, $password);

            if ($result) {
                $_SESSION['user_id'] = $result->id;
                $_SESSION['user_login'] = $result->login;
                $_SESSION['user_role'] = $result->role;
            } else {
                $errors['auth'] = "Niepoprawny login lub hasło.";
            }
        }

        if (isset($_SESSION['user_role'])) {
            Redirect::to("/" . $_SESSION['user_role']);
        }

        $router->render('pages/login', [
            'errors' => $errors,
        ]);
    }

    public function logout($router)
    {
        session_destroy();
        Redirect::to("/");
    }

    public function admin($router)
    {
        Permissions::check("admin");
        $router->render('pages/admin/panel', []);
    }

    public function user($router)
    {
        Permissions::check("user");
        $router->render('pages/user/panel', []);
    }

    public function auditor($router)
    {
        Permissions::check("auditor");
        $router->render('pages/user/panel', [
        ]);
    }
}
