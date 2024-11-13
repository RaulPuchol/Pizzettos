<?php

//include_once("config/DatabaseAccessObject.php");
//include_once("model/Product.php");
//include_once("model/Productos/Shirt.php");

class ProductController
{
    public function index()
    {
        //$dao = new DatabaseAccessObject();
       //$productos = $dao->getAllCamisetas("nombre");
        
        include_once("view/main.php");
    }

    public function delete($id)
    {
        $dao = new DatabaseAccessObject();
        $dao->deleteitem($_GET['id']);
        include_once("view/index.php");
    }

    public function show()
    {
        include_once("view/show.php");
    }

    public function store(){
        $nombre = $_POST['nombre'];
        $talla = $_POST['talla'];
        $precio = $_POST['precio'];

        $producto = new Camiseta();
        $producto->SetNombre($nombre);
        $producto->SetTalla($talla);
        $producto->SetPrecio($precio);

        CamisetaDAO::store($producto);
    }
}

?>