<?php
include "establecer-sesion.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

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
    <section class="vh-200 bg-custom-gradient">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 pt-1 pb-1 text-center">

                            <div class="mb-md-5 mt-md-4 pb-1">

                                <h2 class="fw-bold mb-2 text-uppercase">Sign Up</h2>
                                <p class="text-white-50 mb-5">Create your account below</p>

                                <?php
                                if (empty($_SESSION['csrf_token'])) {
                                    $csrf_token = bin2hex(openssl_random_pseudo_bytes(64));
                                    $_SESSION['csrf_token'] = $csrf_token;
                                }
                                ?>

                                <form action="registro.php" method="post">
                                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                                    <?php
                                    if (isset($_SESSION['error'])) {
                                        echo '<div class="alert alert-danger mb-4" role="alert">';
                                        echo $_SESSION['error'];
                                        echo '</div>';
                                        unset($_SESSION['error']);
                                    }
                                    ?>

                                    <div class="form-outline form-white mb-4">
                                        <input type="text" id="user" name="user" class="form-control form-control-lg" required />
                                        <label class="form-label mt-1" for="user">Username</label>
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="text" id="nombre" name="nombre" class="form-control form-control-lg" required />
                                        <label class="form-label mt-1" for="nombre">First Name</label>
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="text" id="apellidos" name="apellidos" class="form-control form-control-lg" required />
                                        <label class="form-label mt-1" for="apellidos">Last Name</label>
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="email" id="email" name="email" class="form-control form-control-lg" required />
                                        <label class="form-label mt-1" for="email">Email</label>
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="password" id="pass" name="pass" class="form-control form-control-lg" required />
                                        <label class="form-label mt-1" for="pass">Password</label>
                                    </div>

                                    <button class="btn btn-outline-light btn-lg px-5" type="submit">Register</button>
                                </form>
                                <div>
                                <p class="mt-4">Already have an account?
                                    <a href="index.php" class="text-white-50 fw-bold">Login</a>
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