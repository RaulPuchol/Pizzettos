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

            // filter nuevo array que cumple la condicion
            const conDescuento = data.filter(p => p.IDdescuento != null && p.IDdescuento !== ''); 
            console.log("Pedidos con descuento:", conDescuento); 

            //reduce hace que todos los valores de un array se sumen
            const cantidadTotal = data.reduce((acc, p) => acc + Number(p.Cantidad), 0); 
            console.log("Cantidad total:", cantidadTotal); 


            //find devuelve el primero elemento que cumpla la condicion
            const pedidoCien = data.find(p => p.IDpedido === 100); 
            if (pedidoCien) console.log("Pedido con ID 100:", pedidoCien); 

            //some hace true si algun elemento cumple la condicion
            const hayPrecioAlto = data.some(p => Number(p .Precio) > 100); 
            console.log("precios mayores a 100 = ", hayPrecioAlto); 


            //every devuelve true si todos los elementos del array cumplen la condicion
            const todosConEmail = data.every(p => p.emailusuario && p.emailusuario.includes("@")); 
            console.log("¿Todos los pedidos tienen email válido?", todosConEmail); 

            const emailValido = document.getElementById('email-valid-message');
            if (todosConEmail) {
                emailValido.textContent = "Todos los pedidos tienen un email válido.";
                emailValido.style.color = "green";
            } else {
                emailValido.textContent = "Hay pedidos con email no válido.";
                emailValido.style.color = "red";
            }

            const pedidoCien1 = document.getElementById('pedido-cien');
            if (pedidoCien) {
                pedidoCien1.textContent = `Pedido con ID 100: ${pedidoCien1.IDpedido}, Email: ${pedidoCien1.emailusuario}, Fecha: ${pedidoCien1.Fechapedido}`;
            } else {
                pedidoCien1.textContent = "No hay un pedido con ID 100.";
            }

            const hayPrecioAlto1 = document.getElementById('precio-alto');
            if (hayPrecioAlto) {
                hayPrecioAlto1.textContent = "Hay pedidos con precios mayores a 100.";
            } else {
                hayPrecioAlto1.textContent = "No hay pedidos con precios mayores a 100.";
            }
            
            // Limpiar la tabla antes de agregar datos
            // Agregar cada producto como una fila de la tabla
            data.forEach(pedido => {
                const bloque = document.createElement('div');
                bloque.innerHTML = `
                    
                    <div>
                    
                    
                    <p>IDpedido:</p> 
                    <p>${pedido.IDpedido}</p>

                    <form class="delete-form" >
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
                    </div>
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

            

            localStorage.setItem("emailusuario_filtro", pedido.emailusuario);
            localStorage.setItem("Cantidad_filtro", pedido.Cantidad);
            localStorage.setItem("Precio_filtro", pedido.Precio);
            localStorage.setItem("IDdescuento_filtro", pedido.IDdescuento);

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

        window.addEventListener('DOMContentLoaded', () => {
            const form = document.querySelector('.pedido-form-add');
            if (form) {
                form.querySelector('#emailusuario').value = localStorage.getItem("emailusuario_filtro") || '';
                form.querySelector('#Cantidad').value = localStorage.getItem("Cantidad_filtro") || '';
                form.querySelector('#Precio').value = localStorage.getItem("Precio_filtro") || '';
                form.querySelector('#IDdescuento').value = localStorage.getItem("IDdescuento_filtro") || '';
            }
        });