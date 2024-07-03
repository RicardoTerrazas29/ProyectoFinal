<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Usuarios</title>
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
                <li><a href="Usuarios.php" style="background-color: #959EBD"><i class="bi bi-chat icon"></i>Usuarios</a></li>
                <li><a href="Clientes.php"><i class="bi bi-box-seam icon"></i>Clientes</a></li>
                <li><a href="Productos.php"><i class="bi bi-phone-vibrate icon"></i>Productos</a></li>
                <li><a href="Caja.php"><i class="bi bi-graph-up icon"></i>Caja</a></li>
                <li><a href="Graficos.php"><i class="bi bi-question-circle icon"></i>Grafico</a></li>
                <li><a href="AyudaSoporte.php"><i class="bi bi-gear icon"></i>Ayuda y Soporte</a></li>
            </ul>
        </nav>
        <main class="main-content">
            <!-- Esta es la tabla donde se edita -->
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h2>Formulario de Usuario</h2>
                        <?php
                        include_once 'CRUD/usuario_crud.php';
                        if (isset($_GET['edit'])) {
                            $idUsuario = $_GET['edit'];
                            $usuario = obtenerUsuarioPorId($idUsuario);
                        }
                        ?>
                        <form action="CRUD/usuario_crud.php" method="post">
                            <input type="hidden" name="idUsuario" value="<?php echo isset($usuario) ? $usuario['idUsuario'] : ''; ?>">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo isset($usuario) ? htmlspecialchars($usuario['nombre']) : ''; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="apellido" class="form-label">Apellido</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo isset($usuario) ? htmlspecialchars($usuario['apellido']) : ''; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="dni" class="form-label">DNI</label>
                                <input type="text" class="form-control" id="dni" name="dni" value="<?php echo isset($usuario) ? htmlspecialchars($usuario['dni']) : ''; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="usuario" class="form-label">Usuario</label>
                                <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo isset($usuario) ? htmlspecialchars($usuario['usuario']) : ''; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="clave" class="form-label">Clave</label>
                                <input type="password" class="form-control" id="clave" name="clave" <?php echo isset($usuario) ? '' : 'required'; ?>>
                            </div>
                            <div class="mb-3">
                                <label for="rol" class="form-label">Rol</label>
                                <select class="form-select" id="rol" name="rol" required>
                                    <option value="" selected disabled>Seleccione un rol</option>
                                    <option value="Administrador" <?php echo (isset($usuario) && $usuario['rol'] == 'Administrador') ? 'selected' : ''; ?>>Administrador</option>
                                    <option value="Empleado" <?php echo (isset($usuario) && $usuario['rol'] == 'Empleado') ? 'selected' : ''; ?>>Empleado</option>
                                </select>
                            </div>
                            <button type="submit" name="<?php echo isset($usuario) ? 'update' : 'create'; ?>" class="btn btn-primary"><?php echo isset($usuario) ? 'Actualizar' : 'Crear'; ?></button>
                        </form>
                    </div>
                    <div class="col-md-8">
                        <h2>Lista de Usuarios</h2>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>DNI</th>
                                    <th>Usuario</th>
                                    <th>Rol</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Incluir CRUD de usuarios
                                include_once 'CRUD/usuario_crud.php';

                                // Obtener todos los usuarios
                                $usuarios = obtenerUsuarios();

                                // Mostrar usuarios en la tabla
                                foreach ($usuarios as $usuario) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($usuario['nombre']) . "</td>";
                                    echo "<td>" . htmlspecialchars($usuario['apellido']) . "</td>";
                                    echo "<td>" . htmlspecialchars($usuario['dni']) . "</td>";
                                    echo "<td>" . htmlspecialchars($usuario['usuario']) . "</td>";
                                    echo "<td>" . htmlspecialchars($usuario['rol']) . "</td>";
                                    echo "<td>
                                            <a href='Usuarios.php?edit=" . htmlspecialchars($usuario['idUsuario']) . "' class='btn btn-sm btn-primary'><i class='bi bi-pencil'></i> Editar</a>
                                            <form action='CRUD/usuario_crud.php' method='post' style='display:inline-block;'>
                                                <input type='hidden' name='idUsuario' value='" . htmlspecialchars($usuario['idUsuario']) . "'>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-NaP6Lc+BXq4sR1Bytqf5ggPU3y3V3cg7wAVG0qoK4p1wu8iuA9hAX+lnmwTpY0n2" crossorigin="anonymous"></script>
</body>
</html>
