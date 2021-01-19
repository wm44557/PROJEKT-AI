<?php

namespace app\utility;

class Router
{

    public array $getRoutes = [];
    public array $postRoutes = [];
    public $db;

    public function __construct()
    {
        $conn = require_once("../config/config.php");
        $this->db = new Database($conn);
    }

    public function render($view, $params = [])
    {
        //dump($params);
        $params = $this->escape($params);
        //dump($params);
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once __DIR__ . "../../views/$view.php";
        $content = ob_get_clean();
        include_once __DIR__ . "../../views/_base.php";
    }

    private function escape(array $params)
    {

        $clearParams = [];

        foreach ($params as $key => $param) {   #Key to nazwa parametru, a param to wartosc
            switch (true) {
                case is_array($param):
                    $clearParams[$key] = $this->escape($param);
                    break;
                case is_int($param):
                    //dump($param);
                    $clearParams[$key] = $param;
                    break;
                case is_string($param):
                    $clearParams[$key] = $param;
                    break;
                case is_numeric($param):
                    $clearParams[$key] = $param;
                    break;
                case $param:
                    $temp=[];
                    foreach ($param as $p=>$keys) {
                           $result = htmlentities($keys);
                           $temp[$p]=$result;
                    }
                    $clearParams[$key] = (object)$temp;
                    break;
                default:
                    $clearParams[$key] = $param;
                    break;
            }
        }


        return $clearParams;
    }

    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    public function resolve()
    {
        $currentUrl = $_SERVER['REQUEST_URI'] ?? "/";
        $currentUrl = str_replace(STARTING_URL, "", $currentUrl);
        if (strpos($currentUrl, '?') !== false) {
            $currentUrl = substr($currentUrl, 0, strpos($currentUrl, '?'));
        }
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === "GET") {
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


}