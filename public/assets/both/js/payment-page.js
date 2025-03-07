$(async function () { 
    const formatter = new Intl.NumberFormat('en-IN', {
        style: 'currency',
        currency: 'INR',
      });
async function paymentPage(){ 
   $("#loader").show();
   document.body.classList.add('no-scroll');
    let sub_total = 0;
    let final_amount_total = 0; 
    let paymentData = await fetch(baseUrl+"/get-address-payment-detail");
    let response = await paymentData.json(); 
    let paymentMethods = await fetch(baseUrl+"/api/payment-methods");
    let paymentMethodResponse = await paymentMethods.json();
    let appendToPaymentMethod = '';
    let gst = window.localStorage.getItem('GST');
    let sgst = window.localStorage.getItem('SGST');
    let igst = window.localStorage.getItem('IGST');
    let tax = window.localStorage.getItem('TAX');
     
    paymentMethodResponse.data.forEach(function (item){
        appendToPaymentMethod += `<div class="form-check">
        <input type="radio" class="form-check-input paymentMethod" id="" name="paymentMethod" value="${item.id}"  required ${item.id == 1 ? 'checked':''}>
        <label class="form-check-label" for="" style="margin-left: 14px;">${item.name}</label>
        </div>`;
    }); 

    let address_table = `
    <tbody>  
        <tr>
            <th>Shipping address</th>
            <td>${response.shipping_address.name}, ${response.shipping_address.address}, <br>${response.shipping_address.city}, <br>${response.shipping_address.zip_code}</td> 
            </tr>
            <tr>
            <th>Billing address</th>
            <td>${response.billing_address.name}, ${response.billing_address.address}, <br>${response.billing_address.city}, <br>${response.billing_address.zip_code}</td> 
            </tr>
            <tr>
            <th>Payment Method</th>
            <td>  
            <div class="mb-3" id="payment_methods> 
                ${appendToPaymentMethod}
            </div> 
            
            </td>
        </tr>          
    </tbody>`; 
    $("#payment_method_table").html(address_table);  
    response.cart_data.forEach(function (item){ 
        let month_price = "price_"+item['month']; 
          sub_total = sub_total + (item['get_stock'][month_price]*item['quantity']);
        
    });  
    // sub_total=parseInt(window.localStorage.getItem("tax")) + Number(response.shipping_charge)
    let amount_detail = `<div class="final-order-details">
    <div class="single-order-final">
        <p><b>Sub Total:</b></p>
        <p><b>${formatter.format(sub_total)}</b></p>
    </div>
    </div>
 
    <div class="final-order-details">
    <div class="single-order-final">
        <p><b>Shipping Charge :</b></p>
        <p><b>${formatter.format(response.shipping_charge)}</b></p>
    </div>
    </div>
 <div class="final-order-details">
    <div class="single-order-final">
        <p><b>CGST :</b></p>
        <p><b>${formatter.format(gst)}</b></p>
        <input type="hidden" value="${gst}" name="cgst">
    </div>
    </div>

    <div class="final-order-details">
    <div class="single-order-final">
        <p><b>SGST :</b></p>
        <p><b>${formatter.format(sgst)}</b></p>
        <input type="hidden" value="${sgst}" name="sgst">
    </div>
    </div>
     <div class="final-order-details">
    <div class="single-order-final">
        <p><b>IGST :</b></p>
        <p><b>${formatter.format(igst)}</b></p>
        <input type="hidden" value="${igst}" name="igst">
    </div>
    </div>
 
    <div class="final-order-details total-final">
    <div class="single-order-final text-danger">
        <p><b>Total :</b></p>
        <p><b>${formatter.format(sub_total + parseFloat(response.shipping_charge) + parseFloat(sgst) + parseFloat(igst) + parseFloat(gst))}</b></p>
    </div> 
    </div> `;
    $("#payble_amount_detail").html(amount_detail);
    $("#loader").hide();
    document.body.classList.remove('no-scroll');
    } 
    await paymentPage();
});

 