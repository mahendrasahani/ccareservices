@extends('layouts/backend/main')
@section('main-section') 
<div class="content-body">
            <div class="top-set">
                    <div class="container">                       
                        <div class="row" style=" padding: 0px 15px 0px 16px;">
                            <div class="col-md-12">
                                    <div class="card" style="border: 1px solid #d0d0d0;">
                                        <div class="card-header d-flex align-items-center" style="border-bottom: 1px solid #d0d0d0;">
                                            <div class="col text-center text-md-left">
                                                <h4 class="mb-md-0 h5">Orders</h4>
                                            </div>
                                            <div class="dropdown mb-2 mb-md-0">
                                                <button class="btn border dropdown-toggle" type="button" data-toggle="dropdown"
                                                    aria-expanded="false">
                                                    Bulk Action
                                                </button>
                                                <div class="dropdown-menu dropdowm-menu-right">
                                                    <a class="dropdown-item confirm-alert" href="#"
                                                        data-target="#bulk-delete-modal">
                                                        Delete selection</a>
                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-md-3 ml-auto">
                                                <div class="row g-2">
                                                    <div class="col-md">
                                                        <div class="form-floating">
                                                            <select class="form-select" id="floatingSelectGrid">
                                                                <option selected="">Filter by Payment Status</option>
                                                                <option value="1">Paid</option>
                                                                <option value="2">Unpaid</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
        
                                            </div>
        
                                            <div class="col-xl-2 col-md-3">
                                                <div class="row g-2">
                                                    <div class="col-md">
                                                        <div class="form-floating">
                                                            <select class="form-select" id="floatingSelectGrid">
                                                                <option selected="">Filter by Deliver Status</option>
                                                                <option value="1"> Order Placed</option>
                                                                <option value="2">Confirmed</option>
                                                                <option value="3">Processed</option>
                                                                <option value="4">Shipped</option>
                                                                <option value="5">Delivered</option>
                                                                <option value="6">Cancelled</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-md-3">
                                                <input type="text" class="form-control form-control-sm" id="search"
                                                    name="search" placeholder="Type Order code & hit Enter">
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <form>
                                                        <table class="table aiz-table mb-0 footable footable-1 breakpoint-lg">
                                                            <thead>
                                                                <tr class="footable-header">
                                                                    <th class="footable-first-visible">
                                                                        <div class="form-group">
                                                                            <div class="aiz-checkbox-inline">
                                                                                <label class="aiz-checkbox">
                                                                                    <input type="checkbox" id="selectAllCheckbox">
                                                                                    <span class="aiz-square-check"></span>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </th>
                                                                    <th class="col-xl-2">Order Code</th> 
                                                                    <th>Customer </th>
                                                                    <th class="text-center">Amount</th>
                                                                    <th>Order Status</th>
                                                                    <th class="text-center">Payment Status</th>
                                                                    <th class="text-center">Options</th>
                                                                </tr>
                                                            </thead>
                        
                                                            <tbody>
                                                                @foreach($orders as $order)
                                                                <tr>
                                                                    <td class="footable-first-visible">
                                                                        <div class="form-group d-inline-block">
                                                                            <label class="aiz-checkbox">
                                                                                <input type="checkbox" class="selectCheckbox">
                                                                                <span class="aiz-square-check"></span>
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td style="display: table-cell;">{{$order->order_id}}</td> 
                                                                    <td style="display: table-caption;">{{$order->shipping_name}}</td>
                                                                    <td style="display: table-cell;">₹{{number_format($order->total - $order->promo_discount, 2)}}</td>
                                                                    <td style="display: table-cell;">
                                                                        <span class="text-capitalize">{{strtoupper($order->order_status)}}</span>
                                                                    </td>
                        
                                                                    <td style="display: table-cell;">
                                                                        <span class="badge badge-inline badge-danger">{{strtoupper($order->payment_status)}}</span>
                                                                    </td>
                        
                                                                    <td class="text-right footable-last-visible">
                                                                        <a class="btn btn-soft-primary btn-icon btn-circle btn-sm ico_chnage" href="{{route('backend.order.edit', [$order->id])}}" title="View">
                                                                            <i class="fa-regular fa-eye"></i>
                                                                        </a>
                                                                        <a class="btn btn-success btn-sm text-white" style="border-radius: 100px; background-color: #0abb75;" title="Print Invoice" href="javascript:void(0)" id="printIcon" >
                                                                            <i class="fa-solid fa-print" style="cursor: pointer;"></i>
                                                                        </a> 
                                                                        <a class="btn btn-success btn-icon btn-sm text-white" style="border-radius: 100px; background-color: #25bcf1;"  title="Print Invoice" href="javascript:void(0)">
                                                                            <i class="fa-solid fa-download"></i>
                                                                        </a>
                                                                        
                                                                            <a href=""
                                                                                    class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete delete_ico"
                                                                                    title="Delete" data-toggle="modal" data-target="#exampleModal">
                                                                                    <i class="fa-solid fa-trash-can"></i>
                                                                                </a>           
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                                
                                                            </tbody>
                                                        </table>
                                                         
                                                    </form>
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
        
        @endif

 
@endsection
@endsection