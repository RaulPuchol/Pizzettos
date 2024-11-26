<?php
include_once("config/dataBase.php");

class UsuarioDAO {
    public static function getDatos($email,$password) {
        $con = DataBase::connect();

        $stmt = $con->prepare("SELECT * FROM Usuario WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();
    
            // Verificar la contraseña
            if (password_verify($password, $user['password'])) {
                return $user; // Retorna el usuario si la contraseña es correcta
            } else {
                return null; // Contraseña incorrecta
            }
        } else {
            return null; // Usuario no encontrado
        }
    }
    
}