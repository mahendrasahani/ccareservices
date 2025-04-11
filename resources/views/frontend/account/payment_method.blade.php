<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

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
            
          </div>
      </div> 
      
      <div class="container"> 
        <div class="form-check mb-3 mt-4 d-flex align-items-center gap-3" >
                <input class="form-check-input" type="checkbox" checked  
                  id="termsConditions"
                  style="width: 22px; height: 22px; margin-right:6px">
                <label class="form-check-label">
                  <h6 class="m-0" style="color:#002c6f"><span style="color:gray; font-size:15px;">I have read and agree to the</span> <a href="/terms-and-condition" target="_blank">Terms & Conditions</a></h6> 
                </label> 
                <div class="text-end mt-2"><button class="btn btn-success order_not_btn" id="submit_order_detail">Place Order</button></div> 
          </div> 
        
    </div>
  </form>
  </section>

<!--- term condition content section start --->  

<!--- term condition content end --->  


  <div class="loaderScal" id="loader">
  <div class="loaderPyment">
    <div class="spinner-row">
      <div class="spinner-border m-2" role="status" style="width:2.5rem; height:2.5rem"></div>
    </div>
    <div class="text-row">
      <span class="s">Please wait... Do not reload the page.</span>
    </div>
  </div>
</div>


@section('javascript-section')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="{{url('public/assets/both/js/payment-page.js')}}"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    $(document).on("click", "#submit_order_detail", function(e){
      e.preventDefault();

      const termsConditions = $('#termsConditions'); 
      if(!termsConditions.prop('checked')){
        $('.checkedError').show();
        return;
      }else{
        $('.checkedError').hide();
      }

      $("#loader").show();
        let payment_type = $('input[name="paymentMethod"]:checked').val();
        let formData = $("#order_form").serialize();
        if(payment_type == 2) {
            $.ajax({
                url: baseUrl+"/place-order", 
                type: "POST",
                data: formData,
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                success: function (response) {
                    if (response.key) {
                        var options = response; 
                        options.handler = function (res) {
                            window.location.href = baseUrl+"/payment-success?payment_id=" + res.razorpay_payment_id;
                        };
                        options.modal = {
                        escape: false,
                        backdropclose: false,
                        ondismiss: function () {
                            window.location.href = baseUrl + "/cart";
                        }
                    };

                        var rzp1 = new Razorpay(options);
                        rzp1.open();
                    }
                },
                error: function () {
                    alert("Error processing payment. Please try again.");
                }
            });
        }else{
            $("#order_form").submit();
        }
    });
       
    $(document).ready(function(){
      let termsConditions = $('#termsConditions');
      if (termsConditions.prop('checked')){
        $('#termCollaps').show();
      }else{
        $('#termCollaps').hide();
        $('.checkedError').hide();
      };
      $(termsConditions).on('change', function(){
          if (termsConditions.prop('checked')) {   
            $('#termCollaps').show();
            $('.checkedError').hide();
        } else {
            $('#termCollaps').hide(); 
            $('.checkedError').show();
        };
      });
});
    
</script> 


@endsection
@endsection