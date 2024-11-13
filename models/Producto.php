<?php

abstract class Producto{
    const TYPE_CAMISETA = "1";
    const TYPE_PANTALONES = "2";
    protected $talla;
    protected $precio;
    protected $nombre;

    public function __construct($nombre, $talla, $precio) {
        $this->talla = $talla;
        $this->precio = $precio;
        $this->nombre = $nombre;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    public function getNombre(){
        return $this->nombre;
    }

    public function setTalla($talla){
        $this->talla = $talla;
    }

    public function getTalla(){
        return $this->talla;
    }

    public function setPrecio($precio){
        $this->precio = $precio;
    }

    public function getPrecio(){
        return $this->precio;
    }
}