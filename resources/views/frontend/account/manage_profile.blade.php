@extends('layouts/frontend/main')
@section('main-section')

<style>
  .edit-form input::placeholder {
    font-size: 12px;
  }
</style>

<section class="dahboard-wrapper">
  <div class="container">
    <div class="row">

      @include('layouts/frontend/sidebar')

      <section class="middle col-md-9">
        <div class="">
          <div class="dashboard-heading">
            <h3>Edit Profile</h3>
          </div>
          <form class="edit-form card p-3" action="{{route('frontend.user.update_profile')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row">
              <div class="col-md-6">
                <div class="form-field">
                  <label for="fullName" class="form-about">Full Name:</label>
                  <input type="text" id="name" name="name" placeholder="Enter your full name" required value="{{$user_data->name ?? ''}}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-field">
                  <label for="email" class="form-about">Email:</label>
                  <input type="email" id="email" name="email" placeholder="Enter your email" autocomplete="username"
                    required value="{{$user_data->email ?? ''}}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-field">
                  <label for="phoneNumber" class="form-about">Phone No.</label>
                  <input type="tel" id="phone" name="phone" placeholder="Enter phone number"
                    pattern="[0-9]{10}" title="Please enter a 10-digit phone number" required value="{{$user_data->phone ?? ''}}"/>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-field">
                  <label for="companyName" class="form-about">Enter Company Name</label>
                  <input required placeholder="Enter your company name" type="company_name" name="company_name"
                    id="companyName" value="{{$user_data->company_name ?? ''}}"/>
                </div>
              </div>
 
              <div class="col-md-6">
                <div class="form-field">
                  <label for="address1" class="form-about">Address 1</label>
                  <input placeholder="Address 1" type="text" name="address_1" id="address_1" value="{{$user_data->address_1 ?? ''}}" required/>
                </div>
              </div>
            
                <div class="col-md-6">
                  <div class="form-field">
                    <label for="city" class="form-about">City:</label>
                    <input type="text" id="city" name="city" placeholder="Enter your city" required value="{{$user_data->city ?? ''}}"/>
                  </div>
                </div>

                <!-- <div class="col-md-6">
                  <div class="form-field">
                    <label for="postalCode" class="form-about">Postal Code:</label>
                    <input type="text" id="postal_code" name="postal_code" placeholder="Enter your postal code"  value="{{$user_data->postal_code ?? ''}}"/>
                  </div>
                </div> -->

                <div class="col-12">
                    <div class="row">
                        <div class="col-md-6">
                          <div class="form-field">
                            <label for="aadhar_front" class="form-about">Upload Aadhar Card Front:</label>
                            <input type="file" id="aadhar_front" name="aadhar_front" accept=".pdf, .jpg, .jpeg, .png"/>
                            <small>Allowed formats: PDF, JPG, JPEG, PNG </small>
                            @if($user_data->aadhar_front != '')
                            <a href="{{url($user_data->aadhar_front)}}" target="_blank" style="margin-left: 10px; text-decoration: none;">View</a>
                            @endif
                          </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-field">
                          <label for="aadhar_back" class="form-about">Upload Aadhar Card Back:</label>
                          <input type="file" id="aadhar_back" name="aadhar_back" accept=".pdf, .jpg, .jpeg, .png" />
                          <small>Allowed formats: PDF, JPG, JPEG, PNG </small>
                          @if($user_data->aadhar_back != '')
                          <a href="{{url($user_data->aadhar_back)}}" target="_blank" style="margin-left: 10px; text-decoration: none;">View</a>
                          @endif
                        </div>
                      </div>
                    </div>
                </div>
               
                <div class="upload-container mt-3">
                  <div class="circle" id="selected-image-container">
                    <img class="profile-pic selected-image-container"
                      src="{{url($user_data->profile ?? 'public/assets/both/images/user_profile/profile.jpg')}}">
                  </div>
                  <div class="p-image text-center">
                    <button  class="upload-button" onclick="event.preventDefault(); document.querySelector('.file-upload').click()">
                      Change Profile Picture</button>
                    <input class="file-upload d-none" type="file" name="profile" accept="image/*"
                      onchange="displayImage(this)" />
                  </div>
                </div> 

                 <div style="max-width: 500px; margin: 0 auto;"><input class="btn btn-outline-dark mt-4 p-2" type="submit" value="Submit" /> </div>
            </div>
          </form>
          <section class="address mt-5">
            <div class="row">
              @if(Auth::user()->address_1 != '' || $shipping_addres != null)
              <div class=" col-md-6">
                <div class="card address-default">
                  <h6>Default Shipping Address</h6>
                  <hr>
                  <p style="font-size: 14px;">{{$shipping_addres->address ?? Auth::user()->address_1.', '.Auth::user()->address_2}},</p>
                  <p style="font-size: 14px;">{{$shipping_addres->city ?? Auth::user()->city}}</p>
                </div>
              </div>
              @endif 

                @if($billing_address != null)
              <div class=" col-md-6">
                <div class="card address-default">
                  <h6>Default Billing Address</h6>
                  <hr>
                  <p style="font-size: 14px;">{{$billing_address->address ?? ''}},</p>
                  <p style="font-size: 14px;">{{$billing_address->city ?? ''}}</p>
                </div>
              </div>
              @endif
            </div>
          </section>
        </div>
      </section>
    </div>
  </div>

</section>
<!--registration page-->

@section('javascript-section')

<script>
  // Function to display the selected image
  function displayImage(input)
  {
    const selectedImageContainer = document.getElementById('selected-image-container');
    const file = input.files[0];

    if (file)
    {
      const reader = new FileReader();

      reader.onload = function (e)
      {
        const img = document.createElement('img');
        img.src = e.target.result;
        img.classList.add('profile-pic');
        selectedImageContainer.innerHTML = ''; // Clear previous image
        selectedImageContainer.appendChild(img);
      };

      reader.readAsDataURL(file);
    }
  }
</script>


@if(Session::has('profile_updated'))
        <script> 
            Swal.fire({
            title: "Success!",
            text: "{{Session::get('profile_updated')}}",
            icon: "success",
            timer: 5000,
            });
        </script>
           
         
        @endif

@endsection
@endsection