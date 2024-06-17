<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atencion Veterinaria</title>
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
        <?php include_once "../views/components/insertAtencionVeterinaria.php"; ?>
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
                    <h1 style="font-size: x-large;" class="pt-2 text-secondary text-uppercase font-weight-light mb-0 d-inline" data-controller="AtencionVeterinariaC.php">
                        <i class="fa-solid fa-paw"></i>
                        ATENCIÓN VETERINARIA
                    </h1>
                    <div class="btn-group" role="group">
                        <button class="button-dropdown" data-toggle="modal" data-target="#insert">Añadir</button>
                        <button class="button-dropdown" data-action="update">Editar</button>
                        <button class="button-dropdown" data-action="sdelete">Eliminar</button>
                    </div>
                    <div class="btn-group dropdown" style="position:relative">
                        <button type="button" class="button-dropdown" data-toggle="modal" data-target="#insert">
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
                        <h5 class="text-primary" style="font-weight:600; text-transform:uppercase; font-size: .8em">Nombre</h5>
                        <p style="font-size: .8em"><?= $data['nombre_veterinario'] . ' ' . $data['apellidos_veterinario'] ?></p>
                    </div>
                    <div>
                        <h5 class="text-primary" style="font-weight:600; text-transform:uppercase; font-size: .8em">Clínica</h5>
                        <p style="font-size: .8em"><?= $data['nombre_clinica'] ?></p>
                    </div>
                    <div>
                        <h5 class="text-primary" style="font-weight:600; text-transform:uppercase; font-size: .8em">Animal</h5>
                        <p style="font-size: .8em"><?= $data['nombre_animal'] ?></p>
                    </div>
                    <div>
                        <h5 class="text-primary" style="font-weight:600; text-transform:uppercase; font-size: .8em">Jaula</h5>
                        <p style="font-size: .8em"><?= $data['ubicacion_jaula'] ?></p>
                    </div>
                    <div>
                        <h5 class="text-primary" style="font-weight:600; text-transform:uppercase; font-size: .8em">Fech. asistencia</h5>
                        <p style="font-size: .8em"><?= $data['fecha_atencion'] ?></p>
                    </div>
                </div>
            </div>
            <!-- partial:index.partial.html -->
            <nav class="nav nav-tabs w-100" id="tab" role="tablist">
                <a class="nav-item nav-link border-bottom-0 active" data-toggle="tab" role="tab" aria-selected="true" aria-controls="nav-details" href="#details">Detalles</a>
            </nav>

            <div class="tab-content w-100 border border-1 border-primary-subtle border-top-0" id="tabcontent" style="height:900px; max-height:900px; overflow-y:auto;">
                <div class="tab-pane fade show active h-100" id="details" role="tabpanel" aria-labelledby="details-tab">
                    <form action="../controllers/AtencionVeterinariaC.php" method="POST" class="d-inline-flex flex-column justify-content-between h-100 w-100 p-0 form-register">
                        <div role="tablist" class="p-3">
                            <div class="row" id="infoTareAsignada-show">
                                <div class="col-md-12 col-lg-7 mb-4">
                                    <div class="card mb-3" role="tab" style="position: unset;">
                                        <div class="card-header bg-primary" id="info" data-toggle="collapse" href="#info-show" aria-expanded="true" aria-controls="infoTareAsignada-show">
                                            <h5 class="d-inline-flex align-items-center text-secondary"><i class="fa-solid fa-user-large"></i></i>&nbsp;&nbsp;Información de la asistencia</h5>
                                        </div>
                                        <div class="collapse show" role="tabpanel" aria-labelledby="info" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <label for="nombre_animal" class="col-12 text-primary">Nombre del animal</label>
                                                        <input type="text" name="nombre_animal" id="nombre_animal" class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3" value="<?= $data['nombre_animal'] ?>" readonly disabled>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <label for="nombre_veterinario" class="col-12 text-primary">Veterinario</label>
                                                        <input type="text" name="nombre_veterinario" id="nombre_veterinario" class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3" value="<?= $data['nombre_veterinario'] . ' ' . $data['apellidos_veterinario'] ?>" readonly disabled>                                                        
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label for="fecha_atencion" class="col-12 text-primary">Fech. asistencia</label>
                                                        <input type="datetime-local" name="fecha_atencion" id="fecha_atencion" class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3" value="<?= $data['fecha_atencion'] ?>" readonly>
                                                    </div>
                                                    <div class="col-12 col-md-2">
                                                        <label for="coste" class="col-12 text-primary">Coste</label>
                                                        <input type="number" name="coste" id="coste" class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3" value="<?= $data['coste'] ?>" readonly>
                                                    </div>
                                                    <div class="col-12">
                                                        <h5 class="px-0"><label for="motivo">Motivo de la visita</label></h5>
                                                        <textarea class="form-textarea w-100 rounded-1 p-1" name="motivo" id="motivo" rows="5" style="resize: none;" readonly><?= $data['motivo'] ?></textarea>
                                                    </div>
                                                    <div class="col-12">
                                                        <h5 class="px-0"><label for="procedimientos">Procedimientos realizados</label></h5>
                                                        <textarea class="form-textarea w-100 rounded-1 p-1" name="procedimientos" id="procedimientos" rows="5" style="resize: none;" readonly><?= $data['procedimientos'] ?></textarea>
                                                    </div>
                                                    <div class="col-12">
                                                        <h5 class="px-0"><label for="diagnostico">Diagnóstico</label></h5>
                                                        <textarea class="form-textarea w-100 rounded-1 p-1" name="diagnostico" id="diagnostico" rows="5" style="resize: none;" readonly><?= $data['diagnostico'] ?></textarea>
                                                    </div>
                                                    <div class="col-12">
                                                        <h5 class="px-0"><label for="medicamentos">Medicamentos recetados</label></h5>
                                                        <textarea class="form-textarea w-100 rounded-1 p-1" name="medicamentos" id="medicamentos" rows="5" style="resize: none;" readonly><?= $data['medicamentos'] ?></textarea>
                                                    </div>
                                                    <div class="col-12">
                                                        <h5 class="px-0"><label for="comentarios">Observaciones</label></h5>
                                                        <textarea class="form-textarea w-100 rounded-1 p-1" name="comentarios" id="comentarios" rows="5" style="resize: none;" readonly><?= $data['comentarios'] ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mb-3" role="tab" style="position: unset;">
                                        <div class="card-header bg-primary" id="info" data-toggle="collapse" href="#info-show" aria-expanded="true" aria-controls="infoTareAsignada-show">
                                            <h5 class="d-inline-flex align-items-center text-secondary"><i class="fa-solid fa-user-large"></i></i>&nbsp;&nbsp;Datos del veterinario</h5>
                                        </div>
                                        <div class="collapse show" role="tabpanel" aria-labelledby="info" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <h6 class="col-12 text-primary">Nombre del Veterinario</h6>
                                                        <a href="../controllers/VeterinarioC.php?action=show_register&id=<?= $data['veterinarios_id'] ?>" class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3"><?= $data['nombre_veterinario'] . ' ' . $data['apellidos_veterinario'] ?></a>
                                                    </div>
                                                    <div class="col-12 col-md-8">
                                                        <h6 class="col-12 text-primary">Email</h6>
                                                        <p class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3"><?= $data['correo_veterinario'] ?></p>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <h6 class="col-12 text-primary">Telf. </h6>
                                                        <p class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3"><?= $data['telf_veterinario'] ?></p>
                                                    </div>
                                                    <div class="col-12 col-md-8">
                                                        <h6 class="col-12 text-primary">Clínica</h6>
                                                        <p class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3"><?= $data['nombre_clinica'] ?></a>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <h6 class="col-12 text-primary">Telf. </h6>
                                                        <p class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3"><?= $data['telf_veterinario'] ?></p>
                                                    </div>
                                                    <div class="col-12">
                                                        <h6 class="col-12 text-primary">Email</h6>
                                                        <p class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3"><?= $data['correo_veterinario'] ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-5 mb-4">
                                    <div class="card mb-3" role="tab" style="position: unset;">
                                        <div class="card-header bg-primary" id="info" data-toggle="collapse" href="#info-show" aria-expanded="true" aria-controls="infoTareAsignada-show">
                                            <h5 class="d-inline-flex align-items-center text-secondary"><i class="fa-solid fa-user-large"></i></i>&nbsp;&nbsp;Datos del animal</h5>
                                        </div>
                                        <div class="collapse show" role="tabpanel" aria-labelledby="info" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="form-group row">
                                                    <div class="col-12 col-md-8 ">
                                                        <h6 class="col-12text-primary">Nombre</h6>
                                                        <a href="../controllers/VeterinarioC.php?action=show_register&id=<?= $data['animales_id'] ?>" class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3"><?= $data['nombre_animal'] ?></a>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <h6 class="col-12 text-primary">Especie </h6>
                                                        <p class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3"><?= $data['nombre_especie'] ?></p>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <h6 class="col-12 text-primary">Género</h6>
                                                        <p class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3"><?= $data['genero'] ?></p>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <h6 class="col-12 text-primary">Tamaño</h6>
                                                        <p class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3"><?= $data['tamanio'] ?></p>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <h6 class="col-12 text-primary">Peso</h6>
                                                        <p class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3"><?= $data['peso'] ?></p>
                                                    </div>
                                                    <div class="col-12">
                                                        <h6 class="col-12 text-primary">Jaula</h6>
                                                        <p class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3"><?= $data['ubicacion_jaula'] ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header d-inline-flex" style="align-items: center; justify-content: space-between;">
                                            <h5 class="mb-0">VETERINARIO</h5>
                                        </div>
                                        <?php
                                        if (!empty($data['veterinarios_id'])) {
                                            echo "<input type='hidden' name='veterinarios_id' id='veterinarios_id' value='" . $data['veterinarios_id'] . "'>";
                                            echo "<div class='card-body' style='max-height:350px; overflow-y:auto;' id='list_empleado'>";
                                            echo "<div class='p-1'>";
                                            echo "<div class='row mb-2'>";
                                            echo "<div class='col-8'>";
                                            echo "<span class='d-block'><strong class='text-primary'>Nombre: </strong>" . $data['nombre_veterinario'] . ' ' . $data['apellidos_veterinario'] . "</span>";
                                            echo "<span class='d-block'><strong class='text-primary'>Clínica: </strong>" . $data['nombre_clinica'] . "</span>";
                                            echo "</div>";
                                            echo "<div class='col-4 align-self-center text-end'>";
                                            echo "<a href='../controllers/EmpleadoC.php?action=show_register&id=" . $data['veterinarios_id'] . "' class='btn btn-primary btn-sm'>Ver</a>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";
                                        } else {
                                            echo "<div class='card-body' style='max-height:350px; overflow-y:auto;' id='list_empleado'>";
                                            echo "<div class='p-1 pb-1 text-center'>";
                                            echo "<p>No hay empleado asignado</p>";
                                            echo "</div>";
                                            echo "</div>";
                                        }
                                        ?>
                                    </div>
                                    <div class="card mt-3">
                                        <div class="card-header d-inline-flex" style="align-items: center; justify-content: space-between;">
                                            <h5 class="mb-0">ANIMAL</h5>
                                        </div>
                                        <?php
                                        if (!empty($data['animales_id'])) {
                                            echo "<div class='card-body' style='max-height:350px; overflow-y:auto;' id='list_empleado'>";
                                            echo "<div class='p-1'>";
                                            echo "<div class='row mb-2'>";
                                            echo "<div class='col-8'>";
                                            echo "<span class='d-block'><strong class='text-primary'>Nombre: </strong>" . $data['nombre_animal'] . "</span>";
                                            echo "<span class='d-block'><strong class='text-primary'>Especie: </strong>" . $data['nombre_especie'] . "</span>";
                                            echo "<span class='d-block'><strong class='text-primary'>Jaula: </strong>" . $data['ubicacion_jaula'] . "</span>";
                                            echo "</div>";
                                            echo "<div class='col-4 align-self-center text-end'>";
                                            echo "<a href='../controllers/AnimalC.php?action=show_register&id=" . $data['animales_id'] . "' class='btn btn-primary btn-sm'>Ver</a>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";
                                        } else {
                                            echo "<div class='card-body' style='max-height:350px; overflow-y:auto;' id='list_empleado'>";
                                            echo "<div class='p-1 pb-1 text-center'>";
                                            echo "<p>No hay empleado asignado</p>";
                                            echo "</div>";
                                            echo "</div>";
                                        }
                                        ?>
                                    </div>
                                </div>

                                <div class="form-group p-3 text-center bg-info bg-opacity-25 hidden btn-hidden-register">
                                    <button type="submit" class="btn btn-primary" id="submit_register" name="action" value="update">Guardar Cambios</button>
                                    <button type="button" class="btn btn-primary" id="cancel_register">Descartar</button>
                                </div>
                    </form>
                </div>
                <br>
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
</body>

</html>