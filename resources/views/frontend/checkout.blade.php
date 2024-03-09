@extends('layouts/frontend/main')
@section('main-section')

  <section id="banner-image">
    <div class="container">
      <div class="row">
        <div class="col-md-12 mt-2">
          <h2 class=" text-white pb-2 pt-5 text-center">Checkout</h2>
          <nav aria-label="breadcrumb" style="margin: 0 auto;">
            <ol class="breadcrumb d-flex justify-content-center">
              <li class="breadcrumb-item"><a href="/" class="text-white">Home</a></li>
              <li class="breadcrumb-item active pt-1" aria-current="page" style="color: #01b7e0; font-size: 14px;">
                Checkout</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </section>

<section>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h4>Checkout</h4>
          </div>
          <div class="card-body">
            <h5 class="mb-3">Shipping details</h5>
            <form>
              @csrf
              <div class="mb-3">
                <label for="forName">Full Name<span class="text-danger">*</span></label>
                <input type="text" class="form-control" placeholder="Enter your full name" id="shipping_full_name" name="shipping_full_name" value="{{$shipping_address->name ?? ''}}" required>
                <p class="input_error" id="error_shipping_full_name"></p>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="shipping_email" name="shipping_email" placeholder="Enter your email" value="{{$shipping_address->email ?? ''}}" required>
                <p class="input_error" id="error_shipping_email"></p>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Phone<span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="shipping_phone" name="shipping_phone" placeholder="Enter your phone" value="{{$shipping_address->phone ?? ''}}" required>
                <p class="input_error" id="error_shipping_phone"></p>
              </div>
              <div class="mb-3">
                <label for="address" class="form-label">Address<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="shipping_address" name="shipping_address" placeholder="Enter full address" value="{{$shipping_address->address ?? ''}}" required>
                <p class="input_error" id="error_shipping_address"></p>
              </div>
              <div class="mb-3">
                <label for="city" class="form-label">City<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="shipping_city" name="shipping_city" placeholder="Enter City" value="{{$shipping_address->city ?? ''}}" required>
                <p class="input_error" id="error_shipping_city"></p>
              </div>
              <div class="mb-3">
                <label for="zipCode" class="form-label">Zip Code<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="shipping_zip_code" name="shipping_zip_code" placeholder="Enter Zip Code" value="{{$shipping_address->zip_code ?? ''}}" required>
                <p class="input_error" id="error_shipping_zip_code"></p>
              </div> 
              <div class="mb-3">
                <label for="region" class="form-label">Country / Region<span class="text-danger">*</span></label>
                <select class="form-control aiz-selectpicker" name="shipping_country" id="shipping_country">
                  <option value="India" selected>India</option> 
                </select> 
                <p class="input_error" id="error_shipping_country"></p>
              </div>  
            </form>
          </div>
        </div>
        <br>
        <div class="card">
          <div class="card-header d-flex">
            <div class="aiz-checkbox-inline" data-id="one">
              <label class="aiz-checkbox">
                <input type="checkbox" id="addressToggle" > 
              </label>
            </div>
            <h3 class="h5" style="margin-left: 13px;">Billing address is different?</h3>
          </div>
          <div class="card-body" id="content" style="display: none;">
          <form>
              <div class="mb-3">
                <label for="forName">Full Name<span class="text-danger">*</span></label>
                <input type="text" class="form-control" placeholder="Enter your full name" name="billing_full_name" value="{{$billing_address->name ?? ''}}"  id="billing_full_name" required>
                <p class="input_error" id="error_billing_full_name"></p>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="billing_email" name="billing_email" placeholder="Enter your email" value="{{$billing_address->email ?? ''}}" required>
                <p class="input_error" id="error_billing_email"></p>
              </div>
              <div class="mb-3">
                <label for="" class="form-label">Phone<span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="billing_phone" name="billing_phone" placeholder="Enter your phone" value="{{$billing_address->phone ?? ''}}" required>
                <p class="input_error" id="error_billing_phone"></p>
              </div>
              <div class="mb-3">
                <label for="address" class="form-label">Address<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="billing_address" name="billing_address" placeholder="Enter full address" value="{{$billing_address->address ?? ''}}" required>
                <p class="input_error" id="error_billing_address"></p>
              </div>
              <div class="mb-3">
                <label for="city" class="form-label">City<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="billing_city" name="billing_city" placeholder="Enter City" value="{{$billing_address->city ?? ''}}" required>
                <p class="input_error" id="error_billing_city"></p>
              </div>
              <div class="mb-3">
                <label for="zipCode" class="form-label">Zip Code<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="billing_zip_code" name="billing_zip_code" placeholder="Enter Zip Code" value="{{$billing_address->zip_code ?? ''}}" required>
                <p class="input_error" id="error_billing_zip_code"></p>
              </div> 
              <div class="mb-3">
                <label for="region" class="form-label">Country / Region <span class="text-danger">*</span></label>
                <select class="form-control aiz-selectpicker" name="billing_country" id="billing_country">
                  <option value="India" selected>India</option> 
                </select> 
                <p class="input_error" id="error_billing_country"></p>
              </div> 
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h4 class="d-flex justify-content-between">Your order</h4>
          </div>
          <div class="card-body">
            <form action="">
              <table class="table aiz-table mb-0 footable footable-1 breakpoint-lg">
                <thead>
                  <tr>
                    <th>Product</th>
                    <th style="text-align: end">Subtotal</th>
                  </tr>
                </thead>
                <tbody class="order-paymnent" id="product_on_checkout"> 
                  </tbody>
              </table>

              <table>
                <tbody>
                  <tr>
                    <td>Subtotal</td>
                    <td style="text-align: end" id="sub_total">₹</td>
                  </tr>
                  <tr>
                    <td>Shipping</td>
                    <td style="text-align: end">
                      <div class="form-check">
                        <input type="radio" class="form-check-input" id="flat_rate" name="shipping_rate" value="0" checked>Flat rate Rs 50/-
                        <label class="form-check-label" for="radio1"></label>
                      </div>
                      <div class="form-check">
                        <input type="radio" class="form-check-input" id="free_shipping" name="shipping_rate" value="1">Free shipping
                        <label class="form-check-label" for="radio2"></label>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Total</td>
                    <td style="text-align: end" id="final_amount_total"></td>
                  </tr>
                  </tbody>
              </table>

              <table>
                <tbody>
                  <tr> 
                    <td>
                      <!-- Payment Method -->
                      <h5 class="mb-3">Payment Method</h5>
                      <div class="mb-3">
                        <label class="form-label">Select Payment Method</label>
                        <div class="form-check">
                          <input type="radio" class="form-check-input paymentMethod" id="creditCard"
                            name="paymentMethod" value="creditCard">
                          <label class="form-check-label" for="creditCard" style="margin-left: 14px;">Razorpay</label>
                        </div>
                        <div class="form-check">
                          <input type="radio" class="form-check-input paymentMethod" id="cashOnDelivery"
                            name="paymentMethod" value="cashOnDelivery" checked>
                          <label class="form-check-label" for="cashOnDelivery" style="margin-left: 14px;">Cash on
                            Delivery (COD)</label>
                        </div> 
                      </div> 
                      <div id="creditCardInfo" style="display: none;">
                        <h5 class="mb-3">Razorpay Information</h5>
                        <div class="mb-3">
                          <label for="cardNumber" class="form-label">ID</label>
                          <input type="text" class="form-control" id="cardNumber" placeholder="XXXX-XXXX-XXXX-XXXX">
                        </div>
                        <div class="row">
                          <div class="col-md-6 mb-3">
                            <label for="expiryDate" class="form-label">Expiry Date</label>
                            <input type="text" class="form-control" id="expiryDate" placeholder="MM/YY">
                          </div>
                          <div class="col-md-6 mb-3">
                            <label for="cvv" class="form-label">CVV</label>
                            <input type="text" class="form-control" id="cvv" placeholder="123">
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                  </tbody>
            </table>
            <button type="button" class="btn btn-success" id="submit_order_detail">Place Order</button>
            </form>
          </div>
        </div> 
      </div>
    </div>
  </div> 
</section>
@section('javascript-section')
 
@endsection
@endsection