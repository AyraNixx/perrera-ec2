<?php
$user_name = $_SESSION["nombre"];
$user_surname = 'Gonzales';
$user_profile = $_SESSION["rol"];;

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

        td {
            /* Ajusta la altura deseada para las celdas */
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .fa-sort {
            font-size: .7em;
            line-height: 2em;
            padding-left: 0.5em;
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

        <!-- MODAL ANIMAL -->
        <?php include_once "../views/components/insertAnimal.php"; ?>

        <!-- HEADER -->
        <?php include_once "../views/components/header.php"; ?>


        <!-- CONTENEDOR PRINCIPAL -->
        <main class="mt-5 d-flex flex-column justify-content-center align-content-center p-3" id="main">
<!-- 
            <div id="overlay" class="d-flex flex-column justify-content-center align-items-center" style="height:350px; max-height:500px;">
                <div style="text-align: center;">
                    <div class="loader" width="70" height="70"></div>                                    
                    <div class="mt-3">
                        <h6 style="text-transform: uppercase;" class="loanding text-secondary">Cargando...</h6>
                    </div>
                </div>
            </div> -->

            <?php include_once "../views/components/filterAnimal.php"; ?>

            <?php include_once "../views/components/PruebaCom.php"; ?>

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
    <!-- <script src="../views/js/filteredTable.js"></script>
    <script src="../views/js/changeJaulaValues.js"></script>
    <script src="../views/js/pagination.js"></script> -->
    <script src="../views/js/Utils.js"></script>
    <script src="../views/js/PruebaTable.js"></script>
</body>

</html>