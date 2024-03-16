@extends('layouts/backend/main')
@section('main-section')
 
<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
    <div class="top-set">
        <div class="container">
            <div class="row align-items-center mb-4">
                <div class="col-md-4">
                    <h1 class="h4">All Vendors</h1>
                </div>
                <div class="col-md-8 text-md-right">
                    <a href="{{route('backend.vendor.create')}}" class="btn btn-primary"
                        style="background-color: #f5a100; border: none; border-radius: 50em;">
                        <span>Add New Vendor</span>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card" style="border: 1px solid #dadada;">
                        <div class="d-flex align-items-center" style="border-bottom: 1px solid #ececec;">
                            <div class="col text-center text-md-left">
                                <h5 class="mb-md-0 h6">All Vendors</h5>
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
                                    <input type="text" class="form-control form-control-sm" id="search" name="search"
                                        placeholder="Type &amp; Enter">
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th style="display: table-cell;">S No.</th>
                                        <th style="display: table-cell;">Vendor Image</th>
                                        <th style="display: table-cell;">Vendor Name</th>
                                        <th style="display: table-cell;">Phone</th>
                                        <th style="display: table-cell; text-align: center;">Email</th>
                                        <th style="display: table-cell; text-align: center;">Business Name</th>
                                        <th style="display: table-cell;" class="text-center">Options</th>
                                    </tr>
                                </thead>
                                <tbody id="main_table_body">
                                   @foreach($vendor_list as $vendor)
                                    <tr >
                                        <td style="display: table-cell;">
                                             1
                                        </td>
                                        <td style="display: table-cell;"> 
                                                    <div class="vendor_img">
                                                        <img src="https://pbs.twimg.com/profile_images/1701878932176351232/AlNU3WTK_400x400.jpg">
                                                    </div>   
                                        </td>
                                        <td style="display: table-cell;">
                                             {{$vendor->name}}    
                                        </td>
                                        <td style="display: table-cell;"> 
                                            {{$vendor->phone}}
                                        </td>
                                        <td>
                                             {{$vendor->email}}
                                        </td>
                                        <td> 
                                            {{$vendor->business_name}}
                                        </td>

                                        <td class="text-left footable-last-visible ">
                                            <div class="d-flex justify-content-center "> 
                                            <a class="btn btn-soft-info btn-icon btn-circle btn-sm eye-2"
                                                href="{{route('backend.vendor.edit')}}" title="Edit">
                                                <i class="fa-regular fa-pen-to-square text-white"></i>
                                            </a> 
                                            <button value="" class="btn btn-icon btn-sm delete_ico"
                                            id="delete_btn"> <i class="fa-solid fa-trash-can"></i></button>
                                            </div>
                                        </td>
                                    </tr> 
                                    @endforeach
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