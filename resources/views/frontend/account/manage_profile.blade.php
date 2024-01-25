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
          <form class="edit-form card p-3" action="">
            <div class="row">
              <div class="col-md-6">
                <div class="form-field">
                  <label for="fullName" class="form-about">Full Name:</label>
                  <input type="text" id="fullName" name="fullName" placeholder="Enter your full name" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-field">
                  <label for="email" class="form-about">Email:</label>
                  <input type="email" id="email" name="email" placeholder="Enter your email" autocomplete="username"
                    required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-field">
                  <label for="phoneNumber" class="form-about">Phone No.</label>
                  <input type="tel" id="phoneNumber" name="phoneNumber" placeholder="Enter phone number"
                    pattern="[0-9]{10}" title="Please enter a 10-digit phone number" required />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-field">
                  <label for="companyName" class="form-about">Enter Company Name</label>
                  <input required placeholder="Enter your company name" type="company" name="companyName"
                    id="companyName" />
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-field">
                  <label for="password" class="form-about">Password:</label>
                  <input type="password" id="password" name="password" placeholder="Enter your password"
                    autocomplete="new-password" required />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-field">
                  <label for="confirmPassword" class="form-about">Confirm Password:</label>
                  <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm your password"
                    autocomplete="confirm-password" required />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-field">
                  <label for="address1" class="form-about">Address 1</label>
                  <input required placeholder="Address 1" type="add 1" name="address" id="address1" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-field">
                  <label for="address2" class="form-about">Address 2</label>
                  <input required placeholder="Address 2" type="add 2" name="address" id="address2" />
                </div>
              </div>
            
              <div class="col-md-6">
                <div class="form-field">
                  <label for="country" class="form-about">Country:</label>
                  <select id="country" onchange="updateStates()">
                    <option value="">Select Country</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-field">
                  <label for="state" class="form-about">State:</label>
                  <select id="state">
                    <option value="" >Select State</option>
                  </select>
                </div>
              </div> 
                <div class="col-md-6">
                  <div class="form-field">
                    <label for="city" class="form-about">City:</label>
                    <input type="text" id="city" name="city" placeholder="Enter your city" required />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-field">
                    <label for="postalCode" class="form-about">Postal Code:</label>
                    <input type="text" id="postalCode" name="postalCode" placeholder="Enter your postal code" required />
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-field">
                    <label for="aadharUpload" class="form-about">Upload Aadhar Card:</label>
                    <input type="file" id="aadharUpload" name="aadharUpload" accept=".pdf" required />
                    <small>Allowed formats:PDF</small>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-field">
                    <label for="aadharUpload" class="form-about">Upload Aadhar Card Back:</label>
                    <input type="file" id="aadharUploadBack" name="aadharUploadBack" accept=".pdf" required />
                    <small>Allowed formats: PDF</small>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-field">
                    <label for="companyId" class="form-about">Company Id:</label>
                    <input type="file" id="companyId" name="aadharUpload" accept=".pdf" required />
                    <small>Allowed formats:PDF</small>
                  </div>
                </div>  
                <div class="upload-container ">
                  <div class="circle" id="selected-image-container">
                    <img class="profile-pic selected-image-container"
                      src="https://t3.ftcdn.net/jpg/03/46/83/96/360_F_346839683_6nAPzbhpSkIpb8pmAwufkC7c5eD7wYws.jpg">
                  </div>
                  <div class="p-image text-center">
                    <button class="upload-button" onclick="document.querySelector('.file-upload').click()">Select
                      Image</button>
                    <input class="file-upload d-none" type="file" name="image" accept="image/*"
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
                  <p>4471 Nutters Barn Lane Des Moines, IA 50309</p>
                  <p>5252, Alabaster, Alabama</p>
                </div>
              </div>
              <div class=" col-md-6">
                <div class="card address-default">
                  <h6>Default Billing Address</h6>
                  <hr>
                  <p>4471 Nutters Barn Lane Des Moines, IA 50309</p>
                  <p>5252, Alabaster, Alabama</p>
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

@endsection