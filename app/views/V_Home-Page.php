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
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css">
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

                <div class="container-fluid">
        <div class="table-container">
            <h2 class="text-center mb-4">Tabla de Tareas</h2>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Clark</td>
                            <td><span class="badge bg-success">Activa</span></td>
                            <td>
                                <button class="btn btn-primary btn-sm me-1">Ver</button>
                                <button class="btn btn-secondary btn-sm">Eliminar</button>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Peter</td>
                            <td><span class="badge bg-success">Activa</span></td>
                            <td>
                                <button class="btn btn-primary btn-sm me-1">Ver</button>
                                <button class="btn btn-secondary btn-sm">Eliminar</button>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>John</td>
                            <td><span class="badge bg-success">Activa</span></td>
                            <td>
                                <button class="btn btn-primary btn-sm me-1">Ver</button>
                                <button class="btn btn-secondary btn-sm">Eliminar</button>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">4</th>
                            <td>Sarah</td>
                            <td><span class="badge bg-success">Activa</span></td>
                            <td>
                                <button class="btn btn-primary btn-sm me-1">Ver</button>
                                <button class="btn btn-secondary btn-sm">Eliminar</button>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">5</th>
                            <td>Emma</td>
                            <td><span class="badge bg-success">Activa</span></td>
                            <td>
                                <button class="btn btn-primary btn-sm me-1">Ver</button>
                                <button class="btn btn-secondary btn-sm">Eliminar</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- PAGINACIÓN -->
            <div class="d-flex justify-content-end align-items-center mt-3">
                <div class="me-2">Página:</div>
                <select class="form-select form-select-sm mx-1" id="page">
                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                        <option value="<?= $i ?>"><?= $i ?></option>
                    <?php endfor; ?>
                </select>
                <div class="me-2">de 5</div>
                <button type="button" class="btn btn-outline-primary btn-sm me-1">
                    <i class="bi bi-chevron-left"></i>
                </button>
                <button type="button" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>
        </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>
    <script src="./js/widthMenu.js"></script>
</body>

</html>