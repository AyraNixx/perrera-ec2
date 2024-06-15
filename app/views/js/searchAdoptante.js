$(document).ready(function () {
  $("#duenio_id_text").on("click", open_modal);
  $("#search_duenio_val").on("keyup", function () {
    let value = $(this).val().toLowerCase();
    $("#search_duenio tbody tr").each(function () {
      let secondColumnText = $(this).find("td:eq(1)").text().toLowerCase();
      $(this).toggle(secondColumnText.includes(value));
    });
  });
  $("#send_rows").on("click", get_duenios);
});

function open_modal() {
  $("#search_duenio").modal("show");
  searchDuenioCallBack();
}

function get_duenios() {
  let ids = "";
  let duenio = "";

  $("#search_duenio tbody tr").each(function () {
    if ($(this).find(".duenio-select").prop("checked")) {
      ids = $(this).find(".duenio-select").data("id");
      duenio =
        $(this).find("td:eq(1)").text() + " " + $(this).find("td:eq(2)").text();
      return false;
    }
  });
  if (ids != null) {
    $("#duenio_id_text").val(duenio);
    $("#duenio_id").val(ids);
  } else {
    $("#duenio_id_text").val("");
    $("#duenio_id").val("");
  }
  $("#search_duenio").modal("hide");
}
function searchDuenioCallBack() {
  let selected_id = $("#duenio_id").val();

  $.ajax({
    type: "POST",
    url: "../../app/controllers/DuenioC.php",
    data: {
      action: "search_duenio_modal",
    },
    dataType: "json",
    success: function (res) {
      let rows = "";
      if (Array.isArray(res) && res.length > 0) {
        res.forEach((a) => {
          rows += `
            <tr>
              <td><input type="radio" name="duenio-select" class="duenio-select" value="${a.id}" data-id="${a.id}" data-name="${a.nombre}"></td>
              <td>${a.nombre}</td>
              <td>${a.apellidos}</td>
              <td>${a.NIF}</td>
              <td>${a.correo}</td>
            </tr>`;
        });
      } else {
        rows = '<tr><td colspan="5">No hay registros disponibles</td></tr>';
      }
      $("#search_duenio tbody").empty().html(rows);
    },
    error: function (xhr, status, error) {
      console.error("Error fetching dueño data:", xhr.responseText);
    },
  });
}
