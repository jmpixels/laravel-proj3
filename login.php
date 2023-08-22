<?php


// include "class/function.class.php";
include 'autoloader.php';
require_once('config.php');


$username = $_POST['username'];
$password = $_POST['password'];

$user = new User();
$loggedIn = $user->LoginUser($username, $password);

if ($loggedIn) {
    header("Location: home.php");
    exit();
}else{
    header("Location:admin.php?error= Username or password is incorrect");
}

// $user = new User($username, $password);
// if ($user->authenticate()) {
//     header("Location: home.php");
//     exit();
// } else {
//     // $error = urlencode("Invalid username or password");
//     header("Location: ../views/admin.php?error=Username or password is incorrect");
//     exit();
// }
