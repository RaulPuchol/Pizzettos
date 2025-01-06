<?php
include_once("models/ProductoDAO.php");

class productoController{
    public function index(){ // función que muestra la vista de inicio
        include_once("views/index.php");
    }
    public function pizzas(){ // función que muestra la vista de pizzas
        include_once("views/pizzas.php");
    }
    public function comprar(){ // función que muestra la vista de comprar
        include_once("views/comprar.php");
    }

    public function nombreProducto() { // función que obtiene los productos de la base de datos
        return ProductoDAO::getAll();
    }

    


    public function meterAlCarrito($emailCarrito, $idproducto) { // función que añade un producto al carrito

        if ($emailCarrito === "none"){
            header ("Location: /dashboard/Pizzettos/Pizzettos/?controller=login&action=login");
        } else {
            productoDAO::insertCarrito($emailCarrito, $idproducto, 1);
        }

        
    }

    public function getProductosCarrito($email) { // función que obtiene los productos del carrito

        
        return productoDAO::getProductosDelCarrito($email);
        
        
    }

    public function deletefromCarrito() { // función que elimina un producto del carrito
        $idcarrito = $_POST['idcarrito'];
        $url = $_POST['currentUrl'];
        productoDAO::deleteProductoDelCarrito($idcarrito);
        header ("Location: ". $url);
    }

    public function comprarproductos() { // función que añade un pedido a la base de datos
        $emailusuario = $_POST['email'];
        $fechapedido = date("Y-m-d H:i:s");
        $cantidad = $_POST['cantidad'];
        $precio = $_POST['precio'];
        $iddescuento = $_POST['descuento'];

        if(!isset($_POST['descuento']) || $_POST['descuento'] == '') {
            $iddescuento = 1;
        }

        if ($iddescuento != 1) {
            $descuento = productoController::descuento($iddescuento);
            $descuentoCalculado = $precio * ($descuento / 100);
            $precio -= $descuentoCalculado; 
        }

        if($precio > 0) {
            productoDAO::nuevopedido($emailusuario, $fechapedido, $cantidad, number_format($precio,2), $iddescuento);
            header ("location: ?controller=login&action=pedidos");
        } else {
            header ("location: ?controller=producto&action=comprar");
        }
        

        
    }


    public function descuento($descuento) { // función que valida un descuento
        $result = productoDAO::validarDescuento($descuento);
        // Comprobar si existe el descuento
        if ($result->num_rows > 0) {
            $descuento = $result->fetch_assoc(); // Obtener datos del descuento
            return $descuento['Porcentaje'];
        } else {
            return 0;
        }

    }

    public function descuento1($descuento) { // función que valida un descuento
        $result = productoDAO::validarDescuento($descuento);
        // Comprobar si existe el descuento
        if ($result->num_rows > 0) {
            $descuento = $result->fetch_assoc(); // Obtener datos del descuento
            echo "<p style='color: green'>Descuento aplicado!</p>";
        } else {
            echo "<p style='color: red'>No existe codigo de descuento.</p>";
        }

    }
}