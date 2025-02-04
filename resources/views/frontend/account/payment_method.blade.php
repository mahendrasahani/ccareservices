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
              <li class="breadcrumb-item active pt-1" aria-current="page" style="color: #01b7e0; font-size: 14px;">Payment</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </section>
  <section class="mt-5 payment_option">
    <form action="{{route('place_order')}}" method="POST" id="order_form">
      @csrf
    <div class="container">
        <div class="row">
            <div class="col-md-8"> 
             <table class="payment_method_table" id="payment_method_table"></table>
            </div>
            <div class="col-md-4 card justify-content-center" id="payble_amount_detail"></div>
            <div class="text-end mt-2"><button class="btn btn-success order_not_btn" id="submit_order_detail">Place Order</button></div>
        </div>
    </div> 
  </form>

  </section>

<div class="loaderScal" id="loader"
  style="width: 100%; 
   height: 100vh;
  position: absolute;
  top: 0; 
  left: 0;
  z-index: 99999;
  background: rgba(0, 0, 0, 0.8);
  display: flex;
  justify-content: center;
  align-items: center;
  color: #ffff;
  display: none;"
>
  <div class="loaderPyment">
    <div class="spinner-border m-2" role="status" style="width:2.5rem; height:2.5rem">
    </div>
    <span class="s">Please wait... Do not reload the page.</span>
  </div>
</div>

@section('javascript-section')
<script src="{{url('public/assets/both/js/payment-page.js')}}"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
  
$(document).on("click", "#submit_order_detail", function(e){
  e.preventDefault();
  $("#loader").show();
    let payment_type = $('input[name="paymentMethod"]:checked').val();
    let formData = $("#order_form").serialize();
    if (payment_type == 2) {
        $.ajax({
            url: baseUrl+"/place-order", 
            type: "POST",
            data: formData,
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") // Fetch CSRF token
            },
            success: function (response) {
                console.log('my response ' + response);
                if (response.key) {
                    var options = response; 
                    options.handler = function (res) {
                        window.location.href = baseUrl+"/payment-success?payment_id=" + res.razorpay_payment_id;
                    };
                    var rzp1 = new Razorpay(options);
                    rzp1.open();
                }
            },
            error: function () {
                alert("Error processing payment. Please try again.");
            }
        });
    } else {
        $("#order_form").submit();
    }
});

 
 
 </script> 
 
@endsection

@endsection