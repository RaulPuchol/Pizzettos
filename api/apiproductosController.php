<?php
include_once("config/dataBase.php"); // incluye la clase de conexión a la base de datos
include_once("script/getHeadersApi.php"); // incluye la clase que obtiene los headers de la API

class apiproductosController{
    public static function adminpanel(){ // función que muestra la vista del panel de administración
        include_once("views/adminpanel.php");
    }

    public static function getproductosapi() { // función que obtiene los producto de la base de datos
        getHeadersApi::getHeadersapi();
        $con = DataBase::connect();

        $stmt = $con->prepare("SELECT * FROM Producto");
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $productos = $result->fetch_all(MYSQLI_ASSOC);
            echo json_encode($productos);
        } else {
            http_response_code(404); // No encontrado
            echo json_encode(["message" => "No se encontraron productos"]);
        }

    }

    public static function deleteproductosapi() { // función que elimina un producto de la base de datos
        getHeadersApi::getHeadersapi();
        $input = json_decode(file_get_contents('php://input'), true);
        $idProducto = isset($input['IDproducto']) ? $input['IDproducto'] : null;
        $con = DataBase::connect();

        $stmt = $con->prepare("DELETE FROM Producto WHERE IDproducto = ?");
        $stmt->bind_param("i", $idProducto);
        $stmt->execute();
        
        $stmt->close();
        $con->close();

        if ($stmt->affected_rows > 0) {
            echo json_encode(["success" => true, "message" => "Producto Borrado"]);
        } else {
            echo json_encode(["success" => false, "message" => "No se pudo borrar el producto "]);
        }
    }
    //deleteitems hecho

    public static function updateproductosapi() { // función que actualiza un producto de la base de datos
        getHeadersApi::getHeadersapi();
        $input = json_decode(file_get_contents('php://input'), true);
        $idProducto = isset($input['IDproducto']) ? $input['IDproducto'] : null;
        $nombre = isset($input['Nombre']) ? $input['Nombre'] : null;
        $precioBase = isset($input['PrecioBase']) ? $input['PrecioBase'] : null;
        $idDescuento = isset($input['IDdescuento']) ? $input['IDdescuento'] : null;
        $idCategoria = isset($input['IDcategoria']) ? $input['IDcategoria'] : null;
            
        $con = DataBase::connect();
        $stmt = $con->prepare("UPDATE Producto SET Nombre = ?, PrecioBase = ?, IDdescuento = ?, IDcategoria = ? WHERE IDproducto = ?");
        $stmt->bind_param("sdiii", $nombre, $precioBase, $idDescuento, $idCategoria, $idProducto);
        $stmt->execute();

        $stmt->close();
        $con->close();
    
        if ($stmt->affected_rows > 0) {
            echo json_encode(["success" => true, "message" => "Producto actualizado"]);
        } else {
            echo json_encode(["success" => false, "message" => "No se pudo actualizar o el producto ya tiene los mismos datos"]);
        }
    }

    public static function addproductosapi() { // función que añade un producto a la base de datos
        getHeadersApi::getHeadersapi();
        $input = json_decode(file_get_contents('php://input'), true);
        $nombre = isset($input['Nombre']) ? $input['Nombre'] : null;
        $precioBase = isset($input['PrecioBase']) ? $input['PrecioBase'] : null;
        $idDescuento = isset($input['IDdescuento']) ? $input['IDdescuento'] : null;
        $idCategoria = isset($input['IDcategoria']) ? $input['IDcategoria'] : null;
        $imagen = "pizza";
            
        $con = DataBase::connect();
        $stmt = $con->prepare("INSERT INTO Producto (Nombre, PrecioBase, Imagen, IDdescuento, IDcategoria) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sdsii", $nombre, $precioBase, $imagen, $idDescuento, $idCategoria);
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