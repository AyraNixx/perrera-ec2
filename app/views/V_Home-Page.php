<?php

// Comprobamos que la sesion esta iniciada
session_start();
//Si no tenemos guardado login 

if (!isset($_SESSION["login"])) 
{
    header("Location:../../public/Login.php");
}

$user_name = $_SESSION["nombre"];
$user_surname = 'Gonzales';
$user_profile = $_SESSION["rol"];

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="shortcut icon" href="../../public/imgs/logos/logo1.png" type="image/x-icon">
    <script src="https://kit.fontawesome.com/8d125d2b91.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../views/css/sass.css">
</head>

<body>
    <!-- MENU -->
    <?php include_once "./components/menu.php"; ?>


    <!-- CONTENIDO -->
    <section id="content">

        <!-- HEADER -->
        <?php include_once "./components/header.php"; ?>


        <!-- CONTENEDOR PRINCIPAL -->
        <main class="mt-5">
            <div class="date w-100 p-3 pt-4 text-end text-capitalize text-primary">

                <?php
                // Sacamos la fecha actual
                $format = new IntlDateFormatter(
                    'es_Es',
                    IntlDateFormatter::FULL, // Utilizamos el estilo completo para mostrar el nombre completo del mes
                    IntlDateFormatter::NONE // No especificamos el formato de la hora, ya que solo estamos formateando la fecha
                );

                echo $format->format(new DateTime());
                ?>
            </div>

            <!-- TEXTO BIENVENIDA -->
            <h1 class="welcome-text mt-5 text-primary font-weight-bold text-uppercase text-center">Bienvenido</h1>

            <h4 class="welcome-text mt-3 text-info text-uppercase text-center" style="font-weight: 200;">
                <?= $user_name ?>
            </h4>

            <!-- TABLA DE TAREAS -->
            <section class="home-tasks m-3 mt-5 p-3">

                <div class="task-header d-flex justify-content-between align-items-center flex-wrap w-100 py-3 pb-4 text-primary">
                    <!-- TÍTULO -->
                    <h5 class="mb-0">Mis tareas</h5>
                    <!-- SELECT -->
                    <select name="show_task" id="show_task" class="border-0 bg-transparent text-uppercase">
                        <option value="pending_task">Pendientes</option>
                        <option value="finished_task">Finalizadas</option>
                    </select>

                </div>

                <!-- TABLA DE TAREAS -->
                <div class="task-table">
                    <table class="table table-striped" width="100%">
                        <thead class="text-center">
                            <tr>
                                <th></th>
                                <th>Nombre</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr>
                                <td>1</td>
                                <td>Clark</td>
                                <td>
                                    <span class="task-active rounded-pill bg-success px-3 text-uppercase text-white small">Activa</span>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Peter</td>
                                <td>
                                    <span class="task-active rounded-pill bg-success px-3 text-uppercase text-white small">Activa</span>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>John</td>
                                <td>
                                    <span class="task-active rounded-pill bg-success px-3 text-uppercase text-white small">Activa</span>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Peter</td>
                                <td>
                                    <span class="task-active rounded-pill bg-success px-3 text-uppercase text-white small">Activa</span>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>John</td>
                                <td>
                                    <span class="task-active rounded-pill bg-success px-3 text-uppercase text-white small">Activa</span>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Peter</td>
                                <td>
                                    <span class="task-active rounded-pill bg-success px-3 text-uppercase text-white small">Activa</span>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>John</td>
                                <td>
                                    <span class="task-active rounded-pill bg-success px-3 text-uppercase text-white small">Activa</span>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Peter</td>
                                <td>
                                    <span class="task-active rounded-pill bg-success px-3 text-uppercase text-white small">Activa</span>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>John</td>
                                <td>
                                    <span class="task-active rounded-pill bg-success px-3 text-uppercase text-white small">Activa</span>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Peter</td>
                                <td>
                                    <span class="task-active rounded-pill bg-success px-3 text-uppercase text-white small">Activa</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- PAGINACIÓN -->

                    <div class="pagination float-end p-2">
                        <button type="submit" class="border-0 bg-transparent text-primary">
                            <i class="fa-sharp fa-solid fa-backward"></i>
                        </button>
                        <select name="page" id="page" class="mx-1 ">
                            <?php
                            for ($i = 1; $i <= 100; $i++) {
                                echo "<option value'$i'>$i</option>";
                            }
                            ?>
                        </select>
                        <span class="pe-2">of <?= 10 ?></span>
                        <button type="submit" class="border-0 bg-transparent text-primary">
                            <i class="fa-sharp fa-solid fa-forward"></i>
                        </button>
                    </div>
                </div>
            </section>

        </main>

    </section>
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="./js/widthMenu.js"></script>
</body>

</html>