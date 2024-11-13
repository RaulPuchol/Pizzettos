<?php

include_once("models/CamisetaDAO.php");

class productoController{
    public function index(){

        $view = "views/Inicio.php";
        include_once("views/index.php");
    }

    public function show() {
        echo"Muestra un producto";

        $producto = new CamisetaDAO();
        $producto = $producto->getAll();

        echo "<table>";
        for ($i=0; $i < count($producto); $i++) { 
            echo "<tr>";
            echo "<td>".$producto[$i]->getNombre()."</td>";
            echo "<td>".$producto[$i]->getPrecio()."</td>";
            echo "<td>".$producto[$i]->getTalla()."</td>";
            echo "</tr>";
        }

        echo "</table>";
        return $producto;
    }

    public function newProducto() {
        echo"Crear nuevo producto";
    }

    public function crear() {
        /*
        $producto = new CamisetaDAO();
        $producto = $producto->getAll();
        $producto = $producto->store($producto);
        */

        include_once("views/productos/create.php");
        
    }
}