<?php
include_once("models/Producto.php");

class Productos extends Producto {

    public function __construct($idproducto, $nombre, $preciobase , $imagen , $iddescuento, $idcategoria ) {
        parent::__construct($idproducto, $nombre, $preciobase, $imagen, $iddescuento, $idcategoria);
    }

    public function getIdproducto() {
        return $this->idproducto;
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
