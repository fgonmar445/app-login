<?php
session_start(); //Pendiente de seguridad
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
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

                                <form action="autenticacion.php" method="post">
                                    <!-- Aqui se mostraran los errores desde dentro de la aplicacion -->
                                    <?php
                                    if (isset($_SESSION['error'])) {
                                        echo '<div class="alert alert-danger mb-4" role="alert">';
                                        echo $_SESSION['error'];
                                        echo '</div>';
                                        $_SESSION['error'] = "";        //Manera incorrecta de limpiar variable, contenido vacio pero la variable sigue declarada
                                        unset($_SESSION['error']);      //Manera correcta
                                    }
                                    ?>
                                    <!--                                    -->
                                    <div data-mdb-input-init class="form-outline form-white mb-4">
                                        <input type="text" id="user" name="user" class="form-control form-control-lg" required />
                                        <label class="form-label" for="user">User</label>
                                    </div>

                                    <div data-mdb-input-init class="form-outline form-white mb-4">
                                        <input type="password" id="pass" name="pass" class="form-control form-control-lg" required />
                                        <label class="form-label" for="pass">Password</label>
                                    </div>

                                    <p class="small mb-5 pb-lg-2">
                                        <a class="text-white-50" href="#!">Forgot password?</a>
                                    </p>

                                    <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>
                                </form>


                                <div class="d-flex justify-content-center text-center mt-4 pt-1">
                                    <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                                    <a href="#!" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                                    <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
                                </div>

                            </div>

                            <div>
                                <p class="mb-0">Don't have an account? <a href="#!" class="text-white-50 fw-bold">Sign
                                        Up</a>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="validaciones.js"></script>
</body>

</html>