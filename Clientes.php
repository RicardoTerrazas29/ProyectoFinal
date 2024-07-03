<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Clientes</title>
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
                <li><a href="Clientes.php" style="background-color: #959EBD"><i class="bi bi-box-seam icon"></i>Clientes</a></li>
                <li><a href="Productos.php"><i class="bi bi-phone-vibrate icon"></i>Productos</a></li>
                <li><a href="Caja.php"><i class="bi bi-graph-up icon"></i>Caja</a></li>
                <li><a href="historial.php"><i class="bi bi-question-circle icon"></i>Historial</a></li>
                <li><a href="AyudaSoporte.php"><i class="bi bi-gear icon"></i>Ayuda y Soporte</a></li>
            </ul>
        </nav>
        <main class="main-content">
            <!-- Esta es la tabla donde se edita -->
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h2>Formulario de Cliente</h2>
                        <?php
                        include_once 'CRUD/cliente_crud.php';
                        if (isset($_GET['edit'])) {
                            $idCliente = $_GET['edit'];
                            $cliente = obtenerClientePorId($idCliente);
                        }
                        ?>
                        <form action="CRUD/cliente_crud.php" method="post">
                            <input type="hidden" name="idCliente" value="<?php echo isset($cliente) ? $cliente['idCliente'] : ''; ?>">
                            <div class="mb-3">
                                <label for="dni" class="form-label">DNI</label>
                                <input type="text" class="form-control" id="dni" name="dni" value="<?php echo isset($cliente) ? htmlspecialchars($cliente['dni']) : ''; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo isset($cliente) ? htmlspecialchars($cliente['nombre']) : ''; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="apellido" class="form-label">Apellido</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo isset($cliente) ? htmlspecialchars($cliente['apellido']) : ''; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo isset($cliente) ? htmlspecialchars($cliente['telefono']) : ''; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="correo" class="form-label">Correo</label>
                                <input type="email" class="form-control" id="correo" name="correo" value="<?php echo isset($cliente) ? htmlspecialchars($cliente['correo']) : ''; ?>" required>
                            </div>
                            <button type="submit" name="<?php echo isset($cliente) ? 'update' : 'create'; ?>" class="btn btn-primary"><?php echo isset($cliente) ? 'Actualizar' : 'Crear'; ?></button>
                        </form>
                    </div>
                    <div class="col-md-8">
                        <h2>Lista de Clientes</h2>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>DNI</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Teléfono</th>
                                    <th>Correo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $clientes = obtenerClientes();
                                foreach ($clientes as $cliente) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($cliente['dni']) . "</td>";
                                    echo "<td>" . htmlspecialchars($cliente['nombre']) . "</td>";
                                    echo "<td>" . htmlspecialchars($cliente['apellido']) . "</td>";
                                    echo "<td>" . htmlspecialchars($cliente['telefono']) . "</td>";
                                    echo "<td>" . htmlspecialchars($cliente['correo']) . "</td>";
                                    echo "<td>
                                            <a href='Clientes.php?edit=" . htmlspecialchars($cliente['idCliente']) . "' class='btn btn-sm btn-primary'><i class='bi bi-pencil'></i> Editar</a>
                                            <form action='CRUD/cliente_crud.php' method='post' style='display:inline-block;'>
                                                <input type='hidden' name='idCliente' value='" . htmlspecialchars($cliente['idCliente']) . "'>
                                                <button type='submit' name='delete' class='btn btn-sm btn-danger'><i class='bi bi-trash'></i> Eliminar</button>
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
            <!-- fin tabla -->
        </main>
    </div>
</body>
</html>
