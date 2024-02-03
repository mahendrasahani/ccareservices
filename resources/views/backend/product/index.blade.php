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
                                        <tr>
                                            <td style="display: table-cell;">
                                                <div class="form-group">
                                                    <div class="form-check-inline">
                                                        <input type="checkbox" class="form-check-input check-one" name="id[]" value="307">
                                                        <label class="form-check-label"></label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="display: table-cell;">
                                                <a href="" target="_blank" class="text-reset d-block">
                                                    <div class="d-flex align-items-center">
                                                        <a href="#" target="_blank" class="">
                                                            <div class="d-flex align-items-center">
                                                                <img src="{{url('public/assets/backend/images/products_img/iphone-1.jpg')}}">
                                                                <span class="flex-grow-1 minw-0">
                                                                    <div class=" text-truncate-2">
                                                                        <p class="font-s">
                                                                            Apple iPhone 12 Pro, 128GB, 256GB, 512 GB Deep Purple
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
                                                    <div><span>Total Sold</span>: <span class="fw-600">2</span></div>
                                                    <div>
                                                        <span>Price</span>: <span class="fw-600">₹999.00 - ₹1,299.00</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="display: table-cell;">
                                                <span class="badge badge-primary mb-1">Cellphones & Tabs</span>
                                                <span class="badge badge-primary mb-1">Smartphones</span>
                                            </td>
                                            <td>
                                                <div
                                                    class="h-50px w-100px d-flex align-items-center justify-content-center">
                                                    <img src="{{url('public/assets/backend/images/products_img/brand.png')}}" class="w-50">
                                                </div>
                                            </td>
                                            <td style="display: table-cell;">
                                                <label class="switch">
                                                    <input type="checkbox">
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
                                                        <i class="fa-regular fa-pen-to-square text-white"></i>
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
                                    </tbody>
                                </table>
                                <nav class="mt-3">
                                    <ul class="pagination">
                                        <li class="page-item disabled" aria-disabled="true" aria-label="pagination.previous">
                                            <span class="page-link  border-0" aria-hidden="true">‹</span>
                                        </li>
                                        <li class="page-item active" aria-current="page"><span class="page-link  border-0">1</span>
                                        </li>
                                        <li class="page-item"><a class="page-link  border-0" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link  border-0" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link  border-0" href="#">4</a></li>
                                        <li class="page-item"><a class="page-link  border-0" href="#">5</a></li>
                                        <li class="page-item"><a class="page-link  border-0" href="#">6</a></li>
                                        <li class="page-item"><a class="page-link  border-0" href="#">7</a></li>
                                        <li class="page-item"><a class="page-link  border-0" href="#">8</a></li>
                                        <li class="page-item"><a class="page-link  border-0" href="#">9</a></li>
                                        <li class="page-item"><a class="page-link  border-0" href="#">10</a></li>
                                        <li class="page-item"><a class="page-link  border-0" href="#">11</a></li>
                                        <li class="page-item"><a class="page-link  border-0" href="#">12</a></li>
                                        <li class="page-item">
                                            <a class="page-link  border-0" href="#" rel="next" aria-label="pagination.next">›</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #/ container -->
    </div>


@endsection