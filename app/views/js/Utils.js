$(document).ready(function () {
  if ($('select[name="ocupacion"]').length) {
    let ocupacion_text = '';
    if ($('input[name="ocupacion_text"]').length) {
      ocupacion_text = $('input[name="ocupacion_text"]').val();
    }
    $.getJSON("../views/js/Utils.json", function (data) {
      $.each(data.ocupaciones, function (k, v) { 
        let option = $('<option></option>').attr('value', v.value).text(v.text);
        if(ocupacion_text != '' && v.text == ocupacion_text){
          option.prop('selected', true);
        }
        $('select[name="ocupacion"]').append(option);
      });
    });
  }

  if ($('select[name="pais"]').length) {
    let pais_text = '';
    if ($('input[name="pais_text"]').length) {
      pais_text = $('input[name="pais_text"]').val();
    }
    $.getJSON("../views/js/Utils.json", function (data) {
      $.each(data.paises, function (k, v) { 
        let option = $('<option></option>').attr('value', v.value).text(v.text);
        if(pais_text != '' && v.text == pais_text){
          option.prop('selected', true);
        }
        $('select[name="pais"]').append(option);
      });
    });
  }
  
  if ($('select[name="estado_solicitud"]').length) {
    let estado_solicitud_text = '';
    if ($('input[name="estado_solicitud_text"]').length) {
      estado_solicitud_text = $('input[name="estado_solicitud_text"]').val();
    }
    $.getJSON("../views/js/Utils.json", function (data) {
      $.each(data.estado_solicitud, function (k, v) { 
        let option = $('<option></option>').attr('value', v.estado).text(v.estado);
        if(estado_solicitud != '' && v.estado == estado_solicitud){
          option.prop('selected', true);
        }
        $('select[name="estado_solicitud"]').append(option);
      });
    });
  }

  if ($('select[name="estado_adopcion"]').length) {
    let estado_adopcion_text = '';
    if ($('input[name="estado_adopcion_text"]').length) {
      estado_adopcion_text = $('input[name="estado_adopcion_text"]').val();
    }
    $.getJSON("../views/js/Utils.json", function (data) {
      $.each(data.estado_solicitud, function (k, v) { 
        let option = $('<option></option>').attr('value', v.estado).text(v.estado);
        if(estado_adopcion != '' && v.estado == estado_adopcion){
          option.prop('selected', true);
        }
        $('select[name="estado_adopcion"]').append(option);
      });
    });
  }

  if ($('select[name="tipo_vivienda"]').length) {
    let tipo_vivienda_text = '';
    if ($('input[name="tipo_vivienda_text"]').length) {
      tipo_vivienda_text = $('input[name="tipo_vivienda_text"]').val();
    }
    $.getJSON("../views/js/Utils.json", function (data) {
      $.each(data.tipos_vivienda, function (k, v) { 
        let option = $('<option></option>').attr('value', v.value).text(v.text);
        if(tipo_vivienda_text != '' && v.text == tipo_vivienda_text){
          option.prop('selected', true);
        }
        $('select[name="tipo_vivienda"]').append(option);
      });
    });
  }
});

//------------------------------     DROPDOWN BUTTON    ------------------------------
//
//
// Si los elementos con btn-options tienen la clase show, la quitan, en caso contrario, la ponen
function show_btn_options(event) {
  if (event && event.currentTarget) {
    $(event.currentTarget)
      .find(".button-dropdown i")
      .toggleClass("fa-caret-down fa-caret-up");
    $(event.currentTarget)
      .next(".btn-dropdown-options")
      .toggleClass("show-block");
  } else {
    console.error("Error: Event or currentTarget is undefined.");
  }
}

// //Si hace click fuera del div, se cierra porque le quitamos la clase show-block
$(document).on("click", function (event) {
  if (!$(event.target).closest(".button-dropdown").length) {
    $(".button-dropdown i")
      .removeClass("fa-caret-up")
      .addClass("fa-caret-down");
    $(".btn-dropdown-options").removeClass("show-block");
  }
});

//-----------------------------     TABS    ------------------------------
//
//
function open_tab() {
  var tabName, tabContent;

  tabContent = $(".tab-content");
}

//----------------------------      FORM VALIDATIONS ------------------------
//
//
$(function () {
  // when the page is ready
  // EMAIL VALIDATION
  $("input[type=email]").on("blur", function () {
    let emailPattern = /^[\w\.-]+@[a-zA-Z\d\.-]+\[a-zA-Z]{2,}$/;
    if (!emailPattern.test($(this).val())) {
      return false; // NEEDS TO BE MODIFIED
    }
  });

  // PASSWORD VALIDATION
  $("input[type=password]").on("blur", function () {
    let passwdPattern = /^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/;
    if (!passwdPattern.test($(this).val())) {
      return false; // NEEDS TO BE MODIFIED
    }
  });

  // TLF VALIDATION
  $("input[type=tel]").on("blur", function () {
    let tlfPattern =
      /^(\(\+?\d{2,3}\)[\*|\s|\-|\.]?(([\d][\*|\s|\-|\.]?){6})(([\d][\s|\-|\.]?){2})?|(\+?[\d][\s|\-|\.]?){8}(([\d][\s|\-|\.]?){2}(([\d][\s|\-|\.]?){2})?)?)$/;
    if (!tlfPattern.test($(this).val())) {
      return false; //
    }
  });
});
//
//
//--------------------------------    SHOW PASSWORD/EMAIL/TLF     ------------------------
let first_click = false; //  Para saber si es false o true
let email_val = $("p.hide-str[input_type=email]").text(); // Guardar el valor del email
let tlf_val = $("p.hide-str[input_type=tlf]").text(); // Guardar el valor del telefono
let name_val = $("#name").val();
let lname_val = $("#lname").val();
let fechnac_val = $("#fech_nac").val(); // Guardar el valor del telefono

$(".show-text").on("click", function (event) {
  // Funcion para mostrar cadenas "ocultas"
  $(this).toggleClass("fa-eye fa-eye-slash");
  let p = $(event.target).closest(".col-12").find("p[input_type]"); // Recuperamos el p con el atributo input_type que se encuentre dentro de la clase .col-12
  let type = $(p).attr("input_type"); // Obtenemos el tipo para ver si hay que cambiar de su tipo a texto o no

  switch (
    type // Dependiendo del tipo, se cambia el etributo type para mostrar o no
  ) {
    case "psswd":
      p.attr("type", p.attr("type") == "password" ? "text" : "password");
      break;
    case "email":
    case "tlf":
      p.toggleClass("hide-str show-str");
      show_hide_str(p);
      break;
  }
});

function show_hide_str(p) {
  let type = $(p).attr("input_type");

  if ($(p).hasClass("hide-str")) {
    let txt = $(p).text();

    if (type == "email") {
      let at = txt.indexOf("@");
      let username =
        txt.substring(0, at).charAt(0) +
        txt.substring(1, at).replace(/\S/g, "*");
      let domain =
        txt.substring(at + 1, txt.indexOf(".", at)).charAt(0) +
        txt.substring(at + 2, txt.indexOf(".", at)).replace(/[^.]/g, "*") +
        txt.substring(txt.indexOf(".", at));

      $(p).text(username + "@" + domain);
    } else if (type == "tlf") {
      $(p).text(txt.replace(/./g, "*"));
    }
  } else if ($("p[input_type]").hasClass("show-str")) {
    if (type == "email") {
      $(p).text(email_val);
    }

    if (type == "tlf") {
      $(p).text(tlf_val);
    }
  }
}

$(function () {
  $("p[input_type]").each(function () {
    show_hide_str($(this));
  });

  $(".title_name").text($("head title").text());

  console.log($("head title").text());
});

//
//
//--------------------------------- EDIT PROFILE ----------------------------------------
function edit_privacy_info(event) {
  event.preventDefault();
  let not_edit = $(event.target).closest(".row").find(".not-edit");
  let edit = $(event.target).closest(".row").find(".edit");

  not_edit.hide();
  edit.show();

  not_edit.toggleClass("not-edit edit");
  edit.toggleClass("not-edit edit");
}

function edit_form_profile(event) {
  event.preventDefault();
  let profile_edit = $(event.target)
    .closest(".profile-settings")
    .find(".profile-edit");
  let profile_not_edit = $(event.target)
    .closest(".profile-settings")
    .find(".profile-not-edit");

  profile_edit.show();
  profile_not_edit.hide();

  profile_edit.toggleClass("profile-not-edit profile-edit");
  profile_not_edit.toggleClass("profile-not-edit profile-edit");
}

$('[data-form="form-settings"]').on("input", function (event) {
  let send = false;

  let email_inputs = $(this).find(":input[type=email]");
  let tlf_inputs = $(this).find(":input[type=tel]");
  let text_inputs = $(this).find(":input[type=text]");
  let psswd_inputs = $(this).find(":input[type=password]");

  let profile_values = {
    name: name_val,
    lname: lname_val,
    fechnac: fechnac_val,
  };

  if (email_inputs.length > 1) {
    if (
      email_inputs[0].value == email_inputs[1].value &&
      email_inputs[0].value != email_val
    ) {
      send = true;
    }
  }

  if (tlf_inputs.length == 1) {
    tlf_inputs.each(function () {
      if ($(this).val() != tlf_val) {
        send = true;
      }
    });
  }
  if (
    $("input[name=old_psswd]").length > 0 &&
    $("input[name=new_psswd]").length > 0 &&
    $("input[name=new_psswd2]").length > 0 &&
    $.trim($("input[name=old_psswd]").val()) !== "" &&
    $.trim($("input[name=new_psswd]").val()) !== "" &&
    $.trim($("input[name=new_psswd2]").val()) !== "" &&
    $.trim($("input[name=old_psswd]").val()) !==
      $.trim($("input[name=new_psswd]").val()) &&
    $.trim($("input[name=new_psswd]").val()) ===
      $.trim($("input[name=new_psswd2]").val())
  ) {
    send = true;
  }
  text_inputs.each(function () {
    if ($(this).attr("id") in profile_values) {
      if ($(this).val() != profile_values[$(this).attr("id")]) {
        send = true;
      }
    }
  });

  if (send) {
    $(this)
      .closest('[data-form="form-settings"]')
      .find("button[name=action]")
      .prop("disabled", false)
      .removeClass("bg-secondary")
      .addClass("bg-primary");
  } else {
    $(this)
      .closest('[data-form="form-settings"]')
      .find("button[name=action]")
      .prop("disabled", true)
      .removeClass("bg-primary")
      .addClass("bg-secondary");
  }
});

//
//
//------------------------------------------    BOTONES DE LA RECORD PAGE    ---------------------------------------------------------------------
// $(document).ready(function () {
//   let default_controller = $("*[data-controller]").first().data("controller");

//   $('[data-action="sdelete"]').click(function () {
//     let urlParams = new URLSearchParams(window.location.search);
//     let id = urlParams.get("id");
//     // Crear un formulario dinámicamente
//     let form = $("<form></form>");
//     form.attr("method", "POST");
//     form.attr("action", "../../app/controllers/".default_controller);

//     // Agregar campos ocultos al formulario
//     let id_val = $("<input/>")
//       .attr("type", "hidden")
//       .attr("name", "id")
//       .val(id);
//     let action_val = $("<input/>")
//       .attr("type", "hidden")
//       .attr("name", "action")
//       .val("sdelete");
//     form.append(id_val);
//     form.append(action_val);

//     // Adjuntar el formulario al cuerpo del documento y enviarlo
//     $(document.body).append(form);
//     form.submit();
//   });

//   $('[data-action="update"]').click(function () {
//     let id = getIdUrl("id");
//     // Remove readonly attribute from inputs
//     $("input").attr("readonly", false);
//     $("textarea").attr("readonly", false);
//     $("select").attr("disabled", false);

//     // Comprobamos si existe un input de tipo texto con el name especies
//     if ($('input[type="text"][name="especies-form"]')) {
//       let specie = $('input[type="text"][name="especies-form"]').val();
//       $('input[type="text"][name="especies-form"]').hide();
//       $.ajax({
//         type: "POST",
//         url: `../../app/controllers/EspecieC.php`,
//         data: { action: "generate_species_sel" },
//         dataType: "json",
//         success: function (res) {
//           $('select[name="especies_id"]').empty();
//           res.forEach((e) => {
//             let option = $("<option>")
//               .attr({ value: e.id })
//               .text(e.nombre)
//               .appendTo('select[name="especies_id"]');
//             if (e.nombre === specie) {
//               option.attr("selected", "selected");
//             }
//           });
//           $('select[name="especies_id"]').show();

//           if ($('input[type="text"][name="jaulas-form"]')) {
//             console.log($('select[name="especies_id"]').val());
//             generate_cages($('select[name="especies_id"]').val());
//             $('input[type="text"][name="jaula-form"]').hide();
//           }
//         },
//         error: function (xhr, status, error) {
//           console.error("Error al obtener los datos - imgs:", error);
//         },
//       });
//       $('input[type="text"][name="jaulas-form"]').hide();
//     }
//     // Show the submit button
//     $(".btn-hidden-register").removeClass("hidden");
//   });

//   function generate_cages(id) {
//     $.ajax({
//       type: "POST",
//       url: `../../app/controllers/JaulaC.php`,
//       data: { action: "generate_cages_sel", id },
//       dataType: "json",
//       success: function (res) {
//         $('select[name="jaulas_id"]').empty();
//         res.forEach((e) => {
//           let option = $("<option>")
//             .attr({ value: e.id })
//             .text(e.ubicacion)
//             .appendTo('select[name="jaulas_id"]');
//           if (e.nombre === $('input[type="text"][name="jaula-form"]').val()) {
//             option.attr("selected", "selected");
//           }
//         });
//         $('select[name="jaulas_id"]').show();
//       },
//       error: function (xhr, status, error) {
//         console.error("Error al obtener los datos - imgs:", error);
//       },
//     });
//   }

//   $(document).on("submit", ".form-register", handle_submit);
//   function handle_submit(e) {
//     e.preventDefault();
//     let id = getIdUrl("id");
//     if ($(this).find('input[name="id"]').length === 0) {
//       $("<input>")
//         .attr({
//           type: "hidden",
//           name: "id",
//           value: id,
//         })
//         .appendTo(this);
//     }
//     if ($(this).find('input[name="action"]').length === 0) {
//       $("<input>")
//         .attr({
//           type: "hidden",
//           name: "action",
//           value: "update",
//         })
//         .appendTo(this);
//     }
//     console.log(this);

//     this.submit();
//   }

//   $("#cancel_register").click(function () {
//     // Remove readonly attribute from inputs
//     $("input").attr("readonly", true);
//     $("textarea").attr("readonly", true);
//     // Show the submit button
//     $(".btn-hidden-register").addClass("hidden");
//     if ($('input[type="text"][name="especies"]')) {
//       $('input[type="text"][name="especies"]').show();
//       $('select[name="especies_id"]').hide();
//     }
//     var form = $(".form-register")[0];
//     // Reset the form
//     form.reset();
//   });
// });

// function getIdUrl(name) {
//   let url = window.location.href;
//   let regex = new RegExp(
//     "[?&]" + name.replace(/[\[\]]/g, "\\$&") + "(=([^&#]*)|&|#|$)"
//   );
//   let results = regex.exec(url);
//   if (!results) return null;
//   return decodeURIComponent(results[2].replace(/\+/g, " "));
// }
