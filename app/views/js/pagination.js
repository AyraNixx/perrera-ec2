$(document).ready(function () {
    let default_field = $('.sort-btn:first').data("field");
    let default_ord = $('.sort-btn:first').data("ord");
    let default_controller = $('*[data-controller]').first().data("controller");

    // Para filtrar la tabla
    $(document).on('click', '.sort-btn', function () {
        // Obtener los valores del campo y ord
        let field = $(this).data("field");
        let ord = $(this).data("ord");
        // Obtener los valores de page y amount
        let amount = parseInt($("#amount").val());
        let search = $("#search_table").val();
        let page = 1; // Cada vez que se modifique el orden, se empezará desde la primera página.
        reset_page();
        // Cambiar el valor de ord de asc a desc, o viceversa
        let newOrd = (ord === "asc") ? "desc" : "asc";

        $(this).data("ord", newOrd); // Actualizar el valor del atributo data-ord

        default_ord = newOrd;   // Modificamos los valores que había por defecto para recordar el orden
        default_field = field;
        // Realizar la solicitud AJAX

        let data = {
            "action": "pagination",
            "amount": amount,
            "page": page,
            "ord": newOrd, 
            "field": field,
            "search_value": search
        };
        callController(data);
    });

    // Para ir a la página anterior
    $(document).on("click", "#previous", function (e) {

        // Obtener los valores de page y amount
        let amount = parseInt($("#amount").val());
        let prev = parseInt($("#previous").val());
        let field = default_field;
        let ord = default_ord;
        let search = $("#search_table").val();

        let data = {
            "action": "pagination",
            "amount": amount,
            "page": prev,
            "ord": ord, 
            "field": field,
            "search_value": search
        };

        callController(data);
    });

    // Para ir a la página siguiente
    $(document).on("click", "#next", function (e) {

        // Obtener los valores de page y amount
        let amount = parseInt($("#amount").val());
        let next = parseInt($("#next").val());
        let field = default_field;
        let ord = default_ord;
        let search = $("#search_table").val();


        let data = {
            "action": "pagination",
            "amount": amount,
            "page": next,
            "ord": ord, 
            "field": field,
            "search_value": search
        };

        callController(data);

        // Actualizamos el valor del select page
        $("#page").val(next);
    });

    // Cambiar página
    $(document).on("change", "#page", function (e) {

        // Obtener los valores de page y amount
        let amount = parseInt($("#amount").val());
        let page = parseInt($("#page").val());
        let field = default_field;
        let ord = default_ord;
        let search = $("#search_table").val();

        let data = {
            "action": "pagination",
            "amount": amount,
            "page": page,
            "ord": ord, 
            "field": field,
            "search_value": search
        };

        callController(data);

    });

    // Cambiar cantidad de registros para ver
    $(document).on("change", "#amount", function (e) {
        let amount = parseInt($("#amount").val());
        let search = $("#search_table").val();
        let field = default_field;
        let ord = default_ord;
        let page = 1; // Cada vez que se modifique el orden, se empezará desde la primera página.

        let data = {
            "action": "pagination",
            "amount": amount,
            "page": page,
            "ord": ord, 
            "field": field,
            "search_value": search
        };

        callController(data);
    });

    // Al escribir en la barra de búsqueda
    $("#search_table").on("keyup", function () {
        let amount = parseInt($("#amount").val());
        let search = $(this).val().toLowerCase();
        let field = default_field;
        let ord = default_ord;
        let page = 1; // Cada vez que se modifique el orden, se empezará desde la primera página.

        let data = {
            "action": "pagination",
            "amount": amount,
            "page": page,
            "ord": ord, 
            "field": field,
            "search_value": search
        };

        callController(data);
    });



    function callController(data) {
        // Realizar la llamada Ajax para obtener los datos de la página anterior/siguiente
        $.ajax({
            url: '../../app/controllers/' . default_controller,
            method: 'POST',
            data: data,
            success: function (res) {
                console.log(res);
                var resJSON = JSON.parse(res);

                $("#list-container tbody").html("");
                $("#pagination").html("");
                $("#pagination").html(resJSON.pagination); 

                if(resJSON.rows.length !== 0){
                    $("#list-container tbody").html(resJSON.rows);
                }else{
                    if($('#list-container tbody').find('tr:visible').length === 0) {
                        $("tbody").append("<tr id='no-results'><td colspan='8'>No se ha encontrado ningún registro.</td></tr>");    
                    }
                }           
            },
            error: function () {
                alert('Error al obtener los datos');
            }
        });
    }

    // function updateBtn() {
    //     let page = parseInt($("#page").val());
    //     let total_pages = parseInt($("#total_pages").text());

    //     if (page === 1) {
    //         $("#previous").prop("disabled", true);
    //     } else {
    //         $("#previous").prop("disabled", false);
    //     }

    //     if (page === total_pages) {
    //         $("#next").prop("disabled", true);
    //     } else {
    //         $("#next").prop("disabled", false);
    //     }
    // }

    function reset_page(){
        // Modificar el valor del select con id "miSelect" a 1
        $("#page").val(1);
        let total_pages = parseInt($("#total_pages").text());
        
        // Deshabilitar el botón con id "prev"
        $("#previous").prop("disabled", true);
        
        // Habilitar el botón con id "next" si el total de páginas es mayor que 1, de lo contrario, deshabilitarlo
        if (total_pages > 1) {
            $("#next").prop("disabled", false);
        } else {
            $("#next").prop("disabled", true);
        }
    }

    // Llamamos a la función updateBtn() al cargar la página para inicializar los botones
    // updateBtn();

});
