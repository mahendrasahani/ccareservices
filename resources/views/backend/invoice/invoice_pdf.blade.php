
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> Order confirmation </title>
<meta name="robots" content="noindex,nofollow" />
<meta name="viewport" content="width=device-width; initial-scale=1.0;" />


<style type="text/css">
 .table {
    width: 100%;
    max-width: 100%;
    margin-bottom: 10px;
}
    
 .table-bordered {
    border: 1px solid #ddd;
}   
    
 .table thead > tr > td, .table tbody > tr > td {
    vertical-align: middle;
}   
 .table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {
    border: 1px solid #ddd;
} 
    
 table {
    border-spacing: 0;
    border-collapse: collapse;
}   

.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    padding: 8px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;
}    
 address {
    margin-bottom: 20px;
    font-style: normal;
    line-height: 1.42857143;
}   
    
b, strong {
    font-weight: bold;
} 
    
.table > caption + thead > tr:first-child > th, .table > colgroup + thead > tr:first-child > th, .table > thead:first-child > tr:first-child > th, .table > caption + thead > tr:first-child > td, .table > colgroup + thead > tr:first-child > td, .table > thead:first-child > tr:first-child > td {
    border-top: 0;
} 
.text-right {
    text-align: right;
}    
    
    
    
</style>
 
    <h1>Invoice {{$order->order_id}}</h1>
    <table class="table table-bordered">
      <thead>
        <tr>
          <td colspan="2">Order Details</td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td style="width: 50%;">
               <img src="{{$imageSrc}}" width="40%" alt="logo" border="0"/>
              <address><strong>Cool Care Service</strong><br>
              F222 opposite radhaswami satsang patodi road, Saraswati Enclave, Sector 10A, Gurugram, Haryana 122001</address>
            <b>Telephone</b> 7291917070<br>
            <b>E-Mail</b> info@coolcareservice.in<br>
            <b>Web Site:</b><a href="https://www.coolcareservice.in">https://www.coolcareservice.in</a></td>
          <td style="width: 50%;"><b>Date Added</b> {{\Carbon\Carbon::parse($order->created_at)->format('M d, Y')}}<br>
          <b>Order ID:</b> {{$order->order_id}}<br>
          <b>Payment Method</b>
          @if($order->payment_method == "cash_on_delivery")
          Cash On Delivery
          @elseif($order->payment_method == "razorpay")
          Online
          @else
          Not Available
          @endif
          <br>
        </td>
        </tr>
      </tbody>
    </table>
    <table class="table table-bordered">
      <thead>
        <tr>
          <td style="width: 50%;"><b>Shipping Detail</b></td>
          <td style="width: 50%;"><b>Billing Detail</b></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
          <p>{{ $order->shipping_name ?? '' }}</p>
            <p>{{ $order->shipping_email ?? '' }}</p>
            <p>{{ $order->shipping_phone ?? '' }}</p>
            <address>{{$order->shipping_address}}</address>
          </td>
            <td> 
            <p>{{ $order->billing_name ?? '' }}</p>
            <p>{{ $order->billing_email ?? '' }}</p>
            <p>{{ $order->billing_phone ?? '' }}</p>
            <address>{{$order->billing_address}}</address>
          </td>

        </tr>
      </tbody>
    </table>
    <table class="table table-bordered">
      <thead>
        <tr>
          <td><b>Product</b></td> 
          <td class="text-right"><b>Quantity</b></td>
          <td class="text-right"><b>Unit Price</b></td>
          <td class="text-right"><b>Total</b></td>
        </tr>
      </thead>
      <tbody>
      @foreach($order->getOrderProduct as $product)
                <tr>
          <td>{{$product->product_name}} ({{$product->getProduct->tax_name}} {{$product->getProduct->tax_rate}}%)
            <br>
            &nbsp;<small> - Select Month: {{$product->month}} </small><br>
            &nbsp;<small> - {{$product->option_id}}: {{$product->option_value_id}}</small> 

                        <!-- <br>
            &nbsp;<small> - Delivery Date: 2024-04-06</small> -->
            </td>
          
          <td class="text-right">{{$product->quantity}}</td>
          <td class="text-right">Rs.{{number_format($product->price, 2)}}</td>
          <td class="text-right">Rs.{{number_format($product->total_price, 2)}}</td>
        </tr>
        @endforeach
          <tr>
          <td class="text-right" colspan="3"><b>Sub-Total</b></td>
          <td class="text-right">Rs.{{number_format($order->sub_total, 2)}}</td>
        </tr>

        @if($order->cgst > 0)
        <tr>
          <td class="text-right" colspan="3"><b>GST</b></td>
          <td class="text-right">Rs.{{number_format($order->cgst, 2)}}</td>
        </tr>
      @endif

      @if($order->sgst > 0)
        <tr>
          <td class="text-right" colspan="3"><b>SGST</b></td>
          <td class="text-right">Rs.{{number_format($order->sgst, 2)}}</td>
        </tr>
        @endif

        @if($order->igst > 0)
        <tr>
          <td class="text-right" colspan="3"><b>IGST</b></td>
          <td class="text-right">Rs.{{number_format($order->igst, 2)}}</td>
        </tr>
        @endif

        <tr>
          <td class="text-right" colspan="3"><b>Shipping Charge</b></td>
          <td class="text-right">Rs.{{number_format($order->delivery_charge, 2)}}</td>
        </tr>
        <tr>
          <td class="text-right" colspan="3"><b>Discount</b></td>
          <td class="text-right">Rs.{{$order->promo_discount ?? '0'}}</td>
        </tr>
      <tr>
          <td class="text-right" colspan="3"><b>Total</b></td>
          <td class="text-right">Rs.{{number_format($order->total - $order->promo_discount, 2)}}</td>
        </tr>
       </tbody>
    </table>
    @if($order->delivery_remark != '')
    <p>Remark:- {{ $order->delivery_remark }}</p>
    @endif
  