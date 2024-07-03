<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="css/Ingresodedatos.css" rel="stylesheet" type="text/css"/>
    <link href="css/Procesarformda.css" rel="stylesheet" type="text/css"/>
    <link href="css/SeccionInformacion.css" rel="stylesheet" type="text/css"/>
    <link href="css/links.css" rel="stylesheet" type="text/css"/>
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
                <li><a href="Productos.php" style="background-color: #959EBD"><i class="bi bi-phone-vibrate icon"></i>Productos</a></li>
                <li><a href="Caja.php"><i class="bi bi-graph-up icon"></i>Caja</a></li>
                <li><a href="historial.php"><i class="bi bi-question-circle icon"></i>Historial</a></li>
                <li><a href="AyudaSoporte.php"><i class="bi bi-gear icon"></i>Ayuda y Soporte</a></li>
            </ul>
        </nav>
        <main class="main-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h2>Formulario de Producto</h2>
                        <?php
                        include_once 'CRUD/producto_crud.php';
                        if (isset($_GET['edit'])) {
                            $idProducto = $_GET['edit'];
                            $producto = obtenerProductoPorId($idProducto);
                        }
                        ?>
                        <form action="CRUD/producto_crud.php" method="post">
                            <input type="hidden" name="idProd" value="<?php echo isset($producto) ? $producto['idProd'] : ''; ?>">
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo isset($producto) ? htmlspecialchars($producto['descripcion']) : ''; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="precio" class="form-label">Precio</label>
                                <input type="text" class="form-control" id="precio" name="precio" value="<?php echo isset($producto) ? htmlspecialchars($producto['precio']) : ''; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="stock" class="form-label">Stock</label>
                                <input type="text" class="form-control" id="stock" name="stock" value="<?php echo isset($producto) ? htmlspecialchars($producto['stock']) : ''; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="categoria" class="form-label">Categoría</label>
                                <select class="form-select" id="categoria" name="categoria" required>
                                    <option value="" selected disabled>Seleccione una categoría</option>
                                    <option value="Celulares" <?php echo (isset($producto) && $producto['categoria'] == 'Celulares') ? 'selected' : ''; ?>>Celulares</option>
                                    <option value="Laptops" <?php echo (isset($producto) && $producto['categoria'] == 'Laptops') ? 'selected' : ''; ?>>Laptops</option>
                                    <option value="Tablets" <?php echo (isset($producto) && $producto['categoria'] == 'Tablets') ? 'selected' : ''; ?>>Tablets</option>
                                    <option value="Monitores" <?php echo (isset($producto) && $producto['categoria'] == 'Monitores') ? 'selected' : ''; ?>>Monitores</option>
                                    <option value="Accesorios" <?php echo (isset($producto) && $producto['categoria'] == 'Accesorios') ? 'selected' : ''; ?>>Accesorios</option>
                                </select>
                            </div>
                            <button type="submit" name="<?php echo isset($producto) ? 'update' : 'create'; ?>" class="btn btn-primary"><?php echo isset($producto) ? 'Actualizar' : 'Crear'; ?></button>
                        </form>
                    </div>
                    <div class="col-md-8">
                        <h2>Lista de Productos</h2>
                        <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Descripción</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <th>Categoría</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $productos = obtenerProductos();
                            foreach ($productos as $producto) {
                                echo "<tr>";
                                echo "<td>" . $producto['idProd'] . "</td>";
                                echo "<td>" . $producto['descripcion'] . "</td>";
                                echo "<td>" . $producto['precio'] . "</td>";
                                echo "<td>" . $producto['stock'] . "</td>";
                                echo "<td>" . $producto['categoria'] . "</td>";
                                echo "<td>
                                        <a href='Productos.php?edit=" . $producto['idProd'] . "' class='btn btn-sm btn-warning'><i class='bi bi-pencil'></i></a>
                                        <form action='CRUD/producto_crud.php' method='post' style='display: inline;'>
                                            <input type='hidden' name='idProd' value='" . $producto['idProd'] . "'>
                                            <button type='submit' name='delete' class='btn btn-sm btn-danger'><i class='bi bi-trash'></i></button>
                                        </form>
                                      </td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>

