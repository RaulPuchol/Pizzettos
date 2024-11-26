<?php
include_once("models/Productos.php");
include_once("config/dataBase.php");

class ProductoDAO {
    public static function getAll() {
        $con = DataBase::connect();
        //$allowedColumns = ['idproducto', 'nombre', 'preciobase', 'idcategoria'];
        //$order = in_array($order, $allowedColumns) ? $order : 'idproducto';

        $stmt = $con->prepare("SELECT * FROM Producto");
        $stmt->execute();
        $result = $stmt->get_result();

        $productos = [];
        while ($row = $result->fetch_assoc()) {
            $producto = new Productos(
                $row['IDproducto'],
                $row['Nombre'],
                $row['PrecioBase'],
                $row['Imagen'],
                $row['IDdescuento'],
                $row['IDcategoria'],
            );
            $productos[] = $producto;
        }

        $con->close();
        return $productos;
    }
}