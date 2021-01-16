<?php


namespace app\utility;

use app\utility\Redirect;


class Permissions
{
    public static function check($role){

        if (!is_array($role)){
            $role = array($role);
        }
        if (isset($_SESSION['user_role'])){
            $url_user = explode('/', $_SERVER['REQUEST_URI'])[2];
            if ($url_user != $_SESSION['user_role']){
                Redirect::to("/" . $_SESSION['user_role']);
            }
            if (!in_array($_SESSION['user_role'], $role)){
                Redirect::to("/" . $_SESSION['user_role']);
            }
        } else {
            Redirect::to("/" . $_SESSION['user_role']);
        }
    }
}