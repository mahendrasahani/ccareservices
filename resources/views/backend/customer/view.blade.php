@extends('layouts/backend/main')
@section('main-section')
        <div class="content-body">
            <div class="top-set">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card" style="border: 1px solid #e5e5e5;">
                                <div class="card-body text-center">
                                    <div class="avatar avatar-xxl mb-3">
                                        <img src="{{url($customer->profile ?? 'public/assets/backend/images/imgs/customer-1.png')}}" class="img-fluid" alt="User Avatar" style="border-radius: 84px ">
                                    </div>
                                    <h1 class="h5 mb-1">{{$customer->name ?? ''}}</h1>
                                    
                                    <div class="text-left mt-5">
                                        <h6 class="separator text-left"><span class="bg-white pr-3"><b>Account Information</b></span></h6>
                                        <p class="text-muted">
                                            <strong>Full Name :</strong>
                                            <span class="ml-2">{{$customer->name ?? ''}}</span>
                                        </p>
                                        <p class="text-muted"><strong>Email :</strong>
                                            <span class="ml-2">{{$customer->email ?? ''}}</span>
                                        </p>
                                        <p class="text-muted"><strong>Phone :</strong>
                                            <span class="ml-2">{{$customer->phone ?? ''}}</span>
                                        </p>
                                        <p class="text-muted"><strong>Registration Date :</strong>
                                            <span class="ml-2">{{Carbon\Carbon::parse($customer->created_at)->format('d M, Y') }}</span>
                                        </p>
                                        <!-- <p class="text-muted"><strong>Balance :</strong>
                                            <span class="ml-2">₹5,270.55</span>
                                        </p> -->
                                    </div>
                            
                                    <div class="text-left mt-5">
                                        <h6 class="separator text-left">
                                            <span class="bg-white pr-3"><b>Other Information</b></span>
                                        </h6>
                                        <p class="text-muted">
                                            <strong>Number of Orders :</strong>
                                            <span class="ml-2">{{$customer->get_user_order_count}}</span>
                                        </p>
                                        <p class="text-muted">
                                            <strong>Ordered Amount :</strong>
                                            <span class="ml-2">₹{{number_format($customer->get_user_order_sum_total - $customer->get_user_order_sum_promo_discount, 2)}}</span>
                                        </p>
                                        <p class="text-muted">
                                            <strong>Number of items in cart :</strong>
                                            <span class="ml-2">{{number_format($customer->get_cart_item_count)}}</span>
                                        </p>
                                        @if($customer->aadhar_front != '')
                                        <a class="text-muted" href="{{url($customer->aadhar_front)}}" target="_blank">View Adhar Front</a><br>
                                        @endif
                                        @if($customer->aadhar_front != '')
                                        <a class="text-muted" href="{{url($customer->aadhar_back)}}" target="_blank">View Adhar Back</a><br>
                                        @endif
                                        @if($customer->security_check != '')
                                        <a class="text-muted" href="{{url($customer->security_check)}}" target="_blank">View Security Check</a><br>
                                        @endif
                                        <!-- <p class="text-muted">
                                            <strong>Number of items in wishlist :</strong>
                                            <span class="ml-2">10</span>
                                        </p> -->
                                      
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-md-9">
                            <div class="card" style="border: 1px solid #e5e5e5;">
                                <div class="card-header" style="border-bottom: 1px solid #e5e5e5;">
                                   <h3 class="h4">Orders of this customer</h3>  
                                </div>
                                @php
                                    $sn = 1;
                                @endphp
                                @if(count($customer->getUserOrder) > 0)
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Order Code</th>
                                                    <th>Amount</th>
                                                    <th>Delivery Status</th>
                                                    <th>Payment Status</th>
                                                    <th class="text-right">Options</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($customer->getUserOrder as $order)
                                                <tr id="row_id_{{$order->id}}">
                                                    <td>{{$sn++}}</td>
                                                    <td>{{$order->order_id}}</td>
                                                    <td>₹{{number_format($order->total - $order->promo_discount, 2)}}</td>
                                                    <td><span class="text-capitalize">{{$order->order_status}}</span></td>
                                                                                                        <td>
                                                        @if($order->payment_status == 'paid')
                                                            <span class="badge badge-inline badge-success text-white p-2">{{ strtoupper($order->payment_status) }}</span>  
                                                        @else
                                                            <span class="badge badge-inline badge-danger p-2">{{ strtoupper($order->payment_status) }}</span> 
                                                        @endif
                                                    </td>

                                                     
                                                    <td class="text-right footable-last-visible">
                                                                        <a class="btn btn-soft-primary btn-icon btn-circle btn-sm ico_chnage" href="{{route('backend.order.edit', [$order->id])}}" title="View">
                                                                            <i class="fa-regular fa-eye"></i>
                                                                        </a>
                                                                        <a class="btn btn-success btn-sm text-white" style="border-radius: 100px; background-color: #0abb75;" title="Print Invoice" href="{{route('backend.invoice.index', [$order->id])}}" id="printIcon" >
                                                                            <i class="fa-solid fa-print" style="cursor: pointer;"></i>
                                                                        </a> 
                                                                        <button value="{{$order->id}}" class="btn btn-icon btn-sm delete_ico"
                                                                         id="delete_btn"> <i class="fa-solid fa-trash-can"></i></button>            
                                                                    </td>   
                                                    
                                                </tr>
                                                @endforeach
                                                <!-- Repeat the above structure for other rows -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @else
                                <p>No Order</p>
                                @endif
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- #/ container end-->
        </div>


        @section('javascript-section')
@if(Session::has('stock_added'))
        <script> 
            Swal.fire({
            title: "Success!",
            text: "{{Session::get('stock_added')}}",
            icon: "success",
            timer: 5000,
            });
        </script>
        @elseif(Session::has('stock_updated'))
        <script> 
            Swal.fire({
            title: "Success!",
            text: "{{Session::get('stock_updated')}}",
            icon: "success",
            timer: 5000,
            });
        </script>    
        @endif

        <script>
    $(document).on('click', '#delete_btn', function (){
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
                    url: "{{route('backend.order.destroy')}}",
                    data: { 'id': id },
                    type: "GET",
                    success: function (response){
                        Swal.fire({
                            title: "Deleted!",
                            text: "Product has been deleted.",
                            icon: "success"
                        });
                        $("#row_id_" + id).hide();
                    }
                })
            }
        }); 
    });
</script>
 
@endsection
@endsection