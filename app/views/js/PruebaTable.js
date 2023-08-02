"use strict";


function col_selected(th) {

    let col, ord, page, amount, addClass, rmvClass; // Campos que necesitamos
    
    // Obtenemos los valores que necesitamos, en caso de que no tengan nada, ponemos uno por defecto
    col = $(th).attr('col'); // Obtenemos la columna
    ord = $(th).attr('ord'); // Obtenemos la ordenación
    page = $("#page").val(); // Obtenemos la página
    amount = $("#amount").val(); // Obtenemos la cantidad

    // En caso que no tenga valor, sea nulo o undefined, ponemos un valor por defecto
    col = (col != undefined && col != null && col != "") ? col : "nombre";
    ord = (ord != undefined && ord != null && ord != "") ? ord : "ASC";
    page = (page != undefined && page != null && page != "") ? page : 1;
    amount = (amount != undefined && amount != null && amount != "") ? amount : 10;

    // Obtenemos el valor del atributo ord que tenemos en la th seleccioanda
    if ($(th).attr('ord') != '') // Si ord es distinto de nulo
    {
        addClass = (ord == 'ASC') ? 'ASC' : 'DESC';
        rmvClass = (ord == 'ASC') ? 'DESC' : 'ASC';
    }

    // console.log("Pagina: " + page);
    // console.log("Col: " + col);
    // console.log("ord: " + ord);
    // console.log("page: " + page);
    // console.log("amount: " + amount);


    // Usamos ajax
    $.ajax({
        type: "POST",
        url: "../controllers/PruebaC.php",
        data: "page=" + page + "&col=" + col + "&ord=" + ord + "&action=prueba",
        // beforesend: function(){
        //     $('.loanding').show(); // Muestra un 'Cargando' mientras se actualizan los campos
        // },
        // dataType: "json",
        success: function (response) {
            console.log(response);
        },
        error: function (xhr, status, error) {
            // Se ha producido un error en la solicitud AJAX
            console.log("Error en la solicitud AJAX:", error);
        },
        complete: function () {
            // Este bloque de código se ejecuta después de que la solicitud haya finalizado, con éxito o con error.
            console.log("Solicitud AJAX completa.");
        }
    });

    $(".loading").fadeOut("slow");
}



function change_selPage(page)
{

}



$(function () {
    $("th.sorting").click(function (e) {
        col_selected(this);
    });

    $("#page").change(function (e) { 
        alert($(this).val());        
    });
});
