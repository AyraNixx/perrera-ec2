<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dueño</title>
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
        <?php include_once "../views/components/insertDuenio.php"; ?>

        <!-- CHECK ANIMALS -->
        <?php include_once "../views/components/searchAnimal.php"; ?>

        <!-- HEADER -->
        <?php include_once "../views/components/header.php"; ?>


        <!-- CONTENEDOR PRINCIPAL -->
        <main class="mx-4 mt-5 mb-5">
            <br />
            <!-- Split dropup button -->
            <div class="mb-4 w-100 bg-secondary bg-opacity-75 " style="border-radius:5px;">
                <div class="button-option-container d-flex justify-content-between align-content-center w-100 bg-primary p-3">
                    <h1 style="font-size: x-large;" class="pt-2 text-secondary text-uppercase font-weight-light mb-0 d-inline" data-controller="DuenioC.php">
                        <i class="fa-solid fa-paw"></i>
                        DUEÑO
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
                        <h5 class="text-primary" style="font-weight:600; text-transform:uppercase; font-size: .8em">NIF</h5>
                        <p style="font-size: .8em"><?= $data['NIF'] ?></p>
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
                    <form action="../controllers/DuenioC.php" method="POST" class="d-inline-flex flex-column justify-content-between h-100 w-100 p-0 form-register">
                        <div role="tablist" class="p-3">
                            <div class="row" id="infoDuenio-show">
                                <div class="col-md-12 col-lg-7 mb-4">
                                    <div class="card mb-3" role="tab" style="position: unset;">
                                        <div class="card-header bg-primary" id="info" data-toggle="collapse" href="#info-show" aria-expanded="true" aria-controls="infoDuenio-show">
                                            <h5 class="d-inline-flex align-items-center text-secondary"><i class="fa-solid fa-user-large"></i></i>&nbsp;&nbsp;Información Personal</h5>
                                        </div>
                                        <div class="collapse show" role="tabpanel" aria-labelledby="info" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="form-group row">
                                                    <div class="col-12 col-lg-6">
                                                        <label for="nombre" class="col-12 text-primary">Nombre</label>
                                                        <input type="text" name="nombre" id="nombre" class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3" value="<?= $data['nombre'] ?>" readonly>
                                                    </div>
                                                    <div class="col-12 col-lg-6">
                                                        <label for="apellidos" class="col-12 text-primary">Apellidos</label>
                                                        <input type="text" name="apellidos" id="apellidos" class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3" value="<?= $data['apellidos'] ?>" readonly>
                                                    </div>
                                                    <div class="col-12 col-lg-4">
                                                        <label for="fech_nac" class="col-12 text-primary">Fecha Nac.</label>
                                                        <input type="date" name="fech_nac" id="fech_nac" class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3" value="<?= $data['fech_nac'] ?>" readonly>
                                                    </div>
                                                    <div class="col-12 col-lg-4">
                                                        <label for="NIF" class="col-12 text-primary">NIF</label>
                                                        <input type="text" name="NIF" id="NIF" class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3" value="<?= $data['NIF'] ?>" readonly>
                                                    </div>
                                                    <div class="col-12 col-lg-4">
                                                        <label for="ocupacion" class="col-12 text-primary">Ocupación</label>
                                                        <input type="hidden" name="ocupacion" id="ocupacion" value="<?= $data['ocupacion'] ?>"> 
                                                        <select name="ocupacion" id="ocupacion" class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3" disabled></select>
                                                    </div>
                                                    <div class="col-12 col-lg-3">
                                                        <label for="telf" class="col-12 text-primary">Teléfono</label>
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
                                        <div class="card-header bg-primary" id="info" data-toggle="collapse" href="#info-show" aria-expanded="true" aria-controls="infoDuenio-show">
                                            <h5 class="d-inline-flex align-items-center text-secondary"><i class="fa-regular fa-circle-check"></i>&nbsp;&nbsp;Dirección</h5>
                                        </div>
                                        <div class="collapse show" role="tabpanel" aria-labelledby="info" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <label for="direccion" class="col-12">Direccion</label>
                                                        <input type="text" name="direccion" id="direccion" class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3" value="<?= $data['direccion'] ?>" readonly>
                                                    </div>
                                                    <div class="col-12 col-lg-4">
                                                        <label for="codigo_postal" class="col-12 text-primary">Código postal</label>
                                                        <input type="text" name="codigo_postal" id="codigo_postal" class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3" value="<?= $data['codigo_postal'] ?>" readonly> 
                                                    </div>
                                                    <div class="col-12 col-lg-4">
                                                        <label for="ciudad" class="col-12 text-primary">Ciudad</label>
                                                        <input type="text" name="ciudad" id="ciudad" class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3" value="<?= $data['ciudad'] ?>" readonly> 
                                                    </div>
                                                    <div class="col-12 col-lg-4">
                                                        <label for="pais" class="col-12 text-primary">País</label>
                                                        <input type="hidden" name="pais_text" id="pais_text" value="<?= $data['pais'] ?>"> 
                                                        <select name="pais" id="pais" class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3" disabled></select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mt-3" role="tab" style="position: unset;">
                                        <div class="card-header bg-primary" id="info" data-toggle="collapse" href="#info-show" aria-expanded="true" aria-controls="infoDuenio-show">
                                            <h5 class="d-inline-flex align-items-center text-secondary"><i class="fa-solid fa-dog text-secondary"></i>&nbsp;&nbsp;Otros datos de interés</h5>
                                        </div>
                                        <div class="collapse show" role="tabpanel" aria-labelledby="info" data-parent="#accordion">
                                            <div class="card-body" style="max-height:350px; overflow-y:auto;">
                                                <div class="form-group row">
                                                    <div class="col-7">
                                                        <label for="fecha_ultima_visita" class="col-12 text-primary">Fech. última visita</label>
                                                        <input type="datetime-local" name="fecha_ultima_visita" id="fecha_ultima_visita" class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3" readonly>
                                                    </div>
                                                    <div class="col-5 align-self-center">
                                                        <label for="permiso_visita" class="d-flex align-self-center">Puede visitar<input type="checkbox" name="permiso_visita" id="permiso_visita" class="ms-3" style="width: fit-content;" value="<?=$data['permiso_visita']?>" disabled></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row textarea-container m-1 p-3 pt-0">
                                            <h5><label for="observaciones">Otros datos de interés</label></h5>
                                            <textarea class="form-textarea" name="observaciones" id="observaciones" cols="30" rows="10" style="resize: none;" readonly><?=$data['observaciones']?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-5 mb-4">
                                    <div class="card">
                                        <div class="card-header d-inline-flex" style=" align-items: center; justify-content: space-between;">
                                            <h5 class="mb-0">Animales</h5>
                                            <i class="fa-solid fa-plus circle-icon bg-secondary text-primary d-flex rounded-circle" id="animals_list_add" aria-hidden="true" style="padding: 2px 4px; cursor:pointer;"></i>
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
                                        echo "</div>";
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
    <script src="/DES/perrera-ec2/app/views/js/searchAnimalModal.js"></script>
</body>

</html>