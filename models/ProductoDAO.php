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

    public static function getProductosDelCarrito($emailCarrito) {
        $con = DataBase::connect();
    
        $stmt = $con->prepare("
            SELECT p.IDproducto, p.Nombre, p.PrecioBase, p.Imagen, p.IDdescuento, p.IDcategoria, c.Cantidad, c.ID
            FROM Carrito c
            JOIN Producto p ON c.IDproducto = p.IDproducto
            WHERE c.emailCarrito = ?
        ");
        $stmt->bind_param("s", $emailCarrito);
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
            $producto->cantidad = $row['Cantidad'];
            $producto->IDcarrito = $row['ID'];
            $productos[] = $producto; 
        }
    
        $stmt->close();
        $con->close();
        return $productos;
    }

    public static function deleteProductoDelCarrito($idcarrito) {
        $con = DataBase::connect();

        $stmt = $con->prepare("DELETE FROM Carrito WHERE ID=?");
        $stmt->bind_param("i", $idcarrito);
        $stmt->execute();
        $stmt->close();
        
    }

    public static function nuevopedido($emailusuario, $fechapedido, $cantidad, $precio, $iddescuento) {
        $con = DataBase::connect();

        $stmt = $con->prepare("INSERT INTO Pedido (emailusuario, Fechapedido, Cantidad, Precio, IDdescuento) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssidi", $emailusuario, $fechapedido, $cantidad, $precio, $iddescuento);
        $stmt->execute();

         // Obtener el ID del último Pedido insertado
        $IDpedido = $con->insert_id;
        $precio1 = 0;
        $cantidad = 0;
        $idproducto = 0;
        // Insertar en la tabla haciendo un bucle insertando los productos en cada row
        foreach (ProductoDAO::getProductosDelCarrito($emailusuario) as $producto){ 
            $precio1 += $producto->getPrecioBase() * $producto->cantidad; 
            $cantidad += $producto->cantidad;
            $idproducto = $producto->getIdproducto();
            $stmt = $con->prepare("INSERT INTO Pedido_Producto VALUES (?, ?, ?, ?)");
            $stmt->bind_param("diii", $precio1, $cantidad, $IDpedido, $idproducto);
            $stmt->execute();
        }
        

        $stmt = $con->prepare("DELETE FROM Carrito WHERE emailCarrito=?");
        $stmt->bind_param("s", $emailusuario);
        $stmt->execute();

        $stmt->close();
        $con->close();
        
    }

    public static function insert_pedidoProducto() {

    }
}