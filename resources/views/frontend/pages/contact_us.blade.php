@extends('layouts/frontend/main')
@section('main-section')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<!-- background image-->
<section id="banner-image">
  <!-- breadcrumb strat -->
  <div class="container">
    <div class="row">
      <div class="col-md-12 mt-2">
        <h2 class=" text-white pb-2 pt-5 text-center">Contact Us</h2>
        <nav aria-label="breadcrumb" style="margin: 0 auto;">
          <ol class="breadcrumb d-flex justify-content-center">
            <li class="breadcrumb-item"><a href="#" class="text-white">Home</a></li>
            <li class="breadcrumb-item active pt-1" aria-current="page" style="color: #01b7e0; font-size: 14px;">Contact
              Us</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <!-- breadcrumb end -->
</section>
<!-- google map & contact us -->
<section>
  <div class="container">
    <form action="{{ route('frontend.contact_us.submit_contact_form') }}" method="POST">
      @csrf
    <div class="row">
      <div class="col-md-6 mt-5 mb-5">
        <h1 style=" color: #002c6f;">Contact Us</h1>
      </div>
      <div class="col-md-6  mt-5 mb-5">
        <address>
          <p class="fw-bold" style=" color: #002c6f;">Cool Care Service</p>
          <p>F222 opposite radhaswami satsang patodi road, Saraswati Enclave, Sector 10A, Gurugram, Haryana 122001
          </p>
          <p class="fw-bold">
            Telephone &nbsp&nbsp<i class="fa-solid fa-phone" style=" color: #002c6f;"></i> <a href="tel:+917291917070 "
              class="text-dark text-decoration-none">7291917070 </a>
          </p>
        </address>
      </div>
      <div class="col-md-6">
        <h4>Contact Us</h4>
        <div class="form-group required mt-2 mb-2">
          <label class="col-sm-2 control-label" for="input-name">Your Name <span style="color:red;">*</span></label>
          <div class="col-sm-10">
            <input type="text" name="name" value="{{ old('name') }}" id="input-name" class="form-control" required>
            @error('name')
              <p style="color:red;"><b>{{ $message }}</b></p>
            @enderror
          </div>
        </div>
        <div class="form-group required mt-2 mb-2">
          <label class="col-sm-2 control-label" for="input-email" style="display: inline;">E-Mail Address <span style="color:red;">*</span></label>
          <div class="col-sm-10">
            <input type="email" name="email" value="{{ old('email') }}" id="input-email" class="form-control" required>
            @error('email')
              <p style="color:red;"><b>{{ $message }}</b></p>
            @enderror
          </div>
        </div>
        <div class="form-group required">
          <label class="col-sm-2 control-label" for="input-enquiry">Enquiry <span style="color:red;">*</span></label>
          <div class="col-sm-10">
            <textarea name="message" rows="4" id="input-enquiry" class="form-control" required>{{ old('message') }}</textarea>
            @error('message')
              <p style="color:red;"><b>{{ $message }}</b></p>
            @enderror
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="responsive-map">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d47196.58360687822!2d76.9599848500094!3d28.452224351016348!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d1794fb6e12ff%3A0x7eaa313653aa3cf4!2sCoolcare%20services!5e0!3m2!1sen!2sin!4v1705562093442!5m2!1sen!2sin"
            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
      <!-- <div class="col-md-12 mb-5">
         // uncomment this captcha code when go live-----------------
      <label for="verify_otp">Captcha <span style="color:red;">*</span></label>  
          <div class="inputfild">
           <script src="https://www.google.com/recaptcha/api.js"
               async defer></script>
           <div class="g-recaptcha" id="feedback-recaptcha"
               data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}">
           </div>
           @error('g-recaptcha-response')
           <p style="color:red;"><b>The google recptcha is required.</b></p>
           @enderror
       </div> 
            <button type="submit" class="animate-btx mt-3 text-white btn btn-info btn-sm animate-btx">Submit<span id="arrow-icon"></span></button>
          </a>
        </div> -->
      </div>
    </form>
  </div>
</section> 
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

@section('javascript-section')
  @if(Session::has('submitted'))
    <script>
      Swal.fire({
      title: "Thankyou",
      text: "{{ Session::get('submitted') }}",
      icon: "success"
    });
    </script>
  @endif
@endsection

@endsection