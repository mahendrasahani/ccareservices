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
            <form action="{{route('submit_checkout_address')}}" method="POST">
              @csrf
              <div class="mb-3">
                <label for="forName">Full Name<span class="text-danger">*</span></label>
                <input type="text" class="form-control" placeholder="Enter your full name" id="shipping_full_name" name="s_name" value="{{$shipping_address->name ?? ''}}" required>
                <p class="input_error" id="error_shipping_full_name"></p>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="shipping_email" name="s_email" placeholder="Enter your email" value="{{$shipping_address->email ?? ''}}" required>
                <p class="input_error" id="error_shipping_email"></p>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Phone<span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="shipping_phone" name="s_phone" placeholder="Enter your phone" value="{{$shipping_address->phone ?? ''}}" required>
                <p class="input_error" id="error_shipping_phone"></p>
              </div>
              <div class="mb-3">
                <label for="address" class="form-label">Address<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="shipping_address" name="s_address" placeholder="Enter full address" value="{{$shipping_address->address ?? ''}}" required>
                <p class="input_error" id="error_shipping_address"></p>
              </div>
              <div class="mb-3">
                <label for="city" class="form-label">City<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="shipping_city" name="s_city" placeholder="Enter City" value="{{$shipping_address->city ?? ''}}" required>
                <p class="input_error" id="error_shipping_city"></p>
              </div>
              <div class="mb-3">
                <label for="zipCode" class="form-label">Zip Code<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="shipping_zip_code" name="s_zip_code" placeholder="Enter Zip Code" value="{{$shipping_address->zip_code ?? ''}}" required>
                <p class="input_error" id="error_shipping_zip_code"></p>
              </div> 
              <div class="mb-3">
                <label for="region" class="form-label">Country / Region<span class="text-danger">*</span></label>
                <select class="form-control aiz-selectpicker" name="shipping_country" id="s_country">
                  <option value="India" selected>India</option> 
                </select> 
                <p class="input_error" id="error_shipping_country"></p>
              </div>  
           
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
          
              <div class="mb-3">
                <label for="forName">Full Name<span class="text-danger">*</span></label>
                <input type="text" class="form-control" placeholder="Enter your full name" name="b_name" value="{{$billing_address->name ?? ''}}"  id="billing_full_name">
                <p class="input_error" id="error_billing_full_name"></p>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="billing_email" name="b_email" placeholder="Enter your email" value="{{$billing_address->email ?? ''}}">
                <p class="input_error" id="error_billing_email"></p>
              </div>
              <div class="mb-3">
                <label for="" class="form-label">Phone<span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="billing_phone" name="b_phone" placeholder="Enter your phone" value="{{$billing_address->phone ?? ''}}">
                <p class="input_error" id="error_billing_phone"></p>
              </div>
              <div class="mb-3">
                <label for="address" class="form-label">Address<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="billing_address" name="b_address" placeholder="Enter full address" value="{{$billing_address->address ?? ''}}">
                <p class="input_error" id="error_billing_address"></p>
              </div>
              <div class="mb-3">
                <label for="city" class="form-label">City<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="billing_city" name="b_city" placeholder="Enter City" value="{{$billing_address->city ?? ''}}">
                <p class="input_error" id="error_billing_city"></p>
              </div>
              <div class="mb-3">
                <label for="zipCode" class="form-label">Zip Code<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="billing_zip_code" name="billing_zip_code" placeholder="Enter Zip Code" value="{{$billing_address->zip_code ?? ''}}">
                <p class="input_error" id="error_billing_zip_code"></p>
              </div> 
              <div class="mb-3">
                <label for="region" class="form-label">Country / Region <span class="text-danger">*</span></label>
                <select class="form-control aiz-selectpicker" name="b_country" id="billing_country">
                  <option value="India" selected>India</option> 
                </select> 
                <p class="input_error" id="error_billing_country"></p>
              </div> 
           
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h4 class="d-flex justify-content-between">Your order</h4>
          </div>
          <div class="card-body">
           
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

              <table class="table aiz-table mb-0 footable footable-1 breakpoint-lg">
                <tbody>
                  <tr>
                    <td>Subtotal</td>
                    <td style="text-align: end" id="sub_total">₹</td>
                  </tr>
                  <tr>
                    <td>Shipping</td>
                    <td style="text-align: end">
                      @if($free_shipping_charges != '')
                      <div class="form_check_checkout">
                        <input type="radio" class="form-check-input" id="shipping_charge_{{$free_shipping_charges->id}}" name="shipping_rate" data-shipping-id="{{$free_shipping_charges->id}}" value="{{$free_shipping_charges->amount}}" required>
                        <label class="form-check-label mx-2" for="radio2">{{$free_shipping_charges->name}}</label>
                      </div>
                      @endif
                      @if($paid_shipping_charges != '')
                      @foreach($paid_shipping_charges as $paid_charge)
                      <div class="form_check_checkout">
                        <input type="radio" class="form-check-input" id="shipping_charge_{{$paid_charge->id}}" name="shipping_rate" value="{{$paid_charge->amount}}" data-shipping-id="{{$paid_charge->id}}" required> 
                        <label class="form-check-label mx-2" for="radio1">{{$paid_charge->name}} {{number_format($paid_charge->amount, 2)}}/-</label>
                      </div>
                      @endforeach
                      @endif
                      <p class="input_error" id="shipping_charge_error"></p>
                    </td>
                  </tr>
              
                  <tr>
                    <td>Total</td>
                    <td style="text-align: end" id="final_amount_total"></td>
                  </tr>
                  </tbody>
              </table> 
               <div class="text-end mt-2"><button type="submit" class="btn btn-success" id="submit_order_detail">Order Now</button></div> 
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