//------------------------------     DROPDOWN BUTTON    ------------------------------
// 
// 
// Si los elementos con btn-options tienen la clase show, la quitan, en caso contrario, la ponen
function show_btn_options(event) {

    $(event.currentTarget).find(".button-dropdown i").toggleClass("fa-caret-down fa-caret-up");
    $(event.currentTarget).next(".btn-dropdown-options").toggleClass("show-block");
}

// //Si hace click fuera del div, se cierra porque le quitamos la clase show-block
$(document).on("click", function (event) {
    if (!$(event.target).closest('.button-dropdown').length) {
        $(".button-dropdown i").removeClass("fa-caret-up").addClass("fa-caret-down");
        $(".btn-dropdown-options").removeClass("show-block");
    }
});


//-----------------------------     TABS    ------------------------------
//
//
function open_tab() {
    var tabName, tabContent;

    tabContent = $('.tab-content');
}



//----------------------------      FORM VALIDATIONS ------------------------
//
//
$(function () {       // when the page is ready
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
        let tlfPattern = /^(\(\+?\d{2,3}\)[\*|\s|\-|\.]?(([\d][\*|\s|\-|\.]?){6})(([\d][\s|\-|\.]?){2})?|(\+?[\d][\s|\-|\.]?){8}(([\d][\s|\-|\.]?){2}(([\d][\s|\-|\.]?){2})?)?)$/;
        if (!tlfPattern.test($(this).val())) {
            return false; // 
        }
    });
});
//
//
//--------------------------------    SHOW PASSWORD/EMAIL/TLF     ------------------------
let first_click = false;    //  Para saber si es false o true
let email_val = $('p.hide-str[input_type=email]').text();    // Guardar el valor del email
let tlf_val = $('p.hide-str[input_type=tlf]').text();    // Guardar el valor del telefono
let name_val = $('#name').val();
let lname_val = $('#lname').val();
let fechnac_val = $('#fechnac').val();     // Guardar el valor del telefono

$('.show-text').on('click', function (event) { // Funcion para mostrar cadenas "ocultas"
    $(this).toggleClass('fa-eye fa-eye-slash')
    let p = $(event.target).closest('.col-12').find('p[input_type]'); // Recuperamos el p con el atributo input_type que se encuentre dentro de la clase .col-12
    let type = $(p).attr('input_type'); // Obtenemos el tipo para ver si hay que cambiar de su tipo a texto o no

    switch (type) { // Dependiendo del tipo, se cambia el etributo type para mostrar o no
        case "psswd":
            p.attr('type', p.attr('type') == 'password' ? 'text' : 'password');
            break;
        case "email":
        case "tlf":
            p.toggleClass('hide-str show-str');
            show_hide_str(p);
            break;
    }
});

function show_hide_str(p) {

    let type = $(p).attr('input_type');

    if ($(p).hasClass('hide-str')) {

        let txt = $(p).text();

        if (type == 'email') {
            let at = txt.indexOf('@');
            let username = txt.substring(0, at).charAt(0) + txt.substring(1, at).replace(/\S/g, '*');
            let domain = txt.substring(at + 1, txt.indexOf('.', at)).charAt(0) + txt.substring(at + 2, txt.indexOf('.', at)).replace(/[^.]/g, '*') + txt.substring(txt.indexOf('.', at));

            $(p).text(username + '@' + domain);
        } else if (type == 'tlf') {
            $(p).text(txt.replace(/./g, '*'));
        }
    } else if ($('p[input_type]').hasClass('show-str')) {
        if (type == "email") {
            $(p).text(email_val);
        }

        if (type == "tlf") {
            $(p).text(tlf_val);
        }
    }
}

$(function () {
    $('p[input_type]').each(function () {
        show_hide_str($(this));
    });

    $('.title_name').text($('head title').text());

    console.log($('head title').text())
});


//
//
//--------------------------------- EDIT PROFILE ----------------------------------------
function edit_privacy_info(event) {
    event.preventDefault();
    let not_edit = $(event.target).closest('.row').find('.not-edit');
    let edit = $(event.target).closest('.row').find('.edit');

    not_edit.hide();
    edit.show();

    not_edit.toggleClass('not-edit edit');
    edit.toggleClass('not-edit edit');
};

function edit_form_profile(event) {
    event.preventDefault();
    let profile_edit = $(event.target).closest('.profile-settings').find('.profile-edit');
    let profile_not_edit = $(event.target).closest('.profile-settings').find('.profile-not-edit');

    profile_edit.show();
    profile_not_edit.hide();

    profile_edit.toggleClass('profile-not-edit profile-edit');
    profile_not_edit.toggleClass('profile-not-edit profile-edit');
}


$('form').on('focusout', function (event) {
    let send = false;

    let email_inputs = $(this).find(':input[type=email]');
    let tlf_inputs = $(this).find(':input[type=tel]');
    let text_inputs = $(this).find(':input[type=text]');

    let profile_values = { name: name_val, lname: lname_val, fechnac: fechnac_val };

    if (email_inputs.length > 1) {
        if (email_inputs[0].value == email_inputs[1].value && email_inputs[0].value != email_val) {
            send = true;
        }
    }

    if (tlf_inputs.length == 1) {
        tlf_inputs.each(function () {

            if ($(this).val() != tlf_val) {
                send = true;
            }
        })
    }

    text_inputs.each(function () {
        if ($(this).attr('id') in profile_values) {
            if ($(this).val() != profile_values[$(this).attr('id')]) {
                send = true;
            }
        }
    });


    if (send) {
        $(this).closest('form').find('button[name=action]').prop('disabled', false).removeClass('bg-secondary').addClass('bg-primary');
    } else {
        $(this).closest('form').find('button[name=action]').prop('disabled', true).removeClass('bg-primary').addClass('bg-secondary');
    }

});


//
//
//------------------------------------------        ---------------------------------------------------------------------



