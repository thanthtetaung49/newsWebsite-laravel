$(document).ready(function ()
{
    $("#hamburger-btn").click(function (e) { 
        e.preventDefault();
        $("#logout-text").toggle();
    });
});