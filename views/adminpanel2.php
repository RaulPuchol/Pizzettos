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
                <form class="usuario-form-add">
                    <div><p>Email:</p> <input id="email" Requiered></div>
                    <div><p>Nombre de Usuario:</p> <input id="usuario" Requiered></div>
                    <button type="button" onclick="addUsuarioData()">Añadir</button>
                </form>
            </div> 
            <div id="producto">
        
            </div> 
            
        </div>

    </section>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>     
    // Llamada a la API usando fetch
    fetch('?controller=apiusuarios&action=getusuariosapi')
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
            data.forEach(usuario => {
                const bloque = document.createElement('div');
                bloque.innerHTML = `
                    
                    <div>
                    <p>IDusuario:</p> 
                    <p>${usuario.IDusuario}</p>

                    <form class="delete-form">
                        <input type="hidden" name="IDusuario" id="IDusuariod" value="${usuario.IDusuario}">
                        <button type="button" onclick="deleteUsuarioData(${usuario.IDusuario})">Eliminar</button>
                    </form>
                    

                    </div>

                    <form class="usuario-form">
                        <input type="hidden" id="IDusuario" value="${usuario.IDusuario}">
                        <div><p>Email:</p> <input id="email" value="${usuario.email}"></div>
                        <div><p>Nombre de Usuario:</p> <input id="usuario" value="${usuario.usuario}"></div>
                        <button type="button" onclick="updateUsuarioData(${usuario.IDusuario})">Actualizar</button>
                    </form>
                `;
                pedido1.appendChild(bloque);
                const form = document.getElementById('usuario-form');
                const dform = document.getElementById('delete-form');
            });
        })
        .catch(error => {
            console.error('Error al cargar los datos:', error);
        });


        // Seleccionar todos los botones de actualización
        
        function updateUsuarioData(id) {
            // Obtener los datos del formulario dinámicamente
            const button = document.querySelector(`button[onclick="updateUsuarioData(${id})"]`);
            const form = button.closest('form');
            
            const usuario = {
                IDusuario: form.querySelector('#IDusuario').value,
                email: form.querySelector('#email').value,
                usuario: form.querySelector('#usuario').value
            };

            // Hacer el fetch para actualizar los datos en el servidor
            fetch("?controller=apiusuarios&action=updateusuariosapi", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(usuario)  // Enviar el objeto 'usuario' con los valores del formulario
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
                    // Aquí puedes hacer lo que necesites, como actualizar la interfaz con los datos actualizados
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

        function deleteUsuarioData(id) {
            // Obtener los datos del formulario dinámicamente
            const button = document.querySelector(`button[onclick="deleteUsuarioData(${id})"]`);
            const dform = button.closest('form');
            
            const usuario = {
                IDusuario: dform.querySelector('#IDusuariod').value
            };

            // Hacer el fetch para actualizar los datos en el servidor
            fetch("?controller=apiusuarios&action=deleteusuariosapi", {
                method: "DELETE",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(usuario)  // Enviar el objeto 'pedido' con los valores del formulario
                
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
                    // Aquí puedes hacer lo que necesites, como actualizar la interfaz con los datos actualizados
                    alert(`Usuario borrado`);
                    location.reload();
                } else {
                    alert("Error al borrar el Usuario");
                    location.reload();
                }
            })
            .catch(error => {
                console.error("Error:", error);
                location.reload();
                
            });
        }

        function addUsuarioData() {
            // Obtener los datos del formulario dinámicamente
            const form = document.querySelector('.usuario-form-add');
            
            const usuario = {
                email: form.querySelector('#email').value,
                usuario: form.querySelector('#usuario').value
            };

            // Hacer el fetch para actualizar los datos en el servidor
            fetch("?controller=apiusuarios&action=addusuariosapi", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(usuario)  // Enviar el objeto 'usuario' con los valores del formulario
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
                    // Aquí puedes hacer lo que necesites, como actualizar la interfaz con los datos actualizados
                    alert(`Usuario actualizado`);
                    location.reload();
                } else {
                    alert("Error al actualizar el Usuario");
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