<?php

class DataBase{
    public static function connect($host = "127.0.0.1", $user="root", $pass="1590", $database="ProyectoDBRAUL", $port= 3307){
        $con = new mysqli($host, $user, $pass, $database, $port);

        if ($con === false) {
            die("ERROR". $con->connect_error);
        }

        return $con;
    }

    
}