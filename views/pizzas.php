<?php include_once "script/session.php"?>
<?php
    if(isset($_POST['idproducto'])) {
        $session = new productoController();
        $session->meterAlCarrito($_POST['email'], $_POST['idproducto']);
    }
?>
<!DOCTYPE html>
<html lang="en">
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




<section id="paginacion">
    <span><a href="?controller=producto">INICIO</a></span> <span>/</span> <span><a>PIZZAS Y MÁS</a></span>
    <h4>PIZZAS Y MÁS</h4>
    <p>En Pizzettos nos hemos especializado en enriquecer y potenciar las Pizzas a través de nuestros restaurantes que despierten el apetito. Además, de contar una gama de pizzas / entrantes includo al gusto que desea. Para ello, hemos preparado una amplísima gama de platos para toda la famila que se adaptan a diferentes personas y niños .</p>

</section>

<section id="productoscontainer" class="container-fluid m-0">
    
    <div class="row">
    
        <div class="col productosleft accordion" id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                    <p>BUSCAR POR CATEGORÍA</p>
                </button>
                </h2>
                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                <div class="accordion-body">
                    
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                    <p>BUSCAR POR PRECIO</p>
                </button>
                </h2>
                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                <div class="accordion-body">
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                    <p>BUSCAR POR BEBIDAS</p>
                </button>
                </h2>
                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                <div class="accordion-body">
                </div>
                </div>
            </div>
        </div>
        
        <div class="col productosright">
            
        <?php foreach (productoController::nombreProducto() as $producto): ?>
            <div class="producto">
                <img src="Images/<?= $producto->getImagen(); ?>.webp">
                <a href="#buy"><?= $producto->getNombre(); ?></a>
                <p><?= $producto->getPrecioBase(); ?> €</p>
                
                <form action="?controller=producto&action=pizzas" method="post">
                    <input type="hidden" name="email" value="<?php 
                    echo htmlspecialchars($email);
                    ?>">
                    <input type="hidden" name="idproducto" value="<?= $producto->getIdproducto()?>">
                    <button type="submit"><i class="fa-solid fa-cart-shopping"></i></button>
                </form>
                
                
            </div> 
        <?php endforeach; ?>

        </div>
    </div>
</section>

<?php
    include_once footer;
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>