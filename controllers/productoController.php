<?php
include_once("models/ProductoDAO.php");

class productoController{
    public function index(){
        include_once("views/index.php");
    }
    public function pizzas(){
        include_once("views/pizzas.php");
    }
    public function comprar(){
        include_once("views/comprar.php");
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

    public function comprarproductos() {
        $emailusuario = $_POST['email'];
        $fechapedido = date("Y-m-d H:i:s");
        $cantidad = $_POST['cantidad'];
        $precio = $_POST['precio'];
        $iddescuento = $_POST['descuento'];

        productoDAO::nuevopedido($emailusuario, $fechapedido, $cantidad, $precio, $iddescuento);
    }

    public function descuento() {
        $descuento = $_POST['descuento'];

        $resultado = productoDAO::validarDescuento($descuento);

    }
}