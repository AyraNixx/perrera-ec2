$(document).ready(function() {
    $(document).on('click', '.sort-btn', function() {
        // Obtener los valores del campo y ord
        let field = $(this).data("field");
        let ord = $(this).data("ord");

        // Obtener los valores de page y amount
        let amount = $("#amount").val();
        let page = $("#page").val();

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
            success: function(response) {
                $("#list-container tbody").html("");
                $("#list-container tbody").html(response);
            },
            error: function(error) {
                console.log('Error:', error);
            }
        });
    });
});






// $('.previous').click(function(){
    
//     // Guardamos el valor de page para que sea más fácil interaccionar con ella
//     let page = $("#page").val();
//     // Guardamos también el valor de la cantidad de registros que queremos por 
//     // página
//     let amount = $("#amount").val();

//     // En caso de que page sea distinto y mayor de 1, le restamos uno para obtener 
//     // la página anterior
//     if(page != 1 && page > 1)
//     {
//         page = parseInt(page) - 1;
//     }

//     // Realizar la llamada Ajax para obtener los datos de la página anterior
//     $.ajax({
//         url: '../../app/controllers/AnimalC.php',
//         method: 'POST',
//         data: {
//             "amount": amount,
//             "page": page, "prueba":1
//         },
//         success: function(response) {
//             console.log(response);
//             // // Actualizar el contenido de la tabla con los datos de la página anterior
//             // $('#table-body').html(response);
//             // // Actualizar el valor del select de página con la página anterior
//             // $('#page').val(previousPage);
//         },
//         error: function() {
//             alert('Error al obtener los datos');
//         }
//     });
// })
