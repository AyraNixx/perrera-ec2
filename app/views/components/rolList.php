<div class="w-100" style="overflow: auto; max-height:700px;">
    <table id="list-container" class="table table-striped mb-0" style="vertical-align:middle">
        <thead>
            <tr>
                <th style="z-index:301;">
                    <div class="d-flex align-items-center justify-content-space-between">
                        <span>Nombre</span>
                        <button class="btn btn-link sort-btn p-0" data-field="rol" data-ord="asc">
                            <i class="fas fa-sort"></i>
                        </button>
                    </div>
                </th>
                <th>
                    <span class="d-flex" style="width: max-content;">Descripción</span>
                </th>
                <th class='text-center'></th>
                <!-- <th class='text-center' colspan="2"></th> -->
            </tr>
        </thead>
        <tbody>
            <?php

            use utils\Constants;

            foreach ($data as $show_data) {
                $url = "RolC.php"; //URL destino

                echo "<tr>";
                echo "<td class='sticky-column' id='showRegister' value='" . $show_data["id"] . "'> <a href='?id=" . $show_data["id"] . "&action=show_register'>" . $show_data["rol"] . "</a> </td>";;
                echo "<td style=>" . $show_data["descripcion"] . "</td>";
                echo "<td class='ps-4 pe-2 text-center'>";
            ?>
                <div class="btn-group dropdown d-block" style="position:relative">
                    <button type="button" onclick="show_btn_options(event)" id="add" class="button-dropdown rounded" style="padding: .8em;width: 1.3em;height: 1.3em;">
                        <i class="fa-solid fa-caret-down text-primary"></i>
                    </button>
                    <!-- <div class="btn-dropdown-options w-100 position-absolute start-0 show-block"> -->
                    <div class="btn-dropdown-options w-auto position-absolute" style="left:45.7%;">
                        <ul class="list-unstyled m-0">
                            <li>
                                <a href=<?= "../controllers/RolC.php?action=show_register&id=" . $show_data["id"] ?>>Ver</a>
                            </li>
                            <li>
                                <a href=<?= "../controllers/RolC.php?action=sdelete&id=" . $show_data["id"] ?>>Borrar</a>
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