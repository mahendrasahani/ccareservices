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
             <img src="{{url('public/assets/frontend/images/logo/coolcarelogo.jpg')}}" alt="img">
        </div>
        <div class="form-part" >
            {{-- <form method="POST" action="{{ route('login') }}" class="form" id="login-form">
                @csrf
                <p style="text-align: center;font-size:17px;font-weight: 600;">LOGIN TO COOLCARE</p>
                <div class="form-field">
                    <label for="text">Email <span>*</span></label>
                    <input type="email" name="email" id="email" placeholder="Enter your email....." required value="{{old('email')}}">
                    <p id="check_account_error" style="color:red;"></p>
                    @error('email')
                      <p style="color:red;">{{$message}}</p>
                    @enderror 
                </div> 
                <div class="form-field"> 
                    <label for="password">Password <span>*</span></label>
                     <input type="password" name="password" placeholder="Enter your password....." required>
                     <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div> 
                <a href="{{route('password.request')}}" style="text-align:center;margin-top:5px"><span>Forget Password?</span></a>
                <button class="form-btn">Login</button>
                <p style="margin-top:5px">Don't have an account? <a href="{{route('register')}}">Signup here</a></p>
            </form>  --}}
            <form method="POST" action="{{ route('sendLoginOTP') }}" class="form" id="login-form">
                @csrf
                <p style="text-align: center;font-size:17px;font-weight: 600;">LOGIN TO COOLCARE</p>
                <div class="form-field">
                    <label for="text">Mobile Number <span>*</span></label>
                    <input type="number" name="phone" id="phone"  maxlength="10" minlength="10"  placeholder="Enter Mobile Number....." value="{{old('phone')}}">
                    <p id="check_account_error" style="color:red;"></p>
                    @error('phone')
                      <p style="color:red;">{{$message}}</p>
                    @enderror 
                </div>
                
              {{--  <a href="{{route('password.request')}}" style="text-align:center;margin-top:5px"><span>Forget Password?</span></a> --}}
                <button class="form-btn">Login</button>
                <p style="margin-top:5px">Don't have an account? <a href="{{route('register')}}">Signup here</a></p>
            </form> 
        </div>
    </div>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="{{url('public/assets/frontend/js/bootstrap.bundle.min.js')}}"></script>
     
    <script>
      
    // $("#login-form").submit(async function(event){
    //     event.preventDefault(); 
    //     let email = $("#email").val(); 
    //     let response = await fetch("{{route('user.check_account_exist')}}/?email=" + email);
    //     let data = await response.json(); // extract JSON from the response
    //     if(data.message == "user_not_found"){
    //         $("#check_account_error").html('This email id is not registered.')
    //     }else{
    //         $("#check_account_error").html('')
    //         this.submit();
    //     } 
    // });

    $(document).ready(function() {
        $('#phone').on('input', function(){
            const phoneVal = $('#phone').val();
            //$('#phone').val(phoneVal.replace(/\D/g, ''));
            if (phoneVal.length > 10) { 
                $('#phone').val(phoneVal.slice(0, 10));
            } 
        })
    })
    
    </script>
</body>
</html>



