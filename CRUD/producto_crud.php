<?php
// Incluir la conexión a la base de datos
include_once 'Conexion.php';

// Función para obtener todos los productos
function obtenerProductos() {
    global $conn;

    $query = "SELECT * FROM productos";
    $resultado = mysqli_query($conn, $query);

    $productos = [];
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $productos[] = $fila;
    }

    return $productos;
}

// Función para obtener un producto por su ID
function obtenerProductoPorId($idProd) {
    global $conn;

    $idProd = mysqli_real_escape_string($conn, $idProd);
    $query = "SELECT * FROM productos WHERE idProd = $idProd";
    $resultado = mysqli_query($conn, $query);

    return mysqli_fetch_assoc($resultado);
}

// Función para crear un nuevo producto
function crearProducto($descripcion, $precio, $stock, $categoria) {
    global $conn;

    $descripcion = mysqli_real_escape_string($conn, $descripcion);
    $precio = mysqli_real_escape_string($conn, $precio);
    $stock = mysqli_real_escape_string($conn, $stock);
    $categoria = mysqli_real_escape_string($conn, $categoria);

    $query = "INSERT INTO productos (descripcion, precio, stock, categoria) VALUES ('$descripcion', $precio, $stock, '$categoria')";
    $resultado = mysqli_query($conn, $query);

    return $resultado;
}

// Función para actualizar un producto
function actualizarProducto($idProd, $descripcion, $precio, $stock, $categoria) {
    global $conn;

    $idProd = mysqli_real_escape_string($conn, $idProd);
    $descripcion = mysqli_real_escape_string($conn, $descripcion);
    $precio = mysqli_real_escape_string($conn, $precio);
    $stock = mysqli_real_escape_string($conn, $stock);
    $categoria = mysqli_real_escape_string($conn, $categoria);

    $query = "UPDATE productos SET descripcion='$descripcion', precio=$precio, stock=$stock, categoria='$categoria' WHERE idProd=$idProd";
    $resultado = mysqli_query($conn, $query);

    return $resultado;
}

// Función para eliminar un producto
function eliminarProducto($idProd) {
    global $conn;

    $idProd = mysqli_real_escape_string($conn, $idProd);
    $query = "DELETE FROM productos WHERE idProd=$idProd";
    try {
        $resultado = mysqli_query($conn, $query);
    } catch (mysqli_sql_exception $e) {
        // Manejar la excepción de restricción de clave foránea
        echo "Error al eliminar el producto: " . $e->getMessage();
        return false;
    }

    return $resultado;
}

// Manejar solicitudes POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['create'])) {
        crearProducto($_POST['descripcion'], $_POST['precio'], $_POST['stock'], $_POST['categoria']);
    } elseif (isset($_POST['update'])) {
        actualizarProducto($_POST['idProd'], $_POST['descripcion'], $_POST['precio'], $_POST['stock'], $_POST['categoria']);
    } elseif (isset($_POST['delete'])) {
        eliminarProducto($_POST['idProd']);
    }

    header("Location: ../Productos.php");
    exit();
}
?>
