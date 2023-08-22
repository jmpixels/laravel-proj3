<?php


require_once __DIR__ . '/config/__init.php';
require_once __DIR__ . '/router/index.php';


$router = new Router();

$router->get('/', 'admin.php');

$router->get('/home', 'home.php');

$router->get('/contact', 'contact.php');

// $router->get('/?admin', 'admin.php');
// $router->get('/lol.php', 'admin.php');

$router->get('/about', 'about.php');


// $router->get('/wp-admin', function() {
//     $redirectUrl = urlencode($_SERVER['REQUEST_URI']);
//     $loginUrl = "/wp-login.php?redirect_to=$redirectUrl&reauth=1";
//     header("Location: $loginUrl");
//     exit();
// });



?>