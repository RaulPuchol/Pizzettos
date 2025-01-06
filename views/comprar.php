<?php include_once "script/sessioncompra.php"?>


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
$descuentoAplicado = '';

if (isset($_POST['descuento'])) {
    $descuentoAplicado = $_POST['descuento'];
}

?>
    <section id="comprar">
        <div></div>
        <div class="col comprarleft accordion" id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                    <p>1. DATOS PERSONALES</p>
                </button>
                </h2>
                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                <div class="accordion-body">
                <p>Conectado como: <?= $email?></p>
                <p>¿No es usted? <a class="logout" href="?controller=login&action=logout">Cerrar sesión</a></p> 
                <p>Si cierra sesión ahora, se vaciará su carrito.</p>
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                    <p>2. DIRECCIONES</p>
                </button>
                </h2>
                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                <div class="accordion-body">
                    
                    <div>
                        <h4>Su dirección de entrega</h4>
                        <p><?=$email?></p>
                        <p></p>
                        <p>08760</p>
                        <p>España</p>
                        <p>Barcelona</p>
                        <p></p>
                        <p></p>
                        <p></p>
                    </div>
                    <div>
                        <h4>Su dirección de facturación</h4>
                        <p><?=$email?></p>
                        <p></p>
                        <p>08760</p>
                        <p>España</p>
                        <p>Barcelona</p>
                        <p></p>
                        <p></p>
                        <p></p>
                    </div>
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                    <p>3. MÉTODOS DE ENTERGA</p>
                </button>
                </h2>
                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                <div class="accordion-body">
                    <form>
                        <div class="input">
                            <div>
                                <input type="radio" id="1" name="envio" value="1">
                            </div>
                            <div>
                                <p><label for="1">Envío a domicilio</label></p>
                                <p><label for="1">Envíos en 48h desde la salida del almacén</label></p>
                            </div>
                            
                            
                        </div>
                        <div class="input">
                            <div>
                                <input type="radio" id="2" name="envio" value="2">
                            </div>
                            <div>
                                <p><label for="2">Recoger en tienda</label></p>
                                <p><label for="2">Recogida aproximada entre 2-5 días.</label></p>
                            </div>
                        
                        </div>
                    </form>
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
                    <p>4. MÉTODOS DE PAGO</p>
                </button>
                </h2>
                <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        <form action="?controller=producto&action=comprarproductos" method="post">
                            <div class="input2">
                                <div>
                                <?php $cantidad = 0;
                                $precio = 0;
                                foreach (productoController::getProductosCarrito($email) as $producto){ 
                                        $precio += $producto->getPrecioBase() * $producto->cantidad; 
                                        $cantidad += $producto->cantidad; ?>
                            <?php } ?>
                                    
                                    <input type="hidden" name="email" value="<?= $email?>">
                                    <input type="hidden" name="precio" value="<?= $precio?>">
                                    <input type="hidden" name="cantidad" value="<?= $cantidad?>">
                                    <input  type="hidden" name="descuento" id="descuentoid" value="<?= htmlspecialchars($descuentoAplicado) ?>">
                                    <button type="submit">Comprar en efectivo</button>
                                </div>
                                <div>
                                <i class="fa-solid fa-money-bill"></i>
                                </div>     
                            </div>       
                        </form>
                    </div>
                </div>
            </div> 
        </div>
        <div class="comprarright">
            <div>
                <div class="cajacarrito">
                    <div class="carritocompra">
                        <?php foreach (productoController::getProductosCarrito($email) as $producto): ?>
                            <div class="productoCarrito">
                                <img src="Images/<?= $producto->getImagen(); ?>.webp">
                                <p><a href="#buy"><?= $producto->getNombre(); ?></a><p><?= $producto->cantidad?></p></p>
                                <p><?= $producto->getPrecioBase() * $producto->cantidad; ?> €</p>

                                <form action="?controller=producto&action=deletefromCarrito" method="post">
                                    <input type="hidden" name="idcarrito" value="<?= $producto->IDcarrito?>">
                                    <input type="hidden" name="currentUrl" id="currentUrl">
                                    <button type="submit">Eliminar</button>
                                </form>
                            </div> 
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <form action="?controller=producto&action=comprar" class="searchercarrito" method="post" >
                    <label for="descuento">Codigo descuento</label>
                    <div>
                        <input type="text" name="descuento" id="descuento" value="<?= htmlspecialchars($descuentoAplicado) ?>">
                        <button type="submit" >APLICAR</button>
                    </div>
                    <?php
                        if(isset($_POST['descuento'])) {
                            $session = new productoController();
                            $session->descuento1($_POST['descuento']);
                        }
                    ?>
                </form>

                <div class="total">
                    <p>TOTAL:</p>

                    <?php $total = 0;
                    foreach (productoController::getProductosCarrito($email) as $producto){
                        $total += $producto->getPrecioBase() * $producto->cantidad;
                    } 
                    
                    if (isset($_POST['descuento'])) {
                        $session = new productoController();
                        $descuentoAplicado = $session->descuento($_POST['descuento']);

                        if ($descuentoAplicado > 0 && $descuentoAplicado <= 100) {
                            $descuentoCalculado = $total * ($descuentoAplicado / 100); // Si es porcentaje
                            $total -= $descuentoCalculado; 
                            echo "<p>Descuento aplicado: ($descuentoAplicado%)</p>";
                        }
                    }
                    
                    ?>
                    <p><?=number_format($total,2)?> €</p>
                </div>
            </div>
        </div>           
        <div>
        

        </div>
    </section>


<?php
include_once footer;
?>
</script>

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