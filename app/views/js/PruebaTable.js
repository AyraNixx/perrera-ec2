"use strict";


function col_selected(page) {
    let col;
    let order;
    let addClass;
    let rmvClass;

    // Si la página tiene un valor que se puede considerar como falso, se pone 0. 
    // En caso contrario, se mantiene el número pasado
    page = page ? page : 0;

    // Recorremos todas las th que tengan la clase sorting

    if ($(this).attr('order') != '') // Si order es distinto de nulo
    {
        col = $(this).attr('col'); // Asignamos el nombre de la columna que tenga
        order = $(this).attr('order'); // Asignamos el orden que tenga

        addClass = (order == 'ASC') ? 'ASC' : 'DESC';
        rmvClass = (order == 'ASC') ? 'DESC' : 'ASC';
    }

    console.log("Pagina: " + page);
    console.log("Col: " + col);
    console.log("order: " + order);

    // Usamos ajax
    // $.ajax({
    //     type: "POST",
    //     url: "../../app/controllers/PruebaC.php",
    //     data: "page=" + page + "&col=" + col + "&order=" + order + "action=prueba",
    //     beforesend: function(){
    //         $('.loanding').show(); // Muestra un 'Cargando' mientras se actualizan los campos
    //     },
    //     dataType: "json",
    //     success: function (response) {
    //         console.log(response);
    //     }
    // });
}


$(function () {
    $("th.sorting").click(function (e) {
        // alert($(this).attr("col"));
        // console.log()
        col_selected(page, this);
    });
})
