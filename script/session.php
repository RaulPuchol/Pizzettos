<?php 
session_start();
if (!isset($_SESSION['email'])){
    $email = "none";
} else {
    $email = $_SESSION['email'];
}


?>