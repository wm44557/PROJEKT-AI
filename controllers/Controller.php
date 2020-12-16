<?php

namespace app\controllers;

use app\Router;
use app\models\User;
use app\utility\Redirect;
use app\utility\Permissions;

class Controller{

    public function login($router){

        $errors=[];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            dump($_POST);
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


        if (isset($_SESSION['user_role'])){
            Redirect::to("/" . $_SESSION['user_role']);
        }

        $router->render('pages/login', [
            'errors' => $errors,
            'user' => $_GET['okon'],
        ]);
    }

    public function logout($router){
        session_destroy();
        Redirect::to("/");
    }




    public function user($router)
    {
        Permissions::check("user");
        $router->render('pages/panel', [

        ]);
    }

    public function  user_edit($router){
        Permissions::check("user");
        $router->render("pages/user/edit");
    }





    public function admin($router){
        Permissions::check("admin");
        $router->render('pages/admin', [
        ]);
    }

    public function  register_user($router){
        Permissions::check("admin");
        $router->render('pages/register', [
            'kozak' => "XD",
        ]);
    }


}