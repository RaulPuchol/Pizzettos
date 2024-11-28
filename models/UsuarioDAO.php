<?php
include_once("config/dataBase.php");

class UsuarioDAO {
    public static function iniciarsesion($email) {
        $con = DataBase::connect();

        $stmt = $con->prepare("SELECT * FROM Usuario WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        return $result = $stmt->get_result();
    }

    public static function insertarUsuario($email, $usuario, $passwd) {
        $con = DataBase::connect();

        $stmt = $con->prepare("INSERT INTO Usuario (email, usuario, passwd) VALUES (?,?,?)");
        $stmt->bind_param("sss", $email, $usuario, $passwd);
        $stmt->execute();

        $stmt->close();
        header ("Location: /dashboard/Pizzettos/Pizzettos/?controller=login&action=login");
    }
    
}