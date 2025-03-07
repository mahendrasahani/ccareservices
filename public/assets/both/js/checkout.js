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
        $("#addressToggle").on("change", function (){
          if ($(this).is(":checked")){
            $("#content").slideDown();
          } else{
            $("#content").slideUp();
          }
        });
      });

      const formatter = new Intl.NumberFormat('en-IN', {
        style: 'currency',
        currency: 'INR',
      });

      async function updateCheckoutPage(){ 
         
        if($('input[name="shipping_rate"]:checked').length > 0){
          shipping_rate = parseInt($('input[name="shipping_rate"]:checked').val());
        }else{
          shipping_rate = 0;
        } 
        const product_list = await fetch(baseUrl+"/checkout-product-list"); 
        if(product_list.ok){
            const response = await product_list.json();
            console.log(response);
            let product_tr = '';
            let sub_total = 0;
            let final_amount_total = 0;
            let new_amount = 0;
            let sgst = 0;
            let sgst_total = 0;
            let gst = 0;
            let gst_total = 0;
            let igst = 0;
            let igst_total = 0;
            let tax = 0;
            // const tax_list = await fetch(baseUrl+"/get-tax-list"); 
            // const tax_response = await tax_list.json();
            // console.log(tax_response);
            // tax_response.data.forEach(function (tax_item){  
            // });
            response.data.forEach(function (item){
            let month_price = "price_"+item['month']; 
            //  tax += ((item['get_product']['tax_rate']*((item['get_stock'][month_price]*item['quantity'])))/100);
            tax = (((item['get_stock'][month_price]*item['quantity'])*item['get_product']['tax_rate'])/100);
           
            if(item['get_product']['tax_name'] == 'SGST'){
              sgst_total += tax;
            }else if(item['get_product']['tax_name'] == 'CGST'){
              gst_total += tax;
            }else if(item['get_product']['tax_name'] == 'IGST'){
              igst_total += tax;
            }
            

            product_tr += `<tr>
                              <td class="footable-first-visible d-flex">
                                <a href="#" target="_blank" class="product-name-default">${item['get_product']['product_name']}</a>
                                <strong>× ${item['quantity']} </strong> 
                              </td> 
                              <td>${item['get_product']['tax_name']} ${item['get_product']['tax_rate']}% ₹${tax}.00</td>
                              <td style="text-align: end">${formatter.format(item['get_stock'][month_price]*item['quantity'])}</td>
                          </tr>`;

              sub_total = sub_total + ((item['get_stock'][month_price]*item['quantity'])+tax);

              // ----------------------------------------------------------------------
              // JSON.parse(item.get_product.tax_name).forEach(function (item2, index){
              //   let tax_name = JSON.parse(item.get_product.tax_name);
              //   let tax_price = JSON.parse(item.get_product.tax_rate); 
              
              //   if(tax_name[index] == 'SGST'){
              //     sgst = sgst + item['get_stock'][month_price] * tax_price[index] / 100;
              //   }else if(tax_name[index] == 'CGST'){
              //     cgst = cgst + item['get_stock'][month_price] * tax_price[index] / 100;
              //   }else if(tax_name[index] == 'IGST'){
              //     igst = igst + item['get_stock'][month_price] * tax_price[index] / 100;
              //   }  
              //   // let tax_rates = JSON.parse(item.get_product.tax_rate);
              //   // let tax_rate_percent = tax_rates[index];
              //   // let tax_amoun_total =  (item['get_stock'][month_price]*tax_rate_percent)/100;
              //   // if(tax_name == 'IGST'){
              //   //   new_amount = new_amount+tax_amoun_total
              //   // }
              //   //  console.log(tax_name +'-'+new_amount);
              //   }); 
              // -----------------------------------------------------------------------------------
            }); 
 
            window.localStorage.setItem('SGST', sgst_total);
            window.localStorage.setItem('GST', gst_total);
            window.localStorage.setItem('IGST', igst_total);
            
            $("#product_on_checkout").html(product_tr); 
            $("#sub_total").html(formatter.format(sub_total));
            // $("#CGST").html(`₹${cgst}.00`); 
            // $("#IGST").html(`₹${igst}.00`); 
            // $("#SGST").html(`₹${sgst}.00`);  

            // response.data.forEach(function (item){
            // $("#"+item.tax_name).html(item.tax_rate); 
            // }); 
            $("#final_amount_total").html(formatter.format(sub_total + shipping_rate)); 
            // window.localStorage.setItem("SGST", sgst);
            // window.localStorage.setItem("CGST", cgst);
            // window.localStorage.setItem("IGST", igst); 
            }
        } 
    await updateCheckoutPage(); 
    $('input[name="shipping_rate"]').change(async function() {
      await updateCheckoutPage(); 
  });

 
  
async function submitOrderDetails(){ 
  $("#error_shipping_full_name").html("");
  $("#error_shipping_email").html("");
  $("#error_shipping_phone").html("");
  $("#error_shipping_address").html("");
  $("#error_shipping_city").html("");
  $("#error_shipping_zip_code").html("");
  $("#error_shipping_country").html("")
  $("#error_billing_full_name").html("");
  $("#error_billing_email").html("");
  $("#error_billing_phone").html("");
  $("#error_billing_address").html("");
  $("#error_billing_city").html("");
  // $("#error_billing_zip_code").html("");
  $("#error_billing_country").html("");
  let s_name = $("#shipping_full_name").val();
  let s_email = $("#shipping_email").val();
  let s_phone = $("#shipping_phone").val();
  let s_address = $("#shipping_address").val();
  let s_city = $("#shipping_city").val();
  let s_zip_code = $("#shipping_zip_code").val();
  let s_country = $("#shipping_country").val()
  let b_name = $("#billing_full_name").val();
  let b_email = $("#billing_email").val();
  let b_phone = $("#billing_phone").val();
  let b_address = $("#billing_address").val();
  let b_city = $("#billing_city").val();
  // let b_zip_code = $("#billing_zip_code").val();
  let b_country = $("#billing_country").val(); 
  //-------------- shipping details validation (start) -----------------------
      if(s_name == ''){
          $("#error_shipping_full_name").html("This field is required.");
          $("#shipping_full_name").focus();
          return false;
      } 
      if(s_email == ''){
        $("#error_shipping_email").html("This field is required.");
        $("#shipping_email").focus();
        return false;
      }
      if(s_phone == ''){
        $("#error_shipping_phone").html("This field is required.");
        $("#shipping_phone").focus();
        return false;
      }
      if(s_address == ''){
        $("#error_shipping_address").html("This field is required.");
        $("#shipping_address").focus();
        return false;
      }
      if(s_city == ''){
        $("#error_shipping_city").html("This field is required.");
        $("#shipping_city").focus();
        return false;
      }
      if(s_zip_code == ''){
        $("#error_shipping_zip_code").html("This field is required.");
        $("#shipping_zip_code").focus();
        return false;
      }
      if(s_country == ''){
        $("#error_shipping_country").html("This field is required.");
        $("#shipping_country").focus();
        return false;
      }
    

  //-------------- shipping details validation (end) -----------------------

  //-------------- billing details validation (start) -----------------------
      if($('#addressToggle').prop('checked')){
          if(s_name == ''){
            $("#error_billing_full_name").html("This field is required.");
            return false;
          } 
          if(s_email == ''){
            $("#error_billing_email").html("This field is required.");
            return false;
          }
          if(s_phone == ''){
            $("#error_billing_phone").html("This field is required.");
            return false;
          }
          if(s_address == ''){
            $("#error_billing_address").html("This field is required.");
            return false;
          }
          if(s_city == ''){
            $("#error_billing_city").html("This field is required.");
            return false;
          }
          // if(s_zip_code == ''){
          //   $("#error_billing_zip_code").html("This field is required.");
          //   return false;
          // }
          if(s_country == ''){
            $("#error_billing_country").html("This field is required.");
            return false;
          }
    } 
  //-------------- billing details validation (end) -----------------------

        if($('input[name="shipping_rate"]:checked').length <= 0){
          $("#shipping_charge_error").html("This field is required.");
          return false;
        }


  // var csrf_token = $('input[name="_token"]').val();
  // try{
  //    let submitPostCheckout = await fetch(baseUrl+"/submit_checkout_address", {
  //     method:"POST",
  //     headers:{
  //         'Content-Type':'application/json',
  //         'X-CSRF-Token':csrf_token
  //     },
  //     body:JSON.stringify({
  //       's_name':s_name,
  //        's_email':s_email,
  //        's_phone':s_phone,
  //        's_address':s_address,
  //        's_city':s_city,
  //        's_zip_code':s_zip_code,
  //        's_country':s_country,
  //        'both_address':$('#addressToggle').prop('checked'),
  //        'b_name':b_name,
  //        'b_email':b_email,
  //        'b_phone':b_phone,
  //        'b_address':b_address,
  //        'b_city':b_city,
  //        'b_zip_code':b_zip_code,
  //        'b_country':b_country,
  //     })
  //   }); 
  //     let response = await submitPostCheckout.json(); 
  //     window.open(baseUrl+'/payment-method');
  //   }catch(error){
  //     console.log("Error: "+ error);
  //   }
}
    $(document).on("click", "#submit_order_detail", submitOrderDetails);
});

