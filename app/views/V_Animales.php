<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/8d125d2b91.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container mt-5">
        <!-- MODAL -->
        <div id="aviso" class="modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Aviso</h5>
                        <button type="button" class="btn-close" id="cerrarModalBtn" aria-label="Close" data-bs-dismiss="modal" onclick="close_modal();"></button>
                    </div>
                    <div class="modal-body">
                        <p><?= $new_msg ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-wrapper">
            <div class="table-tittle">
                <div class="row">
                    <div class="col-sm-8">
                        <h2><b>PRUEBA: ANIMALES</b></h2>
                    </div>
                    <div class="col-sm-4 text-end">
                        <form action="../../app/controllers/AnimalC.php" method="POST">
                            <button name="action" value="add_or_update" class="btn btn-success add-new">
                                Añadir
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <table class="table table-striped">
                <thead class="table-dark text-center">
                    <tr>
                        <!-- Si $this->ord es ASC, tendrá la clase desc, si NO lo es, la clase será ASC -->
                        <!-- Se puede mejorar pero ya si eso en otra vida porque yo no puedo más -->
                        <th scope="col">Nombre</th>
                        <th scope="col">Especie</th>
                        <th scope="col">Raza</th>
                        <th scope="col">Género</th>
                        <th scope="col">Tamaño</th>
                        <th scope="col">Peso</th>
                        <th scope="col">Colores</th>
                        <th scope="col">Personalidad</th>
                        <th scope="col">Fecha de nacimiento</th>
                        <th scope="col">Estado adopción</th>
                        <th scope="col">Estado salud</th>
                        <th scope="col">Necesidades especiales</th>
                        <th scope="col">Otras observaciones</th>
                        <th scope="col">Jaula</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //Recorremos el array data
                    foreach ($data_visible as $dato) {

                        //Url destino
                        $url = "AnimalC.php";

                        echo "<tr>";
                        //Mostramos los datos de cada elemento
                        //Llamamos a la funcion details para mostrar más datos del elemento seleccionado
                        echo "<td class='text-center'>" . $dato["nombre"] . "</td>";
                        echo "<td class='text-center'>" . $dato["nombre_especie"] . "</td>";
                        echo "<td class='text-center'>" . $dato["raza"] . "</td>";
                        echo "<td class='text-center'>" . $dato["genero"] . "</td>";
                        echo "<td class='text-center'>" . $dato["tamanio"] . "</td>";
                        echo "<td class='text-center'>" . $dato["peso"] . "</td>";
                        echo "<td class='text-center'>" . $dato["colores"] . "</td>";
                        echo "<td class='text-center'>" . $dato["personalidad"] . "</td>";
                        echo "<td class='text-center'>" . $dato["fech_nac"] . "</td>";
                        echo "<td class='text-center'>" . $dato["estado_adopcion"] . "</td>";
                        echo "<td class='text-center'>" . $dato["estado_salud"] . "</td>";
                        echo "<td class='text-center'>" . $dato["necesidades_especiales"] . "</td>";
                        echo "<td class='text-center'>" . $dato["otras_observaciones"] . "</td>";
                        echo "<td class='text-center'>" . $dato["ubicacion"] . "</td>";
                        echo "<td class='p-0 text-center'>";
                    ?>
                        <!-- Creamos dos botones para modificar o eliminar y pasamos los datos con input hidden -->
                        <form action="<?= $url ?>" method="POST" class="d-inline-block" enctype="multipart/form-data">
                            <input type="hidden" name="id" value='<?= $dato["id"] ?>'>
                            <input type="hidden" name="nombre" value='<?= $dato["nombre"] ?>'>
                            <input type="hidden" name="especie" value='<?= $dato["especies_id"] ?>'>
                            <input type="hidden" name="raza" value='<?= $dato["raza"] ?>'>
                            <input type="hidden" name="genero" value='<?= $dato["genero"] ?>'>
                            <input type="hidden" name="tamanio" value='<?= $dato["tamanio"] ?>'>
                            <input type="hidden" name="peso" value='<?= $dato["peso"] ?>'>
                            <input type="hidden" name="colores" value='<?= $dato["colores"] ?>'>
                            <input type="hidden" name="personalidad" value='<?= $dato["personalidad"] ?>'>
                            <input type="hidden" name="fech_nac" value='<?= $dato["fech_nac"] ?>'>
                            <input type="hidden" name="estado_adopcion" value='<?= $dato["estado_adopcion"] ?>'>
                            <input type="hidden" name="estado_salud" value='<?= $dato["estado_salud"] ?>'>
                            <input type="hidden" name="necesidades_especiales" value='<?= $dato["necesidades_especiales"] ?>'>
                            <input type="hidden" name="otras_observaciones" value='<?= $dato["otras_observaciones"] ?>'>
                            <input type="hidden" name="jaula" value='<?= $dato["jaulas_id"] ?>'>                            
                            <button value="add_or_update" name="action" class="mt-2 border-0 bg-transparent text-warning">
                                <i class="fa-solid fa-marker"></i>
                            </button>
                        </form>

                        <i class="text-muted">|</i>

                        <form action="<?= $url ?>" method="POST" class="d-inline-block">
                            <input type="hidden" name="id" value="<?= $dato["id"] ?>">
                            <button value="sdelete" name="action" class="mt-2 border-0 bg-transparent text-danger">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    <?php
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <div id="info_content">
            </div>
        </div>
    </div>
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
</body>

</html>