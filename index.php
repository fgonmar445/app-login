<?php
include "establecer-sesion.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <style>
        .bg-custom-gradient {
            background: linear-gradient(135deg, #4facfe 0%, #38f9d7 50%, #6a11cb 100%);
        }
    </style>

</head>

<body>
    <section class="vh-100 bg-custom-gradient">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <div class="mb-md-5 mt-md-4 pb-5">

                                <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                                <p class="text-white-50 mb-5">Please enter your login and password!</p>


                                <?php
                                if (empty($_SESSION['csrf_token'])) {
                                    // Creación de un CSRF Token
                                    $csrf_token = bin2hex(openssl_random_pseudo_bytes(64));

                                    // Resguardo del CSRF Token en una sesión
                                    $_SESSION['csrf_token'] = $csrf_token;
                                }
                                ?>

                                <form id="form" action="autenticacion.php" method="post">

                                    <!-- Creacion del token csrf enviado en oculto -->
                                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                                    <!-- Aqui se mostraran los errores desde dentro de la aplicacion -->
                                    <?php
                                    if (isset($_SESSION['error'])) {
                                        echo '<div class="alert alert-danger mb-4" role="alert">';
                                        echo $_SESSION['error'];
                                        echo '</div>';
                                        //$_SESSION['error'] = "";       -- Manera incorrecta de limpiar variable, contenido vacio pero la variable sigue declarada --
                                        unset($_SESSION['error']);      //Manera correcta
                                    }
                                    ?>
                                    <!--                                    -->
                                    <div data-mdb-input-init class="form-outline form-white mb-3">
                                        <input type="text" id="user" name="user" class="form-control form-control-lg" oninput="limpiarError('user')" required />
                                        <label class="form-label mt-2" for="user">User</label>
                                        <div id="userHelp" class="form-text text-danger" style="visibility: hidden;">El usuario debe tener un tamaño entre ocho y quince letras</div>

                                    </div>

                                    <div data-mdb-input-init class="form-outline form-white mb-0">
                                        <input type="password" id="pass" name="pass" class="form-control form-control-lg" oninput="limpiarError('pass')" required />
                                        <label class="form-label mt-2" for="pass">Password</label>
                                        <div id="passHelp" class="form-text text-danger" style="visibility: hidden;">El contraseña debe tener un tamaño entre ocho y quince letras y contener mayus, minus y caracteres especiales excepto '' "" \ / <> = ( )</div>

                                        <p class="small mt-1 mb-4 pb-lg-3">
                                            <a class="text-white-50" href="#!">Forgot password?</a>
                                        </p>

                                        <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>
                                </form>
                            </div>
                        </div>
                        <div>
                            <p class="mb-0">Don't have an account? <a href="./sign-up.php" class="text-white-50 fw-bold">Sign
                                    Up</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>
    <script src="./verificaciones.js"></script>

</body>

</html>