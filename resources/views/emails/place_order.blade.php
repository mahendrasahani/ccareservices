<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>GETTING STARTED WITH BRACKETS</title>
        <meta name="description" content="An interactive getting started guide for Brackets.">
        <link rel="stylesheet" href="main.css">
    </head>
	
	<style>
		table {
			border:0px;
			border-collapse:collapse;
			padding:5px;
			margin: auto;
		width: 100%;
		}
		table th {
			border:1px solid #b3adad;
			padding:5px;
			background: #f0f0f0;
			color: #313030;
		}
		table td {
			border:1px solid #b3adad;
			text-align:left;
			padding:5px;
			background: #ffffff;
            color: #313030;}
			
.line span{display:block; width:100%; border-bottom:1px solid red; margin-top:25px; text-align:center}
.line h2{font-size:15px; text-align:center; position:relative; top:10px; padding:0 15px; display:inline-block; background:white}
	</style> 
       <table style="height: 64px; width: 878.5px;">
<tbody>
<tr>
<td style="width: 877.5px; text-align: center; border:1px solid #b3adad;">
<h1><strong>Thank You For Your Order</strong></h1>
</td>
</tr>
<tr>
<td style="width: 877.5px;">
<p><br />Hi {{$place_order_data['user_name']}}</p>
<p>Just to Let&nbsp; You Know- We've Received Your Order #{{$place_order_data['order_number']}}, and it is now Being processed:</p>
@if($place_order_data['payment_method'] == 'cash_on_delivery')
<p>Pay with Cash Upon Delivery</p>
@else
<p>Pay with Razorpay</p>
@endif
</td>
</tr>
<tr>
<td style="width: 877.5px; text-align: center; border:1px solid #b3adad;">
<h1><strong>Order #{{$place_order_data['order_number']}} ({{\Carbon\Carbon::parse($place_order_data['order_date'])->format('d M, Y')}})</strong></h1>
 
<table style="height: 23px; width: 876px;">
<tbody>
<tr style="height: 21px;">
<td style="width: 291px; height: 21px; text-align: left; border:1px solid #b3adad;">Product</td>
<td style="width: 208.812px; height: 21px; border:1px solid #b3adad;">Quantity</td>
<td style="width: 371.188px; height: 21px; text-align: right; border:1px solid #b3adad;">Price</td>
</tr>
@foreach($place_order_data['product_list'] as $product)
<tr style="height: 21px;">
<td style="width: 291px; height: 21px; text-align: left;">{{$product->product_name}}</td>
<td style="width: 208.812px; height: 21px;">{{$product->quantity}}</td>
<td style="width: 371.188px; height: 21px; text-align: right;"><strong>₹{{number_format($product->total_price, 2)}}</strong></td>
</tr>
@endforeach
<tr style="height: 21px;">
<td style="width: 499.812px; height: 21px; text-align: left; border:1px solid #b3adad;" colspan="2" >Payment method:</td>
<td style="width: 371.188px; height: 21px; text-align: right; border:1px solid #b3adad;">Cash on delivery</td>
</tr>
<tr style="height: 21px;">
<td style="width: 499.812px; height: 21px; text-align: left; border:1px solid #b3adad;" colspan="2">Total:</td>
<td style="width: 371.188px; height: 21px; text-align: right; border:1px solid #b3adad;">₹{{number_format($place_order_data['total'], 2)}}</td>
</tr>
<tr style="height: 21px;">
<td style="width: 499.812px; height: 21px; text-align: left; border:1px solid #b3adad;" colspan="2">
<h1>Billing Address</h1>
</td>
<td style="width: 371.188px; height: 21px; text-align: right; border:1px solid #b3adad;">
<h1>Shipping Address</h1>
</td>
</tr>
  <tr style="height: 21px;">    
    <td style="width: 499.812px; height: 21px; text-align: left;" colspan="2">{{$place_order_data['billing_address']->name}}<br>{{$place_order_data['billing_address']->address}}<br>{{$place_order_data['billing_address']->city}}<br>{{$place_order_data['billing_address']->zip_code}}<br>{{$place_order_data['billing_address']->email}}</td>
    <td style="width: 371.188px; height: 21px; text-align: right;">{{$place_order_data['shipping_address']->name}}<br>{{$place_order_data['shipping_address']->address}}<br>{{$place_order_data['shipping_address']->city}}<br>{{$place_order_data['shipping_address']->zip_code}}<br>{{$place_order_data['shipping_address']->email}}</td>
   
</tr>
</tbody>
</table>

   

