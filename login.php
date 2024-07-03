<?php
session_start();
include 'CRUD/Conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['Usuario'];
    $password = $_POST['password'];

    $usuario = mysqli_real_escape_string($conn, $usuario);
    $password = mysqli_real_escape_string($conn, $password);

    $query = "SELECT * FROM usuario WHERE usuario = '$usuario' AND clave = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['usuario'] = $usuario;
        header("Location: Usuarios.php");
    } else {
        echo "Nombre de usuario o contraseña incorrectos.";
    }
}
?>
