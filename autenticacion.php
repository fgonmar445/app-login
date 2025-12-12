<?php
include "establecer-sesion.php";

//Inicializar contador de intentos si no existe
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}

//Máximo permitido
$max_attempts = 5;

//Si supera el límite → bloquear acceso
if ($_SESSION['login_attempts'] >= $max_attempts) {
    $_SESSION['error'] = "Has superado el número máximo de intentos. Inténtalo más tarde.";
    header("Location: ./index.php");
    exit;
}

//Solo aceptar POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['error'] = "Debes hacer login para acceder";
    header("Location: ./index.php");
    exit;
}

/******************************************************
 * VALIDACIÓN CSRF
 ******************************************************/
if (!isset($_POST['csrf_token'])) {
    die("Solicitud no válida. Falta token CSRF.");
}

if (!isset($_SESSION['csrf_token'])) {
    die("Solicitud no válida. No existe token CSRF en la sesión.");
}

if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
    die("Solicitud no válida. Token CSRF incorrecto.");
}

if (empty($userInput) || empty($passInput)) {
    $_SESSION['login_attempts']++;
    $_SESSION['error'] = "Debes introducir usuario y contraseña. Intento " . $_SESSION['login_attempts'] . " de $max_attempts.";
    header("Location: ./index.php");
    exit;
}
/******************************************************
 * SANITIZACIÓN CONTRA XSS
 ******************************************************/
$userInput = htmlspecialchars($_POST['user']);
$passInput = htmlspecialchars($_POST['pass']);

    // Aquí ya puedes continuar con el login, registro, borrado, etc.

    /*
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
*/

/******************************************************
 * CONEXIÓN PDO
 ******************************************************/
$server = 'mysql:host=localhost;dbname=login-php;charset=utf8mb4';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO($server, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("ERROR de conexión: " . $e->getMessage());
}

/******************************************************
 * CONSULTA PREPARADA
 ******************************************************/
$sql = "SELECT * FROM users WHERE idUser = :user LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':user', $userInput, PDO::PARAM_STR);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

/******************************************************
 * VALIDACIÓN DE USUARIO
 ******************************************************/
if (!$user) {
    $_SESSION['login_attempts']++;
    $_SESSION['error'] = "Usuario incorrecto. Intento " . $_SESSION['login_attempts'] . " de $max_attempts.";
    header("Location: ./index.php");
    exit;
}

/******************************************************
 * VALIDACIÓN DE CONTRASEÑA
 * Usa password_hash() y password_verify()
 ******************************************************/
/* // CONTRASEÑAS CIFRADAS //
if (!password_verify($passInput, $user['password'])) {
    $_SESSION['login_attempts']++;
    $_SESSION['error'] = "Contraseña incorrecta. Intento " . $_SESSION['login_attempts'] . " de $max_attempts.";
    header("Location: ./index.php");
    exit;
}
*/
if ($passInput !== $user['password']) {
    $_SESSION['login_attempts']++;
    $_SESSION['error'] = "Contraseña incorrecta. Intento " . $_SESSION['login_attempts'] . " de $max_attempts.";
    header("Location: ./index.php");
    exit;
}

/******************************************************
 *LOGIN CORRECTO
 ******************************************************/
$_SESSION['login_attempts'] = 0; // Reiniciar intentos
$_SESSION['nombre'] = $user['nombre'];
$_SESSION['apellidos'] = $user['apellidos'];

header("Location: ./inicio.php");
exit;
    //QUERY
    //$querySQL = "SELECT * FROM users WHERE iduser = '$username'";
    // Consulta preparada
    /*
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
                } else {
                    // Usuario encontrado
                    $row = $resultado->fetch_object();

                    // Si guardas contraseñas en texto plano (no recomendado):
                    if ($row->password == $_POST['pass']) {

                        // Mejor: si guardas contraseñas con password_hash()
                        //if (password_verify($_POST['pass'], $row->password)) {
                        $_SESSION['nombre'] = $row->nombre;
                        $_SESSION['apellidos'] = $row->apellidos;
                        header("Location: ./inicio.php");
                    } else {
                        $_SESSION['error'] = "Contraseña incorrecta";
                        header("Location: ./index.php");
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
    echo $userInput . ": " . $passInput;
    echo "<br>Conexion establecida";
} else {
    $_SESSION['error'] = "Debes hacer login para acceder, contenido sensible";
    header('Location: ./index.php');
}
*/
