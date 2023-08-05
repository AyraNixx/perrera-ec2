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


        .modal-body label {
            display: block;

            padding: 1em 0 .5em;
        }

        .modal-body form input,
        .modal-body form select,
        .modal-body form textarea {
            box-sizing: border-box;

            width: 100%;

            padding: .3em;

            border: 1px solid #425C81;
            border-radius: 4px;

            outline: none;
            box-shadow: none;

        }

        .modal-body form .form-textarea {
            resize: vertical;
            height: 6em;
            padding: 0.375rem 0.75rem;
        }

        .fa-sort {
            font-size: .7em;
            line-height: 2em;
            padding-left: 0.5em;
        }

        @media (max-width: 767.98px) {
            .col-md-6 {
                width: 100%;
                margin-bottom: 10px;
            }

            .modal-body form,
            .modal-body {
                padding: 1em !important;
            }
        }

        @keyframes typing {

            from { width: 0; }
            to { width: 100%; }
        }

        @keyframes blink {

            from, to { border-color: transparent; }
            50%{border-color: black;}
        }

        .loanding 
        {
            border-right: 3px solid black;
        
            white-space: nowrap;
            letter-spacing: .1em;
            overflow: hidden;

            animation: typing 3.5s steps(30, end) infinite, blink .5s step-end infinite;
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
        <main class="mt-5" id="main">

            <div id="overlay" class="d-flex flex-column justify-content-center align-items-center" style="height:350px; max-height:500px;">
                <div style="text-align: center;">
                    <img src="https://cdnl.iconscout.com/lottie/premium/thumb/loader-5478777-4574111.gif" width="70" height="70" />
                    <div>                        
                        <h6 style="text-transform: uppercase;" class="loanding">Cargando...</h6>
                    </div>
                </div>
            </div>

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
    <script src="../views/js/PruebaTable.js"></script>
</body>

</html>