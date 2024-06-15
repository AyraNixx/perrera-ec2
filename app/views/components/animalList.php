<div class="w-100" style="overflow: auto; max-height:700px;">
    <table id="list-container" class="table table-striped mb-0" style="vertical-align:middle">
        <thead>
            <tr>
                <th style="width:12em; z-index:301;">
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
                $url = "AnimalC.php"; //URL destino

                echo "<tr>";
                echo "<td class='sticky-column' id='showRegister' value='" . $show_data["id"] . "'> <a href='?id=" . $show_data["id"] . "&action=show_register'>" . $show_data["nombre"] . "</a> </td>";;
                echo "<td>" . $show_data["nombre_especie"] . "</td>";
                echo "<td>" . $show_data["raza"] . "</td>";
                echo "<td>" . $show_data["fech_nac"] . "</td>";
                echo "<td style='white-space:normal'>" . $show_data["estado_adopcion"] . "</td>";
                echo "<td>" . $show_data["ubicacion"] . "</td>";
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
                            <a href=<?="../controllers/AnimalC.php?action=show_register&id=". $show_data["id"]?>>Ver</a>
                            </li>
                            <li>
                            <a href=<?="../controllers/AnimalC.php?action=update_modal&id=". $show_data["id"]?>>Editar</a>
                            </li>
                            <li>
                                <a href=<?="../controllers/AnimalC.php?action=sdelete&id=". $show_data["id"]?>>Borrar</a>                                
                            </li>                                                       
                            <?php
                                if($_SESSION["rol"] == Constants::ROL_ADMIN && $show_data["disponible"] == '0'){
                            ?>
                            <li>
                                <a href=<?="../controllers/AnimalC.php?action=undelete&id=". $show_data["id"]?>>Recuperar registro</a>                                
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