<?php
include_once("models/Producto.php");

class Productos extends Producto {

    public function __construct($idproducto = null, $nombre = null, $preciobase = null, $imagen = null, $iddescuento = null, $idcategoria = null) {
        parent::__construct($idproducto, $nombre, $preciobase, $imagen, $iddescuento, $idcategoria);
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getPreciobase() {
        return $this->preciobase;
    }

    public function getImagen() {
        return $this->imagen;
    }

    public function getIdcategoria() {
        return $this->idcategoria;
    }
}
