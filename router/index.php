<?php

class Router{

    private $handled = false;
    function __construct(){

    }

    public function get($route, $view)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            $this->handled = true;
            return false;
        }
    
        $uri = $_SERVER['REQUEST_URI'];
        if ($uri === '/?admin') {
            $redirectUrl = urlencode($_SERVER['REQUEST_URI']);
            $loginUrl = "views/admin.php";
            header("Location: $loginUrl");
            exit();
        }
    
        // Handle other routes normally
        if ($uri === $route) {
            return include_once(views . $view);
        }
    }

    


    public function post($route, $view)
    {
        if($_SERVER['REQUEST_METHOD'] !== 'POST')
        {
            return false;
        }

        $uri = $_SERVER['REQUEST_URI'];
            if ($uri === $route)
            {
                return include_once(views . $view);
            }
    }


    function __destruct()
    {
        if($this->handled){
             return include_once(views . '404.php');
        }
    }
}

?>