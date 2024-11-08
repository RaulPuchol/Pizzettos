<?php

abstract class Product
{
    protected $Nombre;
    protected $Precio;
    protected $Talla;
    protected $id;
    
    /*
    // Para poder usar fetch_object hay que vaciar el construct
    public function __construct($nombre, $precio, $talla)
    {
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->talla = $talla;
    }
    */

    public function __construct()
    {

    }

    public function GetNombre()
    {
        return $this->Nombre;
    }

    public function GetPrecio()
    {
        return $this->Precio;
    }

    public function GetTalla()
    {
        return $this->Talla;
    }

    public function SetNombre($value)
    {
        $this->Nombre = $value;
    }

    public function SetPrecio($value)
    {
        $this->Precio = $value;
    }

    public function SetTalla($value)
    {
        $this->Talla = $value;
    }

    /**
     * Get the value of id
     */ 
    public function GetId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function SetId($id)
    {
        $this->id = $id;

        return $this;
    }
}

?>