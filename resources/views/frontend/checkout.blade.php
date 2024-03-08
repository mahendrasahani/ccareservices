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
            <h5 class="mb-3">Billing details</h5>
            <form>
              <div class="mb-3">
                <label for="forName">Full Name<span class="text-danger">*</span></label>
                <input type="text" class="form-control" placeholder="Enter your full name" id="billing_full_name" name="billing_full_name" required>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="billing_email" name="billing_email" placeholder="Enter your email" required>
              </div>
              <div class="mb-3">
                <label for="region" class="form-label">Country / Region </label>
                <select class="form-control aiz-selectpicker" name="billing_country" id="billing_country">
                  <option value="India" selected>India</option> 
                </select> 
              </div> 
              <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="billing_address" name="billing_address" placeholder="Enter full address" required>
              </div>
              <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" id="billing_city" name="billing_city" placeholder="Enter City" required>
              </div>
              <div class="mb-3">
                <label for="zipCode" class="form-label">Zip Code</label>
                <input type="text" class="form-control" id="billing_zip_code" name="billing_zip_code" placeholder="Enter Zip Code" required>
              </div> 
            </form>
          </div>
        </div>
        <br>
        <div class="card">
          <div class="card-header d-flex">
            <div class="aiz-checkbox-inline" data-id="one">
              <label class="aiz-checkbox">
                <input type="checkbox" id="toggleButton"> 
              </label>
            </div>
            <h3 class="h5" style="margin-left: 13px;">Ship to a different address?</h3>
          </div>
          <div class="card-body" id="content" style="display: none;">
          <form>
              <div class="mb-3">
                <label for="forName">Full Name<span class="text-danger">*</span></label>
                <input type="text" class="form-control" placeholder="Enter your full name" name="shipping_full_name"  id="shipping_full_name" required>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="shipping_email" name="shipping_email" placeholder="Enter your email" required>
              </div>
              <div class="mb-3">
                <label for="region" class="form-label">Country / Region </label>
                <select class="form-control aiz-selectpicker" name="shipping_country" id="shipping_country">
                  <option value="India" selected>India</option> 
                </select> 
              </div> 
              <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="shipping_address" name="shipping_address" placeholder="Enter full address" required>
              </div>
              <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" id="shipping_city" name="shipping_city" placeholder="Enter City" required>
              </div>
              <div class="mb-3">
                <label for="zipCode" class="form-label">Zip Code</label>
                <input type="text" class="form-control" id="shipping_zip_code" name="shipping_zip_code" placeholder="Enter Zip Code" required>
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
                  <tr>
                    <td class="footable-first-visible">
                      <a href="single-product.html" target="_blank" class="product-name-default">2 Ton Window Ac On Rent</a>
                      <strong>× 1</strong>
                    </td>
                    <td style="text-align: end">₹3,300.00</td>
                  </tr>
                  <tr>
                    <td class="footable-first-visible">
                      <a href="single-product.html" target="_blank" class="product-name-default">2 Ton Window Ac On Rent</a>
                      <strong>× 1</strong>
                    </td>
                    <td style="text-align: end">₹3,300.00</td>
                  </tr>
                  <tr>
                    <td class="footable-first-visible">
                      <a href="single-product.html" target="_blank" class="product-name-default">2 Ton Window Ac On Rent</a>
                      <strong>× 1</strong>
                    </td>
                    <td style="text-align: end">₹3,300.00</td>
                  </tr>
                  </tbody>
              </table>

              <table>
                <tbody>
                  <tr>
                    <td>Subtotal</td>
                    <td style="text-align: end">₹3,300.00</td>
                  </tr>
                  <tr>
                    <td>Shipping</td>
                    <td style="text-align: end">
                      <div class="form-check">
                        <input type="radio" class="form-check-input" id="radio1" name="optradio" value="option1"
                          checked>Flat rate
                        <label class="form-check-label" for="radio1"></label>
                      </div>
                      <div class="form-check">
                        <input type="radio" class="form-check-input" id="radio2" name="optradio" value="option2">Free
                        shipping
                        <label class="form-check-label" for="radio2"></label>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Total</td>
                    <td style="text-align: end"> ₹3,300.00</td>
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
                    
                      <button type="button" class="btn btn-checkout " style="background-color: #213854; border: none; color:#fff;">Place
                        Order</button>
                    

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