<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animales</title>
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

        <!-- MODAL ANIMAL -->
        <?php include_once "../views/components/insertAnimal.php"; ?>

        <!-- HEADER -->
        <?php include_once "../views/components/header.php"; ?>


        <!-- CONTENEDOR PRINCIPAL -->
        <main class="mx-4 mt-5 mb-5">
            <br />
            <!-- Split dropup button -->
            <div class="mb-4 w-100 bg-secondary bg-opacity-75 " style="border-radius:5px;">
                <div class="button-option-container d-flex justify-content-between align-content-center w-100 bg-primary p-3">
                    <h1 style="font-size: x-large;" class="pt-2 text-secondary text-uppercase font-weight-light mb-0 d-inline" data-controller="AnimalC.php">
                        <i class="fa-solid fa-paw"></i>
                        ANIMAL
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
                        <h5 class="text-primary" style="font-weight:600; text-transform:uppercase; font-size: .8em">Especie</h5>
                        <p style="font-size: .8em"><?= $data['especie'] ?></p>
                    </div>
                    <div>
                        <h5 class="text-primary" style="font-weight:600; text-transform:uppercase; font-size: .8em">Raza</h5>
                        <p style="font-size: .8em"><?= $data['raza'] ?></p>
                    </div>
                    <div>
                        <h5 class="text-primary" style="font-weight:600; text-transform:uppercase; font-size: .8em">Jaula</h5>
                        <p style="font-size: .8em"><?= $data['jaula'] ?></p>
                    </div>
                    <div>
                        <h5 class="text-primary" style="font-weight:600; text-transform:uppercase; font-size: .8em">Estado de adopción</h5>
                        <p style="font-size: .8em"><?= $data['estado_adopcion'] ?></p>
                    </div>
                </div>
            </div>
            <!-- partial:index.partial.html -->
            <nav class="nav nav-tabs w-100" id="tab" role="tablist">
                <a class="nav-item nav-link border-bottom-0 active" data-toggle="tab" role="tab" aria-selected="true" aria-controls="nav-details" href="#details">Detalles</a>
                <a class="nav-item nav-link border-bottom-0" data-toggle="tab" role="tab" aria-selected="false" aria-controls="nav-files" href="#files-tab-div" id="files-tab-link">Archivos</a>
            </nav>

            <div class="tab-content w-100 border border-1 border-primary-subtle border-top-0" id="tabcontent" style="height:900px; overflow-y:auto;">
                <div class="tab-pane fade show active h-100" id="details" role="tabpanel" aria-labelledby="details-tab">
                    <form action="../controllers/AnimalC.php" method="POST" class="d-inline-flex flex-column justify-content-between h-100 w-100 p-0 form-register">
                        <div role="tablist" class="p-3">
                            <div class="row" id="infoAnimal-show">
                                <div class="col-md-12 col-lg-6 mb-4">
                                    <div class="card" role="tab" style="position: unset;">
                                        <div class="card-header bg-primary" id="info" data-toggle="collapse" href="#info-show" aria-expanded="true" aria-controls="infoAnimal-show">
                                            <h5 class="d-inline-flex align-items-center text-secondary"><i class="fa-solid fa-dog text-secondary"></i>&nbsp;&nbsp;Información del Animal</h5>
                                        </div>

                                        <div class="collapse show" role="tabpanel" aria-labelledby="info" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="form-group row">

                                                    <div class="col-12 col-lg-6">
                                                        <label for="nombre" class="col-12 text-primary">Nombre</label>
                                                        <input type="text" name="nombre" id="nombre" class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3" value="<?= $data['nombre'] ?>" readonly>
                                                        <label for="genero" class="col-12">Género</label>
                                                        <input type="text" name="genero" id="genero" class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3" value="<?= $data['genero'] ?>" readonly>
                                                        <label for="raza" class="col-12">Raza</label>
                                                        <input type="text" name="raza" id="raza" class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3" value="<?= $data['raza'] ?>" readonly>
                                                        <label for="tamanio" class="col-12">Tamaño</label>
                                                        <input type="text" name="tamanio" id="tamanio" class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3" value="<?= $data['tamanio'] ?>" readonly>
                                                        <label for="colores" class="col-12">Colores</label>
                                                        <select name="colores[]" id="colores" class="col-12 px-2 border border-dark-subtle mt-1 mb-3" multiple disabled>
                                                            <option disabled>Seleccionar color</option> <!-- TO DO!!  HACER QUE EL DISABLED SE CAMBIE CUANDO HAGAMOS CLICK EN EDITAR-->
                                                            <option value="Negro" <?= (str_contains($data['colores'], 'Negro') ? 'selected' : '') ?>>Negro</option>
                                                            <option value="Blanco" <?= (str_contains($data['colores'], 'Blanco') ? 'selected' : '') ?>>Blanco</option>
                                                            <option value="Marron" <?= (str_contains($data['colores'], 'Marron') ? 'selected' : '') ?>>Marrón</option>
                                                            <option value="Otros" <?= (str_contains($data['colores'], 'Otros') ? 'selected' : '') ?>>Otros</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-12 col-lg-6">
                                                        <label for="fech_nac" class="col-12">Fecha de nacimiento</label>
                                                        <input type="text" name="fech_nac" id="fech_nac" class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3" value="<?= $data['fech_nac'] ?>" readonly>
                                                        <label for="especies_id" class="col-12">Especie</label>
                                                        <input type="text" name="especies_id" id="especies_id" class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3" value="<?= $data['especie'] ?>" readonly>
                                                        <!-- TO DO!!! -->
                                                        <label for="jaula" class="col-12">Jaula</label>
                                                        <input type="text" name="jaula" id="jaula" class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3" value="<?= $data['jaula'] ?>" readonly>
                                                        <!-- TO DO!!! -->
                                                        <label for="peso" class="col-12">Peso</label>
                                                        <input type="text" name="peso" id="peso" class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3" value="<?= $data['peso'] ?>" readonly>
                                                        <label for="personalidad" class="col-12">Personalidad</label>
                                                        <select name="personalidad[]" id="personalidad" class="col-12 px-2 border border-dark-subtle mt-1 mb-3" multiple disabled> <!-- TO DO!!  HACER QUE EL DISABLED SE CAMBIE CUANDO HAGAMOS CLICK EN EDITAR-->
                                                            <option disabled>Seleccionar personalidad</option>
                                                            <option value="Amoroso" <?= (str_contains($data['personalidad'], 'Amoroso') ? 'selected' : '') ?>>Amoroso</option>
                                                            <option value="Curioso" <?= (str_contains($data['personalidad'], 'Curioso') ? 'selected' : '') ?>>Curioso</option>
                                                            <option value="Energetico" <?= (str_contains($data['personalidad'], 'Energetico') ? 'selected' : '') ?>>Energético</option>
                                                            <option value="Independiente" <?= (str_contains($data['personalidad'], 'Independiente') ? 'selected' : '') ?>>Independiente</option>
                                                            <option value="Inteligente" <?= (str_contains($data['personalidad'], 'Inteligente') ? 'selected' : '') ?>>Inteligente</option>
                                                            <option value="Jugueton" <?= (str_contains($data['personalidad'], 'Jugueton') ? 'selected' : '') ?>>Juguetón</option>
                                                            <option value="Protector" <?= (str_contains($data['personalidad'], 'Protector') ? 'selected' : '') ?>>Protector</option>
                                                            <option value="Sociable" <?= (str_contains($data['personalidad'], 'Sociable') ? 'selected' : '') ?>>Sociable</option>
                                                            <option value="Timido" <?= (str_contains($data['personalidad'], 'Timido') ? 'selected' : '') ?>>Tímido</option>
                                                            <option value="Tranquilo" <?= (str_contains($data['personalidad'], 'Tranquilo') ? 'selected' : '') ?>>Tranquilo</option>
                                                            <option value="Otros" <?= (str_contains($data['personalidad'], 'Otros') ? 'selected' : '') ?>>Otros. Especificar en comentarios</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="estado_adopcion" class="col-12">Estado de la adopción</label>
                                                        <select name="estado_adopcion" id="estado_adopcion" class="col-12 px-2 border border-dark-subtle mt-1 mb-3" disabled>
                                                            <option>Seleccionar estado</option>
                                                            <option value="Disponible" <?= ($data['estado_adopcion'] == 'Disponible' ? 'selected' : '') ?>>Disponible</option>
                                                            <option value="Adoptado" <?= ($data['estado_adopcion'] == 'Adoptado' ? 'selected' : '') ?>>Adoptado</option>
                                                            <option value="En_proceso" <?= ($data['estado_adopcion'] == 'En_proceso' ? 'selected' : '') ?>>En proceso</option>
                                                            <option value="Reservado" <?= ($data['estado_adopcion'] == 'Reservado' ? 'selected' : '') ?>>Reservado</option>
                                                            <option value="Pendiente" <?= ($data['estado_adopcion'] == 'Pendiente' ? 'selected' : '') ?>>Pendiente</option>
                                                            <option value="Devuelto" <?= ($data['estado_adopcion'] == 'Devuelto' ? 'selected' : '') ?>>Devuelto</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br />
                                    <div class="card" role="tab" style="position: unset;">
                                        <div class="card-header bg-primary" id="info" data-toggle="collapse" href="#info-show" aria-expanded="true" aria-controls="infoAnimal-show">
                                            <h5 class="d-inline-flex align-items-center text-secondary"><i class="fa-solid fa-kit-medical text-secondary"></i>&nbsp;&nbsp;Salud</h5>
                                        </div>
                                        <div class="collapse show" role="tabpanel" aria-labelledby="info" data-parent="#accordion">
                                            <div class="card-body d-inline-flex align-items-center">
                                                <div class="form-group row">
                                                    <div class="col-12 mt-3">
                                                        <label for="estado_salud" class="text-uppercase col-12">
                                                            <h6>Estado de salud</h6>
                                                        </label>
                                                        <input type="text" name="estado_salud" id="estado_salud" class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3" value="<?= $data['estado_salud'] ?>" readonly>
                                                    </div>
                                                    <div class="col-12 my-3">
                                                        <label for="necesidades_especiales" class="text-uppercase col-12">
                                                            <h6>Requiere de necesidades especiales</h6>
                                                        </label>
                                                        <input type="text" name="necesidades_especiales" id="necesidades_especiales" class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3" value="<?= $data['necesidades_especiales'] ?>" readonly>
                                                    </div>
                                                </div>
                                                <br><br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-5 mb-4">
                                    <div class="card" role="tab" style="position: unset;">
                                        <div class="card-header bg-primary" id="info" data-toggle="collapse" href="#info-show" aria-expanded="true" aria-controls="infoAnimal-show">
                                            <h5 class="d-inline-flex align-items-center text-secondary"><i class="fa-solid fa-comment text-secondary"></i>&nbsp;&nbsp;Otros datos de Interés</h5>
                                        </div>
                                        <div class="collapse show" role="tabpanel" aria-labelledby="info" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <textarea class="form-control" name="otras_observaciones" id="otras_observaciones" cols="30" rows="10" style="resize: none; box-shadow:none; " readonly><?= $data['otras_observaciones'] ?>
                                                    </textarea> <!--CAMBIAR LUEGO-->
                                                </div>
                                            </div>
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
                <div class="tab-pane fade show" id="files-tab-div" role="tabpanel" aria-labelledby="files-tab">
                    <div role="tablist" class="p-3">
                        <div class="row" id="files-show">
                            <div class="col-12 col-md-9 col-lg-9">
                                <div class="card" role="tab" style="position: unset;">
                                    <div class="card-header bg-primary d-flex justify-content-between align-items-center" id="info" data-toggle="collapse" href="#info-show" aria-expanded="true" aria-controls="infoAnimal-show">
                                        <h5 class="d-inline-flex align-items-center text-secondary"><i class="fa-solid fa-image text-secondary"></i>&nbsp;&nbsp;Imágenes</h5>
                                        <i class="fa-solid fa-plus text-primary bg-secondary border border-secondary rounded-circle" data-modal-header="add" aria-hidden="true" style="padding: 2px 3px; cursor:pointer;"></i>
                                        <input class="form-control d-none" type="file" name="imgs[]" id="files-input-hidden" accept="image/*" multiple>
                                    </div>
                                    <div class="card-body imgs-container w-100 overflow-y-auto" style="height: 795px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
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
    <script src="/DES/perrera-ec2/app/views/js/changeJaulaValues.js"></script>
    <script src="/DES/perrera-ec2/app/views/js/imgs-record.js"></script>
    <!-- 
        <script>
            $(document).ready(function() {
                $("#aviso").modal("show");
            });
        </script>

    
    

    <script>
        function close_modal() {
            $("#aviso").modal("hide");
        }
    </script> -->
</body>

</html>