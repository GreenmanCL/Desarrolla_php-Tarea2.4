<?php include 'menu.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css" type="text/css">
    <title>Registro</title>
</head>
<body>
    <h2>Registro de usuarios</h2>
    <form action="registro.php" method="POST"> <!--- formulario -->
        <label for="nombre">Nombre:</label> <br>
        <input type="text" name="nombre" id="nombre" required>
        <br><br>

        <label for="user">Usuario (Login):</label> <br>
        <input type="text" name="user" id="user" required>
        <br><br>

        <label for="password">Contraseña:</label><br>
        <input type="password" name="password" id="password" required>
        <br><br> <!--- tipo password para que se censure -->

        <label for="co_password">Confirmar Contraseña:</label><br>
        <input type="password" name="co_password" id="co_password" required> 
        <br><br>

        <button type="submit" name="calcular">Registrar</button>
    </form>
    <br><br>

    <?php
    session_start(); // iniciar sesion para que se guarde la memoria al cambiar de pagina

    // Procesar el formulario
    if( $_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['calcular'])) {
        $nombre = trim($_POST['nombre']);
        $user = trim($_POST['user']); // el trim le quita espacios finales e iniciales innecesarios
        $pass = $_POST['password'];
        $co_pass = $_POST['co_password'];

        // validar 6 caracteres
        if( strlen($pass) < 6 ) {
            echo "La contraseña debe tener al menos 6 caracteres.";
        } 
        elseif( $pass !== $co_pass ) { 
            echo "Las contraseñas no coinciden."; // validar password
        } 
        else {
            // hashear
            $pass_hasheado = password_hash($pass, PASSWORD_DEFAULT);

            // Guardar el usuario en el arreglo de la sesión
            $_SESSION['users'] = [
                'nombre'   => $nombre,
                'username' => $user,
                'password' => $pass_hasheado // solo el hash
            ];
            
            echo "<h1>¡Usuario registrado correctamente!</h1>";
        }
    }
    ?>
    <br>
    
</body>
</html>