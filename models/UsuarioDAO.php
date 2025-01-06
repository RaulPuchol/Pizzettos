<?php
include_once("config/dataBase.php");
include_once("models/Pedido.php");

class UsuarioDAO {
    public static function iniciarsesion($email) { // función que inicia sesión
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

    public static function pedidos($emailusuario) { // función que obtiene los pedidos de un usuario



        $con = DataBase::connect();
    
        $stmt = $con->prepare("SELECT IDpedido, emailusuario, Fechapedido, Cantidad, Precio, IDdescuento FROM Pedido WHERE emailusuario = ?");
        $stmt->bind_param("s", $emailusuario);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $pedidos = [];
        while ($row = $result->fetch_assoc()) {
            $pedido = new Pedido(
                $row['IDpedido'],
                $row['emailusuario'],
                $row['Fechapedido'],
                $row['Cantidad'],
                $row['Precio'],
                $row['IDdescuento']
            );
            $pedidos[] = $pedido; 
        }
    
        $stmt->close();
        $con->close();
        return $pedidos;
    }
    
    public static function logLogin($email, $fecha, $mensaje) { // función que añade un log de inicio de sesión
        $con = DataBase::connect();

        $stmt = $con->prepare("INSERT INTO log (email, fecha, mensaje) VALUES (?,?,?)");
        $stmt->bind_param("sss", $email, $fecha, $mensaje);
        $stmt->execute();

        $stmt->close();
    }
    
    public static function logLogout($email, $fecha, $mensaje) { // función que añade un log de cierre de sesión
        $con = DataBase::connect();

        $stmt = $con->prepare("INSERT INTO log (email, fecha, mensaje) VALUES (?,?,?)");
        $stmt->bind_param("sss", $email, $fecha, $mensaje);
        $stmt->execute();

        $stmt->close();
    }
}