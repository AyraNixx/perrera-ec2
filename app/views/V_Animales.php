<?php

//Comprobamos que la sesion esta iniciada
// session_start();
// //Si no tenemos guardado login 
// if (!isset($_SESSION["login"])) 
// {
//     header("Location:../../public/Login.php");
// }

// $user_name = $_SESSION["nombre"];
$user_name = 'Pedro';
$user_surname = 'Gonzales';
$user_profile = 'Administrador';

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animales</title>
    <link rel="shortcut icon" href="../../public/imgs/logos/logo1.png" type="image/x-icon">
    <script src="https://kit.fontawesome.com/8d125d2b91.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../views/css/sass.css">
    <style>
        #tabla {
            margin-top: 20px;
        }

        @media (max-width: 767.98px) {
            .col-md-6 {
                margin-bottom: 10px;
            }
        }
    </style>
</head>

<body>
    <!-- MENU -->
    <?php include_once "../views/components/menu.php"; ?>


    <!-- CONTENIDO -->
    <section id="content">

        <!-- MODAL -->
        <?php include_once "../views/components/modalAlert.php"; ?>

        <!-- HEADER -->
        <?php include_once "../views/components/header.php"; ?>


        <!-- CONTENEDOR PRINCIPAL -->
        <main class="mt-5">
            <?php include_once "../views/components/filterAnimal.php"; ?>
            <?php include_once "../views/components/animalList.php"; ?>
            <?php include_once "../views/components/pagination.php"; ?>
        </main>

    </section>
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <?php

    if ($new_msg != null) { ?>

        <script>
            $(document).ready(function() {
                $("#aviso").modal("show");
            });
        </script>
    <?php
    }
    ?>

    <script>
        function close_modal() {
            $("#aviso").modal("hide");
        }
    </script>
    <script src="../views/js/widthMenu.js"></script>
    <script src="../views/js/filteredTable.js"></script>
</body>

</html>