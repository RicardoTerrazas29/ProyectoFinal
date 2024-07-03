<?php
session_start();
include 'CRUD/Conexion.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['Usuario'];
    $password = $_POST['password'];

    // Sanitize user input
    $usuario = mysqli_real_escape_string($conn, $usuario);
    $password = mysqli_real_escape_string($conn, $password);

    // Query the database
    $query = "SELECT * FROM usuario WHERE usuario = '$usuario' AND clave = '$password'";
    $result = mysqli_query($conn, $query);

    // Check if the user exists
    if (mysqli_num_rows($result) == 1) {
        $_SESSION['usuario'] = $usuario;
        header("Location: InicioVentana.php");
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="css/Ingresodedatos.css" rel="stylesheet" type="text/css"/>
    <link href="css/texto.css" rel="stylesheet" type="text/css"/>
</head>
<body style="font-family: Cambria, serif; display: flex">
    <div id="main-content" class="main-content" style="text-align: center; margin: 10px; background-color: #959EBD; height: 790px; width: 100%">
        <h1 class="title" style="color: white">INICIAR SESIÓN</h1>
        <p style="color: white; font-weight: bold; font-size: 20px;">¡Hola! Ingresa tus datos</p>
        <hr class="line-divider">
        <br><br>
        <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
        <form action="index.php" method="POST" class="login-form" name="formDatosPersonales">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="bi bi-person-circle"></i>
                        </span>
                    </div>
                    <input type="text" id="Usuario" name="Usuario" class="form-control" placeholder="Usuario" required>
                </div>
            </div>
            <br>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="bi bi-lock"></i>
                        </span>
                    </div>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Contraseña" required>
                    <div class="input-group-append" id="togglePassword">
                        <span class="input-group-text">
                            <i id="eye-icon" class="bi bi-eye-slash"></i>
                        </span>
                    </div>
                </div>
            </div>
            <br><br>
            <div class="container">
                <div class="password-link-container">
                    <input type="checkbox" name="chex"> Recordar Contraseña
                </div>
                <a href="Contraseñaolvidada.php" class="password-link">Olvidé mi contraseña</a>
            </div>
            <div class="form-group">
                <input type="submit" value="Ingresar" class="submit-button">
            </div>
        </form>
        <script src="Inicio.js" type="text/javascript"></script>
    </div>
    <div style="width: 100%; background-color: white; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center">
        <br>
        <h1 style="color: #ABABAB">TECHCOMPANY</h1>
        <img src="imagenes/TC - Logo Gris Transparente.png" alt="alt" width="450" height="450" class="imgr"/>
        <p style="color: #ABABAB">Se esfuerza por brindar asistencia inmediata y efectiva, ya sea <br> para resolver dudas, atender reclamos o enfrentar cualquier <br>
            otro inconveniente relacionado con sus productos o <br>circunstancias similares</p>
    </div>
</body>
</html>
