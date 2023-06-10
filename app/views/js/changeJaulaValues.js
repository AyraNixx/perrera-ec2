$(function () {
  let id = $("#especies_id").val();
  let id_jaula = $("#cage_selected").val();

  console.log("heee");

  function cargarJaulas() {
    $.ajax({
      url: '../../app/controllers/AnimalC.php',
      data: {
        'action': 'show_cages',
        'especies_id': id
      },
      type: 'POST',
      dataType: 'json',
      success: function (data) {
        console.log(data);
        $("#jaulas_id").empty();

        $.each(data, function (key, value) {
          let new_option = $("<option>")
            .val(value.id)
            .text(value.ubicacion)
            .appendTo("#jaulas_id");

          if (value.id == id_jaula) {
            new_option.prop("selected", true);
          }
        });
      }
    });
  }

  // Llamada inicial al cargar la página
  cargarJaulas();

  // Evento change para el select #especies_id
  $("#especies_id").change(function () {
    id = $(this).val();
    cargarJaulas();
  });
});
