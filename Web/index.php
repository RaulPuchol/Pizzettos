<?php

include_once("./controller/ProductController.php");



        if(!isset($_GET["controller"]))
        {
            header("Location:".$url."?controller=Product&action=index");
        }
        else
        {
            $controller = $_GET['controller'];
            $controller_name = $controller . "Controller";
            include_once("controller/$controller_name.php");

            if(class_exists($controller_name))
            {
                // $controllerName = ProductController
                $controllerClass = new $controller_name();

                if(isset($view["action"]))
                {
                    $action = $_GET["action"];
                }
                else
                {
                    $action = "index";
                }

                $controllerClass->$action();
            }
            else
            {
                echo "Controller name dosent exist. $controller_name";
            }
        }

?>
