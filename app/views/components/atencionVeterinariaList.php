<div class="w-100" style="overflow: auto; max-height:700px;">
    <table id="list-container" class="table table-striped mb-0" style="vertical-align:middle">
        <thead>
            <tr>
                <th style="z-index:301;">
                    <div class="d-flex align-items-center justify-content-space-between">
                        <span>Nombre Veterinario</span>
                        <button class="btn btn-link sort-btn p-0" data-field="nombre_veterinario" data-ord="asc">
                            <i class="fas fa-sort"></i>
                        </button>
                    </div>
                </th>
                <th style="z-index:301;">
                    <div class="d-flex align-items-center justify-content-space-between">
                        <span>Teléfono Veterinario</span>
                        <button class="btn btn-link sort-btn p-0" data-field="telf_veterinario" data-ord="asc">
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
                <th style="z-index:301;">
                    <div class="d-flex align-items-center justify-content-space-between">
                        <span>Nombre Animal</span>
                        <button class="btn btn-link sort-btn p-0" data-field="nombre_animal" data-ord="asc">
                            <i class="fas fa-sort"></i>
                        </button>
                    </div>
                </th>
                <th class="text-center"></th>
            </tr>
        </thead>
        <tbody>

            <?php

            use utils\Constants;

            // Recorremos el array data y concatenamos el HTML generado dinámicamente
            foreach ($data as $show_data) {
                $url = "AtencionVeterinariaC.php"; // URL destino

                // Concatenamos el HTML generado dinámicamente
                echo "<tr>";
                echo "<td class='sticky-column' id='showRegister' value='" . $show_data["id"] . "'> <a href='?id=" . $show_data["id"] . "&action=show_register'>" . $show_data["nombre_veterinario"] . ' ' . $show_data["apellidos_veterinario"] . "</a> </td>";
                echo "<td>" . $show_data["telf_veterinario"] . "</td>";
                echo "<td>" . $show_data["nombre_clinica"] . "</td>";
                echo "<td>" . $show_data["nombre_animal"] . "</td>";
                echo "<td class='ps-4 pe-2'>";
            ?>
                <a href=<?= "../controllers/AtencionVeterinariaC.php?action=show_register&id=" . $show_data["id"] ?> class="btn btn-primary text-white btn-sm me-1">Ver</a>
                <a href=<?= "../controllers/AtencionVeterinariaC.php?action=sdelete&id=" . $show_data["id"] ?> class="btn btn-danger text-white btn-sm me-1">Borrar</a>
            <?php
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>