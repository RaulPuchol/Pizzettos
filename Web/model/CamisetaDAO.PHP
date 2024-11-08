<?php
class CamisetaDAO{
    public static function store($producto){
        $con = DataBase::connect();
        $stmt = $con->prepare("INSERT INTO camisetas (nombre, talla, precio) VALUES (?,?,?);");
        $stmt->bind_param("ssd",$producto->GetNombre(),$producto->getTalla(),$producto->getPrecio());

        $stmt->execute();
        $stmt->close();
    }
}

?>