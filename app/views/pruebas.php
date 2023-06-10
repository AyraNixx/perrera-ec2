<!-- <div class="row show_pages">
    <span class="register-amount">
        Filas por página:
        <select name="amount" id="amount" class="amount">
            <option value="10" selected>10</option>
        </select>
    </span>

    <div class="select-page">
        <button class="previous" value="1">
            <i class="fa-regular fa-angle-left"></i>
        </button>
        <select name="page" id="page">
            <option value="1" selected>1</option>
            <option value="2">2</option>
        </select>
        <span>100</span>
        <button class="next" value="2">
            <i class="fa-regular fa-angle-right"></i>
        </button>
    </div>
</div> -->

<?php



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        td,
        th {
            border: 1px solid black;
            gap: 0;
        }
    </style>
</head>

<body style="font-family: 'Courier New', Courier, monospace;">
    <div class="info-header" style="font-size: .6em; text-align:end">
        <i style="display:inline-block; margin: 1px 0;">¡Patas Arriba!</i><br />
        <i style="display:inline-block; margin: 1px 0;">C/ No existe 3</i><br />
        <i style="display:inline-block; margin: 1px 0;">correo@ejemplo.com</i><br />
        <i style="display:inline-block; margin: 1px 0;">+34 123456789</i>
    </div>
    <h2 style="text-align: center; padding:1em; text-transform:uppercase; letter-spacing:.3em; color:#4e4d4d; ">Perrera - ¡Patas Arriba!</h2>
    <table class="info-animal" style="width: 100%; border-collapse:collapse; font-family:'Courier New', Courier, monospace; font-size:.8em" cellspacing=0>
        <tbody>
            <tr>
                <td colspan="7" style="background: #ccc; padding:3px 0; text-transform:uppercase; font-size:.9em; letter-spacing:.2em; font-weight:bolder;">Datos del animal</td>
            </tr>
            <tr>
                <td style="background:#f3f3f3;">Id</td>
                <td>12345678</td>
                <td colspan="3" style="background:#f3f3f3;">Nombre</td>
                <td>Max</td>
            </tr>
            <tr>
                <td style="background:#f3f3f3;">Fecha de nacimiento</td>
                <td>12/00/2023</td>
                <td style="background:#f3f3f3;">Especie</td>
                <td>Perro</td>
                <td style="background:#f3f3f3;">Raza</td>
                <td>Labrador</td>
            </tr>
            <tr>
                <td style="background:#f3f3f3;">Tamaño</td>
                <td>Mediano</td>
                <td style="background:#f3f3f3;">Peso</td>
                <td>7.5</td>
                <td style="background:#f3f3f3;">Necesidades especiales</td>
                <td>S</td>
            </tr>
            <tr>
                <td colspan="7" style="background: #ccc; padding:3px 0; text-transform:uppercase; font-size:.9em; letter-spacing:.2em; font-weight:bolder;">Otras observaciones</td>
            </tr>
            <tr>
                <td colspan="7">Poner aquí lo que se necesita</td>
            </tr>
        </tbody>
    </table>

    <br>
    <br>
    <br>
    <table style="width: 100%; border-collapse:collapse; font-family:'Courier New', Courier, monospace; font-size:.8em" cellspacing=0>
        <thead>
            <tr>
                <th colspan="5" style="background: #ccc; padding:3px 0; text-transform:uppercase; font-size:.9em; letter-spacing:.2em; font-weight:bolder;">
                    Historial Asistencias
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th style="background: #f3f3f3; padding:3px 0; text-transform:uppercase; font-size:.9em; letter-spacing:.2em; font-weight:bolder;">
                    N.º Asistencia
                </th>
                <th style="background: #f3f3f3; padding:3px 0; text-transform:uppercase; font-size:.9em; letter-spacing:.2em; font-weight:bolder;">
                    Descripción
                </th>
                <th style="background: #f3f3f3; padding:3px 0; text-transform:uppercase; font-size:.9em; letter-spacing:.2em; font-weight:bolder;">
                    Id. Veterinario
                </th>
                <th style="background: #f3f3f3; padding:3px 0; text-transform:uppercase; font-size:.9em; letter-spacing:.2em; font-weight:bolder;">
                    Veterinario
                </th>
                <th style="background: #f3f3f3; padding:3px 0; text-transform:uppercase; font-size:.9em; letter-spacing:.2em; font-weight:bolder;">
                    Fecha asistencia
                </th>
            </tr>
            <tr>
                <td style="text-align: center;">123456789QQQQ</td>
                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus, voluptas.</td>
                <td style="text-align: center;">123456789QQQQ</td>
                <td>Prueba Apellido 1</td>
                <td style="text-align: center;">12/12/2012</td>
            </tr>
            <tr>
                <td style="text-align: center;">123456789QQQQ</td>
                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus, voluptas.</td>
                <td style="text-align: center;">123456789QQQQ</td>
                <td>Prueba Apellido 1</td>
                <td style="text-align: center;">12/12/2012</td>
            </tr>
            <tr>
                <td style="text-align: center;">123456789QQQQ</td>
                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus, voluptas.</td>
                <td style="text-align: center;">123456789QQQQ</td>
                <td>Prueba Apellido 1</td>
                <td style="text-align: center;">12/12/2012</td>
            </tr>
            <tr>
                <td style="text-align: center;">123456789QQQQ</td>
                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus, voluptas.</td>
                <td style="text-align: center;">123456789QQQQ</td>
                <td>Prueba Apellido 1</td>
                <td style="text-align: center;">12/12/2012</td>
            </tr>
            <tr>
                <td style="text-align: center;">123456789QQQQ</td>
                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus, voluptas.</td>
                <td style="text-align: center;">123456789QQQQ</td>
                <td>Prueba Apellido 1</td>
                <td style="text-align: center;">12/12/2012</td>
            </tr>
            <tr>
                <td style="text-align: center;">123456789QQQQ</td>
                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus, voluptas.</td>
                <td style="text-align: center;">123456789QQQQ</td>
                <td>Prueba Apellido 1</td>
                <td style="text-align: center;">12/12/2012</td>
            </tr>
        </tbody>
    </table>

    <div>
        <div class="info-header" style="font-size: .6em; text-align:end">
            <i style="display:inline-block; margin: 1px 0;">Nombre Clínica</i><br />
            <i style="display:inline-block; margin: 1px 0;">Dirección clínica</i><br />
            <i style="display:inline-block; margin: 1px 0;">Nombre Veterinario/i><br />
                <i style="display:inline-block; margin: 1px 0;">Tlf. Veterinario</i>
        </div>
        <div>
            <h2>INFORME VETERINARIO [NOMBRE DEL ANIMAL] Y [FECHA]</h2>
            <div class="content-pdf">
                <p><i style="text-decoration: underline;">Reseña</i>: Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur at reiciendis accusantium magni eos iure debitis ducimus atque accusamus sapiente.</p>
            </div>
            <div class="content-pdf">
                <p><i style="text-decoration: underline;">Anamnesis</i>: Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur at reiciendis accusantium magni eos iure debitis ducimus atque accusamus sapiente.</p>
            </div>
            <div class="content-pdf">
                <p><i style="text-decoration: underline;">Reseña</i>: Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur at reiciendis accusantium magni eos iure debitis ducimus atque accusamus sapiente.</p>
            </div>
            <div class="content-pdf">
                <p><i style="text-decoration: underline;">Reseña</i>: Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur at reiciendis accusantium magni eos iure debitis ducimus atque accusamus sapiente.</p>
            </div>
            <div class="content-pdf">
                <p><i style="text-decoration: underline;">Reseña</i>: Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur at reiciendis accusantium magni eos iure debitis ducimus atque accusamus sapiente.</p>
            </div>
        </div>
    </div>


</body>

</html>