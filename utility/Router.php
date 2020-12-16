<?php

namespace app\utility;

class Router {

    public array $getRoutes = [];
    public array $postRoutes = [];
    public $db;

    public function __construct(){
        $conn = require_once("../config/config.php");
        $this->db = new Database($conn);
    }

    public function get($url, $fn){
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn){
        $this->postRoutes[$url] = $fn;
    }

    public function resolve(){
        $currentUrl = $_SERVER['REQUEST_URI'] ?? "/";
        $currentUrl = str_replace(STARTING_URL, "", $currentUrl);
        if (strpos($currentUrl, '?') !== false){
            $currentUrl = substr($currentUrl, 0, strpos($currentUrl, '?'));
        }
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === "GET"){
            $fn = $this->getRoutes[$currentUrl] ?? null;
        } else {
            $fn = $this->postRoutes[$currentUrl] ?? null;
        }

        if ($fn) {
            call_user_func($fn, $this);
        } else {
            echo "Page not found";
        }
    }

    public function render($view, $params=[]){

        foreach ($params as $key => $value){
            $$key = $value;
        }

        ob_start();
        include_once __DIR__ . "../../views/$view.php";
        $content = ob_get_clean();
        include_once __DIR__ . "../../views/_base.php";
    }
}