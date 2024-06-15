$(document).ready(function () {

    // Para filtrar la tabla
    $(document).on('click', '.sort-btn', function () {
        // Obtener los valores del campo y ord
        let field = $(this).data("field");
        let ord = $(this).data("ord");
        // Obtener los valores de page y amount
        let amount = parseInt($("#amount").val());
        let page = parseInt($("#page").val());

        // Cambiar el valor de ord de asc a desc, o viceversa
        let newOrd = (ord === "asc") ? "desc" : "asc";
        $(this).data("ord", newOrd); // Actualizar el valor del atributo data-ord

        // Realizar la solicitud AJAX
        $.ajax({
            type: "POST",
            url: "../../app/controllers/AnimalC.php",
            data: {
                "action": "pagination",
                "ord": newOrd, // Usar el nuevo valor de ord
                "field": field,
                "amount": amount,
                "page": page
            },
            success: function (response) {
                console.log(response);                
                $("#list-container tbody").html("");
                $("#list-container tbody").html(response);
            },
            error: function (error) {
                console.log('Error:', error);
            }
        });
    });

    // Para ir a la página anterior
    $('#previous').click(function (e) {

        // Obtener los valores de page y amount
        let amount = parseInt($("#amount").val());
        let prev = parseInt($("#previous").val());

        let data = {
            "action": "pagination",
            "amount": amount,
            "page": prev
        };

        callController(data);

        // Actualizamos el valor del select page
        $("#page").val(prev);
    });

    // Para ir a la página siguiente
    $("#next").click(function (e) {

        let next = parseInt($("#next").val());

        // Obtener los valores de page y amount
        let amount = parseInt($("#amount").val());


        let data = {
            "action": "pagination",
            "amount": amount,
            "page": next
        };

        callController(data);

        // Actualizamos el valor del select page
        $("#page").val(next);
    });


    $("#page").change(function (e) {

        // Obtener los valores de page y amount
        let amount = parseInt($("#amount").val());
        let page = parseInt($("#page").val());

        let data = {
            "action": "pagination",
            "amount": amount,
            "page": next
        };

        callController(data);
        updateBtn();
        // Actualizamos el valor del select page
        $("#page").val(selectedPage);

    });



    function callController(data) {
        // Realizar la llamada Ajax para obtener los datos de la página anterior/siguiente
        $.ajax({
            url: '../../app/controllers/AnimalC.php',
            method: 'POST',
            data: data,
            success: function (response) {
                console.log(response);
                $("#list-container tbody").html("");
                $("#list-container tbody").html(response);
                updateBtn();
            },
            error: function () {
                alert('Error al obtener los datos');
            }
        });
    }

    function updateBtn() {
        let page = parseInt($("#page").val());
        let total_pages = parseInt($("#total_pages").text());

        if (page === 1) {
            $("#previous").prop("disabled", true);
        } else {
            $("#previous").prop("disabled", false);
        }

        if (page === total_pages) {
            $("#next").prop("disabled", true);
        } else {
            $("#next").prop("disabled", false);
        }
    }

    // Llamamos a la función updateBtn() al cargar la página para inicializar los botones
    updateBtn();

});
