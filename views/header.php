<?php 
session_start();
if (!isset($_SESSION['email'])){
    $email = "none";
} else {
    $email = $_SESSION['email'];
}


?>
<head><link rel="stylesheet" href="CSS/index.css"></head>
<div id="ad">
        <p class="m-0">CONTACTA EN PEDIDOS@PIZZETTOS.ES SI TIENES ALGÚN PROBLEMA</p>
</div>
    <header>
        <div class="container-fluid m-0 w-100 background">
            <div id="head" class="row">
                <div class="col col-4 logo">
                <a href="?controller=producto"><img src="Images/Logo.png"></a>
                </div>
                <div class="col searcher">
                    <input type="text" placeholder="Buscar">
                    <button><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
                <div class="col icons">
                    <div>
                        <a href="#menu"><i class="fa-solid fa-pizza-slice"></i><p class="m-0 texto">EL CLUB</p></a>
                    </div>
                    <div>
                        <a href="#store"><i class="fa-solid fa-store"></i><p class="m-0 texto ">TIENDA</p></a>
                    </div>
                    <div>
                        <a href="#menu"><i class="fa-regular fa-heart"></i><p class="m-0 texto ">FAVORITOS</p></a>
                    </div>
                    <div>
                        <a href="?controller=login&action=login"><i class="fa-regular fa-user"></i><p class="m-0 texto ">PERFIL</p></a>
                    </div>
                    <div>
                    <button class="btn btn-primary" type="submit" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                        
                        <span class="position-relative">
                        <i class="fa-solid fa-bag-shopping"></i>
                            <span class="position-absolute top-50 start-0 translate-middle badge rounded-pill bg-danger">
                                <?php $totalCantidad = 0;?>
                                <?php foreach (productoController::getProductosCarrito($email) as $producto): ?>
                                   <?php 
                                    $totalCantidad += $producto->cantidad 
                                    ?>
                            <?php endforeach; ?>
                            <?=$totalCantidad?>
                            </span>
                        </span>
                        <p class="m-0 texto ">MI CESTA</p>
                    </button>
                    </div>
                </div>
            </div>
        </div>

        <div id="headbuttons" class="container-fluid m-0 ">
            <div class="row buttons">
                <div class="col red">
                    <a href="#menu">
                        <button>SÚPER OFERTTAS</button>
                    </a>
                </div>
                <div class="col blue">
                    <a href="?controller=producto&action=pizzas">
                        <button>PIZZAS Y MÁS</button>
                    </a>
                </div>
                <div class="col blue">
                    <a href="#menu">
                        <button href="#menu">MENÚS <i class="fa-solid fa-angle-down"></i></button>
                    </a>
                </div>
                <div class="col blue">
                    <a href="#menu">
                        <button href="#menu">PROMOCIONES <i class="fa-solid fa-angle-down"></i></button>
                    </a>
                </div>
                <div class="col blue">
                    <a href="#menu">
                        <button href="#menu">25% Dto. DESDE WEB</button>
                    </a>
                </div>
                <div class="col blue">
                    <a href="#menu">
                        <button href="#menu">ENTRANTES</button>
                    </a>
                </div>
                <div class="col blue">
                    <a href="#menu">
                        <button href="#menu">BEBIDAS</button>
                    </a>
                </div>
                <div class="col blue">
                    <a href="#menu">
                        <button href="#menu">EXTRAS <i class="fa-solid fa-plus"></i></button>
                    </a>
                </div>
            </div>
        </div> 
    </header>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasRightLabel">Mi cesta</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            
            <div class="carrito">
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
        
        <div class="buybutton">
            <div class="buysubtotal">
                <p>Subtotal</p>
            
                <?php $subtotal = 0;?>
                    <?php foreach (productoController::getProductosCarrito($email) as $producto): ?>
                        <?php 
                        $subtotal += $producto->getPrecioBase() * $producto->cantidad 
                        ?>
                <?php endforeach; ?>
                <p><?=$subtotal?> €</p>
            
            </div>
            <button>FINALIZAR COMPRA</button>
        </div>
    </div>
</div>

<script>
// Establecer la URL actual en el campo oculto
document.getElementById("currentUrl").value = window.location.href;
</script>

