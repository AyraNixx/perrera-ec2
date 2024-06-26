<?php

// //Si no tenemos guardado login 
if (!isset($_SESSION["login"])) 
{
    header("Location:../../public/Login.php");
}

$user_name = $_SESSION["nombre"];
$user_surname = $_SESSION['apellidos'];
$user_profile = $_SESSION["rol"];

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jaulas</title>
    <link rel="shortcut icon" href="../../public/imgs/logos/logo1.png" type="image/x-icon">
    <script src="https://kit.fontawesome.com/8d125d2b91.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../views/css/sass.css">
    <style>
        #tabla {
            margin-top: 20px;
        }
        td {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>
</head>

<body>

    <!-- MENU -->
    <?php include_once "../views/components/menu.php"; ?>


    <!-- CONTENIDO -->
    <section id="content">

        <!-- MODAL ALERTA -->
        <?php include_once "../views/components/modalAlert.php"; ?>

        <!-- MODAL Jaula -->
        <?php include_once "../views/components/insertJaula.php"; ?>
        <!-- MODAL REGISTROS ELIMINADOS -->
        <?php include_once "../views/components/seeDeletes.php"; ?>

        <!-- HEADER -->
        <?php include_once "../views/components/header.php"; ?>


        <!-- CONTENEDOR PRINCIPAL -->
        <!-- <main class="mt-5 d-flex flex-column justify-content-center align-content-center p-3"> -->
        <main class="mt-5 d-flex flex-column justify-content-center align-content-center p-3" id="main">            
            <?php include_once "../views/components/filterJaula.php"; ?>

            <?php include_once "../views/components/jaulaList.php"; ?>

            <?php include_once "../views/components/pagination.php"; ?>
        </main>

    </section>
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="/DES/perrera-ec2/app/views/js/Utils.js"></script>
    <script src="/DES/perrera-ec2/app/views/js/see-delete-rows.js"></script>
    <script src="/DES/perrera-ec2/app/views/js/widthMenu.js"></script>
    <script src="/DES/perrera-ec2/app/views/js/create-jaulas.js"></script>
    <script src="/DES/perrera-ec2/app/views/js/pagination.js"></script>
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
</body>

</html>