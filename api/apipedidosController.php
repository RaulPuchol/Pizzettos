<?php
include_once("config/dataBase.php");
include_once("script/getHeadersApi.php");

class apipedidosController{
    public static function adminpanel1(){
        include_once("views/adminpanel1.php");
    }

    public static function getpedidosapi() {
        
        $con = DataBase::connect();

        $stmt = $con->prepare("SELECT * FROM Pedido");
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $pedidos = $result->fetch_all(MYSQLI_ASSOC);
            http_response_code(200); // Respuesta exitosa
            echo json_encode($pedidos);
        } else {
            http_response_code(404); // No encontrado
            echo json_encode(["message" => "No se encontraron pedidos"]);
        }

    }

    public static function deletepedidosapi() {
        getHeadersApi::getHeadersapi();
        $input = json_decode(file_get_contents('php://input'), true);
        $idPedido = isset($input['IDpedido']) ? $input['IDpedido'] : null;
        $con = DataBase::connect();

        $stmt = $con->prepare("DELETE FROM Pedido WHERE IDpedido = ?");
        $stmt->bind_param("i", $idPedido);
        $stmt1 = $con->prepare("DELETE FROM Pedido_Producto WHERE IDpedido = ?");
        $stmt1->bind_param("i", $idPedido);
        $stmt->execute();
        $stmt1->execute();
        
        $stmt->close();
        $stmt1->close();
        $con->close();

        if ($stmt->affected_rows > 0) {
            echo json_encode(["success" => true, "message" => "Pedido Borrado"]);
        } else {
            echo json_encode(["success" => false, "message" => "No se pudo borrar el pedido "]);
        }
    }
    //deleteitems hecho

    public static function updatepedidosapi() {
        getHeadersApi::getHeadersapi();
        $input = json_decode(file_get_contents('php://input'), true);
        $idPedido = isset($input['IDpedido']) ? $input['IDpedido'] : null;
        $emailusuario = isset($input['emailusuario']) ? $input['emailusuario'] : null;
        $Fechapedido = isset($input['Fechapedido']) ? $input['Fechapedido'] : null;
        $Cantidad = isset($input['Cantidad']) ? $input['Cantidad'] : null;
        $Precio = isset($input['Precio']) ? $input['Precio'] : null;
        $idDescuento = isset($input['IDdescuento']) ? $input['IDdescuento'] : null;
        
        
            
        $con = DataBase::connect();
        $stmt = $con->prepare("UPDATE Pedido SET emailusuario = ?, Fechapedido = ?, Cantidad = ?, Precio = ?, IDdescuento = ? WHERE IDpedido = ?");
        $stmt->bind_param("ssidii", $emailusuario, $Fechapedido, $Cantidad, $Precio, $idDescuento, $idPedido);
        $stmt->execute();

        $stmt->close();
        $con->close();
    
        if ($stmt->affected_rows > 0) {
            echo json_encode(["success" => true, "message" => "Pedido actualizado"]);
        } else {
            echo json_encode(["success" => false, "message" => "No se pudo actualizar o el pedido ya tiene los mismos datos"]);
        }
    }

    public static function addpedidosapi() {
        getHeadersApi::getHeadersapi();
        $input = json_decode(file_get_contents('php://input'), true);
        $emailusuario = isset($input['emailusuario']) ? $input['emailusuario'] : null;
        $Fechapedido = date("Y-m-d H:i:s");
        $Cantidad = isset($input['Cantidad']) ? $input['Cantidad'] : null;
        $Precio = isset($input['Precio']) ? $input['Precio'] : null;
        $idDescuento = isset($input['IDdescuento']) ? $input['IDdescuento'] : null;
            
        $con = DataBase::connect();
        $stmt = $con->prepare("INSERT INTO Pedido (emailusuario, Fechapedido, Cantidad, Precio, IDdescuento) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssidi", $emailusuario, $Fechapedido, $Cantidad, $Precio, $idDescuento);
        $stmt->execute();

        $stmt->close();
        $con->close();
    
        if ($stmt->affected_rows > 0) {
            echo json_encode(["success" => true, "message" => "Pedido insertado"]);
        } else {
            echo json_encode(["success" => false, "message" => "No se pudo actualizar o el pedido ya tiene los mismos datos"]);
        }
    }

}