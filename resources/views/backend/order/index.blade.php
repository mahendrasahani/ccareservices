@extends('layouts/backend/main')
@section('main-section') 


<div class="content-body">
    <div class="top-set">
        <div class="container">
            <div class="row align-items-center mb-4">
                <div class="col-md-4">
                    <h1 class="h4">All Orders</h1>
                </div>
                 
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card" style="border: 1px solid #dadada;">
                        <div class="d-flex align-items-center" style="border-bottom: 1px solid #ececec;">
                            <div class="col text-center text-md-left">
                                <h5 class="mb-md-0 h6">Orders</h5>
                            </div>
                            <div class="dropdown mb-2 mb-md-0" id="multiSelectActionBtn" style="display:none;">
                                <button class="btn border dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                    Bulk Action
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item confirm-alert" href="javascript:void(0)" onclick="deleteSelection()"> Delete selection</a>
                                </div>
                            </div>
                            <div class="col-md-2 ml-auto">
                                <div class="form-group mt-2 mb-2">
                                    <select class="form-control form-control-sm" name="type" id="sort_by"
                                        name="sort_by">
                                        <option>Sort by</option>
                                        <option value=" ">Options</option>
                                        <option value=" ">Options</option>
                                        <option value=" ">Options</option>
                                        <option value=" ">Options</option>
                                        <option value=" ">Options</option>
                                        <option value=" ">Options</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" id="search" name="search" placeholder="Type &amp; Enter">
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th style="display: table-cell;">S No.</th>
                                        <th style="display: table-cell;">Customer Name</th>
                                        <th style="display: table-cell;">Order Code </th>
                                        <th style="display: table-cell;">Total Order Amount</th> 
                                        <th style="display: table-cell;">Payment Status</th> 
                                        <th style="display: table-cell;">Order Status</th> 
                                        <th style="display: table-cell;">Options</th> 
                                    </tr>
                                </thead>
                                <tbody id="main_table_body"> 
                                    <tr >
                                        <td style="display: table-cell;">
                                             1
                                        </td>
                                        <td style="display: table-cell;"> 
                                                    gvs   
                                        </td>
                                        <td style="display: table-cell;">
                                             dfsghtr    
                                        </td>
                                        <td style="display: table-cell;"> 
                                            5000 
                                        </td>
                                        <td>
                                          Paid
                                        </td> 
                                        <td>
                                          Delivered
                                        </td> 
                                        <td class="text-left footable-last-visible ">
                                            <div class="d-flex "> 
                                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm ico_chnage mx-1" href="{{route('backend.order.view_product')}}" title="View">
                                                <i class="fa-regular fa-eye"></i>
                                            </a>
                                            <a class="btn btn-soft-info btn-icon btn-circle btn-sm eye-2" href="{{route('backend.order.edit')}}" title="Edit">
                                                <i class="fa-regular fa-pen-to-square text-white"></i>
                                            </a> 
                                            <button value="" class="btn btn-icon btn-sm delete_ico" id="delete_btn"> <i class="fa-solid fa-trash-can"></i></button>
                                            </div>
                                        </td>
                                    </tr> 
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