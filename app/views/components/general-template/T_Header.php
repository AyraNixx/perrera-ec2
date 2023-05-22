<?= require_once "../../../config_file.php" ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href=<?= ROOT_APP . '/views/css/sass.css'?>>
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
                <a class="navbar-brand ms-3">
                    <!-- Usamos la etiqueta object para que en caso de que un navegador no permita visualizar svg
                         tenga como alternativa una imagen con extensión png. -->
                    <object data="./imgs/logos/logo1.svg" type="image/svg+xml" width="30" height="30" class="d-inline-block align-top me-2" alt="Logo perrera">
                        <img src="./imgs/logos/logo1.png">
                    </object>
                    Patas arriba
                </a>
            </nav>
        </header>


        <!-- CONTENIDO -->
        <main class="d-flex flex-column align-items-center justify-content-center mt-5">
            <!-- Texto de bienvenida -->
            <div class="row justify-content-center">
                <div class="col-10 col-sm-7 col-md-7 col-lg-7 p-3 mb-3 text-center">
                    <h3 class="fs-2 fw-light lh-lg">¡Bienvenido! Por favor, inicia sesión para acceder a tu cuenta.</h3>
                </div>
            </div>


            <div class="row justify-content-center align-items-center col-10 col-sm-7 col-md-6 col-lg-3 p-2">                
            </div>
        </main>
    </div>

</body>

</html>