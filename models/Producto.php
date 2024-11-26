<?php

abstract class Producto{
    protected $idproducto;
    protected $nombre;
    protected $preciobase;
    protected $imagen;
    protected $iddescuento;
    protected $idcategoria;

    public function __construct($idproducto, $nombre, $preciobase, $imagen, $iddescuento,$idcategoria) {
        $this->idproducto = $idproducto;
        $this->nombre = $nombre;
        $this->preciobase = $preciobase;
        $this->imagen = $imagen;
        $this->iddescuento = $iddescuento;
        $this->idcategoria = $idcategoria;
    }



    /**
     * Get the value of idproducto
     */ 
    public function getIdproducto()
    {
        return $this->idproducto;
    }

    /**
     * Set the value of idproducto
     *
     * @return  self
     */ 
    public function setIdproducto($idproducto)
    {
        $this->idproducto = $idproducto;

        return $this;
    }

    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of preciobase
     */ 
    public function getPreciobase()
    {
        return $this->preciobase;
    }

    /**
     * Set the value of preciobase
     *
     * @return  self
     */ 
    public function setPreciobase($preciobase)
    {
        $this->preciobase = $preciobase;

        return $this;
    }

    /**
     * Get the value of iddescuento
     */ 
    public function getIddescuento()
    {
        return $this->iddescuento;
    }

    /**
     * Set the value of iddescuento
     *
     * @return  self
     */ 
    public function setIddescuento($iddescuento)
    {
        $this->iddescuento = $iddescuento;

        return $this;
    }

    /**
     * Get the value of idcategoria
     */ 
    public function getIdcategoria()
    {
        return $this->idcategoria;
    }

    /**
     * Set the value of idcategoria
     *
     * @return  self
     */ 
    public function setIdcategoria($idcategoria)
    {
        $this->idcategoria = $idcategoria;

        return $this;
    }

    /**
     * Get the value of imagen
     */ 
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set the value of imagen
     *
     * @return  self
     */ 
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }
}