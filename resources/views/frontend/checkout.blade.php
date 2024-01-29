@extends('layouts/frontend/main')
@section('main-section')


<style>
  .order-paymnent tr td:nth-of-type(1){
text-align:left;
  }
</style>
<!-- background image-->
<section>
  <section id="banner-image">
    <!-- breadcrumb strat -->
    <div class="container">
      <div class="row">
        <div class="col-md-12 mt-2">
          <h2 class=" text-white pb-2 pt-5 text-center">Checkout</h2>
          <nav aria-label="breadcrumb" style="margin: 0 auto;">
            <ol class="breadcrumb d-flex justify-content-center">
              <li class="breadcrumb-item"><a href="#" class="text-white">Home</a></li>
              <li class="breadcrumb-item active pt-1" aria-current="page" style="color: #01b7e0; font-size: 14px;">
                Checkout</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
    <!-- breadcrumb end -->
  </section>

  <!-- breadcrumb strat -->

</section>
<!-- breadcrumb end -->
<!-- Checkout start -->
<section>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h4>Checkout</h4>
          </div>
          <div class="card-body">
            <!-- Billing details -->
            <h5 class="mb-3">Billing details</h5>
            <form>
              <div class="mb-3">
                <label for="forName">
                  Full Name
                  <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control" placeholder="Name" required>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" placeholder="john@example.com" required>
              </div>
              <div class="mb-3">
                <label for="region" class="form-label">Country / Region </label>
                <select class="form-control aiz-selectpicker" name="DEFAULT_LANGUAGE" data-live-search="true"
                  data-selected="en" tabindex="-98">
                  <option value="IND">India</option>
                  <option value="US">United States of America</option>
                  <option value="AUS">Australia</option>
                </select>
                <div class="dropdown-menu" style="overflow: hidden;">
                  <div class="bs-searchbox">
                    <input type="search" class="form-control" autocomplete="off" role="combobox" aria-label="Search"
                      aria-autocomplete="list" aria-activedescendant="bs-select-1-0">
                  </div>
                  <div class="inner show" role="listbox" id="bs-select-1" tabindex="-1" style="overflow-y: auto;">
                    <ul class="dropdown-menu inner show" role="presentation"
                      style="margin-top: 0px; margin-bottom: 0px;">
                      <li class="selected active">
                        <a role="option" class="dropdown-item active selected" id="bs-select-1-0" tabindex="0"
                          aria-setsize="5" aria-posinset="1" aria-selected="true">
                          <span class="text">India</span>
                        </a>
                      </li>
                      <li>
                        <a role="option" class="dropdown-item" id="bs-select-1-1" tabindex="0" aria-setsize="5"
                          aria-posinset="2">
                          <span class="text">United States of America</span>
                        </a>
                      </li>
                      <li>
                        <a role="option" class="dropdown-item" id="bs-select-1-2" tabindex="0" aria-setsize="5"
                          aria-posinset="3">
                          <span class="text">Australia</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>

              <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" placeholder="123 Main St" required>
              </div>
              <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" id="city" placeholder="City" required>
              </div>
              <div class="mb-3">
                <label for="zipCode" class="form-label">Zip Code</label>
                <input type="text" class="form-control" id="zipCode" placeholder="12345" required>
              </div>



              <!-- PayPal Information -->
              <!-- <div id="paypalInfo" style="display: none;"> -->
              <!-- <h5 class="mb-3">PayPal Information</h5> -->
              <!-- <p>Login to your PayPal account to complete the purchase.</p> -->
              <!-- </div> -->

              <!-- Submit Button -->

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
            <!-- Billing details -->

            <form>
              <div class="mb-3">
                <label for="forName">
                  Full Name
                  <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control" placeholder="Name" required>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" placeholder="john@example.com" required>
              </div>
              <div class="mb-3">
                <label for="region" class="form-label">Country / Region </label>
                <select class="form-control aiz-selectpicker" name="region" data-live-search="true" data-selected="en"
                  tabindex="-98">
                  <option value="IND">India</option>
                  <option value="US">United States of America</option>
                  <option value="AUS">Australia</option>
                </select>
                <div class="dropdown-menu" style="overflow: hidden;">
                  <div class="bs-searchbox">
                    <input type="search" class="form-control" autocomplete="off" role="combobox" aria-label="Search"
                      aria-autocomplete="list" aria-activedescendant="bs-select-1-0">
                  </div>
                  <div class="inner show" role="listbox" id="bs-select-1" tabindex="-1" style="overflow-y: auto;">
                    <ul class="dropdown-menu inner show" role="presentation"
                      style="margin-top: 0px; margin-bottom: 0px;">
                      <li class="selected active">
                        <a role="option" class="dropdown-item active selected" id="bs-select-1-0" tabindex="0"
                          aria-setsize="5" aria-posinset="1" aria-selected="true">
                          <span class="text">India</span>
                        </a>
                      </li>
                      <li>
                        <a role="option" class="dropdown-item" id="bs-select-1-1" tabindex="0" aria-setsize="5"
                          aria-posinset="2">
                          <span class="text">United States of America</span>
                        </a>
                      </li>
                      <li>
                        <a role="option" class="dropdown-item" id="bs-select-1-2" tabindex="0" aria-setsize="5"
                          aria-posinset="3">
                          <span class="text">Australia</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>

              <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" placeholder="123 Main St" required>
              </div>
              <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" id="city" placeholder="City" required>
              </div>
              <div class="mb-3">
                <label for="zipCode" class="form-label">Zip Code</label>
                <input type="text" class="form-control" id="zipCode" placeholder="12345" required>
              </div>



              <!-- PayPal Information -->
              <!-- <div id="paypalInfo" style="display: none;"> -->
              <!-- <h5 class="mb-3">PayPal Information</h5> -->
              <!-- <p>Login to your PayPal account to complete the purchase.</p> -->
              <!-- </div> -->

              <!-- Submit Button -->

            </form>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h4 class="d-flex justify-content-between">Your order
            </h4>
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
                <tbody class="order-paymnent">
                  <tr>
                    <td class="footable-first-visible">
                      <a href="single-product.html" target="_blank" class="product-name-default">
                        2 Ton Window Ac On Rent
                      </a>
                      <strong>× 1</strong>
                    </td>
                    <td style="text-align: end">
                      ₹3,300.00
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Subtotal
                    </td>
                    <td style="text-align: end">
                      ₹3,300.00
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Shipping
                    </td>
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
                    <td>
                      Total
                    </td>
                    <td style="text-align: end">
                      ₹3,300.00
                    </td>
                  </tr>
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

                      <!-- Credit Card Information -->
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
                  <tr>
                    <td>
                      <button type="button" class="btn btn-checkout " style="background-color: #213854; border: none; color:#fff;">Place
                        Order</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>

</section>
@section('javascript-section')
<script>
  $(document).on('change', '.paymentMethod', function ()
  {
    var paymentMethodValue = $('input[name="paymentMethod"]:checked').val();
    console.log(paymentMethodValue);

    var creditCardInfo = $('#creditCardInfo');
    var paypalInfo = $('#paypalInfo');
    var razorpayInfo = $('#razorpayInfo');

    if (paymentMethodValue === 'creditCard')
    {
      creditCardInfo.show();
      paypalInfo.hide();
      razorpayInfo.hide();
    } else if (paymentMethodValue === 'cashOnDelivery')
    {
      creditCardInfo.hide();
      paypalInfo.hide();
      razorpayInfo.hide(); // Adjust this based on your requirements
    }
  });


</script>
<script>
  $(document).ready(function ()
  {
    $("#toggleButton").on("change", function ()
    {
      if ($(this).is(":checked"))
      {
        $("#content").slideDown();
      } else
      {
        $("#content").slideUp();
      }
    });
  });
</script>


@endsection
@endsection