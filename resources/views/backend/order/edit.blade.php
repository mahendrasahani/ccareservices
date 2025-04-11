@extends('layouts/backend/main')
@section('main-section') 

<div class="content-body">
            <div class="top-set">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="h4">Order Details</h2>
                            <div class="">
                            <form method="POST" action="{{route('backend.order.update', [$order->id])}}">
                            @csrf
                            <div class="col-md-12">
                                <div class="card" style="border: 1px solid #e5e5e5;">
                                    <div class="card-header" style="border-bottom: 1px solid #e5e5e5;">
                                        <h2 class="h6 font-size-16 font-weight-bold mb-0"> Order Code: {{$order->order_id}}</h2>
                                    </div>
                                    <div class="card-header" style="border-bottom: 1px solid #e5e5e5;">
                                        <div class="row">
                                            <div class="col-md mb-3">
                                                <div>
                                                    <div class="font-size-10 font-weight-bold mb-2" style="font-size: 12px;">Customer info</div>
                                                    <div style="font-size: 12px;"><span class="opacity-80 mr-2 ml-0">Name:</span> {{$order->getUser?->name}}</div>
                                                    <div style="font-size: 12px;"><span class="opacity-80 mr-2 ml-0">Email:</span> {{$order->getUser?->email}}</div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6 col-xl-4" style="font-size: 12px;">
                                                <table class="table table-borderless table-sm">
                                                    <tbody>
                                                        <tr>
                                                            <td class="">Order Code:</td>
                                                            <td class="text-right  font-weight-bold">{{$order->order_id}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="">Order Date:</td>
                                                            <td class="text-right font-weight-bold">{{ \Carbon\Carbon::parse($order->created_at)->format('d M, Y') }}</td>

                                                        </tr>
                                                        
                                                        <tr>
                                                            <td class="">Payment Method:</td>
                                                            <td class="text-right font-weight-bold">
                                                                @if($order->payment_method == "cash_on_delivery" )
                                                                Cash On Delivery
                                                                @elseif($order->payment_method == "razorpay" )
                                                                Online
                                                                @else
                                                                Not Available
                                                                @endif
                                                         </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-header" style="border-bottom: 1px solid #e5e5e5;">
                                        <div class="row align-items-start">
                                            <div class="col-md-4" style="font-size: 12px;">
                                                <div class="mb-3">
                                                    <label class="mb-0">Payment Status</label>
                                                    <select class="form-control" id="payment_status" name="payment_status" style="font-size: 12px;">
                                                        <option value="paid" {{$order->payment_status == "paid" ? "selected" : ""}}>Paid</option>
                                                        <option value="unpaid" {{$order->payment_status == "unpaid" ? "selected" : ""}}>Unpaid</option>
                                                    </select>
                                                </div>


                                                <div class="mb-3" id="order_status_area">
                                                    <label class="mb-0">Order Status</label>
                                                    <select class="form-control" id="order_status" name="order_status" style="font-size: 12px;">
                                                        <option value="ordered" {{$order->order_status == "ordered" ? "selected" : ""}}>Ordered</option> 
                                                        <option value="accepted" {{$order->order_status == "accepted" ? "selected" : ""}}>Accept</option> 
                                                        <option value="shipped" {{$order->order_status == "shipped" ? "selected" : ""}}>Shipped</option> 
                                                        <option value="delivered" {{$order->order_status == "delivered" ? "selected" : ""}}>Delivered</option> 
                                                        <option value="renewed" {{$order->order_status == "renewed" ? "selected" : ""}}>Renewed</option> 
                                                        <option value="canceled" {{$order->order_status == "canceled" ? "selected" : ""}}>Cancel</option> 
                                                        <option value="not_confirmed" {{$order->order_status == "not_confirmed" ? "selected" : ""}}>Not Confirmed</option> 
                                                        <option value="" {{$order->order_status == "" ? "selected" : ""}}>Not Completed</option> 
                                                    </select>
                                                </div>  
                                                @if($order->order_status == 'canceled')
                                                <div class="mb-3" id="cancel_note_area">
                                                    <label class="mb-0">Cancel Note</label>
                                                    <input type="text" id="cancel_note" name="cancel_note" class="form-control" placeholder="Cancel Note" value="{{$order->cancel_note ?? ''}}">
                                                </div>
                                                @endif


                                                 <div class="mb-3">
                                                    <label for="assign_deliver_boy">Assign Deliver Boy</label>
                                                    <select class="form-control" id="delivery_boy" name="delivery_boy" style="font-size: 12px;">
                                                        <option value="" selected>Select Delivery Boy</option>
                                                        @foreach($delivery_boy_list as $delivery_boy)
                                                        <option value="{{$delivery_boy->id}}" {{$order->delivery_boy_id == $delivery_boy->id ? "selected" : ""}}>{{$delivery_boy->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="delivery_date">Delivery Date</label>
                                                     <input type="date" name="delivery_date" id="delivery_date" class="form-control" value="{{ isset($order->delivery_date) ? \Carbon\Carbon::parse($order->delivery_date)->format('Y-m-d') : '' }}" required>
                                                </div>
                                                 <div class="mb-3">
                                                    <label for="remarks">Remarks</label>
                                                    <textarea name="delivery_remark" id="delivery_remark" class="form-control">{{$order->delivery_remark ?? ''}}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <h5 class="font-size-14 mb-3">Shipping Detail</h5>
                                                <p>{{ $order->shipping_name ?? '' }}</p>
                                                <p>{{ $order->shipping_email ?? '' }}</p>
                                                <p>{{ $order->shipping_phone ?? '' }}</p>
                                                <address> 
                                                    {{$order->shipping_address ?? ''}} 
                                                </address>
                                            </div>
                                            <div class="col-md-4" >
                                                <h5 class="h6 font-size-14 mb-3">Billing Detail</h5>
                                                <p>{{ $order->billing_name ?? '' }}</p>
                                                <p>{{ $order->billing_email ?? '' }}</p>
                                                <p>{{ $order->billing_phone ?? '' }}</p>
                                                <address>
                                                {{$order->billing_address}} 
                                                </address>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table class="table" style="border: 2px solid #cbcbcb;">
                                            <thead>
                                                <tr style="font-size: 12px;">
                                                    <th>#</th>
                                                    <th width="40%">Product</th>
                                                    <th>QTY</th>
                                                    <th>Month</th>
                                                    <th>Unit price</th> 
                                                    <th>Total</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                            $sn = 1;
                                            @endphp
                                            @foreach($order->getOrderProduct as $product) 
                                                <tr style="font-size: 12px; border: 2px solid #cbcbcb; border-bottom: none;">
                                                    <td>{{ $sn++ }}</td>
                                                    <td>
                                                        <div class="media"> 
                                                            <img src="{{$product->getProduct->product_images == '' ? url('public/assets/both/placeholder/product.jpg') : url('public/'.$product->getProduct->product_images[0])}}" class="" width="20%"> 
                                                            <div class="media-body mx-2">
                                                                <h4 class="h6 font-size-8 font-weight-">{{$product->product_name}}</h4>
                                                                <div>
                                                                    <span class="mr-2">
                                                                        <span class="opacity-50">{{$product->option_id}}</span>: {{$product->option_value_id}}
                                                                    </span> 
                                                                </div> 
                                                                <div>
                                                                    <span class="mr-2">
                                                                        <span class="opacity-50">Delivery Date</span>: {{Carbon\Carbon::parse($product->delivery_date)->format('d M, Y')}}
                                                                    </span> 
                                                                </div>
                                                                <div>
                                                                    <span class="mr-2">
                                                                        <span class="opacity-50">End Date</span>: {{Carbon\Carbon::parse($product->end_date)->format('d M, Y')}}
                                                                    </span> 
                                                                </div> 
                                                            </div>
                                                            @if(count($product->getRenewalProduct) > 0)
                                                            <img src="{{ url('public/assets/backend/images/renewal.png') }}" width="30%">
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>{{$product->quantity}}</tdlass=>
                                                    <td>{{$product->month}} Months</td>
                                                    <td>₹{{number_format($product->price, 2)}}</td>
                                                    <td>₹{{number_format($product->total_price, 2)}}</td>
                                                    <td>
                                                         <div class="d-flex align-items-center gap-2"> 
                                                            <button class="mr-3 text-primary font-weight-bold addcontants" id="add_renewal_btn" data-order-id="{{ $order->id }}" data-ordered-product-id="{{ $product->id }}">Add Renewal</button>
                                                            <!-- <span class="mr-3 text-primary font-weight-bold addcontants" data-toggle="modal" data-target="#addModal">
                                                                 Add Renewal
                                                            </span> -->
                                                            <!-- <span>
                                                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm ico_chnage" href="" title="Edit" data-toggle="modal" data-target="#editModal">
                                                                    <i class="fa-regular fa-edit"></i>
                                                                </a>
                                                            </span> -->
                                                        </div>
                                                    </td>
                                                </tr>
                                                @if(count($product->getRenewalProduct) > 0)
                                                <tr style="border-right: 2px solid #cbcbcb; border-left: 2px solid #cbcbcb;">
                                                    <td colspan="5"><h4 class="h6 font-size-8 font-weight-">Renew Detail:-</h4></td>
                                                </tr>
                                                @foreach($product->getRenewalProduct as $renewal_detail) 
                                                @php
                                                $renewal_sn = 1;
                                                @endphp
                                                <tr class="m-5" style="border: 2px solid #cbcbcb; border-top: none;">
                                                <td colspan="2">
                                                <div class="media"> 
                                                        <div class="media-body mx-2">
                                                            <div>
                                                                <span class="mr-2">
                                                                    <span class="opacity-50">Start Date</span>: {{ \Carbon\Carbon::parse($renewal_detail->start_date)->format('d M, Y') }}
                                                                </span> 
                                                            </div>
                                                            <div>
                                                                <span class="mr-2">
                                                                    <span class="opacity-50">End Date</span>: {{ \Carbon\Carbon::parse($renewal_detail->end_date)->format('d M, Y') }}
                                                                </span> 
                                                            </div> 
                                                            @if($renewal_detail->renewal_note != '')
                                                            <div>
                                                                <span class="mr-2">
                                                                    <span class="opacity-50">Renew Note</span>: {{ $renewal_detail->renewal_note }} 
                                                                </span> 
                                                            </div> 
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $renewal_detail->quantity }}</td>
                                                <td>{{ $renewal_detail->month }} Month</td>
                                                <td>{{ $renewal_detail->unit_price }}</td>
                                                <td>{{ $renewal_detail->total_amount }}</td>
                                                <td>
                                                  <span> 
                                                     <button id="edit_renewal_btn" data-renewal-id="{{ $renewal_detail->id }}" class="btn btn-soft-primary btn-icon btn-circle btn-sm ico_chnage" title="Edit">
                                                         <i class="fa-regular fa-edit"></i>
                                                    </button> 
                                                    <button value="{{$renewal_detail->id}}" class="btn btn-icon btn-sm delete_ico"
                                                    id="renewal_delete_btn"> <i class="fa-solid fa-trash-can"></i></button> 
                                                 </span> 
                                                </td>
                                                </tr>
                                         
                                                @endforeach
                                                
                                                @endif

                                                @endforeach 
                                            </tbody>
                                        </table>
                                        <div class="row">
                                            <div class="col-xl-4 col-md-6">
                                                <table class="table">
                                                    <tbody>
                                                        <tr style="font-size: 12px;">
                                                            <td><strong class="font-weight-bold">Sub Total :</strong></td>
                                                            <td>₹{{number_format($order->sub_total, 2)}}</td>
                                                        </tr> 
                                                        <tr style="font-size: 12px;">
                                                            <td><strong class="font-weight-bold">Shipping :</strong></td>
                                                            <td>₹{{number_format($order->delivery_charge, 2)}}</td>
                                                        </tr>

                                                        @if($order->cgst > 0)
                                                        <tr style="font-size: 12px;">
                                                            <td><strong class="font-weight-bold">GST :</strong></td>
                                                            <td>₹{{number_format($order->cgst, 2)}}</td>
                                                        </tr>
                                                        @endif

                                                        @if($order->sgst > 0)
                                                        <tr style="font-size: 12px;">
                                                            <td><strong class="font-weight-bold">SGST :</strong></td>
                                                            <td>₹{{number_format($order->sgst, 2)}}</td>
                                                        </tr>
                                                        @endif


                                                        @if($order->igst > 0)
                                                        <tr style="font-size: 12px;">
                                                            <td><strong class="font-weight-bold">IGST :</strong></td>
                                                            <td>₹{{number_format($order->igst, 2)}}</td>
                                                        </tr>
                                                        @endif

                                                        <tr style="font-size: 12px;">
                                                            <td><strong class="font-weight-bold">Discount :</strong></td>
                                                            <td><input type="number" name="discount" id="discount" min="0" value="{{$order->promo_discount ?? '0'}}"></td>
                                                        </tr>
                                                        <tr style="font-size: 12px;">
                                                            <td><strong class="font-weight-bold">Total :</strong></td>
                                                            <input type="hidden" id="total_price" name="total_price" value="{{$order->total}}">
                                                            <td class="h6" id="showFinalPrice">₹{{number_format($order->total - $order->promo_discount, 2)}}</td>
                                                        </tr>
                                                       
                                                    </tbody>
                                                </table>
                                                @if($order->order_status != 'not_confirmed')
                                                <input type="submit" value="Update Order" class="btn btn-primary" style="background-color: #f5a100;border:0;" >
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </form>
                            <!-- <div class="col col-lg-auto w-lg-300px">
                                <div class="card" style="border: 1px solid #e5e5e5;">
                                    <div class="card-header" style="border-bottom: 1px solid #e5e5e5;">
                                        <h3 class="h6 font-size-16 mb-0">Tracking information</h3>
                                    </div>
                                    <div class="card-body">
                                        <form action="" method="POST">
                                            <input type="hidden" name="_token" value="tJMcCHinI3PcvyeD67lcGCBH3nx1h1b5U6IWyUuR">
                                            <input type="hidden" name="order_id" value="226">
                                            <div class="form-group mb-1">
                                                <label class="mb-0" style="font-size: 12px;">Courier name:</label>
                                                <input type="text" class="form-control form-control-sm" name="courier_name" value="" required="">
                                            </div>
                                            <div class="form-group mb-1">
                                                <label class="mb-0" style="font-size: 12px;">Tracking number:</label>
                                                <input type="text" class="form-control form-control-sm" name="tracking_number" value="" required="">
                                            </div>
                                            <div class="form-group mb-1">
                                                <label class="mb-0" style="font-size: 12px;">Tracking URL:</label>
                                                <input type="text" class="form-control form-control-sm" name="tracking_url" value="" required="">
                                            </div>
                                            <div class="text-right">
                                                <button class="btn btn-sm btn-primary" type="submit">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="card" style="border: 1px solid #e5e5e5;">
                                    <div class="card-header" style="border-bottom: 1px solid #e5e5e5;">
                                        <h3 class="h6 font-size-16 mb-0">Order updates</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <div class="p-2 bg-light rounded">
                                                Order status updated to confirmed.
                                            </div>
                                            <span class="font-size-12 opacity-60">by Admin at 10:13pm, 29-10-2023</span>
                                        </div>
                                        <div class="mb-3">
                                            <div class="p-2 bg-light rounded">
                                                Order has been placed.
                                            </div>
                                            <span class="font-size-12 opacity-60">by Christina Ashens at 05:15am, 27-09-2023</span>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            
                        </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- #/ container end-->

            <!----- modal s elements start ---->
            <!-- add Modal --> 
            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Add Renew Order</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('backend.order.add_order_renewal') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <input type="hidden" id="renewal_order_id" name="renewal_order_id">
                                    <input type="hidden" id="renewal_ordered_product_id" name="renewal_ordered_product_id">
                                    <input type="hidden" id="renewal_quantity" name="renewal_quantity">
                                    <div class="col-sm-6 mb-3">
                                        <label> Select Month</label>
                                        <input type="number" id="renewal_month" name="renewal_month" class="form-control" min="1" max="12" required>
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label> Start From</label>
                                        <input type="date" id="renewal_start_from" name="renewal_start_from" class="form-control" required>
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label> Unit Price</label>
                                        <input type="number" id="renewal_unit_prie" name="renewal_unit_prie" class="form-control" value="" required>
                                    </div>  
                                    <div class="col-sm-6 mb-3">
                                        <label> Renewal Note</label>
                                        <input type="text" id="renewal_note" name="renewal_note" class="form-control">
                                    </div>  
                                    <div class="col-12 d-flex justify-content-end">
                                        <button class="btn btn-info text-white">Add</button>
                                    </div>
                                </div>
                            </form>
                        </div> 
                    </div>
                </div>
            </div>

            <!--- edit modal --->
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Edit Renew Order</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form action="{{ route('backend.order.update_order_renewal') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <input type="hidden" id="renew_order_detail_id" name="renew_order_detail_id"> 
                                    <input type="hidden" id="edit_renewal_quantity" name="edit_renewal_quantity">
                                    <div class="col-sm-6 mb-3">
                                        <label> Select Month</label>
                                        <input type="number" id="edit_renewal_month" name="edit_renewal_month" class="form-control" min="1" max="12" required>
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label> Start From</label>
                                        <input type="date" id="edit_renewal_start_from" name="edit_renewal_start_from" class="form-control" required>
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label> Unit Price</label>
                                        <input type="number" id="edit_renewal_unit_prie" name="edit_renewal_unit_prie" class="form-control" value="" required>
                                    </div>  
                                    <div class="col-sm-6 mb-3">
                                        <label> Renewal Note</label>
                                        <input type="text" id="edit_renewal_note" name="edit_renewal_note" class="form-control">
                                    </div>  
                                    <div class="col-12 d-flex justify-content-end">
                                        <button class="btn btn-info text-white">Update</button>
                                    </div>
                                </div>
                            </form>
                            </div> 
                        </div>
                    </div>
            </div>
            <!----- modal s elements end---->

        </div>



@section('javascript-section') 
 
    <script>
    $(document).on("click", "#add_renewal_btn", function(e){
        e.preventDefault();
        let order_id = $(this).data('order-id');
        let ordered_product_id = $(this).data('ordered-product-id'); 
        let url = "{{ route('backend.order.get_order_detail_for_renewal') }}";
        fetch(url, {
            method:"POST",
            headers:{
                "Content-Type":"application/json",
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            },
            body:JSON.stringify({order_id:order_id, ordered_product_id:ordered_product_id}) 
        })
        .then(response => response.json())
        .then(responseData => {
            $("#renewal_order_id").val(responseData.order_detail.id); 
            $("#renewal_ordered_product_id").val(responseData.ordered_product_detail.id); 
            $("#renewal_month").val(responseData.ordered_product_detail.month); 
            let endDate = new Date(responseData.ordered_product_detail.end_date);
            endDate.setDate(endDate.getDate() + 1);
            let nextDate = endDate.toISOString().split('T')[0];
            $("#renewal_start_from").val(nextDate);
            $("#renewal_unit_prie").val(responseData.ordered_product_detail.price); 
            $("#renewal_quantity").val(responseData.ordered_product_detail.quantity); 
            $('#addModal').modal('show');
        }).catch(error => {
            console.error("Error: ", error);
        }); 
    }); 

    $(document).on("click", "#edit_renewal_btn", function(e){
        e.preventDefault();
        let renewal_id = $(this).data('renewal-id');
        let url = "{{ route('backend.order.edit_order_renewal') }}";
        fetch(url, {
            method:"POST",
            headers:{
                "Content-Type":"application/json",
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            },
            body:JSON.stringify({renewal_id:renewal_id}) 
        })
        .then(response => response.json())
        .then(responseData => {
            console.log(responseData); 
            $("#renew_order_detail_id").val(responseData.renewal_order_detail.id);  
            $("#edit_renewal_quantity").val(responseData.renewal_order_detail.quantity);  
            $("#edit_renewal_month").val(responseData.renewal_order_detail.month);  
            let rawDate = responseData.renewal_order_detail.start_date;
            let formattedDate = rawDate.split(' ')[0];
            $("#edit_renewal_start_from").val(formattedDate);
     
 
            $("#edit_renewal_unit_prie").val(responseData.renewal_order_detail.unit_price); 
            $("#edit_renewal_note").val(responseData.renewal_order_detail.renewal_note); 
            $('#editModal').modal('show');

        }).catch(error => {
            console.error("Error: ", error);
        }); 
    });

    $(document).on('click', '#renewal_delete_btn', function (e){
        e.preventDefault();
        const id = $(this).val(); 
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) =>
        {
            if (result.isConfirmed){ 
                $.ajax({
                    url: "{{route('backend.order.destroy_renewal_detail')}}",
                    data: { 'id': id },
                    type: "GET",
                    success: function (response){
                        Swal.fire({
                            title: "Deleted!",
                            text: "Renewal has been deleted.",
                            icon: "success"
                        }); 
                        window.location.reload();
                    }
                })
            }
        }); 
    });
</script>

    <script> 
         $(document).ready(function(){
        $(document).on("click", "#discount", calculateDiscount);

        $(document).on("keyup", "#discount", calculateDiscount);
         });
        function calculateDiscount(){
        let discountPrice = $(this).val(); 
        let totalPrice = $("#total_price").val(); 
        let finalPrice = totalPrice - discountPrice;
        let formattedFinalPrice = '₹' + finalPrice.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');  
        $('#showFinalPrice').text(formattedFinalPrice); 
        // $("#total_price").val(finalPrice); 
        }
    </script> 

    <script> 
        $(document).on("change", "#order_status", function(){
            let order_status = $(this).val();
            let cancel_note_val = $("#cancel_note").val();
            if(order_status == 'canceled'){
                $(`<div class="mb-3" id="cancel_note_area">
                   <label class="mb-0">Cancel Note</label>
                   <input type="text" id="cancel_note" name="cancel_note" class="form-control" value="${cancel_note_val == undefined ? '':cancel_note_val}" placeholder="Cancel Note">
               </div>`).insertAfter('#order_status_area');
            }else{
                $('#cancel_note_area').remove();
            }
        });

        
    </script>

    @if(Session::has('renewal_created'))
        <script>
            Swal.fire({
                title: "Success",
                text: "{{ Session::get('renewal_created') }}",
                icon: "success"
            });
        </script>
        @elseif(Session::has('renewal_update'))
        <script>
            Swal.fire({
                title: "Success",
                text: "{{ Session::get('renewal_update') }}",
                icon: "success"
            });
        </script>
    @endif
@endsection
 
@endsection