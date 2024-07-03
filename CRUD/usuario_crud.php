<?php
// Incluir la conexión a la base de datos
include_once 'Conexion.php';

// Función para obtener todos los usuarios
function obtenerUsuarios() {
    global $conn;

    $query = "SELECT * FROM usuario";
    $resultado = mysqli_query($conn, $query);

    $usuarios = [];
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $usuarios[] = $fila;
    }

    return $usuarios;
}

// Función para obtener un usuario por su ID
function obtenerUsuarioPorId($idUsuario) {
    global $conn;

    $idUsuario = mysqli_real_escape_string($conn, $idUsuario);
    $query = "SELECT * FROM usuario WHERE idUsuario = $idUsuario";
    $resultado = mysqli_query($conn, $query);

    return mysqli_fetch_assoc($resultado);
}

// Función para crear un nuevo usuario
function crearUsuario($nombre, $apellido, $dni, $usuario, $clave, $rol) {
    global $conn;

    $nombre = mysqli_real_escape_string($conn, $nombre);
    $apellido = mysqli_real_escape_string($conn, $apellido);
    $dni = mysqli_real_escape_string($conn, $dni);
    $usuario = mysqli_real_escape_string($conn, $usuario);
    $clave = mysqli_real_escape_string($conn, $clave);
    $rol = mysqli_real_escape_string($conn, $rol);

    $query = "INSERT INTO usuario (nombre, apellido, dni, usuario, clave, rol) VALUES ('$nombre', '$apellido', '$dni', '$usuario', '$clave', '$rol')";
    $resultado = mysqli_query($conn, $query);

    return $resultado;
}

// Función para actualizar un usuario
function actualizarUsuario($idUsuario, $nombre, $apellido, $dni, $usuario, $clave, $rol) {
    global $conn;

    $idUsuario = mysqli_real_escape_string($conn, $idUsuario);
    $nombre = mysqli_real_escape_string($conn, $nombre);
    $apellido = mysqli_real_escape_string($conn, $apellido);
    $dni = mysqli_real_escape_string($conn, $dni);
    $usuario = mysqli_real_escape_string($conn, $usuario);
    $clave = mysqli_real_escape_string($conn, $clave);
    $rol = mysqli_real_escape_string($conn, $rol);

    $query = "UPDATE usuario SET nombre='$nombre', apellido='$apellido', dni='$dni', usuario='$usuario', clave='$clave', rol='$rol' WHERE idUsuario=$idUsuario";
    $resultado = mysqli_query($conn, $query);

    return $resultado;
}

// Función para eliminar un usuario
function eliminarUsuario($idUsuario) {
    global $conn;

    $idUsuario = mysqli_real_escape_string($conn, $idUsuario);
    $query = "DELETE FROM usuario WHERE idUsuario=$idUsuario";
    try {
        $resultado = mysqli_query($conn, $query);
    } catch (mysqli_sql_exception $e) {
        // Manejar la excepción de restricción de clave foránea
        echo "Error al eliminar el usuario: " . $e->getMessage();
        return false;
    }

    return $resultado;
}

// Manejar solicitudes POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['create'])) {
        crearUsuario($_POST['nombre'], $_POST['apellido'], $_POST['dni'], $_POST['usuario'], $_POST['clave'], $_POST['rol']);
    } elseif (isset($_POST['update'])) {
        actualizarUsuario($_POST['idUsuario'], $_POST['nombre'], $_POST['apellido'], $_POST['dni'], $_POST['usuario'], $_POST['clave'], $_POST['rol']);
    } elseif (isset($_POST['delete'])) {
        eliminarUsuario($_POST['idUsuario']);
    }

    header("Location: ../Usuarios.php");
    exit();
}
?>
