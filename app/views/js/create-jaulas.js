$(document).ready(function () {
  $("#insert").on("show.bs.modal", function () {
    generate_species();
  });
  $('select[name="especies_id"]').on("change", generate_area);
  $('input[type="checkbox"]').on("change", change_checkbox);
});

function generate_area() {
  $("#size_dog_div").hide();
  const letter_cage = $('select[name="especies_id"]')
    .find("option:selected")
    .text();
  // console.log(letter_cage);
  switch (letter_cage) {
    case "Perro":
      show_dogs_size();
      $("#size_dog")
        .on("change", function () {
          let size_dog_val = $(this).find("option:selected").text();
          switch (size_dog_val) {
            case "Cachorro":
              update_cage_info("A");
              break;
            case "Pequeño":
              update_cage_info("B");
              break;
            case "Mediano":
              update_cage_info("C");
              break;
            case "Grande":
              update_cage_info("D");
              break;
            default:
              update_cage_info("C");
          }
        })
        .trigger("change");
      break;
    case "Gato":
      hide_dogs_size();
      update_cage_info("E");
      break;
    case "Conejo":
      hide_dogs_size();
      update_cage_info("F");
      break;
    case "Pájaro":
      hide_dogs_size();
      update_cage_info("G");
      break;
    case "Otros":
      hide_dogs_size();
      update_cage_info("H");
      break;
    default:
      hide_dogs_size();
      // Si se crea una nueva jaula para una especie nueva, por defecto se pondrá en el área H
      update_cage_info("H");
      break;
  }
}

function generate_species() {
  let data = {
    controller: "EspecieC.php",
    action: "generate_species_sel",
  };
  generateCallback(data);
}

function generate_dog_letters() {
  const size_dog_sel = $("#size_dog");
  size_dog_sel.empty();
  $('<select id="size_dog"></select>').appendTo("");
  $("<option value='A' selected>Cachorro</option>").appendTo(size_dog_sel);
  $("<option value='B'>Pequeño</option>").appendTo(size_dog_sel);
  $("<option value='C'>Mediano</option>").appendTo(size_dog_sel);
  $("<option value='D'>Grande</option>").appendTo(size_dog_sel);
  show_dogs_size();
}

function show_dogs_size() {
  $("#size_dog_div").show();
  $("#especies_id").parent().removeClass("col-12").addClass("col-4");
}

function hide_dogs_size() {
  $("#size_dog_div").hide();
  $("#especies_id").parent().removeClass("col-4").addClass("col-12");
}

function generateCallback(data) {
  $.ajax({
    type: "POST",
    url: `../../app/controllers/${data.controller}`,
    data: data,
    dataType: "json",
    success: function (res) {
      $(
        '<option value="" disabled selected>Seleccionar especie</option>'
      ).appendTo($('select[name="especies_id"]'));
      $('select[name="especies_id"]').empty();
      res.forEach((e) => {
        let option = $("<option>", {
          value: e.id,
          text: e.nombre,
        }).appendTo($('select[name="especies_id"]'));
      });
      generate_dog_letters();
      $("#letter_cage").val($("#size_dog").val());
      update_cage_info($("#size_dog").val());
    },
    error: function (xhr, status, error) {
      console.error("Error al obtener los datos de la especie:", error);
    },
  });
}

function change_checkbox(e) {
  if ($(this).is(":checked")) {
    $(this).val(1);
  } else {
    $(this).val(0);
  }
}

function update_cage_info(l) {
  $.ajax({
    type: "POST",
    url: `../../app/controllers/JaulaC.php`,
    data: { letter_cage: l, action: "get_last_cage_number" },
    dataType: "json",
    success: function (res) {
      $("#letter_cage").val(l);
      $("#area_num").val(res[0].ultimo_num);
      $('input[type="hidden"][name="ubicacion"]').val(l + "-" + res[0].ultimo_num);
    },
    error: function (xhr, status, error) {
      console.error("Error al obtener el número de la jaula:", error);
    },
  });
}
