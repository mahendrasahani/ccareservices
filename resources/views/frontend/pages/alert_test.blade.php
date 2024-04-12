@foreach($orders as $order)
@foreach ($order->getOrderProduct as $product)
@if($order->delivery_date !=  null)
<p>Alert before 15 days</p>

@php
$alertDate = \Carbon\Carbon::parse($order->delivery_date)->addMonths($product->month)->subDays(15);
@endphp
Order Id:- {{$order->id}}<br>
Product Id:- {{$product->id}}<br>
{{$product->month}} Month,<br>
Delivery Date:- {{\Carbon\Carbon::parse($order->delivery_date)->format('d M, Y')}},<br>
Renew Date:- {{\Carbon\Carbon::parse($order->delivery_date)->addMonths($product->month)->format('d M, Y ')}}<br>
Alert Date:- {{\Carbon\Carbon::parse($alertDate)->format('d M, Y')}}<br>
<br>
<p>Alert before 7 days</p>
@php
$alertDate = \Carbon\Carbon::parse($order->delivery_date)->addMonths($product->month)->subDays(7);
@endphp
Order Id:- {{$order->id}}<br>
Product Id:- {{$product->id}}<br>
{{$product->month}} Month,<br>
Delivery Date:- {{\Carbon\Carbon::parse($order->delivery_date)->format('d M, Y')}},<br>
Renew Date:- {{\Carbon\Carbon::parse($order->delivery_date)->addMonths($product->month)->format('d M, Y ')}}<br>
Alert Date:- {{\Carbon\Carbon::parse($alertDate)->format('d M, Y')}}<br>
<br>
@endif



 
@endforeach
@endforeach