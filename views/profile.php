<?php
session_start(); // Asegúrate de iniciar la sesión al principio

// Verifica si ya hay una sesión iniciada
if (!isset($_SESSION['email']) || $_SESSION['email'] == "none") {
    // Si la sesión está iniciada, redirige a otra página
    header("Location: /dashboard/Pizzettos/Pizzettos/?controller=login&action=login");
}

// Si no hay sesión, continúa mostrando la página de inicio de sesión
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <title>Pizzettos</title>
</head>
<body>
    <header>
        <div class="container-fluid m-0 w-100 backgroundprofile">
        
            <div id="headprofile" class="row">
                <div class="col logoprofile">
                <div><a href="?controller=producto"><button><i class="fa-solid fa-arrow-left"></i> Volver a la tienda</button></a></div>
                <div><a href="?controller=producto"><img src="Images/Logo.svg" alt="logo"></a></div>
                <div></div>
                
                
                </div>
            </div>
        </div>
    </header>

    <section id="profile">
        <h1>Mi cuenta</h1>
        <div class="profilebuttons">
            <div><a href="?controller=login&action=pedidos"><button><i class="fa-solid fa-bag-shopping"></i><h4>Mis pedidos</h4><p>Podrás consultar tus pedidos y realizar devoluciones</p></button></a></div>
            <div><a><button><i class="fa-solid fa-location-dot"></i><h4>Mis direcciones</h4><p>Podrás modificar, eliminar o añadir una nueva dirección de entrega</p></button></a></div>
            <div><a><button><i class="fa-solid fa-user"></i><h4>Mis datos personales</h4><p>Podrás cambiar tus datos personales desde aquí</p></button></a></div>
            <div><a><button><i class="fa-solid fa-store"></i><h4>Compras en tienda</h4><p>Podrás revisar tus compras al día siguiente de realizarlas</p></button></a></div>
            <div><a><button><i class="fa-solid fa-envelope"></i><h4>Newsletter</h4><p>Suscríbete para enterarte antes que nadie de nuestras ofertas y novedades</p></button></a></div>
            <div><a><button><i class="fa-solid fa-tag"></i><h4>Mis promociones</h4><p>Consulta todos tus descuentos y promociones</p></button></a></div>
        </div>
        <a class="logout" href="?controller=login&action=logout">Salir de mi cuenta</a>
    </section>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>