{{--
<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf 
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div> 
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div> 
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div> 
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
--}}
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
            <form method="POST" action="{{ route('register') }}" class="form" id="signup-form" enctype="multipart/form-data">
                @csrf
                <p style="text-align: center;font-size:17px;font-weight: 600;">SIGNUP TO COOLCARE</p>
                <div class="form-field">
                    <label for="">Full Name <span>*</span></label>
                    <input type="text" name="name" placeholder="Enter your name....." required value="{{old('name')}}" id="fullName">
                    @error('name')
                    <p style="color:red;">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-field">
                    <label for="">Email <span>*</span></label>
                    <input type="email" name="email" placeholder="Enter your email....." required value="{{old('email')}}">
                    @error('email')
                    <p style="color:red;">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-field">
                    <label for="phone" >Phone <span>*</span></label>
                    <input type="number" name="phone" id="phone"  maxlength="10" placeholder="Enter your phone....." required value="{{old('phone')}}">
                    @error('phone')
                    <p style="color:red;">{{$message}}</p>
                    @enderror
                </div>  
                <!-- <div class="form-field">
                // uncomment this captcha code when go live-----------------
                <label for="text">Captcha <span>*</span></label> 
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
                
                <button class="form-btn" style="margin-top: 10px;">SignUp</button>
                <p>Already have an account? <a href="{{route('login')}}">Login here</a></p>
            </form>
        </div>
    </div>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
        <script src="{{url('public/assets/frontend/js/bootstrap.bundle.min.js')}}"></script>

         <script>
            $(document).ready(function(){
                $('#fullName').on('input',function(){
                   let fullNameVal =  $("#fullName").val();
                    let regex = /^[A-Za-z ]+$/;
                    if(!regex.test(fullNameVal)){
                        $("#fullName").val(fullNameVal.slice(0,-1) )
                    }
                });

                $('#phone').on('input', function(){
                    let phoneVal = $('#phone').val();
                    $('#phone').val(phoneVal.slice(0, 10));
                })      
            });

         </script>
</body>
</html>



