<div class="w-100" style="overflow: auto; max-height:700px;">
    <table id="list-container" class="table table-striped mb-0" style="vertical-align:middle">
        <thead>
            <tr>
                <th style="z-index:301;">
                    <div class="d-flex align-items-center justify-content-space-between">
                        <span>Ubicación</span>
                        <button class="btn btn-link sort-btn p-0" data-field="ubicacion" data-ord="asc">
                            <i class="fas fa-sort"></i>
                        </button>
                    </div>
                </th>
                <th style="z-index:301;">
                    <div class="d-flex align-items-center justify-content-space-between">
                        <span>Especie</span>
                        <button class="btn btn-link sort-btn p-0" data-field="nombre_especie" data-ord="asc">
                            <i class="fas fa-sort"></i>
                        </button>
                    </div>
                </th>
                <th>
                    <span class="d-flex" style="width: max-content;">Tamaño</span>
                </th>
                <th>
                    <span class="d-flex" style="width: max-content;">Ocupada</span>
                </th>
                <th class='text-center'></th>
                <!-- <th class='text-center' colspan="2"></th> -->
            </tr>
        </thead>
        <tbody>
            <?php

            use utils\Constants;

            foreach ($data as $show_data) {
                $url = "JaulaC.php"; //URL destino

                echo "<tr>";
                echo "<td class='sticky-column' id='showRegister' value='" . $show_data["id"] . "'> <a href='?id=" . $show_data["id"] . "&action=show_register'>" . $show_data["ubicacion"] . "</a> </td>";;
                echo "<td>" . $show_data["nombre_especie"] . "</td>";
                echo "<td>" . $show_data["tamanio"] . "</td>";
                echo "<td>" . (($show_data["ocupada"] == '1') ? 'SI' : 'NO') . "</td>";
                echo "<td class='ps-4 pe-2 text-center'>";
            ?>

                <a href=<?= "../controllers/JaulaC.php?action=show_register&id=" . $show_data["id"] ?> class="btn btn-primary text-white btn-sm me-1">Ver</a>
                <a href=<?= "../controllers/JaulaC.php?action=sdelete&id=" . $show_data["id"] ?> class="btn btn-danger text-white btn-sm me-1">Borrar</a>
            <?php
                echo "</td>";
                echo "</tr>";
            }
            ?>

        </tbody>
    </table>
</div>