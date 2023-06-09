<div class="w-100" style="overflow: auto;">

    <table id="list-container" class="table table-striped" style="width:100%; vertical-align:middle">
        <thead>
            <tr>
                <th class='text-center'>Nombre</th>
                <th class='text-center'>Especie</th>
                <th class='text-center'>Raza</th>
                <th class='text-center'>Fecha de nacimiento</th>
                <th class='text-center'>Estado adopción</th>
                <th class='text-center'>Jaula</th>
                <th colspan="2" class='text-center'></th>
            </tr>
        </thead>
        <tbody>
            <?php
            //Recorremos el array data
            foreach ($data_visible as $dato) {
                $url = "AnimalC.php"; //URL destino

                echo "<tr>";
                echo "<td class='text-center sticky-column' id='showRegister' value='" . $dato["id"] . "'>" . $dato["nombre"] . "</td>";
                echo "<td class='text-center'>" . $dato["nombre_especie"] . "</td>";
                echo "<td class='text-center'>" . $dato["raza"] . "</td>";
                echo "<td class='text-center'>" . $dato["fech_nac"] . "</td>";
                echo "<td class='text-center'>" . $dato["estado_adopcion"] . "</td>";
                echo "<td class='text-center'>" . $dato["ubicacion"] . "</td>";
                echo "<td class='ps-4 pe-2'>";
            ?>
                <form action="<?= $url ?>" method="post" class="p-0">
                    <input type="hidden" name="id" value="<?= $dato["id"] ?>">
                    <button value="add_or_update" name="action" class="border-0 bg-transparent text-success">
                        <i class="fa-solid fa-marker"></i>
                    </button>
                </form>
                <?php
                echo "</td>";
                echo "<td>|</td>";
                echo "<td class='ps-2 pe-4'>";
                ?>
                <form action="<?= $url ?>" method="POST" class="p-0">
                    <input type="hidden" name="id" value="<?= $dato["id"] ?>">
                    <button value="sdelete" name="action" class="border-0 bg-transparent text-danger">
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