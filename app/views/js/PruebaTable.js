"use strict";


function col_selected(th) {

    let col; // Campo por el que hay que filtrar
    let order; // Ordenación
    let page; // Página en la que se encuentre en la tabla
    let amount; // Cantidad 
    let addClass; // clase que vamos añadir
    let rmvClass; // clase que vamos a eliminar

    // Obtenemos el valor del atributo order que tenemos en la th seleccioanda
    if ($(th).attr('order') != '') // Si order es distinto de nulo
    {
        col = $(th).attr('col'); // Obtenemos la columna
        order = $(th).attr('order'); // Obtenemos la ordenación
        page = $("#page").val(); // Obtenemos la página
        amount = $("#amount").val(); // Obtenemos la cantidad

        addClass = (order == 'ASC') ? 'ASC' : 'DESC';
        rmvClass = (order == 'ASC') ? 'DESC' : 'ASC';
    }

    console.log("Pagina: " + page);
    console.log("Col: " + col);
    console.log("order: " + order);
    console.log("page: " + page);
    console.log("amount: " + amount);


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
        col_selected(this);
    });
})
