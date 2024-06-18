<?php

// Comprobamos que la sesion esta iniciada

if (!isset($_SESSION["login"])) {
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
    <?php include_once "../views/components/menu.php"; ?>



    <!-- CONTENIDO -->
    <section id="content">

        <!-- HEADER -->
        <?php include_once "../views/components/header.php"; ?>


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
            <section class="home-tasks m-3 mt-5 p-3 overflow-hidden" style="max-height: 550px; height:550px;">

                <div class="task-header d-flex justify-content-between align-items-center flex-wrap w-100 py-3 pb-4 text-primary">
                    <!-- TÍTULO -->
                    <h5 class="mb-0">Mis tareas</h5>
                    <!-- SELECT -->
                    <select name="show_task" id="show_task" class="border-0 bg-transparent text-uppercase">
                        <option value="pending">Pendientes</option>
                        <option value="finished">Finalizadas</option>
                    </select>

                </div>
                <div class="table-container overflow-y-auto" style="max-height: 550px; height:450px;">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" style="vertical-align: middle;" id="home-tasks">
                            <thead>
                                <tr>
                                    <th class="bg-primary text-secondary" scope="col">Asunto</th>
                                    <th class="bg-primary text-secondary" scope="col">Estado</th>
                                    <th class="bg-primary text-secondary" scope="col">Fech. Asignación</th>
                                    <th class="bg-primary text-secondary" scope="col">Fech. Finalización</th>
                                    <th class="bg-primary text-secondary text-center" scope="col" class="text-center">Prioridad</th>
                                </tr>
                            </thead>
                            <tbody><?php
                                    function class_badge($prioridad)
                                    {
                                        switch ($prioridad) {
                                            case 'baja':
                                                return 'badge bg-success text-white';
                                            case 'media':
                                                return 'badge bg-warning text-dark';
                                            case 'alta':
                                                return 'badge bg-danger text-white';
                                            default:
                                                return 'badge bg-secondary';
                                        }
                                    }
                                    $i = 0;
                                    foreach ($data as $a) {

                                        $st = ($i % 2 != 0) ? 'bg-white' : 'bg-secondary';
                                        echo "<tr>";
                                        echo "<td class='$st'><a href='../controllers/AsignarTareasC.php?action=show_register&id=" . $a['id'] . "'>" . $a['asunto'] . "</a></td>";
                                        echo "<td class='$st'>" . $a['estado_asignacion'] . "</td>";
                                        echo "<td class='$st'>" . $a['fecha_asignacion'] . "</td>";
                                        echo "<td class='$st'>" . $a['fecha_finalizacion'] . "</td>";
                                        echo "<td class='$st'><span class='" . class_badge(strtolower($a['prioridad'])) . "'>" . $a['prioridad'] . "</span></td>";
                                        echo "</tr>";
                                        $i++;
                                    }
                                    ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <input type="hidden" id="empleados_id" value="<?= $correo ?>">
            </section>
    </section>
    </main>

    </section>
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>
    <script src="/DES/perrera-ec2/app/views/js/widthMenu.js"></script>
    <script src="/DES/perrera-ec2/app/views/js/get-task-home.js"></script>
</body>

</html>