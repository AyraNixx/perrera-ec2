$(function(){
  let id = $("#especie").val();

  let id_jaula = $("#cage_selected").val();

  $.ajax({
    url: '../../app/controllers/AnimalC.php', // url destino
    // Datos que vamos a pasarle
    data: 
    {
      'action': 'show_cages',
      'especies_id': id
    },
    type: 'POST', // timpo de petición 
    // dataType: 'json',         
    // Si todo ha ido bien
    success: function (data) {
      let data_array = JSON.parse(data); // Pasamos de JSON a Array

      $("#jaula").empty(); // Vaciamos el select de jaula

      // Recorremos el array
      $.each(data_array, function (key, value) {

        // Creamos los nuevos options
        let new_option = $("<option>")
          .val(value.id)
          .text(value.ubicacion)
          .appendTo("#jaula"); // Añadimos los options al select jaula

          if (value.id == id_jaula) 
          {
            new_option.prop("selected", true);
          }

      });
    }
  });
});

$("#especie").change(function () {

  let id = $(this).val();

  $.ajax({
    url: '../../app/controllers/AnimalC.php', // url destino
    // Datos que vamos a pasarle
    data: 
    {
      'action': 'show_cages',
      'especies_id': id
    },
    type: 'POST', // timpo de petición 
    // dataType: 'json',         
    // Si todo ha ido bien
    success: function (data) {
      let data_array = JSON.parse(data); // Pasamos de JSON a Array

      $("#jaula").empty(); // Vaciamos el select de jaula

      // Recorremos el array
      $.each(data_array, function (key, value) {

        // Creamos los nuevos options
        let new_option = $("<option>")
          .val(value.id)
          .text(value.ubicacion)
          .appendTo("#jaula"); // Añadimos los options al select jaula

      });
    }
  });
});