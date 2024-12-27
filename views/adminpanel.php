<?php
session_start(); // Asegúrate de iniciar la sesión al principio

// Verifica si ya hay una sesión iniciada
if (!isset($_SESSION['email']) || $_SESSION['email'] == "none" || $_SESSION['email'] != "raul@gmail.com") {
    // Si la sesión está iniciada, redirige a otra página
    header("Location: /dashboard/Pizzettos/Pizzettos/?controller=producto&action=index");
}

// Si no hay sesión, continúa mostrando la página de inicio de sesión
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/admin.css">
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
                <div><a href="?controller=login&action=profile"><button><i class="fa-solid fa-arrow-left"></i> Volver al perfil</button></a></div>
                <div><a href="?controller=producto"><img src="Images/Logo.svg" alt="logo"></a></div>
                <div></div>
                
                
                </div>
            </div>
        </div>
    </header>

    <section id="adminbody">
        <div class="adminpanelleft">
        <h1>Admin BBDD Tables</h1>
        <a href=""><button>Tabla de Productos</button></a>
        <a href=""><button>Tabla de Pedidos</button></a>
        <a href=""><button>Tabla de Usuarios</button></a>
        </div>
        <div class="adminpanelright">
            
            <div id="producto">
        
            </div> 
            
        </div>

    </section>







<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>     
        fetch('https://api.freecurrencyapi.com/v1/latest?apikey=fca_live_YK3FqEYXXfnRdW6P8EHZtmB96cdGqENL1Vai4uVk&base_currency=EUR')
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Error al obtener los datos');
                        }
                        return response.json();
                    })
                    .then(data => {
                        producto.innerHTML = '';
                        const producto1 = document.getElementById('producto');

                        const transformprecio = data.data;
                        const select = document.createElement('select');
                        select.classList.add("moneyselect");
                        

                        producto1.appendChild(select);


                        Object.keys(transformprecio).forEach(moneda => {
                            const option = document.createElement('option');
                            option.value = moneda;
                            option.textContent = moneda;
                            select.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error('Error al cargar los datos:', error);
                    });

        // Llamada a la API usando fetch
        fetch('?controller=apiproductos&action=getproductosapi')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error al obtener los datos');
                }
                return response.json();
            })
            .then(data => {
                const producto1 = document.getElementById('producto');
                
                // Limpiar la tabla antes de agregar datos (opcional)
                // Agregar cada producto como una fila de la tabla
                data.forEach(producto => {
                    const bloque = document.createElement('div');
                    bloque.innerHTML = `
                        <form method="POST" action="?controller=apiproductos&action=deleteproductosapi">
                        <input type="hidden" name="IDproducto" value="${producto.IDproducto}">
                        <button type="submit">Eliminar</button>
                        </form>
                        <div><p>IDproducto:</p> <p>${producto.IDproducto}</p></div>
                        <img src="Images/${producto.Imagen}.webp">
                        <div><p>Nombre del Producto:</p> <input value="${producto.Nombre}"></div>
                        <div><p>Precio del Producto:</p> <input value="${producto.PrecioBase}"></div>
                        <div><p>ID Descuento:</p> <input value="${producto.IDdescuento}"></div>
                        <div><p>ID Categoria:</p> <input value="${producto.IDcategoria}"></div>
                    `;
                    producto1.appendChild(bloque);
                    
                });
            })
            .catch(error => {
                console.error('Error al cargar los datos:', error);
                const producto = document.getElementById('producto');
                producto.innerHTML = '<p>No se pudo borrar ningun producto.</p>';
            });



            /*document.addEventListener('DOMContentLoaded', () => {
                const select = document.querySelector('.moneyselect');
                select.addEventListener('change', (event) => {
                    const selectedCurrency = event.target.value;
                    
                            const exchangeRate = data.data[selectedCurrency];
                            const productElements = document.querySelectorAll('#producto div');
                            productElements.forEach(productElement => {
                                const priceInput = productElement.querySelector('input[value]');
                                const basePrice = parseFloat(priceInput.value);
                                const convertedPrice = (basePrice * exchangeRate).toFixed(2);
                                priceInput.value = convertedPrice;
                            });
                        })
                });*/


    </script>
</body>
</html>