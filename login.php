<?php include 'menu.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css" type="text/css">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>

    <form action="login.php" method="POST"> <!-- Formulario -->
        <label>Usuario:</label><br>
        <input type="text" name="user" id="user" required>
        <br><br>

        <label>Contraseña:</label><br>
        <input type="password" name="password" id="password" required>
        <br><br>

        <button type="submit">Iniciar Sesión</button>
    </form>

    <?php
    // Iniciar sesión para poder leer el arreglo guardado en registro.php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user = trim($_POST['user']);
        $pass = $_POST['password'];

        // 1. Verificar si hay algún usuario registrado en la sesión
        if (isset($_SESSION['users'])) {
            $usuario = $_SESSION['users'];

            // 2. Buscar al usuario registrado (comparar el login)
            if ($user === $usuario['username']) {
                
                // 3. Recuperar el hash y verificar la contraseña capturada
                if (password_verify($pass, $usuario['password'])) {
                    echo "¡Bienvenido ". $usuario['nombre'] ."!";
                } else {
                    echo "Contraseña incorrecta";
                }

            } 
            else {
                echo "usuario no registrado en la base de datos";
            }
        } else {
            echo "no hay ningun usuario registrado, vuelva mas tarde";
        }
    }
    ?>

    <p><a href="registro.php">Volver al Registro</a></p>
</body>
</html>