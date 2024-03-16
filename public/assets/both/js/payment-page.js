$(async function () { 
    const formatter = new Intl.NumberFormat('en-IN', {
        style: 'currency',
        currency: 'INR',
      });
async function paymentPage(){

    let sub_total = 0;
    let final_amount_total = 0; 
    let paymentData = await fetch(baseUrl+"/get-address-payment-detail");
    let response = await paymentData.json()
    console.log(response);
    let address_table = `
    <tbody>  
        <tr>
            <th>Shipping address</th>
            <td>${response.shipping_address.name}, ${response.shipping_address.address}, <br>${response.shipping_address.city}, <br>${response.shipping_address.zip_code} - ${response.shipping_address.country}</td> 
            </tr>
            <tr>
            <th>Billing address</th>
            <td>${response.billing_address.name}, ${response.billing_address.address}, <br>${response.billing_address.city}, <br>${response.billing_address.zip_code} - ${response.billing_address.country}</td> 
            </tr>
            <tr>
            <th>Payment Method</th>
            <td>  
            <div class="mb-3"> 
                <div class="form-check">
                   <input type="radio" class="form-check-input paymentMethod" id="cash_on_delivery" name="paymentMethod" value="cash_on_delivery" checked>
                   <label class="form-check-label" for="cashOnDelivery" style="margin-left: 14px;">Cash on Delivery (COD)</label>
                </div> 
            </div> 
            <div class="form-check">
                <input type="radio" class="form-check-input paymentMethod" id="razorpay" name="paymentMethod" value="razorpay">
                <label class="form-check-label" for="creditCard" style="margin-left: 14px;">Razorpay</label>
            </div> 
            </td>
        </tr>          
    </tbody>`; 
    $("#payment_method_table").html(address_table);
    response.cart_data.forEach(function (item){
        let month_price = "price_"+item['month']; 
          sub_total = sub_total + (item['get_stock'][month_price]*item['quantity']);
    }); 

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
        <p><b>Coupon discount :</b></p>
        <p><b>${formatter.format(0)}</b></p>
    </div>
</div>
<div class="final-order-details total-final">
    <div class="single-order-final text-danger">
        <p><b>Total :</b></p>
        <p><b>${formatter.format(sub_total + parseInt(response.shipping_charge))}</b></p>
    </div> 
</div> 
<div class="text-end mt-2"><button type="submit" class="btn btn-success" id="submit_order_detail">Place Order</button></div>`;
$("#payble_amount_detail").html(amount_detail);
}
await paymentPage(); 
});
