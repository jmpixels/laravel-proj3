<?php
session_start();

if (!isset($_SESSION['username']) && !isset($_SESSION['id'])) {
    $error_message = "You do not have access to this page.";
    echo '<script>alert("' . $error_message . '")</script>';
    header("Location: javascript://history.go(-1)");
    exit;
}

?>