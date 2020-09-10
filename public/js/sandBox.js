
$(document).ready(function(){
    $("#search_btn").on("click", function () {
        console.log("search button was pushed");
        $("#search_input").toggleClass("inclicked");
    })
});
