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
        Permissions::check(["admin"]);
        $user = new User();
        $results = $user->getUser($_POST["userID"]);

        $_SESSION['editedLogin'] = $results->login;
        $_SESSION['editedUserId'] = $results->id;

        $router->render("pages/admin/userEdit", [
            'page_name' => 'userEdit',
            $results
        ]);
    }

    public function userEdited($router)
    {
        Permissions::check(["admin"]);

        $user = new User();
        if (!$user->getUserLogin($_POST['login']) || $_POST['login'] == $_SESSION['editedLogin']) {
            $user->editUser($_POST);
            $editInfo = "Udało się edytować dane użytkownika";
        } else {
            $editInfo = "Użytkownik o takim loginie już istnieje!";
        }
        $results = $user->listUsers();


        $router->render("pages/admin/usersList", [
            'page_name' => 'usersList',
            'editInfo' => $editInfo,
            $results
        ]);
    }

    public function userDelete($router)
    {
        Permissions::check(["admin"]);
        $user = new User();

        $user->deleteUser($_SESSION['editedUserId']);
        $editInfo = "Użytkownik został usunięty";

        $results = $user->listUsers();
        $router->render("pages/admin/usersList", [
            'page_name' => 'usersList',
            'editInfo' => $editInfo,
            $results
        ]);
    }
}
