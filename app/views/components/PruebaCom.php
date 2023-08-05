<div class="w-100" style="overflow: auto;">

    <table id="list-container" class="table table-striped" style="width:100%; vertical-align:middle">
        <thead>
            <tr>
                <th class='text-center sorting' col="Nombre" ord="asc">
                    <div class="d-flex align-items-end justify-content-center">
                        <span>Nombre</span>
                        <button class="btn btn-link sort-btn p-0">
                            <i class="fas fa-sort"></i>
                        </button>
                    </div>
                </th>
                <th class='text-center sorting' col="Especie" ord="asc">
                    <div class="d-flex align-items-end justify-content-center">
                        <span>Especie</span>
                        <button class="btn btn-link sort-btn p-0">
                            <i class="fas fa-sort"></i>
                        </button>
                    </div>
                </th>
                <th class='text-center sorting' col="Raza" ord="asc">
                    <div class="d-flex align-items-end justify-content-center">
                        <span>Raza</span>
                        <button class="btn btn-link sort-btn p-0">
                            <i class="fas fa-sort"></i>
                        </button>
                    </div>
                </th>
                <th class='text-center sorting' col="Fechnac" ord="asc">
                    <div class="d-flex align-items-end justify-content-center">
                        <span>Fecha de nacimiento</span>
                        <button class="btn btn-link sort-btn p-0">
                            <i class="fas fa-sort"></i>
                        </button>
                    </div>
                </th>
                <th class='text-center sorting' col="EstadoAdp" ord="asc">Estado adopción</th>
                <th class='text-center sorting' col="Jaula" ord="asc">Jaula</th>
                <th class='text-center' colspan="2"></th>
            </tr>
        </thead>
        <tbody>

            <?php

            //Recorremos el array data
            foreach ($show_data as $data) {
                $url = "AnimalC.php"; //URL destino

                echo "<tr>";
                echo "<td class='text-center sticky-column' id='showRegister' value='" . $data["id"] . "'>" . $data["nombre"] . "</td>";
                echo "<td class='text-center'>" . $data["nombre_especie"] . "</td>";
                echo "<td class='text-center'>" . $data["raza"] . "</td>";
                echo "<td class='text-center'>" . $data["fech_nac"] . "</td>";
                echo "<td class='text-center'>" . $data["estado_adopcion"] . "</td>";
                echo "<td class='text-center'>" . $data["ubicacion"] . "</td>";
                echo "<td class='ps-4 pe-2'>";
            ?>
                <form action="<?= $url ?>" method="post" class="p-0">
                    <input type="hidden" name="id" value="<?= $data["id"] ?>">
                    <button value="add_or_update" name="action" class="bord-0 bg-transparent text-success">
                        <i class="fa-solid fa-marker"></i>
                    </button>
                </form>
                <?php
                echo "</td>";
                echo "<td>|</td>";
                echo "<td class='ps-2 pe-4'>";
                ?>
                <form action="<?= $url ?>" method="POST" class="p-0">
                    <input type="hidden" name="id" value="<?= $data["id"] ?>">
                    <button value="sdelete" name="action" class="bord-0 bg-transparent text-danger">
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
</div>