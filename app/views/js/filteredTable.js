$(document).ready(function () {

    $('#filter-select').change(function (e) {
        let selectVal = $(this).val();

        filter(selectVal);

    });

    $("#search-filter").on("keyup", function () {
        search_filter($(this).val().toLowerCase());
    });

    $("#search_table").on("keyup", function () {
        search_table($(this).val().toLowerCase());
    });

});


function search_filter(e) {
    
    $('#filter-select option').each(function () {
        if ($(this).text().toLowerCase().startsWith(e)) {
            $(this).show();
        } else {
            $(this).hide();
        }
    });
}


function search_table(e) {
    
    $('#list-container tbody tr').each(function () 
    {
        if ($(this).find('td').text().toLowerCase().startsWith(e)) {
            $(this).show();
            $("#no-results").remove();
        } else {
            $(this).hide();
        }
    });

    if($('#list-container tbody').find('tr:visible').length === 0) {
        $("tbody").append("<tr id='no-results'><td colspan='7'>No se ha encontrado ningún registro.</td></tr>");    
    }
}




function filter(e) {

    if (e == '') {
        $.ajax({
            url: '../controllers/AnimalC.php',
            method: 'POST',
            data: {
                action: 'filter'
            },
            success: function (response) {

                $('#list-container').html('');

                $('#list-container').append(response);
            }
        });
    }

    if (e != '') {
        $.ajax({
            url: '../controllers/AnimalC.php',
            method: 'POST',
            data: {
                action: 'filter',
                field: 'especies_id',
                value_field: e
            },
            success: function (response) {

                $('#list-container').html('');

                $('#list-container').append(response);
            }
        });
    }
}

filter('');