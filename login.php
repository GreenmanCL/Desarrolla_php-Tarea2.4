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

    <div class="todo">
        <h1>Login</h1>

        <form action="login.php" method="POST">
            <label>Usuario:</label><br>
            <input type="text" name="user" id="user" required>
            <br><br>

            <label>Contraseña:</label><br>
            <input type="password" name="password" id="password" required>
            <br><br>

            <button type="submit">Iniciar Sesión</button>
        </form>
        <br>
        <?php
            // Iniciar sesión para poder leer el arreglo guardado en registro.php
            session_start();

            if( $_SERVER["REQUEST_METHOD"] == "POST" ) {
                $user = trim($_POST['user']);
                $pass = $_POST['password'];

                //Verificar si hay algún usuario registrado
                if( isset($_SESSION['users']) ) {
                    $usuario = $_SESSION['users'];

                    // Buscar al usuario registrado 
                    if( $user === $usuario['username'] ) {
                        
                        // Recuperar el hash y verificar la contraseña
                        if( password_verify($pass, $usuario['password']) ) {
                            echo "<h3>¡Bienvenido ". $usuario['nombre'] ."!<br>😄</h3>";
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
        
        <a href="menu.php">cerrar</a>
    </div>
</body>
</html>