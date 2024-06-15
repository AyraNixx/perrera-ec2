$(document).ready(function () {
  const controller = $("*[data-controller]").first().data("controller");
  const id = new URLSearchParams(window.location.search).get("id");

  // BORRAR REGISTRO
  $('[data-action="sdelete"]').click(function () {
    $("<form>", {
      method: "POST",
      action: `../../app/controllers/${controller}`,
    })
      .append($("<input>", { type: "hidden", name: "id", value: id }))
      .append(
        $("<input>", { type: "hidden", name: "action", value: "sdelete" })
      )
      .appendTo(document.body)
      .submit();
  });

  $('[data-action="update"]').click(function () {
    $("input, textarea").attr("readonly", false);
    $("select").attr("disabled", false);
    $("select").removeClass('form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3');
    $("select").addClass('col-12 px-2 border border-dark-subtle mt-3 rounded');  

    let specie_input = $('input[type="text"][name="especies-form"]');

    if (specie_input.length) {
      let specie = specie_input.val();
      specie_input.hide();
      generate_species(specie);
    }
    $(".btn-hidden-register").removeClass("hidden");
  });

  $(document).on("change", 'select[name="especies_id"]', function () {
    let specie_selected = $(this).val();
    console.log("Especie seleccionada:", specie_selected);
    generate_cages(specie_selected);
  });

  function generate_species(specie) {
    $.ajax({
      type: "POST",
      url: `../../app/controllers/EspecieC.php`,
      data: { action: "generate_species_sel" },
      dataType: "json",
      success: function (res) {
        let specie_selected = $('select[name="especies_id"]');
        specie_selected.empty();

        res.forEach((e) => {
          let option = $("<option>", {
            value: e.id,
            text: e.nombre,
          }).appendTo(specie_selected);

          if (e.nombre === specie) {
            option.attr("selected", "selected");
          }
        });

        specie_selected.show();

        let jaula_input = $('input[type="text"][name="jaula-form"]');
        if (jaula_input.length) {
          generate_cages(specie_selected.val());
          $('input[type="text"][name="jaula-form"]').hide();
        }
      },
      error: function (xhr, status, error) {
        console.error("Error al obtener los datos de la especie:", error);
      },
    });
  }

  function generate_cages(id) {
    let data = { action: "generate_cages_sel", id };
    if ($("input[data-jaula-id]").length > 0) {
      data["jaula_id"] = $("input[data-jaula-id]").data("jaula-id");
    }
    $.ajax({
      type: "POST",
      url: `../../app/controllers/JaulaC.php`,
      data: data,
      dataType: "json",
      success: function (res) {
        console.log("Jaulas recibidas:", res);
        let cages_select = $('select[name="jaulas_id"]');
        cages_select.empty();

        res.forEach((e) => {
          let option = $("<option>", {
            value: e.id,
            text: e.ubicacion,
          }).appendTo(cages_select);

          if (e.nombre === $('input[type="text"][name="jaula-form"]').val()) {
            option.attr("selected", "selected");
            $("input[data-jaula-id]").attr("data-jaula-id", e.id);
          }
        });

        cages_select.show();
      },
      error: function (xhr, status, error) {
        console.error("Error al obtener las jaulas:", error);
      },
    });
  }

  $(document).on("submit", ".form-register", handle_submit);

  function handle_submit(e) {
    e.preventDefault();

    if (!$(this).find('input[name="id"]').length) {
      $("<input>", { type: "hidden", name: "id", value: id }).appendTo(this);
    }

    if (!$(this).find('input[name="action"]').length) {
      $("<input>", {
        type: "hidden",
        name: "action",
        value: "update",
      }).appendTo(this);
    }
    this.submit();
  }

  $("#cancel_register").click(function () {
    $("input, textarea").attr("readonly", true);
    $("select").attr("disabled", true);
    $("select").removeClass('col-12 px-2 border border-dark-subtle mt-3 rounded');  // Quitar clase existente
    $("select").addClass('form-control-plaintext border-dark-subtle border-0 border-bottom mt-1 mb-3');
    $(".btn-hidden-register").addClass("hidden");

    if ($('input[type="text"][name="especies-form"]').length) {
      $('input[type="text"][name="especies-form"]').show();
      $('select[name="especies_id"]').hide();

      $('input[type="text"][name="jaula-form"]').show();
      $('select[name="jaulas_id"]').hide();
    }
    $(".form-register")[0].reset();
  });
});
