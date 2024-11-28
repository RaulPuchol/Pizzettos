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
                $row['IDcategoria']
            );
            $productos[] = $producto;
        }

        $con->close();
        return $productos;
    }

    public static function insertCarrito($emailCarrito, $idproducto, $cantidad) {
        echo $emailCarrito;
        $con = DataBase::connect();
        //Comprueba si ya existe en la base de dato
        $stmt = $stmt = $con->prepare("SELECT * FROM Carrito WHERE emailCarrito = ? AND idproducto = ?");
        $stmt->bind_param("si", $emailCarrito, $idproducto);
        $stmt->execute();
        $result = $stmt->get_result();


        if ($result->num_rows > 0) {
            // Si ya existe, actualiza sumando la cantidad
            $row = $result->fetch_assoc();
            $nuevaCantidad = $row['Cantidad'] + $cantidad;
    
            $stmt = $con->prepare("UPDATE Carrito SET cantidad = ? WHERE emailCarrito = ? AND idproducto = ?");
            $stmt->bind_param("isi", $nuevaCantidad, $emailCarrito, $idproducto);
            $stmt->execute();
        } else {
            // Si no existe, inserta el nuevo registro
            $stmt = $con->prepare("INSERT INTO Carrito (emailCarrito, idproducto, cantidad) VALUES (?, ?, ?)");
            $stmt->bind_param("sii", $emailCarrito, $idproducto, $cantidad);
            $stmt->execute();
        }
    
        $stmt->close();
        $con->close();
        
    }
}