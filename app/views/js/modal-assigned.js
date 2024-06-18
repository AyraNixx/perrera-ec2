let modal_origin = "";
$(document).ready(function () {
  if (controller_val == "VoluntarioC.php") {
    $("#voluntarios_id").val(id_page);
    $("#assigned_to").val(
      $('#details input[name="nombre"]').val() +
        " " +
        $('#details input[name="apellidos"]').val()
    );
  } else if (controller_val == "EmpleadoC.php") {
    $("#empleados_id").val(id_page);
    $("#assigned_to").val(
      $('#details input[name="nombre"]').val() +
        " " +
        $('#details input[name="apellidos"]').val()
    );
  }
  $("#assigned_to").on("click", open_assigned_modal);
  $("[data-action='change_assigned_to']").on("click", function () {
    modal_origin = "change_assigned_to";
    open_assigned_modal();
  });
  $("#icon-select").on("change", open_assigned_modal);
  $("#assigned_modal #send_rows").on("click", save_value);
  $("#assigned_sel").on("change", function () {
    let icon_sel = $("#icon-select").val();
    let assigned_id = $("#assigned_sel").val();

    if (icon_sel === "empleado") {
      $("#empleados_id").val(assigned_id);
      $("#voluntarios_id").val(null);
    } else if (icon_sel === "voluntario") {
      $("#voluntarios_id").val(assigned_id);
      $("#empleados_id").val(null);
    }
  });

  $("#tareas_id1").on("change", function () {
    $("#asunto").val($("#tareas_id1").text());
  });

  if ($("#jaulas_id").length) {
    generate_options_select("jaulas_id", "JaulaC.php", [
      "id",
      "ubicacion",
      "nombre_especie",
    ]);
  }

  if ($("#tareas_id1").length) {
    generate_options_select("tareas_id1", "TareaC.php", [
      "id",
      "asunto",
      "descripcion",
    ]);
  }
});

function open_assigned_modal() {
  $("#assigned_modal").modal("show");
  get_people();
}

function close_modal() {
  $("#aviso").modal("hide");
}

function save_value() {
  let val = $("#assigned_sel").val();
  let text = $("#assigned_sel").find("option:selected").text();
  let icon_select_val = $("#icon-select").val();

  if (icon_select_val === "empleado") {
    $("#assigned_to").val(text);
    $('input[name="empleados_id"]').val(val);
    $('input[name="voluntarios_id"]').val(null);
  } else if (icon_select_val === "voluntario") {
    $("#assigned_to").val(text);
    $('input[name="voluntarios_id"]').val(val);
    $('input[name="empleados_id"]').val(null);
  }

  if (modal_origin === "change_assigned_to") {
    $.ajax({
      type: "POST",
      url: "../../app/controllers/AsignarTareasC.php",
      data: {
        action: "change_assigned_to",
        id: id_page,
        empleados_id: $('input[name="empleados_id"]').val(),
        voluntarios_id: $('input[name="voluntarios_id"]').val(),
      },
      dataType: "json",
      success: function (res) {
        let msg = "";
        $("#list_empleado").empty();
        $("#list_voluntario").empty();

        if (res.success) {
          msg = res.msg;
          console.log(res);

          if (res.empleado && res.empleado.length > 0) {
            let empleado = res.empleado[0];
            $("#list_empleado").append(
              `<input type="hidden" name="empleados_id" id="empleados_id" value="${empleado.id}">`
            );
            $("#list_empleado").append(
              `<div class='card-body' style='max-height:350px; overflow-y:auto;' id='list_empleado'>
                <div class='row mb-2'>
                <div class='col-8'>
                <span class='d-block'><strong class='text-primary'>Nombre: </strong>${empleado.nombre} ${empleado.apellidos}</span>
                </div>
                <div class='col-4 align-self-center text-end'>
                   <a href="../controllers/VoluntarioC.php?action=show_register&id=${empleado.id}" class="btn btn-primary btn-sm">Ver</a>
                     </div>
                </div>
              </div>`
            );
          } else {
            $("#list_empleado").append(
              `<div class='card-body' style='max-height:350px; overflow-y:auto;' id='list_empleado'>
                <div class='p-2 pb-1 text-center'>
                  <p>Tarea no asignada a un voluntario.</p>
                </div>
              </div>`
            );
          }

          $("#list_voluntario").empty();
          if (res.voluntario && res.voluntario.length > 0) {
            let voluntario = res.voluntario[0];
            $("#list_voluntario").append(
              `<input type="hidden" name="voluntarios_id" id="voluntarios_id" value="${voluntario.id}">`
            );
            $("#list_voluntario").append(
              `<div class="card-body" style="max-height:350px; overflow-y:auto;">
                    <div class="row mb-2">
                      <div class="col-8">
                        <span class="d-block"><strong class="text-primary">Nombre: </strong>${voluntario.nombre} ${voluntario.apellidos}</span>
                      </div>
                      <div class="col-4 align-self-center text-end">
                        <a href="../controllers/VoluntarioC.php?action=show_register&id=${voluntario.id}" class="btn btn-primary btn-sm">Ver</a>
                      </div>
                    </div>
                  </div>`
            );
          } else {
            $("#list_voluntario").append(
              `<div class="card-body" style="max-height:350px; overflow-y:auto;">
                    <div class="p-2 pb-1 text-center">
                      <p>No hay voluntario asignado</p>
                    </div>
                  </div>`
            );
          }
        } else {
          msg = res.msg;
        }

        $("#aviso .modal-body")
          .empty()
          .append("<p>" + msg + "</p>");
        $("#aviso").modal("show");
      },
      error: function (xhr, status, error) {
        console.error("Error: ", xhr.responseText);
      },
    });
  }

  $("#assigned_modal").modal("hide");
}

function get_people() {
  let icon_sel = $("#icon-select").val();
  let controller =
    icon_sel === "empleado" ? "EmpleadoC.php" : "VoluntarioC.php";

  $.ajax({
    type: "POST",
    url: `../../app/controllers/${controller}`,
    data: {
      action: "get_rows_availables",
    },
    dataType: "json",
    success: function (res) {
      let s = $("#assigned_sel");
      s.empty();
      res.forEach((r) => {
        let option = $("<option></option>")
          .val(r.id)
          .text(r.nombre + " " + r.apellidos)
          .attr("data-tokens", r.nombre + " " + r.apellidos);

        s.append(option);
      });

      let assigned_id =
        icon_sel === "empleado"
          ? $('input[name="empleados_id"]').val()
          : $('input[name="voluntarios_id"]').val();
      $("#assigned_sel").val(assigned_id);

      s.selectpicker("refresh");
    },
    error: function (xhr, status) {
      console.error("Error fetching data:", xhr.responseText);
    },
  });
}

function generate_options_select(sname, c, fields) {
  $.ajax({
    type: "POST",
    url: `../../app/controllers/${c}`,
    data: {
      action: "get_rows_availables",
    },
    dataType: "json",
    success: function (res) {
      console.log(res);
      let s = $(`select#${sname}`);
      s.empty();
      res.forEach((r) => {
        let option = $("<option></option>")
          .val(r[fields[0]])
          .text(`${r[fields[1]]} - ${r[fields[2]]}`) // Ajustar según los campos recibidos
          .attr("data-tokens", `${r[fields[1]]} ${r[fields[2]]}`);

        s.append(option);
      });

      // Actualizar la vista del selectpicker después de agregar las opciones
      s.selectpicker("refresh");
    },
    error: function (xhr, status, error) {
      console.error(`Error fetching ${sname} data:`, xhr.responseText);
    },
  });
}
