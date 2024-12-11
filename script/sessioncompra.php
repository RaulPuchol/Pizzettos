<?php 
session_start();
if (!isset($_SESSION['email'])){
    $email = "none";
} else {
    $email = $_SESSION['email'];
}

if (!isset($_SESSION['email']) || $_SESSION['email'] == "none") {
    header("Location: /dashboard/Pizzettos/Pizzettos/?controller=login&action=login");
    exit;
}
?>