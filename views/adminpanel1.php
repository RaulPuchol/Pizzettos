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
                <form class="pedido-form-add">
                    <div><p>Email del Pedido:</p> <input id="emailusuario" requiered></div>
                    <div><p>Cantidad del pedido:</p> <input id="Cantidad" requiered></div>
                    <div><p>Precio del pedido:</p> <input id="Precio" requiered></div>
                    <div><p>ID descuento:</p> <input id="IDdescuento" requiered></div>
                    <button type="button" onclick="addPedidoData()">Añadir</button>
                </form>
            </div> 
            <div id="producto">
        
            </div> 
            
        </div>

    </section>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>     
    // Llamada a la API usando fetch
    fetch('?controller=apipedidos&action=getpedidosapi')
        .then(response => {
            if (!response.ok) {
                throw new Error('Error al obtener los datos');
            }
            return response.json();
        })
        .then(data => {
            const pedido1 = document.getElementById('producto');
            
            // Limpiar la tabla antes de agregar datos (opcional)
            // Agregar cada producto como una fila de la tabla
            data.forEach(pedido => {
                const bloque = document.createElement('div');
                bloque.innerHTML = `
                    
                    <div>
                    <p>IDpedido:</p> 
                    <p>${pedido.IDpedido}</p>

                    <form class="delete-form">
                        <input type="hidden" name="IDpedido" id="IDpedidod" value="${pedido.IDpedido}">
                        <button type="button" onclick="deletePedidoData(${pedido.IDpedido})">Eliminar</button>
                    </form>
                    

                    </div>

                    <form class="pedido-form">
                        <input type="hidden" id="IDpedido" value="${pedido.IDpedido}">
                        <div><p>Email del Pedido:</p> <input id="emailusuario" value="${pedido.emailusuario}"></div>
                        <div><p>Fecha del Pedido:</p> <input id="Fechapedido" value="${pedido.Fechapedido}"></div>
                        <div><p>Cantidad del pedido:</p> <input class="inputshort" id="Cantidad" value="${pedido.Cantidad}"></div>
                        <div><p>Precio:</p> <input id="Precio" value="${pedido.Precio}"></div>
                        <div><p>ID descuento:</p> <input class="inputshort" id="IDdescuento" value="${pedido.IDdescuento}"></div>
                        <button type="button" onclick="updatePedidoData(${pedido.IDpedido})">Actualizar</button>
                    </form>
                `;
                pedido1.appendChild(bloque);
                const form = document.getElementById('pedido-form');
                const dform = document.getElementById('delete-form');
            });
        })
        .catch(error => {
            console.error('Error al cargar los datos:', error);
        });


        // Seleccionar todos los botones de actualización
        
        function updatePedidoData(id) {
            // Obtener los datos del formulario dinámicamente
            const button = document.querySelector(`button[onclick="updatePedidoData(${id})"]`);
            const form = button.closest('form');
            
            const pedido = {
                IDpedido: form.querySelector('#IDpedido').value,
                emailusuario: form.querySelector('#emailusuario').value,
                Fechapedido: form.querySelector('#Fechapedido').value,
                Cantidad: form.querySelector('#Cantidad').value,
                Precio: form.querySelector('#Precio').value,
                IDdescuento: form.querySelector('#IDdescuento').value
            };

            // Hacer el fetch para actualizar los datos en el servidor
            fetch("?controller=apipedidos&action=updatepedidosapi", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(pedido)  // Enviar el objeto 'pedido' con los valores del formulario
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

        function deletePedidoData(id) {
            // Obtener los datos del formulario dinámicamente
            const button = document.querySelector(`button[onclick="deletePedidoData(${id})"]`);
            const dform = button.closest('form');
            
            const pedido = {
                IDpedido: dform.querySelector('#IDpedidod').value
            };

            // Hacer el fetch para actualizar los datos en el servidor
            fetch("?controller=apipedidos&action=deletepedidosapi", {
                method: "DELETE",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(pedido)  // Enviar el objeto 'pedido' con los valores del formulario
                
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

        function addPedidoData() {
            // Obtener los datos del formulario dinámicamente
            const form = document.querySelector('.pedido-form-add');
            
            const pedido = {
                emailusuario: form.querySelector('#emailusuario').value,
                Cantidad: form.querySelector('#Cantidad').value,
                Precio: form.querySelector('#Precio').value,
                IDdescuento: form.querySelector('#IDdescuento').value
            };

            // Hacer el fetch para actualizar los datos en el servidor
            fetch("?controller=apipedidos&action=addpedidosapi", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(pedido)  // Enviar el objeto 'Pedido' con los valores del formulario
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
                    // actualizado
                    alert(`Pedido actualizado`);
                    location.reload();
                } else {
                    alert("Error al actualizar el Pedido");
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