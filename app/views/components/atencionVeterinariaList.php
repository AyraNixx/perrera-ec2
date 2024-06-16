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
                $html_var .= "<tr>";
                $html_var .= "<td class='sticky-column' id='showRegister' value='" . $show_data["id"] . "'> <a href='?id=" . $show_data["id"] . "&action=show_register'>" . $show_data["nombre_veterinario"] . ' ' . $show_data["apellidos_veterinario"] . "</a> </td>";
                $html_var .= "<td>" . $show_data["telf_veterinario"] . "</td>";
                $html_var .= "<td>" . $show_data["nombre_clinica"] . "</td>";
                $html_var .= "<td>" . $show_data["nombre_animal"] . "</td>";
                $html_var .= "<td class='ps-4 pe-2'>";
                $html_var .= "<div class='btn-group dropdown d-block' style='position:relative'>";
                $html_var .= "<button type='button' onclick='show_btn_options(event)' id='add' class='button-dropdown rounded' style='padding: .8em;width: 1.3em;height: 1.3em;'>";
                $html_var .= "<i class='fa-solid fa-caret-down text-primary'></i>";
                $html_var .= "</button>";
                $html_var .= "<div class='btn-dropdown-options w-auto position-absolute start-0'>";
                $html_var .= "<ul class='list-unstyled m-0'>";
                $html_var .= "<li>";
                $html_var .= "<a href='../controllers/AtencionVeterinariaC.php?action=show_register&id=" . $show_data["id"] . "'>Ver</a>";
                $html_var .= "</li>";
                $html_var .= "<li>";
                $html_var .= "<a href='../controllers/AtencionVeterinariaC.php?action=sdelete&id=" . $show_data["id"] . "'>Borrar</a>";
                $html_var .= "</li>";
                $html_var .= "</ul>";
                $html_var .= "</div>";
                $html_var .= "</div>";
                $html_var .= "</td>";
                $html_var .= "</tr>";
            }
            ?>

        </tbody>
    </table>
</div>
