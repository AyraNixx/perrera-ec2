<div class="w-100" style="overflow: auto; max-height:700px;">
    <table id="list-container" class="table table-striped mb-0" style="vertical-align:middle">
        <thead>
            <tr>
                <th style="width:12em; z-index:301;">
                    <div class="d-flex align-items-center justify-content-space-between">
                        <span>Asunto</span>
                        <button class="btn btn-link sort-btn p-0" data-field="asunto" data-ord="asc">
                            <i class="fas fa-sort"></i>
                        </button>
                    </div>
                </th>
                <th style="width:fit-content; z-index:301;">
                    <div class="d-flex align-items-center justify-content-space-between">
                        <span>Estado</span>
                        <button class="btn btn-link sort-btn p-0" data-field="estado_asignacion" data-ord="asc">
                            <i class="fas fa-sort"></i>
                        </button>
                    </div>
                </th>
                <th style="width:fit-content; z-index:301;">
                    <div class="d-flex align-items-center justify-content-space-between">
                        <span>Prioridad</span>
                        <button class="btn btn-link sort-btn p-0" data-field="prioridad" data-ord="asc">
                            <i class="fas fa-sort"></i>
                        </button>
                    </div>
                </th>
                <th style="width:12em; z-index:301;">
                    <div class="d-flex align-items-center justify-content-space-between">
                        <span>Empleado</span>
                        <button class="btn btn-link sort-btn p-0" data-field="nombre_empleado" data-ord="asc">
                            <i class="fas fa-sort"></i>
                        </button>
                    </div>
                </th>
                <th style="width:fit-content; z-index:301;">
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
                <div class="btn-group dropdown d-block" style="position:relative">
                    <button type="button" onclick="show_btn_options(event)" id="add" class="button-dropdown rounded" style="padding: .8em;width: 1.3em;height: 1.3em;">
                        <i class="fa-solid fa-caret-down text-primary"></i>
                    </button>
                    <!-- <div class="btn-dropdown-options w-100 position-absolute start-0 show-block"> -->
                    <div class="btn-dropdown-options w-auto position-absolute start-0">
                        <ul class="list-unstyled m-0">
                            <li>
                            <a href=<?="../controllers/AsignarTareasC.php?action=show_register&id=". $show_data["id"]?>>Ver</a>
                            </li>
                            <li>
                                <a href=<?="../controllers/AsignarTareasC.php?action=sdelete&id=". $show_data["id"]?>>Borrar</a>                                
                            </li>                                                                           
                        </ul>
                    </div>
                </div>
            <?php
                echo "</td>";
                echo "</tr>";
            }
            ?>

        </tbody>
    </table>
</div>