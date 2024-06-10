$(document).ready(function () {
  $("#animals_selected").on("click", open_modal);
  // Al escribir en la barra de búsqueda
  $("#search_animal_val").on("keyup", function () {
    let value = $(this).val().toLowerCase();
    $("#search_animal tbody tr").each(function () {
        let secondColumnText = $(this).find("td:eq(1)").text().toLowerCase();
        $(this).toggle(secondColumnText.includes(value));
    });
  });
  $('#send_rows').on('click', get_animals);

});

function open_modal(){
    $('#search_animal').modal('show');
    searchAnimalCallBack();
}

function get_animals(){
    let ids = [];
    let i = 0;
    $("#search_animal tbody tr").each(function() {
        if ($(this).find(".animal-select").prop("checked")) {
            ids.push($(this).find(".animal-select").data("id"));
            i += 1;
        }
    });
    if(i > 0){
      $('#animals_selected').val('Se han seleccionado ' + i + ' animales');
      $('#animales_id').val(ids.join(','));
    }else{
      $('#animals_selected').val('');
      $('#animales_id').val('');
    }
    $('#search_animal').modal('hide');
}

function searchAnimalCallBack() {
  let ids = [];

  if($('#animales_id').val() != null){
    ids = $('#animales_id').val().split(',');
  }

  $.ajax({
    type: "POST",
    url: "../../app/controllers/AnimalC.php",
    data: {
      action: "search_animal_modal",
    },
    dataType: "json",
    success: function (res) {
      let rows;
      res.forEach((a) => {
        let check = ids.includes(a.id.toString()) ? 'checked' : '';
        console.log(ids.includes(a.id));
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
