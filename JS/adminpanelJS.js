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
                                    <input type="hidden" name="IDproductod" value="${producto.IDproducto}">
                                    <button type="button" onclick="deleteProductData(${producto.IDproducto})">Eliminar</button>
                                </form>
                            </div>
                            <img src="Images/${producto.Imagen}.webp">
                            <form class="producto-form">
                                <input type="hidden" id="IDproducto" value="${producto.IDproducto}">
                                <div><p>Nombre del Producto:</p> <input id="Nombre" value="${producto.Nombre}"></div>
                                <div><p>Precio del Producto:</p> <input id="${uniqueID}" class="PrecioBase" value="${producto.PrecioBase}" data-original="${producto.PrecioBase}"></div>
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
                PrecioBase: form.querySelector('.PrecioBase').value,
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
            const campos = ['Nombre', 'PrecioBase', 'IDdescuento', 'IDcategoria'];

            //map nuevo array aplicando una funcion a cada elemento del array
            campos.map(campo => {
                const valor = form.querySelector(`#${campo}`).value.trim();
                const esNumerico = ['PrecioBase', 'IDdescuento', 'IDcategoria'].includes(campo);
                return [campo, esNumerico ? parseFloat(valor) : valor];
            });
            

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