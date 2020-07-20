/*Search Suggestion function*/
$(document).ready(function(){

    $('.search-bar').on('keyup',function(){
        var query = $(this).val();
        if(query != '')
        {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"autocomplete",
                method:"POST",
                data:{search:query, _token:_token},
                success:function(data){
                    $('#search-suggestion').fadeIn();
                    $('#search-suggestion').html(data);
                }
            });
        }
    });

    $(document).on('click', 'li', function(){
        $('#search-suggestion').val($(this).text());
        $('#search-suggestion').fadeOut();
    });

});

'use strict';
var searchBox = document.querySelectorAll('.search-box input[type="text"] + span');

searchBox.forEach((elm) => {
    elm.addEventListener('click', () => {
        elm.previousElementSibling.value = '';
    });
});
/*Search Suggestion function*/

/*Animated menu*/

/*Animated menu*/


/*Search bar*/

/*Search bar*/

