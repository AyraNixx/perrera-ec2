<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jaulas</title>
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

        <!-- MODAL JAULA -->
        <?php include_once "../views/components/insertJaula.php"; ?>

        <!-- HEADER -->
        <?php include_once "../views/components/header.php"; ?>


        <!-- CONTENEDOR PRINCIPAL -->
        <main class="mx-4 mt-5 mb-5">
            <br />
            <!-- Split dropup button -->
            <div class="mb-4 w-100 bg-secondary bg-opacity-75 " style="border-radius:5px;">
                <div class="button-option-container d-flex justify-content-between align-content-center w-100 bg-primary p-3">
                    <h1 style="font-size: x-large;" class="pt-2 text-secondary text-uppercase font-weight-light mb-0 d-inline" data-controller="JaulaC.php">
                        <i class="fa-solid fa-paw"></i>
                        JAULA
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
                        <p style="font-size: .8em"><?= $data['ubicacion'] ?></p>
                    </div>
                    <div>
                        <h5 class="text-primary" style="font-weight:600; text-transform:uppercase; font-size: .8em">Especie</h5>
                        <p style="font-size: .8em"><?= $data['nombre_especie'] ?></p>
                    </div>
                    <div>
                        <h5 class="text-primary" style="font-weight:600; text-transform:uppercase; font-size: .8em">Tamaño</h5>
                        <p style="font-size: .8em"><?= $data['tamanio'] ?></p>
                    </div>
                    <div>
                        <h5 class="text-primary" style="font-weight:600; text-transform:uppercase; font-size: .8em">Disponibilidad</h5>
                        <p style="font-size: .8em"><?= ($data['ocupada'] == '0') ? 'NO' : 'SI' ?></p>
                    </div>
                </div>
            </div>
            <!-- partial:index.partial.html -->
            <nav class="nav nav-tabs w-100" id="tab" role="tablist">
                <a class="nav-item nav-link border-bottom-0 active" data-toggle="tab" role="tab" aria-selected="true" aria-controls="nav-details" href="#details">Detalles</a>
            </nav>

            <div class="tab-content w-100 border border-1 border-primary-subtle border-top-0" id="tabcontent" style="height:900px;">
                <div class="tab-pane fade show active h-100" id="details" role="tabpanel" aria-labelledby="details-tab">
                    <form action="../controllers/JaulaC.php" method="POST" class="d-inline-flex flex-column justify-content-between h-100 w-100 p-0 form-register">
                        <div role="tablist" class="p-3">
                            <div class="row" id="infoJaula-show">
                                <div class="col-md-12 col-lg-7 mb-4">
                                    <div class="card" role="tab" style="position: unset;">
                                        <div class="card-header bg-primary" id="info" data-toggle="collapse" href="#info-show" aria-expanded="true" aria-controls="infoJaula-show">
                                            <h5 class="d-inline-flex align-items-center text-secondary"><i class="fa-solid fa-house-circle-exclamation"></i>&nbsp;&nbsp;Información de la Jaula</h5>
                                        </div>

                                        <div class="collapse show" role="tabpanel" aria-labelledby="info" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="form-group row">
                                                    <div class="col-12 col-lg-6">
                                                        <label for="ubicacion" class="col-12 text-primary">Ubicación</label>
                                                        <input type="text" name="ubicacion" id="ubicacion" class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3" value="<?= $data['ubicacion'] ?>" readonly>
                                                        <label for="tamanio" class="col-12 text-primary">Tamaño de Jaula</label>
                                                        <input type="num" name="tamanio" id="tamanio" class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3" value="<?= $data['tamanio'] ?>" readonly>

                                                    </div>
                                                    <div class="col-12 col-lg-6">
                                                        <label for="especies_id" class="col-12">Especie</label>
                                                        <input type="text" name="especies-form" id="especies-form" class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3" value="<?= $data['nombre_especie'] ?>" readonly disabled>
                                                        <select name="especies_id" id="especies_id" class="col-12 px-2 border border-dark-subtle my-3 rounded" style="display: none;"></select>
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="descripcion" class="col-12 text-primary mt-3 mb-2">Descripción</label>
                                                        <textarea name="descripcion" id="descripcion" class="form-control" cols="30" rows="10" style="resize: none; box-shadow:none;" readonly><?= $data['descripcion'] ?></textarea>
                                                        <label for="otros_comentarios" class="col-12 text-primary mt-3 mb-2">Otros comentarios de interés</label>
                                                        <textarea name="otros_comentarios" id="otros_comentarios" class="form-control" cols="30" rows="10" style="resize: none; box-shadow:none;" readonly><?= $data['otros_comentarios'] ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br />
                                </div>
                                <div class="col-md-12 col-lg-5 mb-4">
                                    <div class="card" role="tab" style="position: unset;">
                                        <div class="card-header bg-primary" id="info" data-toggle="collapse" href="#info-show" aria-expanded="true" aria-controls="infoJaula-show">
                                            <h5 class="d-inline-flex align-items-center text-secondary"><i class="fa-regular fa-circle-check"></i>&nbsp;&nbsp;Estado de la Jaula</h5>
                                        </div>

                                        <div class="collapse show" role="tabpanel" aria-labelledby="info" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="form-group row">
                                                    <div class="col-12 col-sm-6">
                                                        <label for="estado_comida" class="col-12">¿Comida disponible?</label>
                                                        <select name="estado_comida" id="estado_comida" class="col-12 px-2 border border-dark-subtle mt-1 mb-3 rounded" disabled>
                                                            <option>Seleccionar estado</option>
                                                            <option value="1" <?= ($data['estado_comida'] == '1' ? 'selected' : '') ?>>SI</option>
                                                            <option value="0" <?= ($data['estado_comida'] == '0' ? 'selected' : '') ?>>NO</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <label for="ocupada" class="col-12">¿Espacio disponible?</label>
                                                        <select name="ocupada" id="ocupada" class="col-12 px-2 border border-dark-subtle mt-1 mb-3 rounded" disabled>
                                                            <option>Seleccionar estado</option>
                                                            <option value="1" <?= ($data['ocupada'] == '1' ? 'selected' : '') ?>>SI</option>
                                                            <option value="0" <?= ($data['ocupada'] == '0' ? 'selected' : '') ?>>NO</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <label for="estado_limpieza" class="col-12">¿Jaula limpia?</label>
                                                        <select name="estado_limpieza" id="estado_limpieza" class="col-12 px-2 border border-dark-subtle mt-1 mb-3 rounded" disabled>
                                                            <option>Seleccionar estado</option>
                                                            <option value="1" <?= ($data['estado_limpieza'] == '1' ? 'selected' : '') ?>>SI</option>
                                                            <option value="0" <?= ($data['estado_limpieza'] == '0' ? 'selected' : '') ?>>NO</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>





                                    <div class="card mt-3" role="tab" style="position: unset;">
                                        <div class="card-header bg-primary" id="info" data-toggle="collapse" href="#info-show" aria-expanded="true" aria-controls="infoJaula-show">
                                            <h5 class="d-inline-flex align-items-center text-secondary"><i class="fa-solid fa-dog text-secondary"></i>&nbsp;&nbsp;Animales</h5>
                                        </div>

                                        <div class="collapse show" role="tabpanel" aria-labelledby="info" data-parent="#accordion">
                                            <div class="card-body" style="max-height:350px; overflow-y:auto;">
                                                <?php
                                                if (!empty($data['animal_nombres'])) {
                                                    $ids = explode(',', $data['animal_ids']);
                                                    $animal_estados_adopcion = explode(',', $data['animal_estados_adopcion']);
                                                    foreach (explode(',', $data['animal_nombres']) as $i => $nombre) {
                                                        echo "<div class='row mb-2'>";
                                                        echo "<div class='col-6'>";
                                                        echo "<span class='d-block'><strong class='text-primary'>Nombre: </strong>$nombre</span>";
                                                        echo "<span class='d-block'><strong class='text-primary'>Especie: </strong>" . $data['nombre_especie'] . "</span>";
                                                        echo "</div>";
                                                        echo "<div class='col-6 align-self-center text-end'>";
                                                        echo "<a href='../controllers/AnimalC.php?action=show_register&id=" . $ids[$i] . "' class='btn btn-primary btn-sm'>Ver</a>";
                                                        echo "<button class='ms-2 btn btn-secondary btn-sm' data-delete_animal='delete_animal'>Eliminar</button>";
                                                        echo "</div>";
                                                        echo "</div>";
                                                        if ($i < count($ids) - 1) {
                                                            echo "<hr class='mt-3 text-secondary'>";
                                                        }
                                                    }
                                                } else {
                                                    echo "<div class='row mb-2'>";
                                                    echo "<div class='col-6'>No hay animales asociados";
                                                    echo "</div>";
                                                    echo "</div>";
                                                }
                                                ?>
                                            </div>
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
    <script src="/DES/perrera-ec2/app/views/js/create-jaulas.js"></script>
    <script src="/DES/perrera-ec2/app/views/js/btns-record-page.js"></script>
</body>

</html>