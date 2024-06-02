$(document).ready(function () {    
    let mediaQ = window.matchMedia("(max-width: 768px)");

    function setupMenuToggle() {
        if (mediaQ.matches) {
            // Asignar eventos de clic solo si la media query coincide
            $("#header-btn").on("click", function () { 
                $("#menu").removeClass("close-menu").addClass("show-menu");
            });

            $("#close-btn").on("click", function () { 
                $("#menu").removeClass("show-menu").addClass("close-menu");
            });
        } else {
            // Eliminar eventos de clic si la media query no coincide
            $("#header-btn").off("click");
            $("#close-btn").off("click");
        }
    }

    // Configurar eventos de clic al cargar la página
    setupMenuToggle();

    // Verificar la media query al cambiar el tamaño de la ventana
    $(window).resize(function () {
        mediaQ = window.matchMedia("(max-width: 768px)");
        setupMenuToggle();

        if (!mediaQ.matches && $("#menu").hasClass("show-menu")) {
            $("#menu").removeClass("show-menu");
        }

        if (!mediaQ.matches && $("#menu").hasClass("close-menu")) {
            $("#menu").removeClass("close-menu");
        }
    });
});
