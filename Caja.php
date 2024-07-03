<!doctype html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Caja</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link href="css/Ingresodedatos.css" rel="stylesheet" type="text/css"/>
        <link href="css/Procesarformda.css" rel="stylesheet" type="text/css"/>
        <link href="css/SeccionInformacion.css" rel="stylesheet" type="text/css"/>
        <link href="css/links.css" rel="stylesheet" type="text/css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>
    <body>
        <header class="header">
            <div class="logo-container">
                <img src="imagenes/TC - Logo Blanco Transparente.png" alt="Logo" class="logo">
            </div>
            <div class="logout-container">
                <a href="inic.php" class="btn btn-primary">Cerrar sesión</a>
            </div>
        </header>
        <div class="container">
            <nav class="sidebar">
                <ul>
                    <li><a href="Usuarios.php"><i class="bi bi-chat icon"></i>Usuarios</a></li>
                    <li><a href="Clientes.php"><i class="bi bi-box-seam icon"></i>Clientes</a></li>
                    <li><a href="Productos.php"><i class="bi bi-phone-vibrate icon"></i>Productos</a></li>
                    <li><a href="Caja.php" style="background-color: #959EBD"><i class="bi bi-box-seam icon"></i>Caja</a></li>
                    <li><a href="historial.php"><i class="bi bi-box-seam icon"></i>Historial</a></li>
                    <li><a href="AyudaSoporte.php"><i class="bi bi-gear icon"></i>Ayuda y Soporte</a></li>  
                </ul>
            </nav>
            <main class="main-content">
                <!-- aquí se edita -->
                <div class="row">
                    <div class="col-md-4">
                        <h2>Formulario de Venta</h2>
                        <form id="ventaForm">
                            <div class="mb-3">
                                <label for="cliente" class="form-label">Cliente</label>
                                <select class="form-select" id="cliente" name="cliente" required>
                                    <option value="" selected disabled>Seleccione un cliente</option>
                                    <?php
                                    include_once 'CRUD/cliente_crud.php';
                                    $clientes = obtenerClientes();
                                    foreach ($clientes as $cliente) {
                                        echo "<option value='" . $cliente['id'] . "'>" . $cliente['nombre'] . " " . $cliente['apellido'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="producto" class="form-label">Producto</label>
                                <select class="form-select" id="producto" name="producto" required>
                                    <option value="" selected disabled>Seleccione un producto</option>
                                    <?php
                                    include_once 'CRUD/producto_crud.php';
                                    $productos = obtenerProductos();
                                    foreach ($productos as $producto) {
                                        echo "<option value='" . $producto['idProd'] . "'>" . $producto['descripcion'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="cantidad" class="form-label">Cantidad</label>
                                <input type="number" class="form-control" id="cantidad" name="cantidad" min="1" required>
                            </div>
                            <button type="button" id="agregarProducto" class="btn btn-primary">Agregar Producto</button>
                        </form>
                    </div>
                    <div class="col-md-8">
                        <h2>Productos en la Venta</h2>
                        <table class="table" id="tablaProductos">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Descripción</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Total</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Aquí se agregarán los productos dinámicamente -->
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            <h3>Total: <span id="totalVenta">0</span></h3>
                        </div>
                        <button type="button" id="procesarVenta" class="btn btn-success">Procesar Venta</button>
                    </div>
                </div>
                <!-- aquí finaliza -->
            </main>
        </div>

        <script>
            $(document).ready(function() {
                $('#agregarProducto').click(function() {
                    var productoId = $('#producto').val();
                    var productoTexto = $('#producto option:selected').text();
                    var cantidad = $('#cantidad').val();
                    
                    // Obtener el precio del producto desde el array de productos
                    var precio = 0;
                    <?php
                    foreach ($productos as $producto) {
                        echo "if (productoId == " . $producto['idProd'] . ") precio = " . $producto['precio'] . ";\n";
                    }
                    ?>
                    
                    var total = precio * cantidad;
                    
                    $('#tablaProductos tbody').append(
                        '<tr>' +
                        '<td>' + productoId + '</td>' +
                        '<td>' + productoTexto + '</td>' +
                        '<td>' + cantidad + '</td>' +
                        '<td>' + precio + '</td>' +
                        '<td>' + total + '</td>' +
                        '<td><button type="button" class="btn btn-sm btn-danger eliminarProducto">Eliminar</button></td>' +
                        '</tr>'
                    );
                    
                    actualizarTotal();
                });

                $(document).on('click', '.eliminarProducto', function() {
                    $(this).closest('tr').remove();
                    actualizarTotal();
                });

                $('#procesarVenta').click(function() {
                    // Aquí puedes agregar la lógica para procesar la venta y guardar los datos en la base de datos
                    alert('Venta procesada');
                });

                function actualizarTotal() {
                    var total = 0;
                    $('#tablaProductos tbody tr').each(function() {
                        var totalProducto = parseFloat($(this).find('td:eq(4)').text());
                        total += totalProducto;
                    });
                    $('#totalVenta').text(total);
                }
            });
        </script>
    </body> 
</html>


