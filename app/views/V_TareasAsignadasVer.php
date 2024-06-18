<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarea Asignada</title>
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

        <!-- MODAL -->
        <?php include_once "../views/components/modalAlert.php"; ?>
        <!-- MODAL PARA INSERTAR UNA NUEVA TAREA -->
        <?php include_once "../views/components/insertTareaAsignacion.php"; ?>
        <!-- Modal para elegir quien debe de realizar las tareas -->
        <?php include_once "../views/components/assignedModal.php"; ?>
        <!-- HEADER -->
        <?php include_once "../views/components/header.php"; ?>


        <!-- CONTENEDOR PRINCIPAL -->
        <main class="mx-4 mt-5 mb-5">
            <br />
            <!-- Split dropup button -->
            <div class="mb-4 w-100 bg-secondary bg-opacity-75 " style="border-radius:5px;">
                <div class="button-option-container d-flex justify-content-between align-content-center w-100 bg-primary p-3">
                    <h1 style="font-size: x-large;" class="pt-2 text-secondary text-uppercase font-weight-light mb-0 d-inline" data-controller="AsignarTareasC.php">
                        <i class="fa-solid fa-paw"></i>
                        Tarea Asignada
                    </h1>
                    <div class="btn-group" role="group">
                        <button class="button-dropdown" data-toggle="modal" data-target="#add_tarea_asignada">Añadir</button>
                        <button class="button-dropdown" data-action="update">Editar</button>
                        <button class="button-dropdown" data-action="change_assigned_to">Cambiar asignación</button>
                        <button class="button-dropdown" data-action="sdelete">Eliminar</button>
                    </div>
                    <div class="btn-group dropdown" style="position:relative">
                        <button type="button" class="button-dropdown" data-toggle="modal" data-target="#add_tarea_asignada">
                            Añadir
                        </button>
                        <button type="button" onclick="show_btn_options(event)" class="button-dropdown px-1">
                            <i class="fa-solid fa-caret-down"></i>
                        </button>
                        <div class="btn-dropdown-options w-100 position-absolute start-0">
                            <ul class="list-unstyled m-0">
                                <li data-action="update">
                                    Editar
                                </li>
                                <li data-action="sdelete">
                                    Borrar
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <hr class="mt-0 px-3">
                <div class="d-flex justify-content-around">
                    <div>
                        <h5 class="text-primary" style="font-weight:600; text-transform:uppercase; font-size: .8em">Asunto</h5>
                        <p style="font-size: .8em"><?= $data['asunto'] ?></p>
                    </div>
                    <div>
                        <h5 class="text-primary" style="font-weight:600; text-transform:uppercase; font-size: .8em">Estado</h5>
                        <p style="font-size: .8em"><?= $data['estado_asignacion'] ?></p>
                    </div>
                    <div>
                        <h5 class="text-primary" style="font-weight:600; text-transform:uppercase; font-size: .8em">Prioridad</h5>
                        <p style="font-size: .8em"><?= $data['prioridad'] ?></p>
                    </div>
                    <div>
                        <h5 class="text-primary" style="font-weight:600; text-transform:uppercase; font-size: .8em">Empleado</h5>
                        <p style="font-size: .8em"><?= $data['nombre_empleado'] ?></p>
                    </div>
                    <div>
                        <h5 class="text-primary" style="font-weight:600; text-transform:uppercase; font-size: .8em">Voluntario</h5>
                        <p style="font-size: .8em"><?= $data['nombre_voluntario'] ?></p>
                    </div>
                </div>
            </div>
            <!-- partial:index.partial.html -->
            <nav class="nav nav-tabs w-100" id="tab" role="tablist">
                <a class="nav-item nav-link border-bottom-0 active" data-toggle="tab" role="tab" aria-selected="true" aria-controls="nav-details" href="#details">Detalles</a>
            </nav>

            <div class="tab-content w-100 border border-1 border-primary-subtle border-top-0" id="tabcontent" style="height:900px; max-height:900px; overflow-y:auto;">
                <div class="tab-pane fade show active h-100" id="details" role="tabpanel" aria-labelledby="details-tab">
                    <form action="../controllers/AsignarTareasC.php" method="POST" class="d-inline-flex flex-column justify-content-between h-100 w-100 p-0 form-register">
                        <div role="tablist" class="p-3">
                            <div class="row" id="infoTareAsignada-show">
                                <div class="col-md-12 col-lg-7 mb-4">
                                    <div class="card mb-3" role="tab" style="position: unset;">
                                        <div class="card-header bg-primary" id="info" data-toggle="collapse" href="#info-show" aria-expanded="true" aria-controls="infoTareAsignada-show">
                                            <h5 class="d-inline-flex align-items-center text-secondary"><i class="fa-solid fa-user-large"></i></i>&nbsp;&nbsp;Información de la Tarea</h5>
                                        </div>
                                        <div class="collapse show" role="tabpanel" aria-labelledby="info" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <label for="asunto" class="col-12 text-primary">Asunto</label>
                                                        <input type="text" name="asunto" id="asunto" class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3" value="<?= $data['asunto'] ?>" readonly>
                                                    </div>
                                                    <div class="col-12 col-lg-6">
                                                        <label for="estado_asignacion" class="col-12 text-primary">Estado</label>
                                                        <input type="hidden" name="estado_asignacion_text" value="<?= $data['estado_asignacion'] ?>">
                                                        <select name="estado_asignacion" id="estado_asignacion" class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3" disabled></select>
                                                    </div>
                                                    <div class="col-12 col-lg-6">
                                                        <label for="prioridad" class="col-12 text-primary">Prioridad</label>
                                                        <input type="hidden" name="prioridad_text" value="<?= $data['prioridad'] ?>">
                                                        <select name="prioridad" id="prioridad" class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3" disabled></select>
                                                    </div>
                                                    <div class="col-12 mt-3">
                                                        <h5 class="px-0"><label for="tarea_descripcion">Descripción de la tarea</label></h5>
                                                        <textarea class="form-textarea w-100 rounded-1 p-1" name="tarea_descripcion" id="tarea_descripcion" rows="5" style="resize: none;" readonly disabled><?= $data['tarea_descripcion'] ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-5 mb-4">
                                    <h5>Empleado asignado</h5>
                                    <div class="card">
                                        <div class="card-header d-inline-flex" style="align-items: center; justify-content: space-between;">
                                            <h5 class="mb-0">EMPLEADO</h5>
                                        </div>
                                        <?php
                                        if (!empty($data['empleados_id'])) {
                                            echo "<input type='hidden' name='empleados_id' id='empleados_id' value='" . $data['empleados_id'] . "'>";
                                            echo "<div class='card-body' style='max-height:350px; overflow-y:auto;' id='list_empleado'>";
                                            echo "<div class='row mb-2'>";
                                            echo "<div class='col-8'>";
                                            echo "<span class='d-block'><strong class='text-primary'>Nombre: </strong>" . $data['nombre_empleado'] . "</span>";
                                            echo "</div>";
                                            echo "<div class='col-4 align-self-center text-end'>";
                                            echo "<a href='../controllers/JaulaC.php?action=show_register&id=" . $data['empleados_id'] . "' class='btn btn-primary btn-sm'>Ver</a>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";
                                        } else {
                                            echo "<div class='card-body' style='max-height:350px; overflow-y:auto;' id='list_empleado'>";
                                            echo "<div class='p-2 pb-1 text-center'>";
                                            echo "<p>Tarea no asignada a un voluntario.</p>";
                                            echo "</div>";
                                            echo "</div>";
                                        }
                                        ?>
                                    </div>
                                    <h5 class="mt-3">Voluntario asignado</h5>
                                    <div class="card mt-3">
                                        <div class="card-header d-inline-flex" style="align-items: center; justify-content: space-between;">
                                            <h5 class="mb-0">VOLUNTARIO</h5>
                                        </div>
                                        <?php
                                        if (!empty($data['voluntarios_id'])) {
                                            echo "<input type='hidden' name='voluntarios_id' id='voluntarios_id' value='" . $data['voluntarios_id'] . "'>";
                                            echo "<div class='card-body' style='max-height:350px; overflow-y:auto;' id='list_voluntario'>";
                                            echo "<div class='row mb-2'>";
                                            echo "<div class='col-8'>";
                                            echo "<span class='d-block'><strong class='text-primary'>Nombre: </strong>" . $data['nombre_voluntario'] . "</span>";
                                            echo "</div>";
                                            echo "<div class='col-4 align-self-center text-end'>";
                                            echo "<a href='../controllers/JaulaC.php?action=show_register&id=" . $data['voluntarios_id'] . "' class='btn btn-primary btn-sm'>Ver</a>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";
                                        } else {
                                            echo "<div class='card-body' style='max-height:350px; overflow-y:auto;' id='list_voluntario'>";
                                            echo "<div class='p-2 pb-1 text-center'>";
                                            echo "<p>Tarea no asignada a un voluntario.</p>";
                                            echo "</div>";
                                            echo "</div>";
                                        }
                                        ?>
                                    </div>
                                    <h5 class="mt-3">Jaula asignada</h5>
                                    <div class="card mt-3">
                                        <div class="card-header d-inline-flex" style="align-items: center; justify-content: space-between;">
                                            <h5 class="mb-0">JAULA</h5>
                                        </div>
                                        <?php
                                        if (!empty($data['jaulas_id'])) {
                                            echo "<div class='card-body' style='max-height:350px; overflow-y:auto;' id='list_jaula'>";
                                            echo "<div class='row mb-2'>";
                                            echo "<div class='col-6'>";
                                            echo "<span class='d-block'><strong class='text-primary'>Ubicación: </strong>" . $data['ubicacion'] . "</span>";
                                            echo "<span class='d-block'><strong class='text-primary'>Especie: </strong>" . $data['nombre_especie'] . "</span>";
                                            echo "</div>";
                                            echo "<div class='col-6 align-self-center text-end'>";
                                            echo "<a href='../controllers/JaulaC.php?action=show_register&id=" . $data['jaulas_id'] . "' class='btn btn-primary btn-sm'>Ver</a>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";
                                        } else {
                                            echo '<input type="hidden" name="jaula_id_register" id="jaula_id_register" value="">';
                                            echo "<div class='card-body' style='max-height:350px; overflow-y:auto;' id='list_jaula'>";
                                            echo "<div class='p-2 pb-1 text-center'>";
                                            echo "<p>No hay jaula asignada</p>";
                                            echo "</div>";
                                            echo "</div>";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group p-3 text-center bg-info bg-opacity-25 hidden btn-hidden-register">
                            <button type="submit" class="btn btn-primary" id="submit_register" name="action" value="update">Guardar Cambios</button>
                            <button type="button" class="btn btn-primary" id="cancel_register">Descartar</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>

    </section>
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>

    <script src="/DES/perrera-ec2/app/views/js/Utils.js"></script>
    <script src="/DES/perrera-ec2/app/views/js/widthMenu.js"></script>
    <script src="/DES/perrera-ec2/app/views/js/btns-record-page.js"></script>
    <script src="/DES/perrera-ec2/app/views/js/modal-assigned.js"></script>
</body>

</html>