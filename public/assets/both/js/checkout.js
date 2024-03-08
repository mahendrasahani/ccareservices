$(async function () { 
    $(document).on('change', '.paymentMethod', function (){
        var paymentMethodValue = $('input[name="paymentMethod"]:checked').val();  
        var creditCardInfo = $('#creditCardInfo');
        var paypalInfo = $('#paypalInfo');
        var razorpayInfo = $('#razorpayInfo'); 
        if (paymentMethodValue === 'creditCard'){
          creditCardInfo.show();
          paypalInfo.hide();
          razorpayInfo.hide();
        } else if (paymentMethodValue === 'cashOnDelivery'){
          creditCardInfo.hide();
          paypalInfo.hide();
          razorpayInfo.hide(); 
        }
      });

      $(document).ready(function (){
        $("#toggleButton").on("change", function (){
          if ($(this).is(":checked")){
            $("#content").slideDown();
          } else{
            $("#content").slideUp();
          }
        });
      });

      async function updateCheckoutPage(){
        const product_list = await fetch("http://localhost/ccareservices/checkout-product-list"); 
        if(product_list.ok){
            const response = await product_list.json();
            let product_tr = '';
            console.log(response.data);
            response.data.forEach(function (item){
                let month_price = "price_"+item['month'];
                product_tr += `<tr>
                <td class="footable-first-visible">
                  <a href="#" target="_blank" class="product-name-default">${item['get_product']['product_name']}</a>
                  <strong>× ${item['quantity']}</strong>
                </td>
                <td style="text-align: end">₹ ${item['get_stock'][month_price]*item['quantity']}</td>
              </tr>`; 
            });
            $("#product_on_checkout").html(product_tr);
            }
             
        }
    
    await updateCheckoutPage();
    
});
