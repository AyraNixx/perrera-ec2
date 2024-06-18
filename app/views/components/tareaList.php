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
                <th>
                    <span class="d-flex" style="width: max-content;">Descripción</span>
                </th>
                <th class='text-center'></th>
            </tr>
        </thead>
        <tbody>
            <?php

            use utils\Constants;

            foreach ($data as $show_data) {
                $url = "TareaC.php"; //URL destino

                echo "<tr>";
                echo "<td class='sticky-column' id='showRegister' value='" . $show_data["id"] . "'> <a href='?id=" . $show_data["id"] . "&action=show_register'>" . $show_data["asunto"] . "</a> </td>";;
                echo "<td style=>" . $show_data["descripcion"] . "</td>";
                echo "<td class='ps-4 pe-2 text-center'>";
            ?>
                <a href=<?= "../controllers/TareasC.php?action=show_register&id=" . $show_data["id"] ?> class="btn btn-primary text-white btn-sm me-1">Ver</a>
                <a href=<?= "../controllers/TareasC.php?action=sdelete&id=" . $show_data["id"] ?> class="btn btn-danger text-white btn-sm me-1">Borrar</a>
            <?php
                echo "</td>";
                echo "</tr>";
            }
            ?>

        </tbody>
    </table>
</div>