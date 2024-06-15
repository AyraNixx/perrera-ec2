$(document).ready(function () {    

    let mediaQ = window.matchMedia("(max-width: 768px)");

    if (mediaQ.matches) 
    {

        $("#header-btn").click(function () 
        { 
            $("#menu").removeClass("close-menu");
            $("#menu").addClass("show-menu");
        });

        $("#close-btn").click(function () 
        { 
            $("#menu").removeClass("show-menu");
            $("#menu").addClass("close-menu");
        });
        
    }

    $(window).resize(function () {
        mediaQ = window.matchMedia("(max-width: 768px)");

        if(!mediaQ.matches && $("#menu").hasClass("show-menu"))
        {
            $("#menu").removeClass("show-menu");
        }

        if(!mediaQ.matches && $("#menu").hasClass("close-menu"))
        {
            $("#menu").removeClass("close-menu");
        }
    });

});