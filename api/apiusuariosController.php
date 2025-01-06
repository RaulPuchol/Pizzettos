<?php
include_once("config/dataBase.php"); // incluye la clase de conexión a la base de datos
include_once("script/getHeadersApi.php"); // incluye la clase que obtiene los headers de la API

class apiusuariosController{
    public static function adminpanel2(){ // función que muestra la vista del panel de administración
        include_once("views/adminpanel2.php");
    }

    public static function getusuariosapi() { // función que obtiene los usuarios de la base de datos
        
        $con = DataBase::connect();

        $stmt = $con->prepare("SELECT * FROM Usuario");
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $usuarios = $result->fetch_all(MYSQLI_ASSOC);
            http_response_code(200); // Respuesta exitosa
            echo json_encode($usuarios);
        } else {
            http_response_code(404); // No encontrado
            echo json_encode(["message" => "No se encontraron usuarios"]);
        }

    }

    public static function deleteusuariosapi() { // función que elimina un usuario de la base de datos
        getHeadersApi::getHeadersapi();
        $input = json_decode(file_get_contents('php://input'), true);
        $idUsuario = isset($input['IDusuario']) ? $input['IDusuario'] : null;
        $con = DataBase::connect();

        $stmt = $con->prepare("DELETE FROM Usuario WHERE IDusuario = ?");
        $stmt->bind_param("i", $idUsuario);
        $stmt->execute();
        
        $stmt->close();
        $con->close();

        if ($stmt->affected_rows > 0) {
            echo json_encode(["success" => true, "message" => "Usuario Borrado"]);
        } else {
            echo json_encode(["success" => false, "message" => "No se pudo borrar el Usuario"]);
        }
    }
    //deleteitems hecho

    public static function updateusuariosapi() { // función que actualiza un usuario de la base de datos
        getHeadersApi::getHeadersapi();
        $input = json_decode(file_get_contents('php://input'), true);
        $idUsuario = isset($input['IDusuario']) ? $input['IDusuario'] : null;
        $email = isset($input['email']) ? $input['email'] : null;
        $usuario = isset($input['usuario']) ? $input['usuario'] : null;
            
        $con = DataBase::connect();
        $stmt = $con->prepare("UPDATE Usuario SET email = ?, usuario = ? WHERE IDusuario = ?");
        $stmt->bind_param("ssi", $email, $usuario, $idUsuario);
        $stmt->execute();

        $stmt->close();
        $con->close();
    
        if ($stmt->affected_rows > 0) {
            echo json_encode(["success" => true, "message" => "Usuario actualizado"]);
        } else {
            echo json_encode(["success" => false, "message" => "No se pudo actualizar o el usuario ya tiene los mismos datos"]);
        }
    }

    public static function addusuariosapi() { // función que añade un usuario a la base de datos
        getHeadersApi::getHeadersapi();
        $input = json_decode(file_get_contents('php://input'), true);
        $email = isset($input['email']) ? $input['email'] : null;
        $usuario = isset($input['usuario']) ? $input['usuario'] : null;
            
        $con = DataBase::connect();
        $stmt = $con->prepare("INSERT INTO Usuario (email, usuario) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $usuario);
        $stmt->execute();

        $stmt->close();
        $con->close();
    
        if ($stmt->affected_rows > 0) {
            echo json_encode(["success" => true, "message" => "Producto actualizado"]);
        } else {
            echo json_encode(["success" => false, "message" => "No se pudo actualizar o el producto ya tiene los mismos datos"]);
        }
    }

}