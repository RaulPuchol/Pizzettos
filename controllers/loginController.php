<?php
include_once("models/UsuarioDAO.php");

class loginController{
    public function login(){
        include_once("views/login.php");
    }
    public function register(){
        include_once("views/register.php");
    }

    public function lookaccount(){
        
    }
}

?>