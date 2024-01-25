@extends('layouts/frontend/main')
@section('main-section')

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
                   <li class="breadcrumb-item active pt-1" aria-current="page" style="color: #01b7e0; font-size: 14px;">Contact Us</li>
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
        <div class="row">
          <div class="col-md-6 mt-5 mb-5">
            <h1 style=" color: #002c6f;">Contact Us</h1>
          </div>
          <div class="col-md-6  mt-5 mb-5">
            <address>
              <p class="fw-bold" style=" color: #002c6f;">Cool Care Service</p>
              <p>F222 opposite radhaswami satsang patodi road, Saraswati Enclave, Sector 10A, Gurugram, Haryana 122001
              </p>
              <p class="fw-bold" >
                Telephone &nbsp&nbsp<i class="fa-solid fa-phone" style=" color: #002c6f;"></i> <a href="tel:+917291917070 " class="text-dark text-decoration-none" >7291917070 </a>
              </p>
            </address>
          </div>
          <div class="col-md-6">
            <h4>Contact Us</h4>
            <div class="form-group required mt-2 mb-2">
              <label class="col-sm-2 control-label" for="input-name">Your Name</label>
              <div class="col-sm-10">
                <input type="text" name="name" value="" id="input-name" class="form-control">
              </div>
            </div>
            <div class="form-group required mt-2 mb-2">
              <label class="col-sm-2 control-label" for="input-email" style="display: inline;">E-Mail Address</label>
              <div class="col-sm-10">
                <input type="text" name="email" value="" id="input-email" class="form-control">
              </div>
            </div>
            <div class="form-group required">
              <label class="col-sm-2 control-label" for="input-enquiry">Enquiry</label>
              <div class="col-sm-10">
                <textarea name="enquiry" rows="4" id="input-enquiry" class="form-control"></textarea>
               </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="responsive-map">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d47196.58360687822!2d76.9599848500094!3d28.452224351016348!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d1794fb6e12ff%3A0x7eaa313653aa3cf4!2sCoolcare%20services!5e0!3m2!1sen!2sin!4v1705562093442!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
              </div>
          </div>
          <div class="col-md-12 mt-5 mb-5">
            <h6>captcha</h6>
            <form id="myForm" action="process-form.php" method="post">
              <!-- Your other form fields go here -->
              <!-- Add the reCAPTCHA widget -->
              <div class="g-recaptcha" data-sitekey="YOUR_RECAPTCHA_API_KEY"></div>
              <a href="#" class="text-decoration-none "id="onclick="submitForm()>
                <button class="animate-btx"> 
                    Submit
                    <span id="arrow-icon"></span>
                </button>
            </a>
            </form>
          </div>
        </div>
      </div>
    </section> 
     
    <script src="https://www.google.com/recaptcha/api.js" async defer></script> 
@endsection