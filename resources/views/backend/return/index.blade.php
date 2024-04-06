@extends('layouts/backend/main')
@section('main-section')
  
<div class="content-body">
    <div class="top-set">
        <div class="container">
            <div class="row align-items-center mb-4">
                <div class="col-md-4">
                    <h1 class="h4">Return Product List</h1>
                </div> 
                <div class="col-md-8 text-md-right">
                    <a href="{{route('backend.return.create')}}" class="btn btn-primary" style="background-color: #f5a100; border: none; border-radius: 50em;">
                        <span>Add New Product</span>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card" style="border: 1px solid #dadada;">
                        <div class="d-flex align-items-center" style="border-bottom: 1px solid #ececec;">
                            <div class="col text-center text-md-left">
                                <h5 class="mb-md-0 h6">Return Product List</h5>
                            </div>
                            <div class="dropdown mb-2 mb-md-0" id="multiSelectActionBtn" style="display:none;">
                                <button class="btn border dropdown-toggle" type="button" data-toggle="dropdown"
                                    aria-expanded="false">
                                    Bulk Action
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item confirm-alert" href="javascript:void(0)"
                                        onclick="deleteSelection()"> Delete selection</a>
                                </div>
                            </div>
                            <div class="col-md-2 ml-auto">
                                <div class="form-group mt-2 mb-2">
                                    <select class="form-control form-control-sm" name="type" id="sort_by"
                                        name="sort_by">
                                        <option>Sort by</option>
                                        <option value="rating_high_to_low">Rating (High > Low)</option>
                                        <option value="rating_low_to_high">Rating (Low > High)</option>
                                        <option value="sale_high_to_low">Num of Sale (High > Low)</option>
                                        <option value="sale_low_to_high">Num of Sale (Low > High)</option>
                                        <option value="price_high_to_low" >Base Price (High > Low)</option>
                                        <option value="price_low_to_high">Base Price (Low > High)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" id="search" name="search"
                                        placeholder="Type &amp; Enter">
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr> 
                                        <th style="display: table-cell;">Order Id </th>
                                        <th style="display: table-cell;">Customer Name</th>
                                        <th style="display: table-cell;">Product</th>   
                                        <th style="display: table-cell;">Return Date</th>
                                        <th style="display: table-cell;">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="main_table_body"> 
                                    @if(count($return_products) > 0)
                                    @foreach($return_products as $return_product)
                                    <tr id="row_id_1">
                                         
                                         
                                        <td style="display: table-cell;">
                                            <div class=" text-truncate-2">
                                                        <p class="font-s mt-3">{{$return_product->order_number}}</p>
                                                    </div>
                                        </td>
                                        <td style="display: table-cell;">{{$return_product->customer_name}}</td>
                                        <td style="display: table-cell;">{{$return_product->product_name}}</td>  
                                        <td style="display: table-cell;">{{ \Carbon\Carbon::parse($return_product->created_at)->format('d M, Y') }}</td> 
                                        <td style="display: table-cell;">
                                            <div class="d-flex justify-content-center "> 
                                                <a class="btn btn-soft-info btn-icon btn-circle btn-sm eye-2"
                                                    href="{{route('backend.return.edit', [$return_product->id])}}" title="Edit">
                                                    <i class="fa-regular fa-pen-to-square text-white"></i>
                                                </a>  
                                            </div>
                                        </td> 
                                    </tr> 
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <div id="my_pagination">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

 
@endsection