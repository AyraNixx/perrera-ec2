<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= ($action == 1) ? "Añadir nuevo animal" : "Editar animal" ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/8d125d2b91.js" crossorigin="anonymous"></script>
</head>

<body>
    <div>
        <form action="../controllers/AnimalC.php" method="POST" style="display:flex; flex-direction:column">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="<?= ($action == 1) ? "" : $update["nombre"] ?>">

            <label for="especies_id">Especie</label>
            <select name="especies_id" id="especies_id">
                <option <?= ($action == 1) ? "selected" : "" ?>>Seleccionar especie</option>
                <?php
                foreach ($data_especies as $especie) {
                    echo "<option value='" . $especie["id"] . "'" . (($action == 2 && $update["especies_id"] == $especie["id"]) ? "selected" : "") . ">" . $especie["nombre"] . "</option>";
                }
                ?>
            </select>

            <label for="raza">Raza</label>
            <input type="text" name="raza" id="raza" value="<?= ($action == 1) ? "" : $update["raza"] ?>">

            <label for="genero">Género</label>
            <select name="genero" id="genero">
                <option <?= ($action == 1) ? "selected" : "" ?>>Seleccionar género</option>
                <option value="M" <?= ($action == 2 && $update["genero"] == "M") ? "selected" : "" ?>>M</option>
                <option value="H" <?= ($action == 2 && $update["genero"] == "H") ? "selected" : "" ?>>H</option>
            </select>

            <label for="tamanio">Tamaño</label>
            <select name="tamanio" id="tamanio">
                <option <?= ($action == 1) ? "selected" : "" ?>>Seleccionar tamaño</option>
                <option value="Cachorro" <?= ($action == 2 && $update["tamanio"] == "Cachorro") ? "selected" : "" ?>>Cachorro</option>
                <option value="Pequenio" <?= ($action == 2 && $update["tamanio"] == "Pequenio") ? "selected" : "" ?>>Pequeño</option>
                <option value="Mediano" <?= ($action == 2 && $update["tamanio"] == "Mediano") ? "selected" : "" ?>>Mediano</option>
                <option value="Grande" <?= ($action == 2 && $update["tamanio"] == "Grande") ? "selected" : "" ?>>Grande</option>
            </select>

            <label for="peso">Peso</label>
            <input type="text" name="peso" id="peso" value="<?= ($action == 1) ? "" : $update["peso"] ?>">

            <label for="colores">Colores</label>
            <select name="colores[]" id="colores" multiple>
                <option <?= ($action == 1) ? "selected" : "" ?>>Seleccionar color</option>
                <option>------------</option>
                <option value="Negro" <?= ($action == 2 && in_array("Negro", explode(",", $update["colores"]))) ? "selected" : "" ?>>Negro</option>
                <option value="Blanco" <?= ($action == 2 && in_array("Blanco", explode(",", $update["colores"]))) ? "selected" : "" ?>>Blanco</option>
                <option value="Marron" <?= ($action == 2 && in_array("Marron", explode(",", $update["colores"]))) ? "selected" : "" ?>>Marrón</option>
                <option value="Otros" <?= ($action == 2 && in_array("Otros", explode(",", $update["colores"]))) ? "selected" : "" ?>>Otros. Especificar en comentarios</option>
            </select>


            <label for="personalidad">Personalidad</label>
            <select name="personalidad[]" id="personalidad" multiple>
                <option <?= ($action == 1) ? "selected" : "" ?>>Seleccionar personalidad</option>
                <option>------------</option>
                <option value="Amoroso" <?= ($action == 2 && in_array("Amoroso", explode(",", $update["personalidad"]))) ? "selected" : "" ?>>Amoroso</option>
                <option value="Curioso" <?= ($action == 2 && in_array("Curioso", explode(",", $update["personalidad"]))) ? "selected" : "" ?>>Curioso</option>
                <option value="Energetico" <?= ($action == 2 && in_array("Energetico", explode(",", $update["personalidad"]))) ? "selected" : "" ?>>Energético</option>
                <option value="Independiente" <?= ($action == 2 && in_array("Independiente", explode(",", $update["personalidad"]))) ? "selected" : "" ?>>Independiente</option>
                <option value="Inteligente" <?= ($action == 2 && in_array("Inteligente", explode(",", $update["personalidad"]))) ? "selected" : "" ?>>Inteligente</option>
                <option value="Jugueton" <?= ($action == 2 && in_array("Jugueton", explode(",", $update["personalidad"]))) ? "selected" : "" ?>>Juguetón</option>
                <option value="Protector" <?= ($action == 2 && in_array("Protector", explode(",", $update["personalidad"]))) ? "selected" : "" ?>>Protector</option>
                <option value="Sociable" <?= ($action == 2 && in_array("Sociable", explode(",", $update["personalidad"]))) ? "selected" : "" ?>>Sociable</option>
                <option value="Timido" <?= ($action == 2 && in_array("Timido", explode(",", $update["personalidad"]))) ? "selected" : "" ?>>Tímido</option>
                <option value="Tranquilo" <?= ($action == 2 && in_array("Tranquilo", explode(",", $update["personalidad"]))) ? "selected" : "" ?>>Tranquilo</option>
                <option value="Otros" <?= ($action == 2 && in_array("Otros", explode(",", $update["personalidad"]))) ? "selected" : "" ?>>Otros. Especificar en comentarios</option>
            </select>


            <label for="fech_nac">Fecha de nacimiento</label>
            <input type="date" name="fech_nac" id="fech_nac" value="<?= ($action == 1) ? "" : $update["fech_nac"] ?>">

            <label for="estado_adopcion">Estado adopción</label>
            <select name="estado_adopcion" id="estado_adopcion">
                <option <?= ($action == 1) ? "selected" : "" ?>>Seleccionar estado</option>
                <option>------------</option>
                <option value="Disponible" <?= ($action == 2 && $update["estado_adopcion"] == "Disponible") ? "selected" : "" ?>>Disponible</option>
                <option value="Adoptado" <?= ($action == 2 && $update["estado_adopcion"] == "Adoptado") ? "selected" : "" ?>>Adoptado</option>
                <option value="En_proceso" <?= ($action == 2 && $update["estado_adopcion"] == "En_proceso") ? "selected" : "" ?>>En proceso</option>
                <option value="Reservado" <?= ($action == 2 && $update["estado_adopcion"] == "Reservado") ? "selected" : "" ?>>Reservado</option>
                <option value="Pendiente" <?= ($action == 2 && $update["estado_adopcion"] == "Pendiente") ? "selected" : "" ?>>Pendiente</option>
                <option value="Devuelto" <?= ($action == 2 && $update["estado_adopcion"] == "Devuelto") ? "selected" : "" ?>>Devuelto</option>
            </select>

            <label for="estado_salud">Estado salud</label>
            <select name="estado_salud" id="estado_salud">
                <option <?= ($action == 1) ? "selected" : "" ?>>Seleccionar estado</option>
                <option>------------</option>
                <option value="Control_veterinario" <?= ($action == 2 && $update["estado_salud"] == "Control_veterinario") ? "selected" : "" ?>>Control veterinario</option>
                <option value="Enfermo" <?= ($action == 2 && $update["estado_salud"] == "Enfermo") ? "selected" : "" ?>>Enfermo</option>
                <option value="Recuperacion" <?= ($action == 2 && $update["estado_salud"] == "Recuperacion") ? "selected" : "" ?>>Recuperación</option>
                <option value="Saludable" <?= ($action == 2 && $update["estado_salud"] == "Saludable") ? "selected" : "" ?>>Saludable</option>
            </select>

            <label for="necesidades_especiales">Necesidades especiales</label>
            <select name="necesidades_especiales" id="necesidades_especiales">
                <option <?= ($action == 1) ? "selected" : "" ?>>¿Requiere necesidades especiales?</option>
                <option value="S" <?= ($action == 2 && $update["necesidades_especiales"] == "S") ? "selected" : "" ?>>Si</option>
                <option value="N" <?= ($action == 2 && $update["necesidades_especiales"] == "N") ? "selected" : "" ?>>No</option>
            </select>

            <label for="otras_observaciones">Otras observaciones</label>
            <textarea name="otras_observaciones" id="otras_observaciones" cols="30" rows="10">
            <?= ($action == 1) ? "" : $update["otras_observaciones"] ?>
            </textarea>

            <label for="jaulas_id">Jaulas disponibles</label>
            <select name="jaulas_id" id="jaulas_id">
                <option <?= ($action == 1) ? "selected" : "" ?>>Seleccionar jaula</option>
                <?php
                if (isset($update["jaulas_id"])) {
                    echo "<input type='hidden' id='cage_selected' name='cage_selected' value='" . $update["jaulas_id"] . "'>";
                }
                ?>
            </select>
            <?php

            if ($action == 2) {
                echo "<input type='hidden' id='id' name='id' value='" . $update["id"] . "'>";
            }
            ?>

            <button type="submit" name="action" value="<?= ($action == 1) ? "add" : "update" ?>">Enviar</button>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../views/js/changeJaulaValues.js"></script>
</body>

</html>