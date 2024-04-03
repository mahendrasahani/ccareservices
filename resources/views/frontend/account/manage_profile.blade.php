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
                  <input required placeholder="Address 1" type="text" name="address_1" id="address_1" value="{{$user_data->address_1 ?? ''}}"/>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-field">
                  <label for="address2" class="form-about">Address 2</label>
                  <input required placeholder="Address 2" type="text" name="address_2" id="address_2" value="{{$user_data->address_2 ?? ''}}"/>
                </div>
              </div>
            
              <div class="col-md-6">
                <div class="form-field">
                  <label for="country" class="form-about">Country:</label>
                  <select id="country" name="country">
                    <option value="India" selected>India</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-field">
                  <label for="state" class="form-about">State:</label>
                  <select id="state" name="state">
                    <option value="New Delhi" selected>New Delhi</option>
                  </select>
                </div>
              </div> 
                <div class="col-md-6">
                  <div class="form-field">
                    <label for="city" class="form-about">City:</label>
                    <input type="text" id="city" name="city" placeholder="Enter your city" required value="{{$user_data->city ?? ''}}"/>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-field">
                    <label for="postalCode" class="form-about">Postal Code:</label>
                    <input type="text" id="postal_code" name="postal_code" placeholder="Enter your postal code" required value="{{$user_data->postal_code ?? ''}}"/>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-field">
                    <label for="aadhar_front" class="form-about">Upload Aadhar Card Front:</label>
                    <input type="file" id="aadhar_front" name="aadhar_front" accept=".pdf"  />
                    <small>Allowed formats:PDF</small>
                    @if($user_data->aadhar_front != '')
                    <a href="{{url($user_data->aadhar_front)}}" target="_blank">View</a>
                    @endif
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-field">
                    <label for="aadhar_back" class="form-about">Upload Aadhar Card Back:</label>
                    <input type="file" id="aadhar_back" name="aadhar_back" accept=".pdf"  />
                    <small>Allowed formats:PDF</small>
                    @if($user_data->aadhar_back != '')
                    <a href="{{url($user_data->aadhar_back)}}" target="_blank">View</a>
                    @endif
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-field">
                    <label for="company_id" class="form-about">Company Id:</label>
                    <input type="file" id="company_id" name="company_id" accept=".pdf"  />
                    <small>Allowed formats:PDF</small>
                    @if($user_data->company_id != '')
                    <a href="{{url($user_data->company_id)}}" target="_blank">View</a>
                    @endif
                  </div>
                </div>  
                <div class="upload-container ">
                  <div class="circle" id="selected-image-container">
                    <img class="profile-pic selected-image-container"
                      src="{{url($user_data->profile ?? 'https://t3.ftcdn.net/jpg/03/46/83/96/360_F_346839683_6nAPzbhpSkIpb8pmAwufkC7c5eD7wYws.jpg')}}">
                  </div>
                  <div class="p-image text-center">
                    <button  class="upload-button" onclick="event.preventDefault(); document.querySelector('.file-upload').click()">Select
                      Image</button>
                    <input class="file-upload d-none" type="file" name="profile" accept="image/*"
                      onchange="displayImage(this)" />
                  </div>
                </div> 
              <input class="btn  btn-outline-dark mt-4" type="submit" value="Submit" /> 
            </div>
          </form>
          <section class="address mt-5">
            <div class="row">
              <div class=" col-md-6">
                <div class="card address-default">
                  <h6>Default Shipping Address</h6>
                  <hr>
                  <p>{{$shipping_addres->address}}</p>
                  <p>{{$shipping_addres->city}} {{$shipping_addres->zip_code}} {{$shipping_addres->country}}</p>
                </div>
              </div>
              <div class=" col-md-6">
                <div class="card address-default">
                  <h6>Default Billing Address</h6>
                  <hr>
                  <p>{{$billing_address->address}}</p>
                  <p>{{$billing_address->city}} {{$billing_address->zip_code}} {{$billing_address->country}}</p>
                </div>
              </div>
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