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
  <form action="{{route('place_order')}}" method="POST">
    @csrf
  <section class="mt-5 payment_option">
    <div class="container">
        <div class="row">
            <div class="col-md-8"> 
             <table class="payment_method_table" id="payment_method_table"></table>
            </div>
            <div class="col-md-4 card justify-content-center" id="payble_amount_detail"></div>
        </div>
    </div> 
  </section>
</form>
@section('javascript-section')
<script src="{{url('public/assets/both/js/payment-page.js')}}"></script>
@endsection

@endsection