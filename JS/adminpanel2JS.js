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
            const todosConEmail = data.every(p => p.email && p.email.includes("@")); 
            console.log("¿Todos los pedidos tienen email válido?", todosConEmail); 

            const emailValido = document.getElementById('email-valid-message');
            if (todosConEmail) {
                emailValido.textContent = "Todos los pedidos tienen un email válido.";
                emailValido.style.color = "green";
            } else {
                emailValido.textContent = "Hay pedidos con email no válido.";
                emailValido.style.color = "red";
            }
            
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