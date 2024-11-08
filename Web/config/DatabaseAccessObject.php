<?php

/*
 * Progreso del viernes, creamos un patron de programacion llamado DAO (DatabaseAccessObject)< el cual
 * centraliza todas las operaciones de la base de datos, todas las salidas de las funciones devuelven valores
 * nunca tiene que devolver un objeto tipo mysqli para evitar problemas.
 */

class DatabaseAccessObject
{
    // Conexion con la BBDD
    private $conn;

    // Al crear el objeto DAO se conecta con la BBDD
    public function __construct($host = "localhost", $user="root", $pass="", $db = "proyecto1", $puerto="3306")
    {
        $this->conn = $this->connect($host, $user,$pass,$db,$puerto);
    }

    // Devuelve la Conexion
    public function connect($host = "localhost", $user="root", $pass="", $db = "proyecto1", $puerto="3306")
    {
        try
        {
            $connection = new mysqli($host, $user,$pass, $db,$puerto);
            return $connection; 
        }
        catch(Exception $e)
        {
            echo $e;
        }
    }

    public function getAllCamisetas($order = "Nombre")
    {
        // Evita que puedas injectar sql, solo puedes solicitar ordenar estas columnas
        $whitelist = ["Nombre","Precio","Talla","id"];
        if(in_array( $order, $whitelist) == false)
            $order = "Nombre";  // Si no esta en la whitelist por defecto se ordena por 'nombre'
        
        // Recoje la solicitud SELECT
        $conn = $this->conn;
        $query = $conn->prepare("SELECT * FROM PRODUCTOS ");
        $query->execute();
        $result = $query->get_result();

        // Guarda productos como una clase de tipo 'Shirt'
        // Shirt esta en "./Web/model/Productos/Shirt.php"
       /* 
        $productos = [];
        while($producto = $result->fetch_object("Shirt"))   // fetch_object convierte los valores de la bbdd (nombre, precio, talla) a los valores del mismo nombre (nombre, precio, talla) que estan en Shirt.php
            $productos [] = $producto;
        

        */
        // Forma simplificada de hacer lo mismo
        $productos = [];
        $i = 0;
        while($fetchProductos = $result->fetch_array())  // Ejecuta fetch_array en cada iteración
        {
            $productos[$i] = new Shirt();
            $productos[$i]->SetNombre($fetchProductos["Nombre"]);
            $productos[$i]->SetPrecio($fetchProductos["Precio"]);
            $productos[$i]->SetTalla($fetchProductos["Talla"]);
            $productos[$i]->SetId($fetchProductos["id"]);
            $i++;
        }
        

        return $productos;
    }

    public function deleteitem($id){
        $conn = $this->conn;

        $deleteid = $id;
          
        $query = $conn->prepare("DELETE FROM productos WHERE id = ?");
        $query->bind_param("i",$deleteid);

        $query->execute();
        $query->close();
    
    }

}

?>