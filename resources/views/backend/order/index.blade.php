@extends('layouts/backend/main')
@section('main-section') 
<div class="content-body">
            <div class="top-set">
                    <div class="container">                       
                        <div class="row" style=" padding: 0px 15px 0px 16px;">
                            <div class="col-md-12">
                                    <div class="card" style="border: 1px solid #d0d0d0;">
                                        <div class="card-header d-flex align-items-center" style="border-bottom: 1px solid #d0d0d0;gap:20px">
                                            <div class="col text-center text-md-left">
                                                <h4 class="mb-md-0 h5">Orders</h4>
                                            </div>
                                            <!-- <div class="dropdown mb-2 mb-md-0">
                                                <button class="btn border dropdown-toggle" type="button" data-toggle="dropdown"
                                                    aria-expanded="false">
                                                    Bulk Action
                                                </button>
                                                <div class="dropdown-menu dropdowm-menu-right">
                                                    <a class="dropdown-item confirm-alert" href="#"
                                                        data-target="#bulk-delete-modal">
                                                        Delete selection</a>
                                                </div>
                                            </div> -->
                                <div class="col-md-2">
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" id="search" name="search" placeholder="Search name or order number">
                                </div>
                                </div>
                                        <div class="col-xl-2 col-md-3 ml-auto">
                                                <form id="filter_form" method="GET" action=""> 
                                                <div class="row g-2">
                                                    <div class="col-md">
                                                        <div class="form-floating">
                                                            <select class="form-select payment_status" style="padding:7px 0;" id="payment_status" name="payment_status">
                                                                <option selected value="">Filter by Payment Status</option>
                                                                <option value="paid" {{isset($_GET['payment_status']) && $_GET['payment_status'] == 'paid'?'selected':''}}>Paid</option>
                                                                <option value="unpaid" {{isset($_GET['payment_status']) && $_GET['payment_status'] == 'unpaid'?'selected':''}}>Unpaid</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
        
                                            </div>
        
                                            <div class="col-xl-2 col-md-3">
                                                <div class="row g-2">
                                                    <div class="col-md">
                                                        <div class="form-floating">
                                                            <select class="form-select" id="delivery_status" style="padding:7px 0;" name="delivery_status">
                                                                <option selected value="">Filter by Deliver Status</option>
                                                                <option value="ordered" {{isset($_GET['delivery_status']) == 'ordered'?'selected':''}}>Ordered</option>
                                                                <option value="shipped" {{isset($_GET['delivery_status']) == 'shipped'?'selected':''}}>Shipped</option>
                                                                <option value="delivered" {{isset($_GET['delivery_status']) == 'delivered'?'selected':''}}>Delivered</option> 
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </form>
                                            <!-- <div class="col-xl-2 col-md-3">
                                                <input type="text" class="form-control form-control-sm" id="search"
                                                    name="search" placeholder="Type Order code & hit Enter">
                                            </div> -->
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                               
                                                        <table class="table aiz-table mb-0 footable footable-1 breakpoint-lg">
                                                            <thead>
                                                                <tr class="footable-header">
                                                                    <!-- <th class="footable-first-visible">
                                                                        <div class="form-group">
                                                                            <div class="aiz-checkbox-inline">
                                                                                <label class="aiz-checkbox">
                                                                                    <input type="checkbox" id="selectAllCheckbox">
                                                                                    <span class="aiz-square-check"></span>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </th> -->
                                                                    <th class="col-xl-2">Order Code</th> 
                                                                    <th>Customer </th>
                                                                    <th >Amount</th>
                                                                    <th>Order Status</th>
                                                                    <th >Payment Status</th>
                                                                    <th >Options</th>
                                                                </tr>
                                                            </thead>
                        
                                                            <tbody id="main_table_body">
                                                                @foreach($orders as $order)
                                                                <tr id="row_id_{{$order->id}}">
                                                                    <!-- <td class="footable-first-visible">
                                                                        <div class="form-group d-inline-block">
                                                                            <label class="aiz-checkbox">
                                                                                <input type="checkbox" class="selectCheckbox">
                                                                                <span class="aiz-square-check"></span>
                                                                            </label>
                                                                        </div>
                                                                    </td> -->
                                                                    <td>{{$order->order_id}}</td> 
                                                                    <td>{{$order->shipping_name}}</td>
                                                                    <td>₹{{number_format($order->total - $order->promo_discount, 2)}}</td>
                                                                    <td>
                                                                        <span class="text-capitalize">{{strtoupper($order->order_status)}}</span>
                                                                    </td> 
                                                                    <td style="display: table-cell;">
                                                                        @if($order->payment_status == 'paid')
                                                                            <span class="badge badge-inline badge-success text-white p-2">{{ strtoupper($order->payment_status) }}</span>  
                                                                        @else
                                                                            <span class="badge badge-inline badge-danger p-2">{{ strtoupper($order->payment_status) }}</span>  
                                                                        @endif
                                                                    </td>  
                                                                    <td class="footable-last-visible">
                                                                        <a class="btn btn-secondary btn-icon btn-circle btn-sm ico_chnage" id="send_invoice_btn" href="{{route('backend.order.send_invoice_to_customer', [$order->id])}}" title="Send Invoice to Customer">
                                                                        <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                                                        </a>
                                                                        <a class="btn btn-soft-primary btn-icon btn-circle btn-sm ico_chnage" href="{{route('backend.order.edit', [$order->id])}}" title="Edit/View Order">
                                                                            <i class="fa-regular fa-edit"></i>
                                                                        </a>
                                                                        <a class="btn btn-success btn-sm text-white" style="border-radius: 100px; background-color: #0abb75;" title="Print Invoice" href="{{route('backend.invoice.index', [$order->id])}}" id="printIcon" title="Delete Order">
                                                                            <i class="fa-solid fa-print" style="cursor: pointer;"></i>
                                                                        </a> 
                                                                        <button value="{{$order->id}}" class="btn btn-icon btn-sm delete_ico"
                                                                         id="delete_btn"> <i class="fa-solid fa-trash-can"></i></button>            
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                                
                                                            </tbody>
                                                        </table>
                                                         
                                                     {{$orders->links('pagination::bootstrap-5')}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
              
                </div>
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
            @elseif(Session::has('invoice_sent'))
            <script> 
                Swal.fire({
                title: "Success!",
                text: "{{Session::get('invoice_sent')}}",
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

    $(document).on("click", "#send_invoice_btn", function(){
        $(this).html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
    }); 
</script>
    
<script> 
    document.addEventListener("DOMContentLoaded", function() {
        var selectElement = document.getElementById('payment_status');
        var formElement = document.getElementById('filter_form');
        selectElement.addEventListener('change', function() {
            formElement.submit();
        });
    }); 
</script>
<script> 
    document.addEventListener("DOMContentLoaded", function() {
        var selectElement = document.getElementById('delivery_status');
        var formElement = document.getElementById('filter_form');
        selectElement.addEventListener('change', function() {
            formElement.submit();
        });
    }); 
</script>

<script>
    $(document).ready(function (){
        $(document).on('keydown', '#search', function (){
            const search_val = $(this).val();
            if (search_val === ''){
                $('#my_pagination').show();
            } else{ 
                $.ajax({
                    url: "{{route('backend.product.search')}}",
                    method: "GET",
                    data: { 'search_val': search_val },
                    success: function (result){ 
                        $("#main_table_body").html(result);
                        $('#my_pagination').hide();
                    }
                });
            }
        });
    }); 
</script>
 
@endsection
@endsection