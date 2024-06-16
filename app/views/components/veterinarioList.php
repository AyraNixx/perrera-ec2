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
                <th style="z-index:301;">
                    <div class="d-flex align-items-center justify-content-space-between">
                        <span>Apellidos</span>
                        <button class="btn btn-link sort-btn p-0" data-field="apellidos" data-ord="asc">
                            <i class="fas fa-sort"></i>
                        </button>
                    </div>
                </th>
                <th style="z-index:301;">
                    <div class="d-flex align-items-center justify-content-space-between">
                        <span>Email</span>
                        <button class="btn btn-link sort-btn p-0" data-field="correo" data-ord="asc">
                            <i class="fas fa-sort"></i>
                        </button>
                    </div>
                </th>
                <th style="z-index:301;">
                    <div class="d-flex align-items-center justify-content-space-between">
                        <span>Clínica</span>
                        <button class="btn btn-link sort-btn p-0" data-field="nombre_clinica" data-ord="asc">
                            <i class="fas fa-sort"></i>
                        </button>
                    </div>
                </th>
                <th style="z-index:301;"><span>Horario</span></th>
                <th>
                    <div class="d-flex align-items-center justify-content-space-between">
                        <span style="width: max-content;">ELIMINADO</span>
                        <button class="btn btn-link sort-btn p-0" data-field="disponible" data-ord="asc">
                            <i class="fas fa-sort"></i>
                        </button>
                    </div>
                </th>

                <th class='text-center'></th>
                <!-- <th class='text-center' colspan="2"></th> -->
            </tr>
        </thead>
        <tbody>

            <?php

            //Recorremos el array data

            use utils\Constants;

            foreach ($data as $show_data) {
                $url = "VeterinarioC.php"; //URL destino

                echo "<tr>";
                echo "<td class='sticky-column' id='showRegister' value='" . $show_data["id"] . "'> <a href='?id=" . $show_data["id"] . "&action=show_register'>" . $show_data["nombre"] . "</a> </td>";;
                echo "<td>" . $show_data["apellidos"] . "</td>";
                echo "<td>" . $show_data["correo"] . "</td>";
                echo "<td>" . $show_data["nombre_clinica"] . "</td>";
                echo "<td>" . $show_data["hora_apertura"] . " - " . $show_data["hora_cierre"] . "</td>";
                echo "<td>" . (($show_data["disponible"] == '0') ? 'SI' : 'NO') . "</td>";
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
                            <a href=<?="../controllers/VeterinarioC.php?action=show_register&id=". $show_data["id"]?>>Ver</a>
                            </li>
                            <li>
                            <a href=<?="../controllers/VeterinarioC.php?action=update_modal&id=". $show_data["id"]?>>Editar</a>
                            </li>
                            <li>
                                <a href=<?="../controllers/VeterinarioC.php?action=sdelete&id=". $show_data["id"]?>>Borrar</a>                                
                            </li>                                                       
                            <?php
                                if($_SESSION["rol"] == Constants::ROL_ADMIN && $show_data["disponible"] == '0'){
                            ?>
                            <li>
                                <a href=<?="../controllers/VeterinarioC.php?action=undelete&id=". $show_data["id"]?>>Recuperar registro</a>                                
                            </li>
                            <?php } ?>
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