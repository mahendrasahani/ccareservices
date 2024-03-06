$(document).ready(function(){
    let product_id = $('#product_id').val(); 
    let updateCartOnLoad = fetch(baseUrl+"/update-cart-on-load");
    updateCartOnLoad.then(response => {
        return response.json();
    }).then(async response =>{
        console.log(response.data);
        if(response.data == ''){
            $('#cartItemCount').html('0');
            $('#add_to_cart_btn').html('Add to cart');
        }else{
        let item_count = response.data.length;   
        $('#cartItemCount').html(item_count);   
        let decryptId = await getDecryptId(product_id);   
        let decryptIdParse = parseInt(decryptId);
        console.log(decryptIdParse);
        console.log(typeof decryptIdParse);
        console.log(response.data); 
        let found = false; 
            response.data.forEach(function(item){
                if(decryptIdParse == item.product_id){
                    console.log('hello');
                    $('#delivery_date').val(item.delivery_date);
                    $('#option_' + item.option_value_id).prop('checked', true);
                    $('#slider').val(item.month);
                    $('#month').val(item.month);
                    $('#quantity').val(item.quantity);
                    $('#price').val(item.price);
                    $('#show_price').html(item.price);
                    $('#add_to_cart_btn').html('Added');
                    $('#add_to_cart_btn').addClass("add_to_cart_btn_success");
                    // checkStock();
                    found = true;   
                }
            });
            if (!found) { 
                $('#add_to_cart_btn').html('Add to cart');
                console.log("my test");
            }
        }
    }).catch(error => {
        console.log('There was a problem with the fetch operation:', error);
      });
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

