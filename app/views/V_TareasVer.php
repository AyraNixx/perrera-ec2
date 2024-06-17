<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tareas</title>
    <link rel="shortcut icon" href="../../public/imgs/logos/logo1.png" type="image/x-icon">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css'>
    <script src="https://kit.fontawesome.com/8d125d2b91.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="../views/css/sass.css">
</head>

<body>
    <!-- MENU -->
    <?php include_once "../views/components/menu.php"; ?>

    <!-- CONTENIDO -->
    <section id="content">

        <!-- MODAL -->
        <?php include_once "../views/components/modalAlert.php"; ?>

        <!-- MODAL TAREA -->
        <?php include_once "../views/components/insertTarea.php"; ?>

        <!-- HEADER -->
        <?php include_once "../views/components/header.php"; ?>


        <!-- CONTENEDOR PRINCIPAL -->
        <main class="mx-4 mt-5 mb-5">
            <br/>
            <!-- Split dropup button -->
            <div class="mb-4 w-100 bg-secondary bg-opacity-75 " style="border-radius:5px;">
                <div class="button-option-container d-flex justify-content-between align-content-center w-100 bg-primary p-3">
                    <h1 style="font-size: x-large;" class="pt-2 text-secondary text-uppercase font-weight-light mb-0 d-inline" data-controller="TareaC.php">
                        <i class="fa-solid fa-paw"></i>
                        TAREA
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
                        <h5 class="text-primary" style="font-weight:600; text-transform:uppercase; font-size: .8em">Asunto</h5>
                        <p style="font-size: .8em"><?= $data['asunto'] ?></p>
                    </div>
                    <div>
                        <h5 class="text-primary" style="font-weight:600; text-transform:uppercase; font-size: .8em">Descripción</h5>
                        <p style="font-size: .8em"><?= $data['descripcion'] ?></p>
                    </div>
                </div>
            </div>
            <!-- partial:index.partial.html -->
            <nav class="nav nav-tabs w-100" id="tab" role="tablist">
                <a class="nav-item nav-link border-bottom-0 active" data-toggle="tab" role="tab" aria-selected="true" aria-controls="nav-details" href="#details">Detalles</a>
            </nav>

            <div class="tab-content w-100 border border-1 border-primary-subtle border-top-0" id="tabcontent" style="height:900px;">
                <div class="tab-pane fade show active h-100" id="details" role="tabpanel" aria-labelledby="details-tab">
                    <form action="../controllers/TareaC.php" method="POST" class="d-inline-flex flex-column justify-content-between h-100 w-100 p-0 form-register">
                        <div role="tablist" class="p-3">
                            <div class="row" id="infoEspecie-show">
                                <div class="col-md-12 col-lg-6 mb-4">
                                    <div class="card" role="tab" style="position: unset;">
                                        <div class="card-header bg-primary" id="info" data-toggle="collapse" href="#info-show" aria-expanded="true" aria-controls="infoEspecie-show">
                                            <h5 class="d-inline-flex align-items-center text-secondary"><i class="fa-solid fa-dog text-secondary"></i>&nbsp;&nbsp;Información de la Tarea</h5>
                                        </div>

                                        <div class="collapse show" role="tabpanel" aria-labelledby="info" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <label for="asunto" class="col-12 text-primary">Asunto</label>
                                                        <input type="text" name="asunto" id="asunto" class="form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3" value="<?= $data['asunto'] ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="row px-2">
                                                    <label for="descripcion" class="col-12 p-2 ps-0 ms-0">Descripción</label>
                                                    <textarea name="descripcion" id="descripcion" class="form-textarea rounded border-dark-subtle" cols="30" rows="10" style="resize: none; box-shadow:none;" readonly><?= $data['descripcion'] ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br />
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>

    <script src="/DES/perrera-ec2/app/views/js/Utils.js"></script>
    <script src="/DES/perrera-ec2/app/views/js/widthMenu.js"></script>
    <script src="/DES/perrera-ec2/app/views/js/btns-record-page.js"></script>
</body>

</html>