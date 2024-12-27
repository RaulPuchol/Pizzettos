<?php
include_once("config/dataBase.php");
include_once("script/getHeadersApi.php");

class apiproductosController{
    public static function adminpanel(){
        include_once("views/adminpanel.php");
    }

    public static function getproductosapi() {
        
        $con = DataBase::connect();

        $stmt = $con->prepare("SELECT * FROM Producto");
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $productos = $result->fetch_all(MYSQLI_ASSOC);
            http_response_code(200); // Respuesta exitosa
            echo json_encode($productos);
        } else {
            http_response_code(404); // No encontrado
            echo json_encode(["message" => "No se encontraron productos"]);
        }

    }

    public static function deleteproductosapi() {
        $id = $_POST['IDproducto'];
        $con = DataBase::connect();

        $stmt = $con->prepare("DELETE FROM Producto WHERE IDproducto = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        $stmt->close();
        $con->close();
        header ("Location: /dashboard/Pizzettos/Pizzettos/?controller=apiproductos&action=adminpanel");
    }

    //deletehecho


}