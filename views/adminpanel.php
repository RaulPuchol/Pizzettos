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
        <a href="?controller=apiproductos&action=adminpanel"><button>Tabla de Productos</button></a>
        <a href="?controller=apipedidos&action=adminpanel1"><button>Tabla de Pedidos</button></a>
        <a href="?controller=apiusuarios&action=adminpanel2"><button>Tabla de Usuarios</button></a>
        </div>
        <div class="adminpanelright">

            <div id="productoadd">
                <form class="producto-form-add">
                    <div><p>Nombre del Producto:</p> <input id="Nombre" Requiered></div>
                    <div><p>Precio del Producto:</p> <input id="PrecioBase" Requiered></div>
                    <div><p>ID Descuento:</p> <input class="inputshort" id="IDdescuento" Requiered></div>
                    <div><p>ID Categoria:</p> <input class="inputshort" id="IDcategoria" Requiered></div>
                    <button type="button" onclick="addProductData()">Añadir</button>
                </form>
            </div> 
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
            const transformprecio = data.data;

            // Llamada al segundo fetch: Productos
            fetch('?controller=apiproductos&action=getproductosapi')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error al obtener los datos');
                    }
                    return response.json();
                })
                .then(productos => {
                    const productoContainer = document.getElementById('producto');
                    productoContainer.innerHTML = ''; // Limpiar el contenedor

                    productos.forEach(producto => {
                        const bloque = document.createElement('div');
                        const uniqueID = `PrecioBase-${producto.IDproducto}`; // ID único para el precio base

                        bloque.innerHTML = `
                            <div>
                                <p>IDproducto:</p> 
                                <p>${producto.IDproducto}</p>
                                <form class="delete-form">
                                    <input type="hidden" name="IDproducto" value="${producto.IDproducto}">
                                    <button type="button" onclick="deleteProductData(${producto.IDproducto})">Eliminar</button>
                                </form>
                            </div>
                            <img src="Images/${producto.Imagen}.webp">
                            <form class="producto-form">
                                <input type="hidden" id="IDproducto" value="${producto.IDproducto}">
                                <div><p>Nombre del Producto:</p> <input id="Nombre" value="${producto.Nombre}"></div>
                                <div><p>Precio del Producto:</p> <input id="${uniqueID}" value="${producto.PrecioBase}" data-original="${producto.PrecioBase}"></div>
                                <div><p>ID Descuento:</p> <input id="IDdescuento" value="${producto.IDdescuento}"></div>
                                <div><p>ID Categoria:</p> <input id="IDcategoria" value="${producto.IDcategoria}"></div>
                                <button type="button" onclick="updateProductData(${producto.IDproducto})">Actualizar</button>
                            </form>
                        `;

                        productoContainer.appendChild(bloque);

                        // Crear y agregar select de monedas
                        const select = document.createElement('select');
                        select.classList.add('moneyselect');

                        Object.keys(transformprecio).forEach(moneda => {
                            const option = document.createElement('option');
                            option.value = moneda;
                            option.textContent = moneda;
                            select.appendChild(option);
                        });

                        // Evento para actualizar el precio
                        select.addEventListener('change', () => {
                            const monedaSeleccionada = select.value;
                            const tasaCambio = transformprecio[monedaSeleccionada];
                            const precioBaseInput = document.getElementById(uniqueID);

                            // Recuperar el precio original
                            const precioOriginal = parseFloat(precioBaseInput.getAttribute('data-original')) || 0;

                            // Si selecciona EUR, restablece el precio original
                            if (monedaSeleccionada === 'EUR') {
                                precioBaseInput.value = precioOriginal.toFixed(2);
                            } else {
                                // Calcular el precio con la tasa de cambio
                                const nuevoPrecio = (precioOriginal * tasaCambio).toFixed(2);
                                precioBaseInput.value = nuevoPrecio;
                            }
                        });

                        bloque.appendChild(select);
                    });
                })
                .catch(error => {
                    console.error('Error al cargar los productos:', error);
                });
        })
        .catch(error => {
            console.error('Error al cargar los datos de monedas:', error);
        });


        // Seleccionar todos los botones de actualización
        
        function updateProductData(id) {
            // Obtener los datos del formulario dinámicamente
            const button = document.querySelector(`button[onclick="updateProductData(${id})"]`);
            const form = button.closest('form');
            
            const producto = {
                IDproducto: form.querySelector('#IDproducto').value,
                Nombre: form.querySelector('#Nombre').value,
                PrecioBase: form.querySelector('#PrecioBase').value,
                IDdescuento: form.querySelector('#IDdescuento').value,
                IDcategoria: form.querySelector('#IDcategoria').value
            };

            // Hacer el fetch para actualizar los datos en el servidor
            fetch("?controller=apiproductos&action=updateproductosapi", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(producto)  // Enviar el objeto 'producto' con los valores del formulario
            })
            .then(response => {
                // Inspecciona el contenido de la respuesta
                return response.text().then(text => {
                    console.log("Respuesta del servidor:", text);
                    try {
                        return JSON.parse(text); // Intenta parsear el texto como JSON
                    } catch (error) {
                        throw new Error("La respuesta no es un JSON válido");
                    }
                });
            })
            .then(json => {
                if (json.success) {
                    alert(`Producto actualizado`);
                    location.reload();
                } else {
                    alert("Error al actualizar el producto");
                    location.reload();
                }
            })
            .catch(error => {
                console.error("Error:", error);
                location.reload();
                
            });
        }

        function deleteProductData(id) {
            // Obtener los datos del formulario dinámicamente
            const button = document.querySelector(`button[onclick="deleteProductData(${id})"]`);
            const dform = button.closest('form');
            
            const producto = {
                IDproducto: dform.querySelector('#IDproductod').value
            };

            // Hacer el fetch para actualizar los datos en el servidor
            fetch("?controller=apiproductos&action=deleteproductosapi", {
                method: "DELETE",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(producto)  // Enviar el objeto 'producto' con los valores del formulario
                
            })
            .then(response => {
                // Inspecciona el contenido de la respuesta
                return response.text().then(text => {
                    console.log("Respuesta del servidor:", text);
                    try {
                        return JSON.parse(text); // Intenta parsear el texto como JSON
                    } catch (error) {
                        throw new Error("La respuesta no es un JSON válido");
                    }
                });
            })
            .then(json => {
                if (json.success) {
                    alert(`Producto borrado`);
                    location.reload();
                } else {
                    alert("Error al borrar el producto");
                    location.reload();
                }
            })
            .catch(error => {
                console.error("Error:", error);
                location.reload();
                
            });
        }

        function addProductData() {
            // Obtener los datos del formulario dinámicamente
            const form = document.querySelector('.producto-form-add');
            
            const producto = {
                Nombre: form.querySelector('#Nombre').value,
                PrecioBase: form.querySelector('#PrecioBase').value,
                IDdescuento: form.querySelector('#IDdescuento').value,
                IDcategoria: form.querySelector('#IDcategoria').value
            };

            // Hacer el fetch para actualizar los datos en el servidor
            fetch("?controller=apiproductos&action=addproductosapi", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(producto)  // Enviar el objeto 'producto' con los valores del formulario
            })
            .then(response => {
                // Inspecciona el contenido de la respuesta
                return response.text().then(text => {
                    console.log("Respuesta del servidor:", text);
                    try {
                        return JSON.parse(text); // Intenta parsear el texto como JSON
                    } catch (error) {
                        throw new Error("La respuesta no es un JSON válido");
                    }
                });
            })
            .then(json => {
                if (json.success) {

                    alert(`Producto actualizado`);
                    location.reload();
                } else {
                    alert("Error al actualizar el producto");
                    location.reload();
                }
            })
            .catch(error => {
                console.error("Error:", error);
                location.reload();
                
            });
        }
    </script>
</body>
</html>