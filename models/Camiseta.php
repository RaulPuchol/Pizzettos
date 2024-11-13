<?php
include_once("models/Producto.php");

class Camiseta extends Producto{
    public function __construct($nombre = null, $talla = null, $precio = null){
        parent::__construct($nombre, $talla, $precio);
    }

    function getNombre() {
        return $this->nombre;
    }

    function getTalla() {
        return $this->talla;
    }

    function getPrecio() {
        return $this->precio;
    }
}