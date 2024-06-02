
// let default_field = $('.sort-btn:first').data("field");
// let default_ord = $('.sort-btn:first').data("ord");
// let default_controller = $('*[data-controller]').first().data("controller");

// $(document).ready(function () {
//     // $('#filter-select').change(function (e) {
//     //     let selectVal = $(this).val();

//     //     filter(selectVal);

//     // });

//     $("#search-filter").on("keyup", function () {
//         search_filter($(this).val().toLowerCase());
//     });

//     $("#search_table").on("keyup", function () {
//         search_table($(this).val().toLowerCase());
//     });

// });


// function search_filter(e) {
    
//     $('#filter-select option').each(function () {
//         if ($(this).text().toLowerCase().startsWith(e)) {
//             $(this).show();
//         } else {
//             $(this).hide();
//         }
//     });
// }


// function search_table(e) {
//     // if(e != '' && e != null){
//         let amount = parseInt($("#amount").val());
//         let page = parseInt($("#page").val());

//         $.ajax({
//             type: "POST",
//             url: "../../app/controllers/" + default_controller,
//             data: { 
//                 "action": "search",
//                 "search_value": e,
//                 "field": default_field,
//                 "sort": default_ord,
//                 "amount": amount,
//                 "page": page
//             },
//             success: function (res) {
//                 console.log(res);
//                 var resJSON = JSON.parse(res);

//                 $("#list-container tbody").html("");
//                 $("#pagination").html("");
//                 $("#pagination").html(resJSON.pagination); 

//                 if(resJSON.rows.length !== 0){
//                     $("#list-container tbody").html(resJSON.rows);
//                 }else{
//                     if($('#list-container tbody').find('tr:visible').length === 0) {
//                         $("tbody").append("<tr id='no-results'><td colspan='8'>No se ha encontrado ningún registro.</td></tr>");    
//                     }
//                 }               
//             }
//         });

//     // }else{
//     //     console.log('entra alñ cadsasd');
//     //     if($('#list-container tbody').find('tr:visible').length === 0) {
//     //         $("tbody").append("<tr id='no-results'><td colspan='8'>No se ha encontrado ningún registro.</td></tr>");    
//     //     }
//     // }
//     // $('#list-container tbody tr').each(function () {
//     //     if ($(this).find('td').text().toLowerCase().startsWith(e)) {
//     //         $(this).show();
//     //         $("#no-results").remove();
//     //     } else {
//     //         $(this).hide();
//     //     }
//     // });
// }




// // function filter(e) {

// //     // if (e == '') {
// //     //     $.ajax({
// //     //         url: '../controllers/AnimalC.php',
// //     //         method: 'POST',
// //     //         data: {
// //     //             action: 'filter'
// //     //         },
// //     //         success: function (res) {

// //     //             $('#list-container').html('');

// //     //             $('#list-container').append(res);
// //     //         }
// //     //     });
// //     // }

// //     if (e != '') {
// //         $.ajax({
// //             url: '../controllers/AnimalC.php',
// //             method: 'POST',
// //             data: {
// //                 action: 'filter',
// //                 field: 'especies_id',
// //                 value_field: e
// //             },
// //             success: function (res) {

// //                 $('#list-container').html('');

// //                 $('#list-container').append(res);
// //             }
// //         });
// //     }
// // }

// // filter('');