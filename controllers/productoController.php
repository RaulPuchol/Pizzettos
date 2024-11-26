<?php
include_once("models/ProductoDAO.php");

class productoController{
    public function index(){
        include_once("views/index.php");
    }
    public function pizzas(){
        include_once("views/pizzas.php");
    }

    public function nombreProducto() {
        return ProductoDAO::getAll();
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