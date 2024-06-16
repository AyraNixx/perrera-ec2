$(document).ready(function () {
  $("#assigned_to").on("click", open_assigned_modal);
  $("#icon-select").on("change", open_assigned_modal);
  $("#assigned_modal #send_rows").on("click", save_value);
  $("#assigned_sel").on("change", function () {
    let icon_sel = $("#icon-select").val();
    let assigned_id = $("#assigned_sel").val();

    if (icon_sel == "empleado") {
      $("#empleados_id").val(assigned_id);
    } else if (icon_sel == "voluntario") {
      $("#voluntarios_id").val(assigned_id);
    }
  });

  $("#tareas_id1").on("change", function () {
    $("#asunto").val($("#tareas_id1").val());
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

function save_value() {
  let val = $("#assigned_sel").val();
  let text = $("#assigned_sel").find("option:selected").text();

  if ($("#icon-select").val() == "empleado") {
    $("#assigned_to").val(text);
    $('input[name="empleados_id"]').val(val);
  } else if ($("#icon-select").val() == "voluntario") {
    $("#assigned_to").val(text);
    $('input[name="voluntarios_id"]').val(val);
  }

  $("#assigned_modal").modal("hide");
}

function get_people() {
  let icon_sel = $("#icon-select").val();
  let controller = icon_sel == "empleado" ? "EmpleadoC.php" : "VoluntarioC.php";

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
        icon_sel == "empleado"
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
