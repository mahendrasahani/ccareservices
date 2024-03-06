$(document).ready(async function(){
    try{
    let product_id = $('#product_id').val(); 
    let updateCartOnLoad = await fetch(baseUrl+"/update-cart-on-load");
    const response = await updateCartOnLoad.json();
    
        if(response.data == ''){
            $('#cartItemCount').html('0');
            $('#add_to_cart_btn').html('Add to cart');
        }else{
        let item_count = response.data.length;   
        $('#cartItemCount').html(item_count);   
        let decryptId = await getDecryptId(product_id);   
        let decryptIdParse = parseInt(decryptId); 
        let found = false; 
            response.data.forEach(function(item){
                if(decryptIdParse == item.product_id){
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
                    found = true;   
                }
            });
            if (!found) { 
                $('#add_to_cart_btn').html('Add to cart'); 
            }
        }
    } catch (error) {
        console.log(error);
      }
});

async function getDecryptId(encryptId) {
    try {
        const response = await fetch(baseUrl + "/get-product-id?encrypt_id=" + encryptId);
        const data = await response.json();
        return data.product_id;
    } catch (error) {
        console.error('Error fetching product id:', error);
        return null; 
    }
}


    $(document).on("click", "#remove_cart_item", async function(){
    let p_id = $(this).data("product_id"); 
    try{
        let product_remove = await fetch(baseUrl+"/remove-from-cart?product_id="+p_id);
        const response = await product_remove.json();
        var closestTr = $(this).closest("tr");
        closestTr.remove();
        console.log(response.cart_item);
        $('#cartItemCount').html(response.cart_item); 
    }catch(error){
        console.log("Error: " + error);
    } 
    })
 

