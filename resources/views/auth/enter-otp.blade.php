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
        <div class="form-part" >
             

            <form method="POST" action="{{ route('otp.verify.submit', [$user->id]) }}" class="form" id="signup-form">
                @csrf
                <p style="text-align: center;font-size:17px;font-weight: 600;">Verify OTP</p> 
                <div class="form-field"> 
                    <label for="verify_otp">Enter OTP <span>*</span></label>
                    <input type="number" name="otp" placeholder="Enter OTP" required>
                </div> 
                <button class="form-btn" style="margin-top: 10px;">SignUp</button>
                <p class="cstm_resend"><a href="">Resend OTP</a></p>
                <p class="cstm_resend">Already have an account? <a href="{{route('login')}}">Login here</a></p>
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
</body>
</html>



