<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animales</title>
    <link rel="shortcut icon" href="../../public/imgs/logos/logo1.png" type="image/x-icon">
    <script src="https://kit.fontawesome.com/8d125d2b91.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../views/css/sass.css">
    <style>
        .circle-container {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            width: 150px;
            height: 150px;

            border-radius: 50%;

            font-weight: 800;
        }

        .small-btn {
            display: flex;
            justify-content: center;
            align-items: center;

            height: 1.4rem;
            width: 1.4rem;

        }

        .small-btn:hover,
        .small-btn:active {
            border-radius: 8%;
            box-shadow: 1px 1px 1px #dddddd;
        }

        .small-btn:hover {
            background: #efefef;
        }

        .small-btn:active {
            background-color: #dddddd;
        }

        .px-sm-3 {
            padding-right: 0 !important;
            padding-left: 0 !important;

        }

        /*
        .alrt-chat-msg{
            background-color: #efefef;
            
            margin: 1.5em 0 1em;
            padding: 1em;

            position:relative;
            
            font-size: .7em;

            border-radius: .5em;
            box-shadow: 6px .3em .2em 0 rgb(100 100 100 / 20%);
        }

        .alrt-chat-msg::before{
            content: '';

            border-top: none ;
            border-left: 1em solid transparent;
            border-right: 1em solid transparent;
            border-bottom: 9px solid #efefef;   
            
            position: absolute;
            bottom: 100%;
        }                                                    
        
        
        DIV DE EJEMPLO PARA ESTA CLASE --> <div class="alrt-chat-msg text-primary"></div>
*/

        @media (max-width: 768px) {
            .px-sm-3 {
                padding-right: 1rem !important;
                padding-left: 1rem !important;
            }

        }
    </style>
</head>

<body>
    <!-- MENU -->
    <?php include_once "../views/components/menu.php"; ?>

    <!-- CONTENIDO -->
    <section id="content">

        <!-- MODAL -->
        <?php include_once "../views/components/modalAlert.php"; ?>

        <!-- MODAL PARA CAMBIAR CONTRASEÑA -->
        <?php include_once "../views/components/changePsswd.php"; ?>

        <!-- HEADER -->
        <?php include_once "../views/components/header.php"; ?>


        <!-- CONTENEDOR PRINCIPAL -->
        <main class="mx-4 mt-5">

            <div class="row align-items-center h-100 justify-content-center">
                <div class="col-lg-11 col-sm-12">
                    <div class="row h-100 w-100 pt-5">
                        <h1 class="h2 text-primary pb-4">Ajustes de perfil</h1>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-sm-12 p-0">
                            <div class="col-12 p-3 px-5 text-center">
                                <div class="circle-container border border-2 border-primary text-primary bg-primary-subtle h4">
                                    <?= "PMH" ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-sm-10 p-0 mx-auto profile-settings">
                            <!-- ADD ACTION AND METHOD -->
                            <div class="d-flex justify-content-between align-items-end">
                                <h5 class="text-uppercase text-primary h5">Ajustes del perfil</h5>
                                <div class="d-flex mb-1 p-0 text-primary" style="font-size:.8em">
                                    <div class="small-btn">
                                        <i class="fa-regular fa-pen-to-square" onclick="edit_form_profile(event)"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="login border border-1 border-primary-subtle rounded py-3">
                                <div class="form-group col-12 px-sm-3 profile-not-edit">
                                    <div class="row m-0 px-md-3">

                                        <div class="col-sm-12 col-md-3">
                                            <h5 class="h5 pb-1 text-uppercase text-primary" style="font-size:.9rem">Nombre</h5>
                                        </div>
                                        <div class="col-sm-12 col-md-9 d-flex align-items-center">
                                            <p class="form-control px-3 border border-1 border-primary-subtle rounded bg-transparent" style="font-size: .8rem;"><?= $data['nombre'] ?></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row m-0 px-md-3">

                                        <div class="col-sm-12 col-md-3">
                                            <h5 class="h5 pb-1 text-uppercase text-primary" style="font-size:.9rem">Apellidos</h5>
                                        </div>
                                        <div class="col-sm-12 col-md-9">
                                            <p class="form-control px-3 border border-1 border-primary-subtle rounded bg-transparent" style="font-size: .8rem;"><?= $data['apellidos'] ?></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row m-0 px-md-3">

                                        <div class="col-sm-12 col-md-3">
                                            <h5 class="h5 pb-1 text-uppercase text-primary" style="font-size:.9rem">Fecha de Nacimiento</h5>
                                        </div>
                                        <div class="col-sm-12 col-md-9">
                                            <p class="form-control px-3 border border-1 border-primary-subtle rounded bg-transparent" style="font-size: .8rem;">30/00/1900 </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-12 profile-edit" style="display:none;">
                                    <form class="col-12" action="../controllers/SettingsC.php" method="POST">
                                        <div class="form-group col-md-11 col-sm-12 mx-auto px-sm-3">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-3">
                                                    <h5 class="h5 pb-1 text-uppercase text-primary" style="font-size:.9rem">Nombre</h5>
                                                </div>
                                                <div class="col-sm-12 col-md-9 d-flex align-items-center">
                                                    <label for="name" hidden></label>
                                                    <input type="text" class="form-control px-3 border border-1 border-primary-subtle rounded bg-transparent" style="font-size: .8rem;" name="name" id="name" value="<?= $data['nombre'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group col-md-11 col-sm-12 mx-auto px-sm-3">
                                            <div class="row">

                                                <div class="col-sm-12 col-md-3">
                                                    <h5 class="h5 pb-1 text-uppercase text-primary" style="font-size:.9rem">Apellidos</h5>
                                                </div>
                                                <div class="col-sm-12 col-md-9">
                                                    <label for="lname" hidden></label>
                                                    <input type="text" class="form-control px-3 border border-1 border-primary-subtle rounded bg-transparent" style="font-size: .8rem;" name="lname" id="lname" value=<?= $data['apellidos'] ?>>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group col-md-11 col-sm-12 mx-auto px-sm-3">
                                            <div class="row">

                                                <div class="col-sm-12 col-md-3">
                                                    <h5 class="h5 pb-1 text-uppercase text-primary" style="font-size:.9rem">Fecha de Nacimiento</h5>
                                                </div>
                                                <div class="col-sm-12 col-md-9">
                                                    <label for="fechnac" hidden></label>
                                                    <input type="date" class="form-control px-3 border border-1 border-primary-subtle rounded bg-transparent" style="font-size: .8rem;" name="fechnac" id="fechnac" value="1900-01-01">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="d-inline-flex align-items-center justify-content-center w-100 my-3">
                                            <input type="submit" value="Guardar" name="edit" class="py-1 w-25 text-white border-0 me-2 bg-secondary" style="border-radius:3px; font-size:.9em;" disabled>
                                            <button class="py-1 w-25 bg-primary text-white border-0" style="border-radius:3px; font-size:.9em;" onclick="edit_form_profile(event)">Cancelar</button>
                                        </div>
                                    </form>

                                </div>
                            </div>

                            <h5 class="text-uppercase text-primary h5 pt-5">Datos de Contacto</h5>
                            <div class="login border border-1 border-primary-subtle rounded py-3 px-sm-3">
                                <div class="form-group col-md-11 col-sm-12 mx-auto px-sm-3">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-3">
                                            <h5 class="h5 pb-1 text-uppercase text-primary" style="font-size:.9rem">Email</h5>
                                        </div>
                                        <div class="col-sm-12 col-md-9 not-edit">
                                            <div class="col-12 d-flex align-items-center">
                                                <p input_type="email" class="hide-str form-control p-0 border-0 " style="font-size: .8rem;"><?= $data['correo'] ?></p>
                                                <div class="d-flex mb-3 px-2 text-primary" style="font-size:.8em">
                                                    <div class="me-2 ms-1 small-btn">
                                                        <i class="fa-regular fa-eye show-text"></i>
                                                    </div>
                                                    <div class="small-btn">
                                                        <i class="fa-regular fa-pen-to-square" onclick="edit_privacy_info(event)"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <p class="m-0" style="font-size: .7rem;">Correo electrónico vinculado a la cuenta</p>
                                        </div>
                                        <div class="col-sm-12 col-md-9 edit" style="display: none;">
                                            <form class="col-12" action="../controllers/SettingsC.php" method="POST">
                                                <div class="form-group">
                                                    <input type="email" class="hide-str form-control px-3 border border-1 border-primary-subtle rounded bg-transparent" style="font-size: .8rem;" value="<?= $data['correo'] ?>" name="new_email" id="new_email" title="Correo no válido" required />
                                                    <label for="new_email" class="border-light fw-bold text-primary" style="font-size: .8em;">Confirma tu nueva dirección de correo</label>
                                                </div>
                                                <div class="form-group">
                                                    <input type="email" class="hide-str form-control px-3 mt-3 border border-1 border-primary-subtle rounded bg-transparent" style="font-size: .8rem;" value="<?= $data['correo'] ?>" name="new_email2" id="new_email2" title="Correo no válido" required />
                                                    <div class="alrt-chat-msg text-primary"></div>
                                                    <label for="new_email2" class="border-light" style="font-size: .8em;"><span class="fw-bold text-primary">Verifica</span> el correo introducido</label>
                                                </div>
                                                <p class="m-0 my-1 text-info" style="font-size: .65rem;">Correo electrónico vinculado a la cuenta</p>
                                                <div class="d-inline-flex align-items-center justify-content-center w-100 my-3">
                                                    <button type="submit" name="action" value="CHANGE_EMAIL" class="py-1 w-50 bg-secondary text-white border-0 me-2" style="border-radius:3px; font-size:.9em;" disabled>Guardar</button>
                                                    <button class="py-1 w-50 bg-primary text-white border-0" style="border-radius:3px; font-size:.9em;" onclick="edit_privacy_info(event)">Cancelar</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group col-md-11 col-sm-12 mx-auto px-sm-3">
                                    <div class="row">

                                        <div class="col-sm-12 col-md-3">
                                            <h5 class="h5 pb-1 text-uppercase text-primary" style="font-size:.9rem">Número de teléfono</h5>
                                        </div>
                                        <div class="col-sm-12 col-md-9 not-edit">
                                            <div class="col-12 d-flex align-items-center">
                                                <p input_type="tlf" class="hide-str form-control p-0 border-0" style="font-size: .8rem;">000000000</p>
                                                <div class="d-flex mb-3 px-2 text-primary" style="font-size:.8em">
                                                    <div class="me-2 ms-1 small-btn">
                                                        <i class="fa-regular fa-eye show-text"></i>
                                                    </div>
                                                    <div class="small-btn">
                                                        <i class="fa-regular fa-pen-to-square" onclick="edit_privacy_info(event)"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="m-0" style="font-size: .7rem;">Número de teléfono vinculado a la cuenta</p>
                                        </div>
                                        <div class="col-sm-12 col-md-9 edit" style="display: none;">
                                            <form class="col-12" action="../controllers/SettingsC.php" method="POST">
                                                <label for="tlf" class="border-light fw-bold text-primary" style="font-size: .8em;" hidden></label>
                                                <input type="tel" class="hide-str form-control px-3 border border-1 border-primary-subtle rounded bg-transparent" style="font-size: .8rem;" value="000000000" name="tlf" id="tlf" />
                                                <div class="d-inline-flex align-items-center justify-content-center w-100 my-3">
                                                    <input type="submit" value="Guardar" name="edit" class="py-1 w-50 bg-secondary text-white border-0 me-2" style="border-radius:3px; font-size:.9em;" disabled />
                                                    <button class="py-1 w-50 bg-primary text-white border-0" style="border-radius:3px; font-size:.9em;" onclick="edit_privacy_info(event)">Cancelar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h5 class="text-uppercase text-primary h5 pt-5">Seguridad de la cuenta</h5>
                            <div class="login border border-1 border-primary-subtle rounded py-3 px-sm-3 mb-4">
                                <div class="form-group mt-1 col-md-11 col-sm-12 mx-auto px-sm-3">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-3">
                                            <h5 class="h5 pb-1 text-uppercase text-primary" style="font-size:.9rem" input_type="psswd">Contraseña</h5>
                                        </div>
                                        <div class="col-sm-12 col-md-9">
                                            <p class="mb-0 pt-0" style="font-size: .7rem;"><span class="text-secondary" style="cursor:pointer;" data-toggle="modal" data-target="#change_psswd">Modificar contraseña.</span> Mejora la seguridad de tu cuenta con una contraseña segura.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>

    </section>
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <?php
    if ($new_msg != null) { ?>

        <script>
            $(document).ready(function() {
                $("#aviso").modal("show");
            });
        </script>
    <?php
    }
    ?>

    <script>
        function close_modal() {
            $("#aviso").modal("hide");
        }
    </script>
    <script src="../views/js/Utils.js"></script>


    <script src="../views/js/widthMenu.js"></script>
</body>

</html>