

$(document).ready(function(){
    $.ajax({
        url: baseUrl + "/verify-user",
        type: "GET", 
        success: function(response){ 
            $.ajax({
                url: baseUrl+"/update-cart-on-load",
                type: "GET",
                data: {'authentication': response.authentication},  
                success: function(response){
                    console.log(response);
                    if(response.data == ''){
                        $('#cartItemCount').html('0');
                    }else{
                    let item_count = response.data.length; 
                    $('#cartItemCount').html(item_count);
                    }
                }
            });
        }
    });
});
