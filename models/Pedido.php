<?php

class Pedido {
    protected $IDpedido;
    protected $emailusuario;
    protected $Fechapedido;
    protected $Cantidad;
    protected $Precio;
    protected $IDdescuento;

    public function __construct($IDpedido, $emailusuario, $Fechapedido, $Cantidad, $Precio,$IDdescuento) {
        $this->IDpedido= $IDpedido;
        $this->emailusuario = $emailusuario;
        $this->Fechapedido = $Fechapedido;
        $this->Cantidad = $Cantidad;
        $this->Precio = $Precio;
        $this->IDdescuento = $IDdescuento;
    }


    /**
     * Get the value of IDpedido
     */ 
    public function getIDpedido()
    {
        return $this->IDpedido;
    }

    /**
     * Set the value of IDpedido
     *
     * @return  self
     */ 
    public function setIDpedido($IDpedido)
    {
        $this->IDpedido = $IDpedido;

        return $this;
    }

    /**
     * Get the value of emailusuario
     */ 
    public function getEmailusuario()
    {
        return $this->emailusuario;
    }

    /**
     * Set the value of emailusuario
     *
     * @return  self
     */ 
    public function setEmailusuario($emailusuario)
    {
        $this->emailusuario = $emailusuario;

        return $this;
    }

    /**
     * Get the value of Fechapedido
     */ 
    public function getFechapedido()
    {
        return $this->Fechapedido;
    }

    /**
     * Set the value of Fechapedido
     *
     * @return  self
     */ 
    public function setFechapedido($Fechapedido)
    {
        $this->Fechapedido = $Fechapedido;

        return $this;
    }

    /**
     * Get the value of Cantidad
     */ 
    public function getCantidad()
    {
        return $this->Cantidad;
    }

    /**
     * Set the value of Cantidad
     *
     * @return  self
     */ 
    public function setCantidad($Cantidad)
    {
        $this->Cantidad = $Cantidad;

        return $this;
    }

    /**
     * Get the value of Precio
     */ 
    public function getPrecio()
    {
        return $this->Precio;
    }

    /**
     * Set the value of Precio
     *
     * @return  self
     */ 
    public function setPrecio($Precio)
    {
        $this->Precio = $Precio;

        return $this;
    }

    /**
     * Get the value of IDdescuento
     */ 
    public function getIDdescuento()
    {
        return $this->IDdescuento;
    }

    /**
     * Set the value of IDdescuento
     *
     * @return  self
     */ 
    public function setIDdescuento($IDdescuento)
    {
        $this->IDdescuento = $IDdescuento;

        return $this;
    }
}
