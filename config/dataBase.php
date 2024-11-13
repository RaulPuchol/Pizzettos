<?php

class DataBase{
    public static function connect($host = "localhost", $user="root", $pass="secret", $database="batabase", $port= 33060){
        $con = new mysqli($host, $user, $pass, $database, $port);

        if ($con === false) {
            die("ERROR". $con->connect_error);
        }

        return $con;
    }

    
}