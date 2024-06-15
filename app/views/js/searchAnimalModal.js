// let controller_val = $("[data-controller]").attr("data-controller");
// let url_params = new URLSearchParams(window.location.search);
// let id_page = url_params.has("id") ? url_params.get("id") : false;
let modal_origin = null;
let msg = null;
let error = null;
let get_list = false;

$(document).ready(function () {
  $("#animals_selected").on("click", function () {
    modal_origin = "animals_selected";
    open_modal();
  });
  $("#animals_list_add").on("click", function () {
    modal_origin = "animals_list_add";
    msg = "Registro añadido con éxito";
    error = "No se ha podido añadir el registro";
    open_modal();
  });
  $(document).on("click", "a[data-list_animal]", function () {
    modal_origin = "animals_list_add";
    msg = "Registro borrado con éxito";
    error = "No se ha podido borrar el registro";
    delete_animal_from_list($(this).attr("data-list_animal"));
  });

  $("#search_animal_val").on("keyup", function () {
    let value = $(this).val().toLowerCase();
    $("#search_animal tbody tr").each(function () {
      let secondColumnText = $(this).find("td:eq(1)").text().toLowerCase();
      $(this).toggle(secondColumnText.includes(value));
    });
  });
  $("#send_rows").on("click", get_animals);
});

function open_modal() {
  $("#search_animal").modal("show");
  searchAnimalCallBack();
}

function close_modal() {
  $("#aviso").modal("hide");
}

function get_animals() {
  let ids = [];
  let i = 0;
  $("#search_animal tbody tr").each(function () {
    if ($(this).find(".animal-select").prop("checked")) {
      ids.push($(this).find(".animal-select").data("id"));
      i += 1;
    }
  });

  if (modal_origin == "animals_selected") {
    if (i > 0) {
      $("#animals_selected").val("Se han seleccionado " + i + " animales");
      $("#animales_id").val(ids.join(","));
    } else {
      $("#animals_selected").val("");
      $("#animales_id").val("");
    }
  } else if (modal_origin == "animals_list_add") {
    if (i > 0) {
      let ids_insert = $("#animales_list_register").val(ids.join(","));
      ids_insert = ids_insert.val();
      listAnimalCallBack(ids_insert);
    } else {
      $("#animales_list_register").val("");
    }
  }
  $("#search_animal").modal("hide");
}

function delete_animal_from_list(animal_id) {
  $.ajax({
    type: "POST",
    url: `../../app/controllers/${controller_val}`,
    data: {
      action: "delete_animal_from_list",
      id: id_page,
      animal_id: animal_id,
    },
    dataType: "json",
    success: function (res) {
      if (res) {
        let ids_insert = $("#animales_list_register").val();
        if (ids_insert !== null && ids_insert !== "") {
          let array_ids = ids_insert.split(",");
          array_ids = array_ids.filter((id) => id !== animal_id);
          $("#animales_list_register").val(array_ids.join(","));
        }
        $.ajax({
          type: "POST",
          url: "../../app/controllers/AnimalC.php",
          data: {
            action: "getList_animal",
            controller: controller_val,
            register_id: id_page,
          },
          dataType: "json",
          success: function (res) {
            console.log('res', res);
            let content = "";
            if (res[0].animal_ids != null) {
              let fech;
              let ids = res[0].animal_ids.split(",");
              let name_a = res[0].animal_nombres.split(",");
              let name_e = res[0].nombre_especies.split(",");

              if (
                res[0].hasOwnProperty("fechas_registro") &&
                res[0].fechas_registro
              ) {
                fech = res[0].fechas_registro.split(",");
              }
              ids.forEach((id, i) => {
                content += `
                    <div class='row mb-2'>
                        <div class='col-6'>
                            <span class='d-block'><strong class='text-primary'>Nombre: </strong>${name_a[i]}</span>
                            <span class='d-block'><strong class='text-primary'>Especie: </strong>${name_e[i]}</span>`;
                if (fech != null) {
                  content += `<span class='d-block'><strong class='text-primary'>Fecha de registro: </strong> ${fech[i]}</span>`;
                }
                content += `</div>
                        <div class='col-6 align-self-center text-end'>
                            <a href='../controllers/AnimalC.php?action=show_register&id=${id}' class='btn btn-primary btn-sm'>Ver</a>
                            <a class='ms-2 btn btn-secondary btn-sm' data-list_animal='${id}'>Eliminar</a>
                        </div>
                    </div>`;
                if (i < ids.length - 1) {
                  content += "<hr class='mt-3 text-secondary'>";
                }
              });
              $("#list_animal").empty();
              $("#list_animal").html(content);
              $("#aviso .modal-body")
                .empty()
                .append("<p>" + msg + "</p>");
              $("#aviso").modal("show");
            } else {
              content += `
              <div class='p-4 text-center'>
                  <p>No hay animales asociados</p>
              </div>`;
            }
            $("#list_animal").empty();
            $("#list_animal").html(content);
          },
          error: function (xhr, status, error) {
            console.error("Error fetching animal data:", xhr.responseText);
            $("#aviso .modal-body")
              .empty()
              .append("<p>" + error + "</p>");
            $("#aviso").modal("show");
          },
        });
      }
    },
    error: function (xhr, status, error) {
      console.error("Error fetching animal data:", xhr.responseText);
      $("#aviso .modal-body")
        .empty()
        .append("<p>" + error + "</p>");
      $("#aviso").modal("show");
    },
  });
}

function searchAnimalCallBack() {
  let ids = [];

  if (modal_origin == "animals_selected") {
    if ($("#animales_id").val() != null) {
      ids = $("#animales_id").val().split(",");
    }
  } else if (modal_origin == "animals_list_add") {
    if ($("#animales_list_register").val() != null) {
      ids = $("#animales_list_register").val().split(",");
    }
  }
  $.ajax({
    type: "POST",
    url: "../../app/controllers/AnimalC.php",
    data: {
      action: "search_animal_modal",
      controller: controller_val,
    },
    dataType: "json",
    success: function (res) {
      let rows;
      res.forEach((a) => {
        let check = ids.includes(a.id.toString()) ? "checked" : "";
        rows += `
                <tr>
                    <td><input type="checkbox" class="animal-select" value="${a.id}" data-id="${a.id}" data-name="${a.nombre}" ${check}></td>
                    <td>${a.nombre}</td>
                    <td>${a.especie}</td>
                    <td>${a.jaula}</td>
                </tr>
            `;
      });
      $("#search_animal tbody").empty();
      $("#search_animal tbody").html(rows);
    },
    error: function (xhr, status, error) {
      console.error("Error fetching animal data:", xhr.responseText);
    },
  });
}

function listAnimalCallBack(ids) {
  if (ids != null) {
    $.ajax({
      type: "POST",
      url: "../../app/controllers/AnimalC.php",
      data: {
        action: "getList_animal",
        controller: controller_val,
        register_id: id_page,
        id: ids,
      },
      dataType: "json",
      success: function (res) {
        console.log(res);
        let fech;
        let ids = res[0].animal_ids.split(",");
        let name_a = res[0].animal_nombres.split(",");
        let name_e = res[0].nombre_especies.split(",");
        if (
          res[0].hasOwnProperty("fechas_registro") &&
          res[0].fechas_registro
        ) {
          fech = res[0].fechas_registro.split(",");
        }
        let content = "";
        ids.forEach((id, i) => {
          content += `
              <div class='row mb-2'>
                  <div class='col-6'>
                      <span class='d-block'><strong class='text-primary'>Nombre: </strong>${name_a[i]}</span>
                      <span class='d-block'><strong class='text-primary'>Especie: </strong>${name_e[i]}</span>`;
          if (fech != null) {
            content += `<span class='d-block'><strong class='text-primary'>Fecha de registro: </strong> ${fech[i]}</span>`;
          }
          content += `</div>
                  <div class='col-6 align-self-center text-end'>
                      <a href='../controllers/AnimalC.php?action=show_register&id=${id}' class='btn btn-primary btn-sm'>Ver</a>
                      <a class='ms-2 btn btn-secondary btn-sm' data-list_animal='${id}'>Eliminar</a>
                  </div>
              </div>`;
          if (i < ids.length - 1) {
            content += "<hr class='mt-3 text-secondary'>";
          }
        });

        $("#list_animal").empty();
        $("#list_animal").html(content);
        $("#aviso .modal-body")
          .empty()
          .append("<p>" + msg + "</p>");
        $("#aviso").modal("show");
      },
      error: function (xhr, status) {
        console.error("Error fetching animal data:", xhr.responseText);
        $("#aviso .modal-body")
          .empty()
          .append("<p>" + error + "</p>");
        $("#aviso").modal("show");
      },
    });
  } else {
    $("#aviso .modal-body")
      .empty()
      .append("<p>" + error + "</p>");
    $("#aviso").modal("show");
  }
}
