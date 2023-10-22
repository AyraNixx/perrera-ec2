<?php

//      TENGO QUE ARREGLAR ESTO

?>

<!DOCTYPE html>
<html lang="es">

<head> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../app/views/css/sass.css">
    <link rel="shortcut icon" href="./imgs/logos/logo1.png" type="image/x-icon">
</head>
 
<body class="bg-white">

    <!-- TRIANGULOS DE FONDO -->
    <object data="./imgs/bg/triangulo1.svg" type="image/svg+xml" class="bg-1" alt="Triangulo de fondo 1">
        <img src="./imgs/bg/triangulo1.webp">
        <img src="./imgs/bg/triangulo1.png">
    </object>


    <object data="./imgs/bg/triangulo2.svg" type="image/svg+xml" class="bg-2" alt="Triangulo de fondo 2">
        <img src="./imgs/bg/triangulo2.webp">
        <img src="./imgs/bg/triangulo2.png">
    </object>





    <div class="container-fluid bg-transparent">


        <!-- ENCABEZADO -->
        <header>
            <!-- Image and text -->
            <nav class="navbar border-bottom border-secondary ">
                <span class="navbar-brand ms-3 user-select-none">
                    <!-- Usamos la etiqueta object para que en caso de que un navegador no permita visualizar svg
                         tenga como alternativa una imagen con extensión png. -->
                    <object data="../public/imgs/logos/logo1.svg" type="image/svg+xml" width="30" height="30" class="d-inline-block align-top me-2" alt="Logo perrera">
                        <img src="../public/imgs/logos/logo1.svg">
                    </object>
                    Patas arriba
                </span>
            </nav>
        </header>


        <!-- CONTENIDO -->
        <main class="d-flex flex-column align-items-center justify-content-center mt-5">
            <!-- Texto de bienvenida -->
            <div class="row justify-content-center">
                <div class="col-10 col-sm-7 col-md-7 col-lg-7 p-3 mb-3 text-center">
                    <h3 class="fs-2 fw-light lh-lg text-primary">¡Bienvenido! Por favor, inicia sesión para acceder a tu cuenta.</h3>
                </div>
            </div>


            <div class="row justify-content-center align-items-center col-10 col-sm-7 col-md-6 col-lg-3 p-2">
                <form class="login" method="POST" action="../app/controllers/LoginC.php">
                    <?php
                        $msg = (isset($_GET["msg"])) ? base64_decode($_GET["msg"]) : "";
                    ?>
                    <div class="error-label bg-danger text-white text-center p-2 mb-3 <?=($msg != "") ? "d-block" : "d-none"?>">
                        <?=$msg;?>
                    </div>
                    <div class="form-group">
                        <label for="correo">Email</label>
                        <input type="email" class="form-control bg-transparent" placeholder="email@example.com" name="correo" id="correo" required>
                    </div>
                    <div class="form-group mt-4">
                        <label for="passwd">Contraseña</label>
                        <input type="password" class="form-control bg-transparent" placeholder="************" name="passwd" id="passwd" required>
                    </div>
                    <div class="form-check mt-4">
                        <input type="checkbox" class="form-check-input" id="remember_me" name="remember_me">
                        <label class="form-check-label" for="remember_me">Recúerdame</label>
                    </div>
                    <div class="form-group text-center mt-4">
                        <button type="submit" class="btn btn-primary mt-3 py-2 px-5" name="action" value="login">Log in</button>
                    </div>
                </form>

                <div class="bg-form col-10 col-sm-7 col-md-6 col-lg-3 p-2">

                </div>
            </div>
        </main>
    </div>
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>

</html>