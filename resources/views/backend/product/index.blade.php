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
                                        <option value="price_high_to_low" {{isset($_GET['sortBy']) &&
    $_GET['sortBy'] == 'price_high_to_low' ? 'selected' : ''}}>Base Price (High >
                                            Low)</option>
                                        <option value="price_low_to_high" {{isset($_GET['sortBy']) &&
    $_GET['sortBy'] == 'price_low_to_high' ? 'selected' : ''}}>Base Price (Low >
                                            High)</option>
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
                                        <th style="display: table-cell;">
                                            <div class="form-group">
                                                <div class="form-check-inline">
                                                    <input type="checkbox" class="form-check-input check-all"
                                                        name="main_checkbox">
                                                    <label class="form-check-label"></label>
                                                </div>
                                            </div>
                                        </th>
                                        <th style="display: table-cell;">Name</th>
                                        <th style="display: table-cell;">Info</th>
                                        <th style="display: table-cell;">Categories</th> 
                                        <th style="display: table-cell;">Published</th>
                                        <th style="display: table-cell;">Options</th>
                                    </tr>
                                </thead>
                                <tbody id="main_table_body">
                                    @foreach($product_list as $product)
                                    <tr id="row_id_{{$product->id}}">
                                        <td style="display: table-cell;">
                                            <div class="form-group">
                                                <div class="form-check-inline">
                                                    <input type="checkbox" class="form-check-input check-one"
                                                        name="product_ids[]" value="{{$product->id}}">
                                                    <label class="form-check-label"></label>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="display: table-cell;">
                                            <div class="  ">
                                                <a href="#" target="_blank" >
                                                    <div class="pro-img  ">
                                                        <img
                                                            src="{{$product->product_images == '' ? url('public/assets/both/placeholder/product.jpg') : url('public/'.$product->product_images[0])}}">
                                                    </div>
                                                    <div class=" text-truncate-2">
                                                        <p class="font-s mt-3"> <b>{{$product->product_name}}</b></p>
                                                    </div> 
                                                </a>
                                            </div>
                                        </td>
                                        <td style="display: table-cell;">
                                            <div>
                                                <div class="d-flex align-items-center">
                                                    <span>Rating</span>: <span class="rating rating-sm my-2 mx-2">
                                                        <i class="fa fa-star {{round($product->get_review_avg_rating) >= 1 ? 'c_yellow':''}}"></i>
                                                        <i class="fa-solid fa-star {{round($product->get_review_avg_rating) >= 2 ? 'c_yellow':''}}"></i>
                                                        <i class="fa-solid fa-star {{round($product->get_review_avg_rating) >= 3 ? 'c_yellow':''}}"></i>
                                                        <i class="fa-solid fa-star {{round($product->get_review_avg_rating) >= 4 ? 'c_yellow':''}}"></i>
                                                        <i class="fa-solid fa-star {{round($product->get_review_avg_rating) >= 5 ? 'c_yellow':''}}"></i>
                                                    </span>
                                                </div>
                                                <!-- <div><span>Total Sold</span>: <span class="fw-600">2</span></div> -->
                                                <!-- <div>
                                                    <div class="dprice d-flex">
                                                        <span>Price</span>: <span
                                                            class="fw-600">₹<strike>{{number_format($product->regular_price,
                                                                2)}}</strike></span>
                                                    </div> 
                                                    @if($product->discount_type == 'flat')
                                                    <div class="aprice d-flex"> 
                                                        <span>Price</span>: <span
                                                            class="fw-600">₹{{number_format($product->regular_price -
                                                            $product->discount, 2)}}</span>
                                                    </div>
                                                    @elseif($product->discount_type == 'percent')
                                                    <span>Price</span>: <span
                                                        class="fw-600">₹{{number_format($product->regular_price -
                                                        ($product->regular_price * $product->discount)/100, 2)}}</span>
                                                    @endif
                                                </div> -->
                                            </div>
                                        </td>
                                        <td style="display: table-cell;">
                                            @php
                                            $main_cat = App\Models\Backend\MainCategory::whereIn('id',
                                            $product->main_category)->get();
                                            @endphp
                                            @foreach($main_cat as $main)
                                            <span class="badge badge-primary mb-1">{{$main->name}}</span>
                                            @endforeach
                                        </td>
                                         
                                        <td><label class="switch">
                                                <input type="checkbox" {{$product->product_status == 1 ? 'checked':''}}
                                                id="product_status" name="product_status"
                                                value="{{$product->product_status}}" data-id="{{$product->id}}">
                                                <span class="slider"></span></label>
                                        </td>

                                        <td class="text-left footable-last-visible ">
                                            <div class="d-flex justify-content-center ">
                                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm ico_chnage mr-1"
                                                href="{{route('backend.product.view', [$product->id])}}" title="View">
                                                <i class="fa-regular fa-eye"></i>
                                            </a>
                                            <a class="btn btn-soft-info btn-icon btn-circle btn-sm eye-2"
                                                href="{{route('backend.product.edit', [$product->id])}}" title="Edit">
                                                <i class="fa-regular fa-pen-to-square text-white"></i>
                                            </a>
                                            <!-- <a class="btn btn-soft-success btn-icon btn-circle btn-sm eye_3"
                                                href="javascript:void()" title="Duplicate"
                                                onclick="cloneRow({{$product->id}})">
                                                <i class="fa-regular fa-copy"></i>
                                            </a> -->
                                            <button value="{{$product->id}}" class="btn btn-icon btn-sm delete_ico"
                                            id="delete_btn"> <i class="fa-solid fa-trash-can"></i></button> 
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div id="my_pagination">
                                {{$product_list->links('pagination::bootstrap-5')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('javascript-section')
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

<script>
    function deleteSelection(){
        let selectedIds = [];
        document.querySelectorAll('input[name="product_ids[]"]:checked').forEach(function (checkbox){
            selectedIds.push(checkbox.value);
        });
        $.ajax({
            url: "{{route('backend.product.multi_destroy')}}",
            type: "GET",
            data: { "selectedIds": selectedIds },
            success: function (response){
                if (response.status == 200 && response.message == "success"){
                    Swal.fire({
                        title: "Success",
                        text: "Main Category has been deleted !",
                        icon: "success",
                        button: "Ok"
                    }).then(function (){
                        window.location.reload();
                    });
                }
            }
        });
    } 
</script>


<script>
    function formatIndianRupee(number){
        var formattedNumber = number.toLocaleString('en-IN', {
            style: 'currency',
            currency: 'INR',
            minimumFractionDigits: 2
        });
        formattedNumber = formattedNumber.replace(/,/g, '');
        return formattedNumber;
    }

    document.addEventListener("DOMContentLoaded", function (){
        var projectStatus = localStorage.getItem('product_create');
        if (projectStatus == 'success'){
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Operation successful with session value',

            });
            localStorage.removeItem('product_create');
        }
    });
    function cloneRow(id){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('backend.product.clone')}}",
            type: "POST",
            data: { 'id': id },
            success: function (response){
                var product = response.new_product;
                var old_tr = document.getElementById('row_id_' + id);
                var new_tr = document.createElement('tr');
                new_tr.id = 'row_id_' + product.id; // set the id for the new row
                var domainURL = "{{url('public/')}}";
                var domainURLforBrand = "{{url('/')}}";
                var mainurl =
                    new_tr.innerHTML = `
            <td style="display: table-cell;">
                <div class="form-group">
                    <div class="form-check-inline">
                        <input type="checkbox" class="form-check-input check-one" name="product_id[]" value="${product.id}">
                        <label class="form-check-label"></label>
                    </div>
                </div>
            </td>
            <td style="display: table-cell;">
                <a href="" target="_blank" class="text-reset d-block">
                    <div class="d-flex align-items-center">
                        <a href="#" target="_blank" class="">
                            <div class="pro-img">
                                <img src="${product.product_images == null ? domainURL + '/assets/both/placeholder/product.jpg' : domainURL + '/' + product.product_images[0]}" width="50%">
                                <span class="flex-grow-1 minw-0">
                                    <div class=" text-truncate-2">
                                        <p class="font-s mt-3"><b>${product.product_name}</b></p>
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
                    <div>
                        <span>Price</span>: <span class="fw-600">₹<strike>${formatIndianRupee(product.regular_price)}</strike></span>
                        ${product.discount_type == 'flat' ?
                        `<span>Price</span>: <span class="fw-600">₹${product.regular_price - product.discount}</span>` :
                        (product.discount_type == 'percent' ?
                            `<span>Price</span>: <span class="fw-600">₹${product.regular_price - (product.regular_price * product.discount) / 100}</span>` :
                            '')
                    }
                    </div>
                </div>
            </td>
            <td style="display: table-cell;">
                ${response.main_cat.map(main => `<span class="badge badge-primary mb-1">${main.name}</span>`).join('')}
            </td>
            <td>
                <div class="h-50px w-100px d-flex align-items-center justify-content-center">
                    <img src="${product.get_brand.logo == null ? domainURLforBrand + '/assets/both/placeholder/brand.jpg' : domainURLforBrand + '/' + product.get_brand.logo}" width="15%">
                </div>
            </td>
            <td><label class="switch">
            <input type="checkbox" ${product.product_status == 1 ? 'checked' : ''} id="product_status" name="product_status" value="${product.product_status}" data-id="${product.id}">
            <span class="slider"></span></label>
        </td>
            

            <td class="text-right footable-last-visible">
                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm ico_chnage" href="product/view/${product.id}" title="View">
                    <i class="fa-regular fa-eye"></i>
                </a>
                <a class="btn btn-soft-info btn-icon btn-circle btn-sm eye-2" href="product/edit/${product.id}" title="Edit">
                    <i class="fa-regular fa-pen-to-square text-white"></i>
                </a>
                <a class="btn btn-soft-success btn-icon btn-circle btn-sm eye_3" href="javascript:void()" title="Duplicate" onclick="cloneRow(${product.id})">
                    <i class="fa-regular fa-copy"></i>
                </a> 
                <button value="${product.id}" class="btn btn-icon btn-sm delete_ico" id="delete_btn"> <i class="fa-solid fa-trash-can"></i></button>
            </td>
        `;
                old_tr.parentNode.insertBefore(new_tr, old_tr.nextSibling);
            }
        });
    }
</script>

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
                    url: "{{route('backend.product.destroy')}}",
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


<script>
    $(document).on('change', '#product_status', function (){
        var $toggleButton = $(this);
        var status = $toggleButton.prop('checked') ? '1' : '0';
        var product_id = $(this).data('id');
        $.ajax({
            url: "{{route('backend.product.change_status')}}",
            data: { 'product_status': status, 'product_id': product_id },
            type: "GET",
            success: function (response){
                if (response.status == 200){    
                    Swal.fire({
                        title: "Success!",
                        text: "Status successfully updated.",
                        icon: "success"
                    });
                }
            }
        });
    });
</script>


<script>
    $(document).ready(function (){
        $('.check-all').click(function (){
            if ($(this).is(':checked')){
                $('.check-one').prop('checked', true);
                $('#multiSelectActionBtn').show();
            } else{
                $('.check-one').prop('checked', false);
                $('#multiSelectActionBtn').hide();
            }
        });

        $('.check-one').click(function (){
            let checkedCount = 0;
            document.querySelectorAll('input[name="product_ids[]"]').forEach(function (checkbox){
                if (checkbox.checked){
                    checkedCount++;
                }
            });
            if (checkedCount > 0){
                $('#multiSelectActionBtn').show();
            } else{
                $('#multiSelectActionBtn').hide();
            }
        });

    });
</script>

<script>


    $(document).on('change', '#sort_by', function (){
        const sortBy = $(this).val();
        var current_url = "{{route('backend.admin.product.index')}}";
        window.location.replace(current_url + '?sortBy=' + sortBy);
    });

</script>


@endsection
@endsection