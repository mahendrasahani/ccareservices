

$(document).ready(function(){
    let product_id = $('#product_id').val(); 
    $.ajax({
        url: baseUrl + "/verify-user",
        type: "GET", 
        success: function(response){ 
            $.ajax({
                url: baseUrl+"/update-cart-on-load",
                type: "GET",
                data: {'authentication': response.authentication},  
                success: function(response){
                    if(response.data == ''){
                        $('#cartItemCount').html('0');
                    }else{
                    let item_count = response.data.length;  
                    $('#cartItemCount').html(item_count);  
                    let decryptId = getDecryptId(product_id);  
                        response.data.forEach(function(item){
                            if(decryptId == item.product_id){
                                $('#delivery_date').val(item.delivery_date);
                                $('#option_' + item.option_value_id).prop('checked', true);
                                $('#slider').val(item.month);
                                $('#month').val(item.month);
                                $('#quantity').val(item.quantity);
                                $('#price').val(item.price);
                                $('#show_price').html(item.price);
                                $('#add_to_cart_btn').html('Added');
                                $('#add_to_cart_btn').addClass("add_to_cart_btn_success");
                                checkStock();
                            }
                        });
                    }
                }
            });
        }
    });
 
});

function getDecryptId(encryptId){
    var return_product = '';
    $.ajax({
        url: baseUrl+"/get-product-id",
        type:"GET",
        async: false,
        data:{'encrypt_id': encryptId},
        success:function(response){
            return_product += response.product_id;
        }
     });
     return return_product;
}



