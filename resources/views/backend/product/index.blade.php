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
                        <h1 class="h4">All products</h1>
                    </div>
                    <div class="col-md-8 text-md-right">
                        <a href="{{route('backend.product.create')}}" class="btn btn-primary" style="background-color: #f5a100; border: none; border-radius: 50em;">
                            <span>Add New Product</span>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card" style="border: 1px solid #dadada;">
                            <div class="d-flex align-items-center" style="border-bottom: 1px solid #ececec;">
                                    <div class="col text-center text-md-left">
                                        <h5 class="mb-md-0 h6">All products</h5>
                                    </div>
                                    <div class="dropdown mb-2 mb-md-0">
                                        <button class="btn border dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                            Bulk Action
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" style="">
                                            <a class="dropdown-item confirm-alert" href="javascript:void(0)" data-target="#bulk-delete-modal"> Delete selection</a>
                                        </div>
                                    </div>
                                    <div class="col-md-2 ml-auto">
                                        <div class="form-group mt-2 mb-2">
                                            <select class="form-control form-control-sm" name="type" id="type">
                                                <option value="">Sort by</option>
                                                <option value="rating,desc">Rating (High &gt; Low)</option>
                                                <option value="rating,asc">Rating (Low &gt; High)</option>
                                                <option value="num_of_sale,desc">Num of Sale (High &gt; Low)</option>
                                                <option value="num_of_sale,asc">Num of Sale (Low &gt; High)</option>
                                                <option value="unit_price,desc">Base Price (High &gt; Low)</option>
                                                <option value="unit_price,asc">Base Price (Low &gt; High)</option>
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
                                            <th style="display: table-cell;">
                                                <div class="form-group">
                                                    <div class="form-check-inline">
                                                        <input type="checkbox" class="form-check-input check-all">
                                                        <label class="form-check-label"></label>
                                                    </div>
                                                </div>
                                            </th>
                                            <th style="display: table-cell;">Name</th>
                                            <th style="display: table-cell;">Info</th>
                                            <th style="display: table-cell;">Categories</th>
                                            <th style="display: table-cell; text-align: center;">Brand</th>
                                            <th style="display: table-cell; text-align: center;">Published</th>
                                            <th style="display: table-cell;" class="text-center">Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($product_list as $product)
                                        <tr>
                                            <td style="display: table-cell;">
                                                <div class="form-group">
                                                    <div class="form-check-inline">
                                                        <input type="checkbox" class="form-check-input check-one" name="product_id[]" value="{{$product->id}}">
                                                        <label class="form-check-label"></label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="display: table-cell;">
                                                <a href="" target="_blank" class="text-reset d-block">
                                                    <div class="d-flex align-items-center">
                                                        <a href="#" target="_blank" class="">
                                                            <div class="d-flex align-items-center">

                                                                <img src="{{url('public/'.$product->product_images[0])}}" width="50%">

                                                                <span class="flex-grow-1 minw-0">
                                                                    <div class=" text-truncate-2">
                                                                        <p class="font-s">
                                                                            {{$product->product_name}}
                                                                        </p>
                                                                    </div>
                                                                </span>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </a>
                                            </td>
                                            <td style="display: table-cell;">
                                                <div>
                                                    <div>
                                                        <span>Rating</span>: <span class="rating rating-sm my-2"><i class="las la-star active"></i><i class="las la-star active"></i><i class="las la-star active"></i><i class="las la-star active"></i><i class="las la-star active"></i></span>
                                                    </div>
                                                    <!-- <div><span>Total Sold</span>: <span class="fw-600">2</span></div> -->
                                                    <div>
                                                        <span>Price</span>: <span class="fw-600">₹{{number_format($product->regular_price, 2)}}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="display: table-cell;">
                                            @php 
                                                $main_cat = App\Models\Backend\MainCategory::whereIn('id', $product->main_category)->get();
                                            @endphp
                                            @foreach($main_cat as $main)
                                                <span class="badge badge-primary mb-1">{{$main->name}}</span> 
                                                @endforeach
                                            </td>
                                            <td>
                                                <div
                                                    class="h-50px w-100px d-flex align-items-center justify-content-center">
                                                    
                                                    <img src="{{url($product->getBrand->logo)}}" width="15%">

                                                </div>
                                            </td>
                                            <td style="display: table-cell;">
                                                <label class="switch">
                                                <input type="checkbox" {{$product->product_status == 1 ? 'checked' : ''}}>
                                                    <span class="slider"></span>
                                                </label>
                                            </td>
                                                <td class="text-right footable-last-visible ">
                                                    <a class="btn btn-soft-primary btn-icon btn-circle btn-sm ico_chnage"
                                                        href="307.html" title="View">
                                                        <i class="fa-regular fa-eye"></i>
                                                    </a>
                                                    <a class="btn btn-soft-info btn-icon btn-circle btn-sm eye-2"
                                                        href="edit-product.html" title="Edit">
                                                        <i class="fa-regular fa-pen-to-square"></i>
                                                    </a>
                                                    <a class="btn btn-soft-success btn-icon btn-circle btn-sm eye_3"
                                                        href="javascript:void()" title="Duplicate" onclick="duplicateRow(this)">
                                                        <i class="fa-regular fa-copy"></i>
                                                    </a>
                                                    <a href="javascript:void()"
                                                            class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete delete_ico"
                                                            title="Delete" data-toggle="modal"
                                                            data-target="#myModal">
                                                            <i class="fa-solid fa-trash-can"></i>
                                                            <!-- Button trigger modal -->
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog"
                                                                aria-labelledby="myModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="myModalLabel">Delete
                                                                                Confirmation</h5>
                                                                            <button type="button" class="close" data-dismiss="modal"
                                                                                aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="fafaicon_warning mb-4">
                                                                                <i class="fa-solid fa-triangle-exclamation"></i>
                                                                            </div>
                                                                            <h4>Are you sure to delete this?</h4>
                                                                            <p>All data related to this will be deleted.</p>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn"
                                                                                data-dismiss="modal">Cancel</button>
                                                                            <button type="button" class="btn btn-delete">Yes,
                                                                                Delete</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #/ container -->
    </div>


@endsection