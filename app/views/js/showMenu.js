$(document).ready(function () {
    console.log("entra al cargar");
    $(".right-menu-show").click(function()
    {
        console.log("entra al hacer click");
        alert("entro");
        $("#sidenav").toggleClass("show-menu");
    });
});