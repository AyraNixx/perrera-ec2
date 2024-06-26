<div class="w-100" style="overflow: auto; max-height:700px;">
    <table id="list-container" class="table table-striped mb-0" style="vertical-align:middle">
        <thead>
            <tr>
                <th style="z-index:301;">
                    <div class="d-flex align-items-center justify-content-space-between">
                        <span>Nombre</span>
                        <button class="btn btn-link sort-btn p-0" data-field="nombre" data-ord="asc">
                            <i class="fas fa-sort"></i>
                        </button>
                    </div>
                </th>
                <th>
                    <div class="d-flex align-items-center justify-content-space-between">
                        <span>Especie</span>
                        <button class="btn btn-link sort-btn p-0" data-field="nombre_especie" data-ord="asc">
                            <i class="fas fa-sort"></i>
                        </button>
                    </div>
                </th>
                <th>
                    <div class="d-flex align-items-center justify-content-space-between">
                        <span>Raza</span>
                        <button class="btn btn-link sort-btn p-0" data-field="raza" data-ord="asc">
                            <i class="fas fa-sort"></i>
                        </button>
                    </div>
                </th>
                <th>
                    <div class="d-flex align-items-center justify-content-space-between">
                        <span style="width: max-content;">Fecha de nacimiento</span>
                        <button class="btn btn-link sort-btn p-0" data-field="fech_nac" data-ord="asc">
                            <i class="fas fa-sort"></i>
                        </button>
                    </div>
                </th>
                <th>
                    <span class="d-flex" style="width: max-content;">Estado adopción</span>
                </th>
                <th>Jaula</th>

                <th class='text-center'></th>
                <!-- <th class='text-center' colspan="2"></th> -->
            </tr>
        </thead>
        <tbody>

            <?php

            //Recorremos el array data

            use utils\Constants;

            foreach ($data as $show_data) {
                $url = "AnimalC.php"; //URL destino

                echo "<tr>";
                echo "<td class='sticky-column' id='showRegister' value='" . $show_data["id"] . "'> <a href='?id=" . $show_data["id"] . "&action=show_register'>" . $show_data["nombre"] . "</a> </td>";;
                echo "<td>" . $show_data["nombre_especie"] . "</td>";
                echo "<td>" . $show_data["raza"] . "</td>";
                echo "<td>" . $show_data["fech_nac"] . "</td>";
                echo "<td style='white-space:normal'>" . $show_data["estado_adopcion"] . "</td>";
                echo "<td>" . $show_data["ubicacion"] . "</td>";
                echo "<td class='ps-4 pe-2'>";
            ?>

                <a href=<?= "../controllers/AnimalC.php?action=show_register&id=" . $show_data["id"] ?> class="btn btn-primary text-white btn-sm me-1">Ver</a>
                <a href=<?= "../controllers/AnimalC.php?action=sdelete&id=" . $show_data["id"] ?> class="btn btn-danger text-white btn-sm me-1">Borrar</a>

            <?php
                echo "</td>";
                echo "</tr>";
            }
            ?>

        </tbody>
    </table>
</div>