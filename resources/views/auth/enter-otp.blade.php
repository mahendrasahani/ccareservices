 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <link rel="stylesheet" href="{{url('public/assets/frontend/css/login.css')}}">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Login</title>
</head>
<body>
    <div class="form-container" id="form-container">
        <div class="image-part">
             <img src="{{url('public/assets/frontend/images/logo/coolcarelogo.jpg')}}" alt="">
        </div>
       
        <div class="form-part"> 
        
            <form method="POST" action="{{ route('otp.verify.submit', [$user->id]) }}" class="form" id="signup-form">
                @csrf 
                <p style="text-align: center;font-size:17px;font-weight: 600;">Verify OTP</p> 
                <div class="form-field"> 
                    <label for="verify_otp">Enter OTP <span>*</span></label>
                    <input type="number" id="otp" name="otp" placeholder="Enter OTP" maxlength="4" required >
                    @error('otp')
                        <p style="color:red;">{{ $message }}</p>
                    @enderror
                </div>
                <!-- <div class="form-field">
                    // uncomment this captcha code when go live-----------------
                <label for="verify_otp">Captcha <span>*</span></label> 
                <div class="inputfild">
                <script src="https://www.google.com/recaptcha/api.js"
                    async defer></script>
                <div class="g-recaptcha" id="feedback-recaptcha"
                    data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}">
                </div>  
                @error('g-recaptcha-response')
                <p style="color:red;">The google recptcha is required.</p>
                @enderror
            </div> 
            </div>  -->
                <button class="form-btn" style="margin-top: 10px;">Submit</button>
                <p class="cstm_resend"><a onclick="resendOtp(event)">Resend OTP</a></p>
                <p class="cstm_resend"><a href="" onclick="openVerifyNumber(event)">Edit Phone Number</a></p>
                 <p class="cstm_resend">Already have an account? <a href="{{route('login')}}">Login here</a></p>
             </form>
 
            <form method="POST" action="{{ route('otp.edit_phone_number', [$user->id]) }}" class="form" id="verify_number">
                @csrf
                <p style="text-align: center;font-size:17px;font-weight: 600;">Verify Number</p> 
                <div class="form-field"> 
                    <label for="phone_number">Enter Phone <span>*</span></label>
                    <input type="number" value="{{$user->phone}}" name="phone" id="phone_number" placeholder="Enter Phone" required>
                </div>  
                <button class="form-btn">Submit</button>
        </form>
        </div>
    </div>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="{{url('public/assets/frontend/js/bootstrap.bundle.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   
    @if(Session::has('incorrect_otp'))
        <script> 
            Swal.fire({
            title: "Sorry!",
            text: "{{Session::get('incorrect_otp')}}",
            icon: "warning",
            timer: 5000,
            });
        </script>
        @endif

        <script>
             document.addEventListener("DOMContentLoaded", function (){
            const number=document.getElementById("verify_number");
                  number.style.display="none";
              });


             function openVerifyNumber(e){
                e.preventDefault();
            const number=document.getElementById("verify_number");
            number.style.display="flex";

            const signUp=document.getElementById("signup-form");
            signUp.style.display="none";
                  
             }


             function openVerifyOtp(e){
                e.preventDefault();

                const signUp=document.getElementById("signup-form");
            signUp.style.display="flex";

            const number=document.getElementById("verify_number");
            number.style.display="none";

            const numberval=document.getElementById("number_val");
            const val=document.getElementById("phone_number").value;
                numberval.innerHTML=val;
             }

             $(document).ready(function(){
                $('#otp').on('input', function(){
                    let otpVal = $('#otp').val();
                    $('#otp').val(otpVal.slice(0,4)); 
                })
             })
              

        </script>

<script>
    async function resendOtp(e){
    const formData = new FormData();
    formData.append("user_id", {{$user->id}});
    formData.append("phone", {{$user->phone}});

    e.preventDefault();
    const apiResponse = await fetch("http://localhost/ccareservices/api/resend-otp", {
        method: "POST",
        body: formData
    });
    const data = await apiResponse.json();
    Swal.fire({
    title: 'Success!',
    text: 'Otp Send Successfully',
    icon: 'success',
    showConfirmButton: false,
    timer: 1000
});
}

        </script>
</body>
</html>



