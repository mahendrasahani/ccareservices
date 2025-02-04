<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Razorpay Payment</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body>
    <button id="pay-button">Pay Now</button>

    <script>
        var options = {
            "key": "{{ config('services.razorpay.key') }}",
            "amount": "{{ $order['amount'] }}",
            "currency": "INR",
            "name": "Your Company",
            "description": "Test Transaction",
            "order_id": "{{ $order['id'] }}",
            "handler": function (response){
                window.location.href = "/payment-success?razorpay_payment_id=" + response.razorpay_payment_id;
            },
            "theme": {
                "color": "#3399cc"
            }
        };
        var rzp1 = new Razorpay(options);
        document.getElementById('pay-button').onclick = function(e){
            rzp1.open();
            e.preventDefault();
        }
    </script>
</body>
</html>
