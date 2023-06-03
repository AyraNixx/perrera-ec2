<div class="header-list">
    <div class="list-filter"></div>
</div>

<table id="list-container" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th class='text-center'>Nombre</th>
            <th class='text-center'>Especie</th>
            <th class='text-center'>Raza</th>
            <th class='text-center'>Fecha de nacimiento</th>
            <th class='text-center'>Estado adopción</th>
            <th class='text-center'>Jaula</th>
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
            echo "<td class='p-0 text-center'>";
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>