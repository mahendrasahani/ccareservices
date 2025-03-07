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
              <div class="text-end mt-2"><button class="btn btn-success order_not_btn" id="submit_order_detail">Place Order</button></div>
          </div>
      </div> 
  </form>
  </section>
  
  <section>
      <div class="container">

          <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox"  
                  id="termsConditions"
                  style="width: 22px; height: 22px; margin-right:6px"
                >
                <label class="form-check-label" for="termsConditions">
                  <h5 class="m-0" style="color:#002c6f"> Terms & Conditions</h5> 
                </label>
          </div>  

          <div class="" id="termCollaps" style="display: none;">
            <div class="card card-body">
                <p class="pElement" style="font-size: 14px;">The parties to this agreement are the lessor and the lessee where Cool Care Service is the Lessor & the customer is the lessee. The terms of the rental agreement are as follows:</p>
                <h5 class="h5Element">Tenure of Contract</h5>
                <p class="pElement" style="font-size: 14px;">Contract has a lock-in period that is equivalent to the tenure of the contact that has been chosen by the customer while placing the order. Contract shall not be terminated before the tenure. In case of early termination, the rent for agreed tenure has to be paid and a minimum of 1 weeks’ notice has to be given for pick-up. Similarly, the contract can be extended for a minimum period of 3 months by giving a notice, 1 week prior to the end of the contract.</p>
                <h5 class="h5Element">Payment policy</h5>
                <ul class="ulListElement">
                    <li>The refundable deposit has to be paid in full online while placing an orde</li>
                    <li>There are no charges for pick-up. Extra charges may apply in case you do not have lift or permission to use the lift at your premises. This will be discussed before the delivery.</li>
                    <li>Billing cycle is 1st to 1st of the next month. Lessee will receive mails on the registered id on 1st of every month. First month’s rent will be calculated on pro-rata basis from the date of delivery to last day of the month.</li>
                    <li>Monthly rentals have to be paid online before 10th of every month (Due date) to avoid late payment charges of INR100. Refundable deposit does not include any monthly rent. It is simply a security deposit which takes care of the damages if any and also defaulters. Please note that the lessor has the right to physically retrieve the rented items in the event of default of monthly payments if not paid after 15 days of due date.</li>
                </ul>

                <h5 class="h5Element">Delivery policy</h5>
                <ul class="ulListElement">
                    <li>Lessee or his/her representative has to be present at the agreed date and time. Otherwise extra shipping costs incurred i.e. INR 700 will be charged by the lessor.</li>
                     <li>Delivered items cannot be returned unless they have major defects & are non-functional. Once accepted by the Lessee or his/her representative at the time of delivery, items will not be replaced before the tenure.</li>
                    <li>Though we do quality checks at our end before delivery, the lessee is expected to see if there are any damages and report the same to representative of lessor and photos shall be captured of the same.</li>
                    <li>One signed copy of the contract is to be kept by each party. Photos of Lessee will be taken with the items delivered for our records.</li>
                    <li>Please note that the lessee should ensure the entry of delivery vehicle inside the premises. Additionally, lessee has to arrange for the permission to use the lift. In case you do not have lift or permission to use lift at your premises, extra labor charges will be there to carry the products through stairs. If lessee himself wants to arrange the labor to carry the items through stairs he will have to bear any damage incurred during such shifting. Please note that in such cases, paid labor can be arranged by lessor at extra labor charges which should be discussed while placing the order.</li>
                </ul>

                <h5 class="h5Element">Pick-up policy</h5>
                <ul class="ulListElement">
                  <li>Lessee has to inform lessor 1 week prior to the end of the contract if he wants to extend or close the contract. Lessor will send notification regarding the same as well.</li>
                  <li>Pick-up date and time will be mutually decided by lessee and lessor. Lessee has to be present at the agreed date and time. Otherwise extra logistics costs incurred will be charged to the lessee.</li>
                  <li>Photos taken at the time of delivery will be matched to ascertain damages if any. And if damages are found, we advise Lessee to take photographs for reference.</li>
                </ul>

                <h5 class="h5Element">Damage policy</h5>
                <p class="pElement" style="font-size: 14px;">The Lessee agrees to pay for any damage to, loss of, or any theft (disappearance) of items, regardless of cause or fault. Item damaged beyond repair will be paid for at its Market Price. The representative shall check all items of furniture in order to ascertain any damage to the items.</p>
                <ul class="ulListElement">
                  <li>Minor scratches (below 1mm in width and depth, and 2 cm in length) on wooden furniture will be ignored as they are considered ‘normal wear and tear’. Minor Chips and breakages in timber (below 5mm in width, 1mm in depth and 1 cm in length) will be ignored, while those above the said dimensions will be charged for. Any damage which is a result of raw material or manufacturing defects will not be chargeable to the Lessee.</li>
                  <li>Any damage that results in the product being unusable will result in the value of the product being charged to the lessee. Tear in upholstery will result in charge towards replacement of upholstery. Opening up a stitched joint will not be chargeable.</li>
                  <li>Stains on upholstery which are not removable via dry cleaning will result in a charge for upholstery replacement. The extent of damage would be ascertained by comparing against the quality control document signed by the Lessee and the photographs taken on delivery day. Any variation showing damages, if ascertained as not caused by normal wear and tear, would be charged and would have to be borne by the Lessee.</li>
                  <li>A QC report stating the damages if any or a clean chit will be created on the spot and a copy of the same will be handed over to the lessee.</li>
                </ul>

                <h5 class="h5Element">Refund policy</h5>
                <p class="pElement" style="font-size: 14px;">If a clean chit is provided based on the QC report, the whole amount of refundable deposit will be credited to the account of Lessee without any interest within 5 working days. Please make sure that the account details for the transfer are shared with the lessor. In case of damage, the products will undergo further inspection at the lessor’s premises to ascertain the damage cost. This damage cost will be recovered from the refundable deposit amount paid by the lessee.</p>
                <h5 class="h5Element">Cancellation Policy</h5>
                <p class="pElement" style="font-size: 14px;">In order to be eligible for a refund, you have to return the product within 30 
                  calendar days of your purchase. The product must be in the same condition that you receive it and undamaged in any way.
                  <br>
                  <br>
                    After we receive your item, our team of professionals will inspect it and process your refund. The money will be refunded to the original payment method you’ve used during the purchase. For credit card payments it may take 5 to 10 business days for a refund to show up on your credit card statement.
                    <br><br>
                    If the product is damaged in any way, or you have initiated the return after 30 calendar days have passed, you will not be eligible for a refund.
                    <br><br>
                    If anything is unclear or you have more questions feel free to contact our customer support team.
                  </p>
                  <h5 class="h5Element">Maintenance policy</h5>
                  <p class="pElement" style="font-size: 14px;">Maintenance of electronic appliances will be taken care of by Lessor for the entire tenure of the contract. This does not cover damages or breakdowns due to mishandling. Such issues will be addressed & resolved within 3-5 days after notifying our customer care team. In case the issue is not resolved within 5 days, we will not charge the rent for the down time period.</p>
              </div>
          </div>
             
      </div>
      
  </section>

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
      $(termsConditions).on('click', function(){
          if (termsConditions.prop('checked')) {   
            $('#termCollaps').show();
        } else {
            $('#termCollaps').hide();
        }
      });
});
    
</script> 
@endsection
@endsection