@extends('layouts/frontend/main')
@section('main-section')
 

  <section id="banner-image">
    <div class="container">
      <div class="row">
        <div class="col-md-12 mt-2">
          <h2 class=" text-white pb-2 pt-5 text-center">Payment</h2>
          <nav aria-label="breadcrumb" style="margin: 0 auto;">
            <ol class="breadcrumb d-flex justify-content-center">
              <li class="breadcrumb-item"><a href="/" class="text-white">Home</a></li>
              <li class="breadcrumb-item active pt-1" aria-current="page" style="color: #01b7e0; font-size: 14px;">
                Payment</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </section>

  <section class="mt-5 payment_option">
    <div class="container">
        <div class="row">
            <div class="col-md-8"> 
             <table class="payment_method_table">
                            <tbody>
                                <tr>
                                    <th>Name</th>
                                    <td>Kartik</td>
                                </tr>
                                <tr>
                                <th>Shipping address</th>
                                <td> C4B 331B jankpuri 2nd floor <br>NEW DELHI, <br>DELHI 110058</td> 
                                </tr>
                                <tr>
                                <th>Billing address</th>
                                <td> C4B 331B jankpuri 2nd floor <br>NEW DELHI, <br>DELHI 110058</td> 
                                </tr>
                                <tr>
                                <th>Payment Method</th>
                                <td> 
                      <!-- Payment Method --> 
                      <div class="mb-3"> 
                          <div class="form-check">
                              <input type="radio" class="form-check-input paymentMethod" id="cashOnDelivery"
                              name="paymentMethod" value="cashOnDelivery" checked>
                              <label class="form-check-label" for="cashOnDelivery" style="margin-left: 14px;">Cash on
                                Delivery (COD)</label>
                            </div> 
                        </div> 
                        <div class="form-check">
                          <input type="radio" class="form-check-input paymentMethod" id="creditCard"
                            name="paymentMethod" value="creditCard">
                          <label class="form-check-label" for="creditCard" style="margin-left: 14px;">Razorpay</label>
                        </div> 
                    </td>
                                </tr>
                                 
                            </tbody>
                </table>
            </div>
            <div class="col-md-4 card justify-content-center"> 
                                <div class="final-order-details">
                                    <div class="single-order-final">
                                        <p><b>Sub Total:</b></p>
                                        <p><b>$224.10</b></p>
                                    </div>
                                </div>
                                <div class="final-order-details">
                                    <div class="single-order-final">
                                        <p><b>Tax :</b></p>
                                        <p><b>$224.10</b></p>
                                    </div>
                                </div>
                                <div class="final-order-details">
                                    <div class="single-order-final">
                                        <p><b>Shipping Charge :</b></p>
                                        <p><b>$224.10</b></p>
                                    </div>
                                </div>
                                <div class="final-order-details">
                                    <div class="single-order-final">
                                        <p><b>Coupon discount :</b></p>
                                        <p><b>$224.10</b></p>
                                    </div>
                                </div>
                                <div class="final-order-details total-final">
                                    <div class="single-order-final text-danger">
                                        <p><b>Total :</b></p>
                                        <p><b>$224.10</b></p>
                                    </div> 
                                </div> 
                                <div class="text-center mt-2"><button type="button" class="btn btn-success text-center" id="submit_order_detail">Place Order</button></div>
            </div>
        </div>
    </div>
  </section>


@section('javascript-section')
 
@endsection
@endsection