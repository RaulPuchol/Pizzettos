<?php

include_once("config/dataBase.php");
include_once("models/Camiseta.php");

class CamisetaDAO{
    public static function getAll($order = "id") {
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM camisas ORDER BY $order");
        $stmt->execute();
        $result = $stmt->get_result();

        $productos = [];
        while ($row = $result->fetch_assoc()) {
            // Manually create a Camiseta object
            $producto = new Camiseta($row['nombre'], $row['talla'], $row['precio']);
            $productos[] = $producto;
        }

        $con->close();
        return $productos;
    }

    public static function store($producto){
        $con = DataBase::connect();
        $stmt = $con->prepare("INSERT INTO camisas (nombre, talla, precio) VALUES (?,?,?);");
        $stmt ->bind_param("ssd", $producto->getNombre(),$producto->getTalla(),$producto->getPrecio());

        $stmt->execute();
        $result = $stmt->get_result();

        $productos = [];

        while($producto = $result->fetch_object("Camiseta")) {
            $productos[] = $producto;
        }

        $con->close();
    }

    public static function destroy($id) {
        $con = DataBase::connect();
        $stmt = $con->prepare("DELETE FROM camisetas WHERE id = ?");
        $stmt-> bind_param("i", $id);
        $stmt-> execute();
        $stmt-> close();
    }
}