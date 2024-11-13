<head>
    <link rel="stylesheet" href="CSS/inicio.css">
</head>
<body>
    <div id="carrusel">
        <div class="imagenes">
            <img src="Images/webadd (1).png" alt="Imagen 1">
            <!--<
            img src="Images/webadd (1).png" alt="Imagen 2">
            <img src="Images/webadd (1).png" alt="Imagen 3">
            -->
        </div>
    </div> 
    
    <section id="midindex">
        <div class="midtext">
            <h1>Pizzería online</h1>
            <p>Descubre en nuestra tienda de Pizzeria más de 1000 referencias diferentes con las mejores marcas y licencias en todos los productos. Desde Pizzas de italia, Pizzas hechas por nuestros clientes, pasando por los mejores chefs.</p>
        </div>
        <div class="midindexcarruselmain">
            <h2>Las Pizzas mas vendidas</h2>

            <div class="midindexcarrusel">
                <i class="fa-solid fa-chevron-left"></i>
                <div>
                    <img src="Images/pizza.png">
                    <a href="#buy">Pizza con Pepperoni</a>
                    <p>9,99 €</p>
                </div>
                <div>
                    <img src="Images/pizza.png">
                    <a href="#buy">Pizza con Pepperoni</a>
                    <p>9,99 €</p>
                </div>
                <div>
                    <img src="Images/pizza.png">
                    <a href="#buy">Pizza con Pepperoni</a>
                    <p>9,99 €</p>
                </div>
                <div>
                    <img src="Images/pizza.png">
                    <a href="#buy">Pizza con Pepperoni</a>
                    <p>9,99 €</p>
                </div>
                <i class="fa-solid fa-chevron-right"></i>
            </div>
        </div>
    </section>
    <section id="bottomindex">
        <img class="imagebig" src="Images/webadd (1).png">
        <div class="bottomindeximages">
            <div class="images">
                <img src="Images/webadd (1).png">
                <img src="Images/webadd (1).png">
                <img src="Images/webadd (1).png">
            </div>
            <div class="images">
                <img src="Images/webadd (1).png">
                <img src="Images/webadd (1).png">
                <img src="Images/webadd (1).png">
            </div>
        </div>
    </section>

    <table>
       <!-- <?php
        var_dump($productos);
        foreach ($productos as $producto) {
        ?>

        <tr>
            <td>    <?= $producto->GetNombre();?>   </td>
            <td>    <?= $producto->GetPrecio();?>   </td>
            <td>    <?= $producto->GetTalla();?>    </td>
            <td>  <a href="?controller=Product&action=delete&id=<?= $producto->GetId(); ?>">Delete Item</a></td>
        </tr>

        <?php } ?>-->

    </table>

        
</body>


</html>