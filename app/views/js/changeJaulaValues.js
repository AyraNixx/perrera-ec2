$(document).ready(function () {
  $('[name="especies_id"]').on("change", get_cages);
});

function get_cages() {
  let id = $("#especies_id").val();
  console.log(id);
  getCagesCallBack(id);
}

function getCagesCallBack(id) {
  let id_jaula = $("#jaulas_id").val();
  $.ajax({
    url: "../../app/controllers/AnimalC.php",
    data: {
      action: "show_cages",
      especies_id: id,
    },
    type: "POST",
    dataType: "json",
    success: function (data) {
      console.log("data", data);
      $("#jaulas_id").empty();

      console.log(1);
      $.each(data, function (key, value) {
        let new_option = $("<option>")
          .val(value.id)
          .text(value.ubicacion)
          .appendTo("#jaulas_id");

        if (value.id == id_jaula) {
          new_option.prop("selected", true);
        }
      });
      console.log(2);
    },
    error: function (xhr, status, error) {
      console.error("Error al obtener los datos:", error);
    },
  });
}

// $(function () {
//   let id = $("#especies_id").val();
//   let id_jaula = $("#cage_selected").val();

//   function cargarJaulas() {
//     $.ajax({
//       url: '../../app/controllers/AnimalC.php',
//       data: {
//         'action': 'show_cages',
//         'especies_id': id
//       },
//       type: 'POST',
//       dataType: 'json',
//       success: function (data) {
//         $("#jaulas_id").empty();

//         $.each(data, function (key, value) {
//           let new_option = $("<option>")
//             .val(value.id)
//             .text(value.ubicacion)
//             .appendTo("#jaulas_id");

//           if (value.id == id_jaula) {
//             new_option.prop("selected", true);
//           }
//         });
//       },
//       error: function (xhr, status, error) {
//         console.error("Error al obtener los datos:", error);
//       },
//     });
//   }

//   // Llamada inicial al cargar la página
//   cargarJaulas();

//   // Evento change para el select #especies_id
//   $("#especies_id").change(function () {

//     id = $(this).val();
//     console.log(id = $(this).val());
//     cargarJaulas();
//   });
// });
