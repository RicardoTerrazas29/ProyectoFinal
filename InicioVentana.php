<!doctype html>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>css</title>
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
                <li><a href="AyudaSoporte.php"><i class="bi bi-question-circle icon"></i>Ayuda y Soporte</a></li>
                <li><a href="ConfigPerfil.php"><i class="bi bi-gear icon"></i>Configuración de Perfil</a></li>
                </ul>
            </nav>
            <main class="main-content">
                <p class="main-content-text">Seleccione un apartado para empezar a leer</p>
                <svg xmlns="http://www.w3.org/2000/svg" width="180" height="180" fill="#C6D8E2" class="bi bi-book" viewBox="0 0 16 16">
                <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783"/>
                </svg>
            </main>
        </div>
    </body>
</html>


