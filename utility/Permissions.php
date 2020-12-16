<?php


namespace app\utility;

use app\utility\Redirect;


class Permissions
{
    public static function check($role){
        if (isset($_SESSION['user_role'])){
            if ($_SESSION['user_role'] !== $role){
                Redirect::to("/" . $_SESSION['user_role']);
            }
        } else {
            Redirect::to("/" . $_SESSION['user_role']);
        }
    }
}