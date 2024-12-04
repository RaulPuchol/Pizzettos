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

        if ($emailCarrito === "none"){
            header ("Location: /dashboard/Pizzettos/Pizzettos/?controller=login&action=login");
        } else {
            productoDAO::insertCarrito($emailCarrito, $idproducto, 1);
            header ("Location: /dashboard/Pizzettos/Pizzettos/?controller=producto&action=pizzas");

        }

        
    }

    public function getProductosCarrito($email) {

        
        return productoDAO::getProductosDelCarrito($email);
        
        
    }

    public function deletefromCarrito() {
        $idcarrito = $_POST['idcarrito'];
        $url = $_POST['currentUrl'];
        productoDAO::deleteProductoDelCarrito($idcarrito);
        header ("Location: ". $url);
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