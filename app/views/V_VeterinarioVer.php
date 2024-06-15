<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veterinario</title>
    <link rel="shortcut icon" href="../../public/imgs/logos/logo1.png" type="image/x-icon">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css'>
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

        <!-- INSERT DUENIO -->
        <?php include_once "../views/components/insertVeterinario.php"; ?>

        <!-- HEADER -->
        <?php include_once "../views/components/header.php"; ?>


        <!-- CONTENEDOR PRINCIPAL -->
        <main class="mx-4 mt-5 mb-5">
            <br />
            <!-- Split dropup button -->
            <div class="mb-4 w-100 bg-secondary bg-opacity-75 " style="border-radius:5px;">
                <div class="button-option-container d-flex justify-content-between align-content-center w-100 bg-primary p-3">
                    <h1 style="font-size: x-large;" class="pt-2 text-secondary text-uppercase font-weight-light mb-0 d-inline" data-controller="VeterinarioC.php">
                        <i class="fa-solid fa-paw"></i>
                        Veterinario
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
                        <p style="font-size: .8em"><?= $data['nombre'] ?></p>
                    </div>
                    <div>
                        <h5 class="text-primary" style="font-weight:600; text-transform:uppercase; font-size: .8em">Apellidos</h5>
                        <p style="font-size: .8em"><?= $data['apellidos'] ?></p>
                    </div>
                    <div>
                        <h5 class="text-primary" style="font-weight:600; text-transform:uppercase; font-size: .8em">Email</h5>
                        <p style="font-size: .8em"><?= $data['correo'] ?></p>
                    </div>
                    <div>
                        <h5 class="text-primary" style="font-weight:600; text-transform:uppercase; font-size: .8em">Telf.</h5>
                        <p style="font-size: .8em"><?= $data['telf'] ?></p>
                    </div>
                </div>
            </div>
            <!-- partial:index.partial.html -->
            <nav class="nav nav-tabs w-100" id="tab" role="tablist">
                <a class="nav-item nav-link border-bottom-0 active" data-toggle="tab" role="tab" aria-selected="true" aria-controls="nav-details" href="#details">Detalles</a>
            </nav>

            <div class="tab-content w-100 border border-1 border-primary-subtle border-top-0" id="tabcontent" style="height:900px; max-height:900px; overflow-y:auto;">
                <div class="tab-pane fade show active h-100" id="details" role="tabpanel" aria-labelledby="details-tab">
                    <form action="../controllers/VeterinarioC.php" method="POST" class="d-inline-flex flex-column justify-content-between h-100 w-100 p-0 form-register">
                        <div role="tablist" class="p-3">
                            <div class="row" id="infoVeterinario-show">
                                <div class="col-md-12 col-lg-7 mb-4">
                                    <div class="card mb-3" role="tab" style="position: unset;">
                                        <div class="card-header bg-primary" id="info" data-toggle="collapse" href="#info-show" aria-expanded="true" aria-controls="infoVeterinario-show">
                                            <h5 class="d-inline-flex align-items-center text-secondary"><i class="fa-solid fa-user-large"></i></i>&nbsp;&nbsp;Información Personal</h5>
                                        </div>
                                        <div class="collapse show" role="tabpanel" aria-labelledby="info" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="form-group row">
                                                    <div class="col-12 col-lg-4">
                                                        <label for="nombre" class="col-12 text-primary">Nombre</label>
                                                        <input type="text" name="nombre" id="nombre" class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3" value="<?= $data['nombre'] ?>" readonly>
                                                    </div>
                                                    <div class="col-12 col-lg-4">
                                                        <label for="apellidos" class="col-12 text-primary">Apellidos</label>
                                                        <input type="text" name="apellidos" id="apellidos" class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3" value="<?= $data['apellidos'] ?>" readonly>
                                                    </div>
                                                    <div class="col-12 col-lg-4">
                                                        <label for="especialidad" class="col-12 text-primary">Especialidad</label>
                                                        <input type="text" name="especialidad" id="especialidad" class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3" value="<?= $data['apellidos'] ?>" readonly>
                                                    </div>
                                                    <div class="col-12 col-lg-3">
                                                        <label for="telf" class="col-12 text-primary">Telf.</label>
                                                        <input type="tel" name="telf" id="telf" class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3" value="<?= $data['telf'] ?>" readonly>
                                                    </div>
                                                    <div class="col-12 col-lg-9">
                                                        <label for="correo" class="col-12 text-primary">Email</label>
                                                        <input type="email" name="correo" id="correo" class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3" value="<?= $data['correo'] ?>" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card" role="tab" style="position: unset;">
                                        <div class="card-header bg-primary" id="info" data-toggle="collapse" href="#info-show" aria-expanded="true" aria-controls="infoVeterinario-show">
                                            <h5 class="d-inline-flex align-items-center text-secondary"><i class="fa-solid fa-hospital"></i>&nbsp;&nbsp;Información de la clínica</h5>
                                        </div>
                                        <div class="collapse show" role="tabpanel" aria-labelledby="info" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="form-group row">
                                                    <div class="col-12 col-lg-6">
                                                        <label for="hora_apertura" class="col-12">Hora de apertura</label>
                                                        <input type="time" name="hora_apertura" id="hora_cierre" class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3 w-100" value="<?= $data['hora_apertura'] ?>" readonly>
                                                    </div>
                                                    <div class="col-12 col-lg-6">
                                                        <label for="hora_cierre" class="col-12">Hora de cierre</label>
                                                        <input type="time" name="hora_cierre" id="hora_cierre" class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3 w-100" value="<?= $data['hora_cierre'] ?>" readonly>
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="direccion_clinica" class="col-12">Direccion</label>
                                                        <input type="text" name="direccion_clinica" id="direccion_clinica" class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3" value="<?= $data['direccion_clinica'] ?>" readonly>
                                                    </div>
                                                    <div class="col-12 col-lg-3">
                                                        <label for="telf_clinica" class="col-12 text-primary">Telf.</label>
                                                        <input type="tel" name="telf_clinica" id="telf_clinica" class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3" value="<?= $data['telf_clinica'] ?>" readonly>
                                                    </div>
                                                    <div class="col-12 col-lg-9">
                                                        <label for="correo_clinica" class="col-12 text-primary">Email</label>
                                                        <input type="email" name="correo_clinica" id="correo_clinica" class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3" value="<?= $data['correo_clinica'] ?>" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-5 mb-4">
                                    <div class="card" role="tab" style="position: unset;">
                                        <div class="card-header bg-primary" id="info" data-toggle="collapse" href="#info-show" aria-expanded="true" aria-controls="infoVeterinario-show">
                                            <h5 class="d-inline-flex align-items-center text-secondary"><i class="fa-solid fa-message"></i>&nbsp;&nbsp;Otros datos de interés</h5>
                                        </div>
                                        <div class="row textarea-container m-1 p-3 pt-0">
                                            <h5 class="p-0 mt-2"><label for="otra_informacion">Comentarios</label></h5>
                                            <textarea class="form-textarea rounded border-dark-subtle" name="otra_informacion" id="otra_informacion" cols="30" rows="5" style="resize: none;" readonly><?=$data['otra_informacion']?></textarea>
                                        </div>
                                    </div>

                                    <h5 class="mt-4">ANIMALES RELACIONADOS</h5>
                                    <div class="card mt-3">
                                        <div class="card-header d-inline-flex" style=" align-items: center; justify-content: space-between;">
                                            <h5 class="mb-0">Animales</h5>                                            
                                        </div>
                                        <?php
                                        if (!empty($data['animal_ids'])) {
                                            echo '<input type="hidden" name="animales_list_register" id="animales_list_register" value="' . $data['animal_ids'] . '">';
                                            echo "<div class='card-body' style='max-height:350px; overflow-y:auto;' id='list_animal'>";
                                            $ids = explode(',', $data['animal_ids']);
                                            $name_a = explode(',', $data['animal_nombres']);
                                            $name_e = explode(',', $data['nombre_especies']);
                                            $fech = explode(',', $data['fechas_registro']);
                                            foreach ($ids as $i => $v) {
                                                echo "<div class='row mb-2'>";
                                                echo "<div class='col-6'>";
                                                echo "<span class='d-block'><strong class='text-primary'>Nombre: </strong>$name_a[$i]</span>";
                                                echo "<span class='d-block'><strong class='text-primary'>Especie: </strong>$name_e[$i]</span>";
                                                echo "<span class='d-block'><strong class='text-primary'>Fecha de registro: </strong> $fech[$i]</span>";
                                                echo "</div>";
                                                echo "<div class='col-6 align-self-center text-end'>";
                                                echo "<a href='../controllers/AnimalC.php?action=show_register&id=$v' class='btn btn-primary btn-sm'>Ver</a>";
                                                echo "<a class='ms-2 btn btn-secondary btn-sm' data-list_animal=$v>Eliminar</a>";
                                                echo "</div>";
                                                echo "</div>";
                                                if ($i < count($ids) - 1) {
                                                    echo "<hr class='mt-3 text-secondary'>";
                                                }
                                            }
                                        } else {
                                            echo '<input type="hidden" name="animales_list_register" id="animales_list_register" value="">';
                                            echo "<div class='card-body' style='max-height:350px; overflow-y:auto;' id='list_animal'>";
                                            echo "<div class='p-4 text-center'>";
                                            echo "<p>No hay animales asociados</p>";
                                            echo "</div>";
                                            echo "</div>";
                                        }
                                        ?>
                                        <div class="card-footer text-center p-3"></div>
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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js'></script>

    <script src="/DES/perrera-ec2/app/views/js/Utils.js"></script>
    <script src="/DES/perrera-ec2/app/views/js/widthMenu.js"></script>
    <script src="/DES/perrera-ec2/app/views/js/btns-record-page.js"></script>
</body>

</html>