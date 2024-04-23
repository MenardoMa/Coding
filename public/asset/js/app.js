
/**
 * 
 * 
 * JQUERY FOR SEARCH
 * 
 * 
 */

$(document).ready(function(){

    $("#live_search").keyup(function(e){

        e.preventDefault();
        
        var input = $(this).val();

        if(input != ""){

            $.ajax({

                url: "/search",
                method: "POST",
                data:{input:input},
                success: function(data){
                    $("#tabs").html(data)
                }
                
            });

        }

    });

});