<?php
include_once "controllers/loginController.php";
include_once "controllers/productoController.php";
include_once "config/parameters.php";
include_once "api/apiproductosController.php";

if (!isset($_GET['controller'])) {
    echo "No existe en la url Controller";
    header("Location:".url."?controller=producto");
} else {
    
    //Establece el nombre del controlador
    $nombre_controller = $_GET["controller"]."Controller";
    if (class_exists($nombre_controller)) {
        //Instancia el controlador
        $controller = new $nombre_controller();

        //Comprueba si action existe
        if(isset($_GET["action"]) && method_exists( $controller, $_GET["action"] )) {
            $action = $_GET["action"];
        } else {
            //Default action esta definido en parameters.php
            $action = default_action;
        }

        //ejecuta action en el controlador
        $controller -> $action();
        
    } else {
        echo "No existe el Controller ".$nombre_controller;
    }
    
}
