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


    public function meterAlCarrito() {
        $emailCarrito = $_POST['email'];
        $idproducto = $_POST['idproducto'];

        productoDAO::insertCarrito($emailCarrito, $idproducto, 1);
    }

    public function carrito($emailCarrito) {
        return productoDAO::getCarrito($emailCarrito);
    }

    public function getProductosCarrito($email) {
        return productoDAO::getProductosDelCarrito($email);
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