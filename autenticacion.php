<?php
include "establecer-sesion.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Comprobar si el token CSRF enviado en el formulario coincide con el token almacenado en la sesión
    if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
        // El token es válido, procesar el formulario
        // Realizar la acción deseada 
        echo "Formulario enviado correctamente."; // totalmente opcional, si acaso, en un alert
    } else {
        // El token no es válido, posible ataque CSRF
        die("Solicitud no válida. Token CSRF no coincide."); // o mensaje en alert y redirección a index
    }

    if (isset($_POST['user']) && isset($_POST['pass'])) { //comprobacion insegura

        //Inicializacion de parametros de conexion
        $host = 'localhost';
        $username = 'root';         //INSEGURO nunca acceder como root
        $password = '';             //INSEGURO
        $database = 'login-php';

        //establecimiento de conexion
        $my = new mysqli($host, $username, $password, $database);

        if ($my->connect_error) {
            $_SESSION['error'] = "No se puede comprobar el usuario";
            header('Location:./index.php');
        }

        //HAY QUE COMPROBAR SI HUBO INTENTO DE XSS Y CONTESTAR CON MENSAJE DE ERROR
        // Sanitizar entradas contra XSS
        $username = htmlspecialchars($_POST['user']);
        $password = htmlspecialchars($_POST['pass']);

        //QUERY
        //$querySQL = "SELECT * FROM users WHERE iduser = '$username'";
        // Consulta preparada
        $cadenaSQL = "SELECT * FROM users WHERE idUser = ?"; // hay un "hueco" ? para el idusuario particular

        // 2. Preparar la sentencia
        if ($comando = $my->prepare($cadenaSQL)) {
            $comando->bind_param("s", $_POST['user']);

            if ($comando->execute()) {
                // Obtener el resultado de la consulta
                $resultado = $comando->get_result();

                if ($resultado->num_rows == 0) {
                    // Usuario inexistente
                    $_SESSION['error'] = "Usuario incorrecto";
                    header('Location: ./index.php');
                    exit;
                } else {
                    // Usuario encontrado
                    $row = $resultado->fetch_object();

                    // ⚠️ Si guardas contraseñas en texto plano (no recomendado):
                    if ($row->password == $_POST['pass']) {

                        // ✅ Mejor: si guardas contraseñas con password_hash()
                        //if (password_verify($_POST['pass'], $row->password)) {
                        $_SESSION['nombre'] = $row->nombre;
                        $_SESSION['apellidos'] = $row->apellidos;
                        header("Location: ./inicio.php");
                        exit;
                    } else {
                        $_SESSION['error'] = "Contraseña incorrecta";
                        header("Location: ./index.php");
                        exit;
                    }
                }
            } else {
                echo "Error al ejecutar la consulta: " . $comando->error;
            }

            $comando->close();
        } else {
            echo "Error al preparar la consulta: " . $my->error;
        }

        $my->close();

        // Mensaje opcional de depuración
        echo $usernameInput . ": " . $passwordInput;
        echo "<br>Conexion establecida";
    } else {
        $_SESSION['error'] = "Debes hacer login para acceder, contenido sensible";
        header('Location: ./index.php');
        exit;
    }
}
