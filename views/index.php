<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/index.css">
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
<?php
include_once header;
?>
<div id="carouselExampleAutoplaying " class="carousel slide carrusel" data-bs-ride="carousel">
    <div class="carousel-inner imagenes">
        <div class="carousel-item active">
            <img class="d-block w-100" src="Images/webadd (1).png" alt="Imagen 1">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="Images/webadd (1).png" alt="Imagen 2">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="Images/webadd (1).png" alt="Imagen 3">
        </div>
    </div>
</div>
<section id="midindex">
    <div class="midtext">
        <h1>Pizzería online</h1>
        <p>Descubre en nuestra tienda de Pizzeria más de 1000 referencias diferentes con las mejores marcas y licencias en todos los productos. Desde Pizzas de italia, Pizzas hechas por nuestros clientes, pasando por los mejores chefs.</p>
    </div>
    <div class="swiper mySwiper w-75 midindexcarruselmain ">
        <h2>Las Pizzas mas vendidas</h2>
    
        <div class="swiper-wrapper midindexcarrusel">
        
            <!--<i class="col fa-solid fa-chevron-left"></i>-->

            <?php foreach (productoController::nombreProducto() as $producto): 
                if ($producto->getIdcategoria() == 1){?>
                    <div class="swiper-slide">
                        <img src="Images/<?= $producto->getImagen(); ?>.webp">
                        <a href="#buy"><?= $producto->getNombre(); ?></a>
                        <p><?= $producto->getPrecioBase(); ?> €</p>
                    </div>
            <?php   
                }?> 
            <?php endforeach; ?>
            <!--<i class="col fa-solid fa-chevron-right"></i>-->
        </div>
        
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</section>

<section id="bottomindex" class="container-fluid m-0">
    <img class="imagebig" src="Images/webadd (1).png">
    <div class="bottomindeximages">
        <div class="images row w-100">
            <div class="col">
                <img src="Images/promotional_pizza_427x427.png">
            </div>
            <div class="col">
                <img src="Images/promotional_pizza_427x427.png">
            </div>
            <div class="col">
                <img src="Images/promotional_pizza_427x427.png">
            </div>
        </div>
        <div class="images row w-100">
            <div class="col">
                <img src="Images/promotional_pizza_427x427.png">
            </div>
            <div class="col">
                <img src="Images/promotional_pizza_427x427.png">
            </div>
            <div class="col">
                <img src="Images/promotional_pizza_427x427.png">
            </div>
        </div>
    </div>
</section>

<?php
include_once footer;
?>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script >
var swiper = new Swiper(".mySwiper", {
    slidesPerView: 1,
    slidesPerGroup: 1,
    centeredSlides: false,
    loop: true,
    grabCursor: true,
    rightSlide: true,
    keyboard: {
    enabled: true,
    },
    scrollbar: {
    el: ".swiper-scrollbar",
    },
    navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
    },
    pagination: {
    el: ".swiper-pagination",
    clickable: true,
    },
    breakpoints: {
    1562: {
        slidesPerView: 4,
    },
    759: {
        slidesPerView: 2
    },
    }
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>