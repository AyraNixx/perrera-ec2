<div class="w-100" style="overflow: auto; max-height:700px;">
    <table id="list-container" class="table table-striped mb-0" style="vertical-align:middle">
        <thead>
            <tr>
                <th style="z-index:301;">
                    <div class="d-flex align-items-center justify-content-space-between">
                        <span>Asunto</span>
                        <button class="btn btn-link sort-btn p-0" data-field="asunto" data-ord="asc">
                            <i class="fas fa-sort"></i>
                        </button>
                    </div>
                </th>
                <th style="z-index:301;">
                    <div class="d-flex align-items-center justify-content-space-between">
                        <span>Estado</span>
                        <button class="btn btn-link sort-btn p-0" data-field="estado_asignacion" data-ord="asc">
                            <i class="fas fa-sort"></i>
                        </button>
                    </div>
                </th>
                <th style="z-index:301;">
                    <div class="d-flex align-items-center justify-content-space-between">
                        <span>Prioridad</span>
                        <button class="btn btn-link sort-btn p-0" data-field="prioridad" data-ord="asc">
                            <i class="fas fa-sort"></i>
                        </button>
                    </div>
                </th>
                <th style="z-index:301;">
                    <div class="d-flex align-items-center justify-content-space-between">
                        <span>Empleado</span>
                        <button class="btn btn-link sort-btn p-0" data-field="nombre_empleado" data-ord="asc">
                            <i class="fas fa-sort"></i>
                        </button>
                    </div>
                </th>
                <th style="z-index:301;">
                    <div class="d-flex align-items-center justify-content-space-between">
                        <span>Voluntario</span>
                        <button class="btn btn-link sort-btn p-0" data-field="nombre_voluntario" data-ord="asc">
                            <i class="fas fa-sort"></i>
                        </button>
                    </div>
                </th>
                <th class='text-center'> Fech. finalización</th>
                <th class='text-center'></th>
            </tr>
        </thead>
        <tbody>

            <?php

            //Recorremos el array data

            foreach ($data as $show_data) {
                $url = "AsignarTareasC.php"; //URL destino

                echo "<tr>";
                echo "<td class='sticky-column' id='showRegister' value='" . $show_data["id"] . "'> <a href='?id=" . $show_data["id"] . "&action=show_register'>" . $show_data["asunto"] . "</a> </td>";;
                echo "<td>" . $show_data["estado_asignacion"] . "</td>";
                echo "<td>" . $show_data["prioridad"] . "</td>";
                echo "<td><a href='../controllers/EmpleadoC.php?id=" . $show_data["empleados_id"] . "&action=show_register'>" . $show_data["nombre_empleado"] . "</a></td>";
                echo "<td><a href='../controllers/VoluntarioC.php?id=" . $show_data["voluntarios_id"] . "&action=show_register'>" . $show_data["nombre_voluntario"] . "</a></td>";                
                echo "<td>" . $show_data["fecha_finalizacion"] . "</td>";
                echo "<td class='ps-4 pe-2'>";
            ?>
                <a href=<?= "../controllers/AsignarTareasC.php?action=show_register&id=" . $show_data["id"] ?> class="btn btn-primary text-white btn-sm me-1">Ver</a>
                <a href=<?= "../controllers/AsignarTareasC.php?action=sdelete&id=" . $show_data["id"] ?> class="btn btn-danger text-white btn-sm me-1">Borrar</a>

            <?php
                echo "</td>";
                echo "</tr>";
            }
            ?>

        </tbody>
    </table>
</div>