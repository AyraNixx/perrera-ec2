<div class="w-100" style="overflow: auto; max-height:700px;">
    <table id="list-container" class="table table-striped mb-0" style="vertical-align:middle">
        <thead>
            <tr>
                <th style="width:12em; z-index:10000;">
                    <div class="d-flex align-items-center justify-content-between">
                        <span>Nombre</span>
                        <button class="btn btn-link sort-btn p-0" data-field="nombre" data-ord="asc">
                            <i class="fas fa-sort"></i>
                        </button>
                    </div>
                </th>
                <th>
                    <div class="d-flex align-items-center justify-content-between">
                        <span>Especie</span>
                        <button class="btn btn-link sort-btn p-0" data-field="nombre_especie" data-ord="asc">
                            <i class="fas fa-sort"></i>
                        </button>
                    </div>
                </th>
                <th>
                    <div class="d-flex align-items-center justify-content-between">
                        <span>Raza</span>
                        <button class="btn btn-link sort-btn p-0" data-field="raza" data-ord="asc">
                            <i class="fas fa-sort"></i>
                        </button>
                    </div>
                </th>
                <th>
                    <div class="d-flex align-items-center justify-content-between">
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

                <th></th>
                <!-- <th colspan="2"></th> -->
            </tr>
        </thead>
        <tbody>

            <?php

            //Recorremos el array data
            foreach ($data as $show_data) {
                $url = "AnimalC.php"; //URL destino

                echo "<tr>";
                echo "<td id='showRegister' value='" . $show_data["id"] . "'>" . $show_data["nombre"] . "</td>";
                echo "<td>" . $show_data["nombre_especie"] . "</td>";
                echo "<td>" . $show_data["raza"] . "</td>";
                echo "<td>" . $show_data["fech_nac"] . "</td>";
                echo "<td>" . $show_data["estado_adopcion"] . "</td>";
                echo "<td>" . $show_data["ubicacion"] . "</td>";
                echo "<td class='ps-4 pe-2'>";
            ?>
                <div class="btn-group dropdown d-block" style="position:relative">
                    <button type="button" onclick="show_btn_options(event)" id="add" class="button-dropdown rounded" style="padding: .8em;width: 1.3em;height: 1.3em;">
                        <i class="fa-solid fa-caret-down text-primary"></i>
                    </button>
                    <div class="btn-dropdown-options w-auto position-absolute start-0">
                        <ul class="list-unstyled m-0">
                            <li>
                                Editar
                            </li>
                            <li>
                                Borrar
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