<?php
include_once 'Conexion.php';

// Función para obtener todos los clientes
function obtenerClientes() {
    global $conn;

    $query = "SELECT * FROM clientes";
    $resultado = mysqli_query($conn, $query);

    $clientes = [];
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $clientes[] = $fila;
    }

    return $clientes;
}

// Función para obtener un cliente por su ID
function obtenerClientePorId($idCliente) {
    global $conn;

    $idCliente = mysqli_real_escape_string($conn, $idCliente);
    $query = "SELECT * FROM clientes WHERE idCliente = $idCliente";
    $resultado = mysqli_query($conn, $query);

    return mysqli_fetch_assoc($resultado);
}

// Función para crear un nuevo cliente
function crearCliente($dni, $nombre, $apellido, $telefono, $correo) {
    global $conn;

    $dni = mysqli_real_escape_string($conn, $dni);
    $nombre = mysqli_real_escape_string($conn, $nombre);
    $apellido = mysqli_real_escape_string($conn, $apellido);
    $telefono = mysqli_real_escape_string($conn, $telefono);
    $correo = mysqli_real_escape_string($conn, $correo);

    $query = "INSERT INTO clientes (dni, nombre, apellido, telefono, correo) VALUES ('$dni', '$nombre', '$apellido', '$telefono', '$correo')";
    $resultado = mysqli_query($conn, $query);

    return $resultado;
}

// Función para actualizar un cliente
function actualizarCliente($idCliente, $dni, $nombre, $apellido, $telefono, $correo) {
    global $conn;

    $idCliente = mysqli_real_escape_string($conn, $idCliente);
    $dni = mysqli_real_escape_string($conn, $dni);
    $nombre = mysqli_real_escape_string($conn, $nombre);
    $apellido = mysqli_real_escape_string($conn, $apellido);
    $telefono = mysqli_real_escape_string($conn, $telefono);
    $correo = mysqli_real_escape_string($conn, $correo);

    $query = "UPDATE clientes SET dni='$dni', nombre='$nombre', apellido='$apellido', telefono='$telefono', correo='$correo' WHERE idCliente=$idCliente";
    $resultado = mysqli_query($conn, $query);

    return $resultado;
}

// Función para eliminar un cliente
function eliminarCliente($idCliente) {
    global $conn;

    $idCliente = mysqli_real_escape_string($conn, $idCliente);
    $query = "DELETE FROM clientes WHERE idCliente = $idCliente";
    $resultado = mysqli_query($conn, $query);

    return $resultado;
}

// Manejar solicitudes POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['create'])) {
        crearCliente($_POST['dni'], $_POST['nombre'], $_POST['apellido'], $_POST['telefono'], $_POST['correo']);
    } elseif (isset($_POST['update'])) {
        actualizarCliente($_POST['idCliente'], $_POST['dni'], $_POST['nombre'], $_POST['apellido'], $_POST['telefono'], $_POST['correo']);
    } elseif (isset($_POST['delete'])) {
        eliminarCliente($_POST['idCliente']);
    }

    header("Location: ../Clientes.php");
    exit();
}
?>
