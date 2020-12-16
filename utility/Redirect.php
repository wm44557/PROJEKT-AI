<?php

namespace app\utility;

class Redirect{
    public static function to($location="/"){
        header('Location: ' . STARTING_URL . $location);
    }
}