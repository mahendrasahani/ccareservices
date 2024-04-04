@extends('layouts/backend/main')
@section('main-section')

        <div class="content-body">
            <div class="top-set">
                <div class="container-fluid">
                    <div class="row mt-5">
                        <div class="col-lg-3 col-sm-6">
                            <div class="card gradient-1">
                                <div class="card-body">
                                    <h3 class="card-title text-white">Total Customers</h3>
                                    <div class="d-inline-block">
                                        <h2 class="text-white">{{number_format($total_customers)}}</h2>
                                    </div>
    
                                    <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                                </div>
                            </div>
                        </div>
    
                        <div class="col-lg-3 col-sm-6">
                            <div class="card gradient-2">
                                <div class="card-body">
                                    <h3 class="card-title text-white">Total Products</h3>
                                    <div class="d-inline-block">
                                        <h2 class="text-white">{{number_format($total_product)}}</h2>
                                    </div>
                                    <span class="float-right display-5 opacity-5"><i class="fa fa-shopping-cart"></i></span>
    
                                </div>
                            </div>
                        </div>
    
                        <div class="col-lg-3 col-sm-6">
                            <div class="card gradient-3">
                                <div class="card-body">
                                    <h3 class="card-title text-white">Total Orders</h3>
                                    <div class="d-inline-block">
                                        <h2 class="text-white">{{number_format($total_order)}}</h2>
                                    </div>
                                    <span class="float-right display-5 opacity-5"><i class="fa fa-heart"></i></span>
                                </div>
                            </div>
                        </div>
    
                        <div class="col-lg-3 col-sm-6">
                            <div class="card gradient-4">
                                <div class="card-body">
                                    <h3 class="card-title text-white">Total Sales</h3>
                                    <div class="d-inline-block">
                                        <h2 class="text-white">₹{{number_format($total_sales, 2)}}</h2>
                                    </div>
                                    <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-7">
                            <div class="border rounded-lg p-4 mb-4">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                                <div class="fs-16 fw-700 mb-4">Sales stat</div>
                                   <canvas id="salesChart" width="500" height="300"></canvas>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card" style="border: 1px solid #e5e5e5;">
                                <div class="card-header" style="border-bottom: 1px solid #e5e5e5;">
                                    <h4 class="h5"> Recent Activity</h4>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        <li class="list-group-item" style="border-bottom: 1px solid #e5e5e5;">
                                            <a href="#">Shubham MEHRA</a>  added a 
                                            <a href="#">new order</a>
                                            <br>
                                            <small class="text-muted"><i class="fa fa-clock-o"></i> 16/01/2024 21:54:47</small>
                                        </li>
                                        <li class="list-group-item" style="border-bottom: 1px solid #e5e5e5;"><a href="#">Shubham MEHRA</a> added a new address.<br>
                                            <small class="text-muted"><i class="fa fa-clock-o"></i> 16/01/2024 21:54:17</small>
                                        </li>
                                        <li class="list-group-item" style="border-bottom: 1px solid #e5e5e5;"><a href="#">Shubham MEHRA</a> registered a new account.<br>
                                            <small class="text-muted"><i class="fa fa-clock-o"></i> 16/01/2024 21:50:30</small>
                                        </li>
                                        <li class="list-group-item" style="border-bottom: 1px solid #e5e5e5;"><a href="#">Mildred Chiramba</a> registered a new account.<br>
                                            <small class="text-muted"><i class="fa fa-clock-o"></i> 16/01/2024 15:43:16</small>
                                        </li>
                                        <li class="list-group-item" style="border-bottom: 1px solid #e5e5e5;"><a href="#">kaoutar bendefa</a> registered a new account.<br>
                                            <small class="text-muted"><i class="fa fa-clock-o"></i> 14/01/2024 15:42:05</small>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
    
                        <div class="col-md-8">
                            <div class="card" style="border: 1px solid #e5e5e5;">
                                <div class="card-header" style="border-bottom: 1px solid #e5e5e5;">
                                    <h4 class="h5">
                                        <i class="fa fa-shopping-cart"></i>
                                        Latest Orders
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <table id="myTable" class="table aiz-table mb-0 footable footable-1 breakpoint-lg">
                                            <thead>
                                                <tr class="footable-header">
                                                    
                                                    <th class="col-xl-2">Order ID</th>
                                                    <th>Customer</th>
                                                    <th>Status
                                                    </th>
                                                    <th class="text-center">Date Added</th>
                                                    <th>Total</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            @if(count($latest_order) > 0)
                                            <tbody>
                                                @foreach($latest_order as $order)
                                                <tr>
                                                    <td style="display: table-cell;">
                                                    {{$order->order_id}}
                                                    </td>
                                                    <td>{{$order->shipping_name}}</td>
                                                    <td style="display: table-cell;">
                                                    {{strtoupper($order->order_status)}}
                                                    </td>
                                                    <td>
                                                        {{Carbon\Carbon::parse($order->created_at)->format('d M, Y')}}
                                                    </td>
                                                    <td>
                                                    ₹{{number_format($order->total - $order->promo_discount, 2)}}
                                                    </td>
                                                    <td class="text-right footable-last-visible">
                                                        <a href="{{route('backend.order.edit', [$order->id])}}" data-toggle="tooltip" title="" class="btn btn-info" data-original-title="View"><i class="fa fa-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            @endif
                                        </table>
                                    </form>
                                </div>
                            </div>
                            <div class="card" style="border: 1px solid #e5e5e5;">
                                <div class="card-header" style="border-bottom: 1px solid #e5e5e5;">
                                    <h4 class="h5">
                                        <i class="fa fa-shopping-cart"></i>
                                        Cancel Orders
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <table id="myTable" class="table aiz-table mb-0 footable footable-1 breakpoint-lg">
                                            <thead>
                                                <tr class="footable-header">
                                                    
                                                    <th class="col-xl-2">Order ID</th>
                                                    <th>Customer</th>
                                                    <th>Status
                                                    </th>
                                                    <th class="text-center">Date Added</th>
                                                    <th>Total</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="display: table-cell;">
                                                        322
                                                    </td>
                                                    <td>
                                                        Shubham MEHRA
                                                    </td>
                                                    <td style="display: table-cell;">
                                                        Pending
                                                    </td>
                                                    <td>
                                                        16/01/2024
                                                    </td>
                                                    <td>
                                                        ₹1,650.00
                                                    </td>
                                                    <td class="text-right footable-last-visible">
                                                        <a href="#" data-toggle="tooltip" title="" class="btn btn-info" data-original-title="View"><i class="fa fa-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                            </div>
                            
                        </div>  
                    </div>
                </div>
            </div>
            
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
     

 
@endsection