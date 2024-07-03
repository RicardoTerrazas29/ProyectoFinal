<!doctype html>
<html>
<head>
    <title>Historial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
            <li><a href="Productos.php"><i class="bi bi-phone-vibrate icon"></i>Productos</a></li>
            <li><a href="Caja.php"><i class="bi bi-graph-up icon"></i>Caja</a></li>
            <li><a href="Historial.php" style="background-color: #959EBD"><i class="bi bi-graph-up icon"></i>Historial</a></li>
            <li><a href="AyudaSoporte.php"><i class="bi bi-gear icon"></i>Ayuda y Soporte</a></li>
        </ul>
    </nav>
    <main class="main-content">
        <h2>Historial de Ventas</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID Venta</th>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Precio Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once 'CRUD/Conexion.php';
                $sql = "
                    SELECT v.idVenta, v.fecha, c.nombre AS cliente, v.precioTotal
                    FROM ventas v
                    JOIN clientes c ON v.idCliente = c.idCliente
                ";
                $result = $conn->query($sql);

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['idVenta'] . "</td>";
                    echo "<td>" . $row['fecha'] . "</td>";
                    echo "<td>" . htmlspecialchars($row['cliente']) . "</td>";
                    echo "<td>$" . number_format($row['precioTotal'], 2) . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </main>
</div>
</body> 
</html>
