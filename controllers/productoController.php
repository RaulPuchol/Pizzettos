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

    


    public function meterAlCarrito($emailCarrito, $idproducto) {

        if ($emailCarrito === "none"){
            header ("Location: /dashboard/Pizzettos/Pizzettos/?controller=login&action=login");
        } else {
            productoDAO::insertCarrito($emailCarrito, $idproducto, 1);
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

        if(!isset($_POST['descuento']) || $_POST['descuento'] == '') {
            $iddescuento = 1;
        }

        if ($iddescuento != 1) {
            $descuento = productoController::descuento($iddescuento);
            $descuentoCalculado = $precio * ($descuento / 100);
            $precio -= $descuentoCalculado; 
        }

        productoDAO::nuevopedido($emailusuario, $fechapedido, $cantidad, number_format($precio,2), $iddescuento);

        header ("location: ?controller=login&action=pedidos");
    }


    public function descuento($descuento) {
        $result = productoDAO::validarDescuento($descuento);
        // Comprobar si existe el descuento
        if ($result->num_rows > 0) {
            $descuento = $result->fetch_assoc(); // Obtener datos del descuento
            return $descuento['Porcentaje'];
        } else {
            return 0;
        }

    }

    public function descuento1($descuento) {
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