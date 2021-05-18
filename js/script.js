$(document).ready(function () {
    // $("#container").hide();
    
    if($("#container").css("display") == "none"){
    $("#read").on("click", function () {
        $("#read").html("Read or Close");
        $("#container").toggle();
    });
    } 
    // $("#read").html("read");
});