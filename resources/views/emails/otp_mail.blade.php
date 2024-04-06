<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
</head> 
<body style="background:#F3F1FA; padding-top: 13px; padding-bottom: 20px;"> 
    <div class="invoice" style="margin:auto; margin-top:50px; background:#fff; padding:10px 30px;box-shadow: 1px 1px 6px 2px #a19696; border-radius:0.3rem; min-width:315px; max-width:450px;"> 
        <div style="text-align:center;">
            <div class="logo">
                <img src="http://localhost/ccareservices/public/assets/frontend/images/logo/coolcarelogo.jpg" alt="logo" style="width:130px;">
            </div>  
        </div>
        <hr>
        <div class="main-section" style="text-align:justify;">
                    <p>Dear {{$otp_mail_data['user_name']}},</p>
                    <p>We have received your request for an OTP (One-Time Password). Please find your OTP below:</p>
                    <h2 style="font-size: 24px; font-weight: bold;">{{$otp_mail_data['otp']}}</h2>
                    <p>If you did not request this OTP, please ignore this message.</p>
                    <p>Thank you for using our service.</p>
                    <b> <p>Sincerely,<br>CoolCare Services</p></b>
        </div> 
        <hr>
        <div class="main-section" style="text-align:center;"> 
            <p>© Copyright 2024 CoolCare Services</p>
        </div>
    </div>
    </div> 
</body> 
</html>