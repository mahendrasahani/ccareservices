@extends('layouts/backend/main')
@section('main-section')

<style>
    .price {
        display: flex !important;
        justify-content: space-around;
    }
    .product-option-add-btn {
    padding: 8px;
    text-align: end;
    color: #000;
    font-size: 22px;
    width: 100%;
} 
</style>

<div class="content-body">
    <div class="top-set">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-3 mb-3">
                    <h3>Add new Product</h3>
                </div>
            </div>
        </div>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card" style="border: 1px solid #e8e8e8;">
                            <div class="card-header" style="border-bottom: 1px solid #e8e8e8;">
                                <h4 class="mb-0 h6">Product Information</h4>
                            </div>
                            <!-- <form action="{{route('backend.product.store')}}" method="POST" enctype="multipart/form-data" id="create_product_form"> -->
                            <form enctype="multipart/form-data" id="create_product_form"
                                onsubmit="validateAndSubmit(event)">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Product Name <span
                                                class="text-danger">*</span> <i class="las la-language text-danger"
                                                title="Translatable"></i></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="product_name"
                                                placeholder="Product Name" id="product_name" required>
                                            <span id="productNameError" class="formFiedllerror"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Minimum Purchase Qty <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="number" class="form-control" name="min_qty" min="1" value="1"
                                                id="min_qty" placeholder="Product Minimum Purchase Qty." required>
                                            <small class="text-muted">Customer need to purchase this minimum
                                                quantity for this product. Minimum should be 1.</small>
                                            <span id="minQtyError" class="formFiedllerror"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Maximum Purchase Qty</label>
                                        <div class="col-md-9">
                                            <input type="number" class="form-control" name="max_qty" min="1" value="1"
                                                id="max_qty" placeholder="Product Maximum Purchase Qty." required>
                                            <small class="text-muted">Customer will be able to purchase this
                                                maximum quantity for this product. Default empty for
                                                unlimited.</small>
                                        </div>
                                    </div>
                                </div>

                        </div>
                        <div class="card" style="border: 1px solid #e8e8e8;">
                            <div class="card-header" style="border-bottom: 1px solid #e8e8e8;">
                                <h4 class="mb-0 h6">Product Images</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="signinSrEmail">Product
                                        Images<small>(600x600)</small></label>
                                    <div class="col-md-9">
                                        <div class="input-group" data-toggle="" data-type="image" data-multiple="true">
                                            <input type="file" id="product_images" class="form-control"
                                                name="product_images[]" multiple
                                                onchange="displaySelectedImages(event)">
                                        </div>

                                        <div id="imagePreview"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card" style="border: 1px solid #e8e8e8;">
                            <div class="card-header" style="border-bottom: 1px solid #e8e8e8;">
                                <h5 class="h6">Product price, stock
                                </h5>
                            </div>

                            <div class="card-body hidden">
                                <div class="no_product_variant">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Regular price <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="number" step="1" min="1" placeholder="Product Price"
                                                name="product_price" id="product_price" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">SKU</label>
                                        <div class="col-md-9">
                                            <input type="text" placeholder="SKU" name="sku" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">In Stock <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <select class="form-control" id="stock_status" name="stock_status" required>
                                                <option value="1" selected>In Stock</option>
                                                <option value="0">Out of Stock</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card" style="border: 1px solid #e8e8e8;">
                            <div class="card-header" style="border-bottom: 1px solid #e8e8e8;">
                                <h5 class="mb-0 h6">Product Discount</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label" for="start_date">Discount Date Range</label>
                                    <div class="col-sm-9">
                                        <div class="input-group date">
                                            <input type="date" class="form-control aiz-date-range" name="date_range"
                                                placeholder="Select Date" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-from-label">Discount <span
                                            class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input type="number" lang="en" min="1" step="1" placeholder="Discount"
                                            name="discount" class="form-control" required>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <select class="form-control" id="discount_type" name="discount_type">
                                                <option value="flat" selected>Flat</option>
                                                <option value="percent">Percent</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card" style="border: 1px solid #e8e8e8;">
                            <div class="card-header" style="border-bottom: 1px solid #e8e8e8;">
                                <h5 class="h6">Product Description</h5>
                                <p>Description </p>
                            </div>
                            <div class="card-body">
                                <div id="container">
                                    <textarea id="editor" name="product_description"></textarea>
                                </div>
                                <span id="editorError" class="formFiedllerror"></span>
                            </div>
                        </div>
                        <div class="card" style="border: 1px solid #e8e8e8;">
                            <div class="card-header d-flex justify-content-between"
                                style="border-bottom : 1px solid #e8e8e8;">
                                <h5 class="mb-0 pt-2">Product attributes</h5>
                                <button class="btn btn-soft-dark" type="button" onclick="addAttribute()">Add new
                                    attribute</button>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-info">These attributes will be used only for filtering.</div>
                                <div class="all-attributes"></div>
                                <div class="header-nav-menu">
                                    <div class="row gutters-5" id="home"></div>
                                </div>
                                <div id="add_on"></div>
                            </div>
                        </div>
                        <div class="card" style="border: 1px solid #e8e8e8;">
                            <div class="card-header" style="border-bottom: 1px solid #e8e8e8;">
                                <h5 class="mb-0 h6">SEO Meta Tags</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-md-3 col-from-label">Meta Title</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="meta_title"
                                            placeholder="Meta Title">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-from-label">Description</label>
                                    <div class="col-md-9">
                                        <textarea name="meta_description" id="meta_description" row="8"
                                            style="width:100%"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Slug</label>
                                    <div class="col-md-9">
                                        <input type="text" placeholder="Slug" id="slug" name="slug"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="card" style="border: 1px solid #e8e8e8;">
                            <div class="card-header d-flex justify-content-between"
                                style="border-bottom : 1px solid #e8e8e8;">
                                <h5 class="mb-0 pt-2">Product Option</h5>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-info">Add Option</div> 
                                <div class="row" id="option_list_row"></div>
                                <div class="row">
                                    <label class="col-md-3 col-form-label" for="product_option">Select an
                                        option:</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="product_option_select"
                                            id="product_option_select">
                                            <option value="">--Select--</option>
                                            @if(count($attribute_list) > 0)
                                            @foreach($attribute_list as $attribute)
                                            <option value="{{$attribute->id}}">{{$attribute->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>


                                </div>
                            </div>
                        </div>

                        <!------------------------------------ Modal start -------------------------------->
                        <div class="modal fade" id="product_modal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Product Options</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="product-details">
                                                    <input type="hidden" name="table_id" id="table_id">
                                                    <label for="option_value" class="popup_label">Option Value</label>
                                                    <select class="form-control" name="option_value" id="option_value">
                                                        <option value="option1">Option 1</option>
                                                        <option value="option2">Option 2</option>
                                                        <option value="option3">Option 3</option>
                                                        <option value="option4">Option 4</option>
                                                        <option value="option5">Option 5</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="product-details">
                                                    <label for="option_value" class="popup_label">Quantity</label><br>
                                                    <input type="number" min="1" style="width:100%" class="form-control" id="product_qty">
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="product-details">
                                                    <!-- <label for="price" class="popup_label">Month</label> -->

                                                    <div class="price ">
                                                        <label for="price" class="popup_label">Month</label>
                                                        <label for="price" class="popup_label">Price</label>
                                                    </div>
                                                    <div class="price ">
                                                        <div class="month">
                                                            <input type="text" class="form-control" style="width:100%" disabled value="1" id="month_1"> 
                                                            <input type="text" class="form-control" style="width:100%" disabled value="2" id="month_2"> 
                                                            <input type="text" class="form-control" style="width:100%" disabled value="3" id="month_3"> 
                                                            <input type="text" class="form-control" style="width:100%" disabled value="4" id="month_4"> 
                                                            <input type="text" class="form-control" style="width:100%" disabled value="5" id="month_5"> 
                                                            <input type="text" class="form-control" style="width:100%" disabled value="6" id="month_6">  
                                                        </div>
                                                        <div class="price_input">
                                                        <input type="number" min="0" style="width:100%" class="form-control" id="price_1">
                                                        <input type="number" min="0" style="width:100%" class="form-control" id="price_2">
                                                        <input type="number" min="0" style="width:100%" class="form-control" id="price_3">
                                                        <input type="number" min="0" style="width:100%" class="form-control" id="price_4">
                                                        <input type="number" min="0" style="width:100%" class="form-control" id="price_5"> 
                                                        <input type="number" min="0" style="width:100%" class="form-control" id="price_6"> 
                                                        </div> 
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="product-details"> 
                                                    <div class="price ">
                                                        <label for="price" class="popup_label">Month</label>
                                                        <label for="price" class="popup_label">Price</label>
                                                    </div>
                                                    <div class="price ">
                                                    <div class="month">
                                                            <input type="text" class="form-control" style="width:100%" disabled value="7" id="month_7"> 
                                                            <input type="text" class="form-control" style="width:100%" disabled value="8" id="month_8"> 
                                                            <input type="text" class="form-control" style="width:100%" disabled value="9" id="month_9"> 
                                                            <input type="text" class="form-control" style="width:100%" disabled value="10" id="month_10"> 
                                                            <input type="text" class="form-control" style="width:100%" disabled value="11" id="month_11"> 
                                                            <input type="text" class="form-control" style="width:100%" disabled value="12" id="month_12">  
                                                        </div>
                                                        <div class="price_input">
                                                        <input type="number" min="0" style="width:100%" class="form-control" id="price_7">
                                                        <input type="number" min="0" style="width:100%" class="form-control" id="price_8">
                                                        <input type="number" min="0" style="width:100%" class="form-control" id="price_9">
                                                        <input type="number" min="0" style="width:100%" class="form-control" id="price_10">
                                                        <input type="number" min="0" style="width:100%" class="form-control" id="price_11"> 
                                                        <input type="number" min="0" style="width:100%" class="form-control" id="price_12"> 
                                                        </div>
                                                        
                                                    </div>

                                                </div>
                                            </div>
                                             
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" onclick="validateOptionModal()">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!------------------------------ Modal End --------------------->
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mar-all  mb-3">
                                        <button class="btn btn-primary">Add Product</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card" style="border: 1px solid #e8e8e8;">
                            <div class="card-header" style="border-bottom: 1px solid #e8e8e8;">
                                <h5 class="mb-0 h6">Product Status</h5>
                            </div>
                            <div class="card-body">
                                <select class="form-control" id="product_status" name="product_status">
                                    <option value="1" selected>Published</option>
                                    <option value="0">Draft</option>
                                </select>
                            </div>
                        </div>
                        <div class="card" style="border: 1px solid #e8e8e8;">
                            <div class="card-header" style="border-bottom: 1px solid #e8e8e8;">
                                <h5 class="mb-0 h6">Product Brand</h5>
                            </div>
                            <div class="card-body">
                                <select class="form-control" name="product_brand" data-live-search="true"
                                    title="Select Brand" required>
                                    <option value="">Select Brand</option>
                                    @foreach($brand_list as $brand)
                                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!------------------------------- PRODUCT CATEGORY ------------------------------------------->
                        <div class="card" style="border: 1px solid #e8e8e8;">
                            <div class="card-header" style="border-bottom: 1px solid #e8e8e8;">
                                <h5 class="mb-0 h6">Product Category</h5>
                                <h6 class="float-right fs-13 mb-0">
                                    Select Main
                                    <span class="position-relative main-category-info-icon">
                                        <i class="las la-question-circle fs-18 text-info"></i>
                                        <span
                                            class="main-category-info bg-info p-2 position-absolute d-none border">These will be used for Affiliate System.</span>
                                    </span>
                                </h6>
                            </div>
                            <div class="card-body productCard-body">
                                <div class="h-300px overflow-auto c-scrollbar-light">
                                    <div id="treeview_container" class="hummingbird-treeview">
                                        <ul id="treeview" class="hummingbird-base" style="display: block;">
                                            @foreach($main_category_list as $key => $main_cat)
                                            <li data-id="0">
                                                <div class="product-card">
                                                    <span>
                                                        <button
                                                            onclick="showOptions(event, 'sub_cat_list_{{$key}}','show_{{$key}}','hide_{{$key}}')"
                                                            id="show_{{$key}}" class="show_btn"><i
                                                                class="fa-solid fa-plus"></i></button>
                                                        <button
                                                            onclick="hideOptions(event, 'sub_cat_list_{{$key}}','show_{{$key}}','hide_{{$key}}')"
                                                            id="hide_{{$key}}" class="hide_btn" style="display:none;"><i
                                                                class="fa-solid fa-minus"></i></button>
                                                        <label for="main_cat_{{$key}}"></label>
                                                        <input type="checkbox" class="main_checkbox"
                                                            id="main_cat_{{$key}}" name="main_categories[]"
                                                            onchange="checkAllBox('main_cat_{{$key}}', 'sub_checkbox_{{$key}}')"
                                                            value="{{$main_cat->id}}">
                                                        <label for="main_cat_{{$key}}"> {{$main_cat->name}}</label>
                                                    </span>
                                                </div>

                                                <div id="sub_cat_list_{{$key}}" class="sub_cat_list">
                                                    @foreach($main_cat->subCategory as $sub_cat)
                                                    <div class="product-card">
                                                        <span>
                                                            <input type="checkbox"
                                                                class="checkInside0 sub_checkbox_{{$key}}"
                                                                name="sub_categories[]" value="{{$sub_cat->id}}"
                                                                onchange="removeAllCheckBox('main_cat_{{$key}}', 'sub_checkbox_{{$key}}')">
                                                            <label>{{$sub_cat->name}}</label>
                                                        </span>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                        <span id="categoryError" class="formFiedllerror"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                        <!------------------------------------------ END OF PRODUCT CATEGORY ----------------------------------------------->
                        <div class="card" style="border: 1px solid #e8e8e8;">
                            <div class="card-header" style="border-bottom: 1px solid #e8e8e8;">
                                <h4>VAT & Tax</h4>
                            </div>
                            <div class="card-body">
                                <form id="vatTaxForm">
                                    <div class="form-group">
                                        <label for="amount">Amount:</label>
                                        <input type="number" class="form-control" id="amount" placeholder="Enter amount"
                                            required>
                                    </div> 
                                    <div class="form-group">
                                        <label for="vatRate">VAT Rate (%):</label>
                                        <input type="number" class="form-control" id="vatRate"
                                            placeholder="Enter VAT rate" required>
                                    </div> 
                                    <div class="form-group">
                                        <label for="taxRate">Tax Rate (%):</label>
                                        <input type="number" class="form-control" id="taxRate"
                                            placeholder="Enter Tax rate" required>
                                    </div> 
                                    <button type="button" class="btn btn-primary"
                                        onclick="calculate()">Calculate</button>
                                </form> 
                            </div>
                            <div id="result" class="mt-4 mx-4"></div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
</div>

@section('javascript-section')
<script>
    function showOptionModal(table_id){
        console.log(table_id)
        var modal = document.getElementById('product_modal');
        console.log(modal)
        $('#table_id').val(table_id)
        modal.style.display = "block";
    }
</script>
<script>
    function validateOptionModal(){
        var tableId = document.getElementById('table_id').value;
        var optionVal = document.getElementById('option_value').value;
        var product_qty = document.getElementById('product_qty').value;
        
        var product_qty = document.getElementById('product_qty').value;
        var html_to_append = `<tr>
                                <td>${optionVal}</td>
                                <td>${product_qty}</td> 
                                <td style="text-align:end"><i class="fa fa-minus-circle" aria-hidden="true"></i><i class="fa fa-pencil-square mx-2"></i>
                                </td>
                            </tr>
                            <input type="hidden" value="" id="price" name="price">
                            <input type="hidden" value="" id="month" name="price">
                            `;
                        document.getElementById(tableId).insertAdjacentHTML('beforeend', html_to_append);
                        var modal = document.getElementById('product_modal');  
                        var inputs = modal.querySelectorAll('input[type="number"]');  
                        inputs.forEach(function(input) {
                        input.value = '';
                        }); 
                        $('#product_modal').modal('hide');
    }
</script>


<script>
    let myEditor;

    ClassicEditor
        .create(document.querySelector('#editor'))
        .then(editor => {
            myEditor = editor;

        })
        .catch(error => {
            console.error(error);
        });

    function validateAndSubmit(event) {
        event.preventDefault();
        var errorFields = document.getElementsByClassName('formFiedllerror');
        for (var i = 0; i < errorFields.length; i++) {
            errorFields[i].innerText = '';
        }

        var formData = new FormData($('#create_product_form')[0]);
        var CatCheckboxes = document.querySelectorAll('.main_checkbox:checked');
        if (CatCheckboxes.length < 1) {
            var EmptyCatCheckboxes = document.querySelectorAll('.main_checkbox');
            document.getElementById('categoryError').innerText = 'Select category.';
            EmptyCatCheckboxes[0].focus();
            return;
        }

        const editorValue = myEditor.getData();
        if (editorValue == '') {
            document.getElementById('editorError').innerText = 'Enter product description';
            myEditor.focus();
            return;
        } else {
            formData.append('product_description', editorValue);
        }

        // Append additional data to formData
        var attributeName = $('#add_on select[name^="product_attributes"]');
        attributeName.each(function (index, element) {
            formData.append(element.name, $(element).val());
        });

        var attributeValue = $('#add_on select[name^="filtering_attributes"]');
        attributeValue.each(function (index, element) {
            formData.append(element.name, $(element).val());
        });

        // Append productImagesValue to formData
        var productImagesInput = document.getElementById('product_images');
        var productImagesValue = productImagesInput.files;
        for (var i = 0; i < productImagesValue.length; i++) {
            formData.append('product_images[]', productImagesValue[i].name);
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('backend.product.store')}}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == 200 && response.message == "success") {
                    localStorage.setItem('product_create', 'success');
                    window.location.href = "{{route('backend.admin.product.index')}}";
                }
            }
        });
    }    
</script>

<script>
    function addAttribute() {

        var imageInput = document.getElementById('product_images');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var formData = $('#create_product_form').serializeArray();
        var attributeName = $('#add_on select[name^="product_attributes"]');
        attributeName.each(function (index, element) {
            formData.push({
                name: element.name,
                value: $(element).val()
            });
        });
        var attributeValue = $('#add_on select[name^="filtering_attributes"]');
        attributeValue.each(function (index, element) {
            formData.push({
                name: element.name,
                value: $(element).val()
            });
        });
        $.ajax({
            url: "{{route('backend.product.add_attribute')}}",
            type: "POST",
            data: formData,
            success: function (response) {
                console.log(response);
                // if(response.message == 'empty'){ 
                var appendIn = document.getElementById('add_on');
                var rowId = Date.now();
                var add_to_html = '<div class="row gutters-5" id="">' +
                    '<div class="col-md-3">' +
                    '<div class="form-group">' +
                    '<select onchange="get_attributes_values(this, ' + rowId + ')"  class="asf selectpicker form-control"  data-live-search="true" title="Attribute Name"name="product_attributes[]">';
                response.attributes.forEach(function (item) {
                    add_to_html += '<option value="' + item.id + '">' + item.name + '</option>';
                });
                add_to_html += '</select>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col">' +
                    '<div class="form-group">' + 
                    '<select class="form-control selectpicker" name="filtering_attributes[]" id="' + rowId + '" data-toggle="select2" data-placeholder="Choose ..." data-live-search="true" multiple="">' +
                    '</select>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-auto">' +
                    '<button type="button" onclick="" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" style="background-color :#ef486a26; border-radius: 55px; color: #ef486a;">' +
                    '<i class="fa-solid fa-xmark"></i>' +
                    '</button>' +
                    '</div>' +
                    '</div>';
                appendIn.insertAdjacentHTML('beforeend', add_to_html);
                $('.selectpicker').selectpicker('refresh');
                // }
            }
        });
    }

    function get_attributes_values(e, selectId) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            data: {
                attribute_id: $(e).val()
            },
            url: '{{route('backend.product.get-attribte-value')}}',
            success: function (response) {
                var add_to_html = '';
                response.attributes_value.forEach(function (item) {
                    add_to_html += '<option value="' + item.id + '">' + item.name + '</option>';
                });
                var selectFields = document.getElementById(selectId);
                selectFields.innerHTML += add_to_html;
                $('.selectpicker').selectpicker('refresh');
            }
        });
    }
</script>
<script>
    $(document).ready(function () {
        $('.aiz-date-range').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true,
            showMeridian: true,
            forceParse: false,
            minuteStep: 1,
            startDate: new Date()
        });
    });
</script>
<script>
    function calculate() {
        var amount = parseFloat(document.getElementById('amount').value);
        var vatRate = parseFloat(document.getElementById('vatRate').value);
        var taxRate = parseFloat(document.getElementById('taxRate').value);
        if (isNaN(amount) || isNaN(vatRate) || isNaN(taxRate)) {
            alert('Please enter valid numeric values.');
            return;
        }
        var vatAmount = (amount * vatRate) / 100;
        var taxAmount = (amount * taxRate) / 100;
        var totalAmount = amount + vatAmount + taxAmount;
        var resultHTML = '<h4>Result:</h4>' +
            '<p>VAT Amount: ₹' + vatAmount.toFixed(2) + '</p>' +
            '<p>Tax Amount: ₹ ' + taxAmount.toFixed(2) + '</p>' +
            '<p>Total Amount (including VAT and Tax): ₹ ' + totalAmount.toFixed(2) + '</p>';
        document.getElementById('result').innerHTML = resultHTML;
    }
</script>
<script>
    $(document).ready(function () {
        $('.selectpicker').selectpicker();
    });
</script>
<script>
    function checkAllBox(main, sub) {
        var mainCheckboxs = document.getElementById(main);
        var subCheckboxes = document.querySelectorAll('.' + sub);
        for (var i = 0; i < subCheckboxes.length; i++) {
            subCheckboxes[i].checked = mainCheckboxs.checked;
        }
    }
    function removeAllCheckBox(main, sub) {
        var mainCheckboxs = document.getElementById(main);
        var subCheckboxes = document.querySelectorAll('.' + sub + ':checked');
        if (subCheckboxes.length > 0) {
            mainCheckboxs.checked = true;
        } else {
            mainCheckboxs.checked = false;
        }
    }
    function showOptions(event, option, show, hide) {
        event.preventDefault();
        const subCatList = document.getElementById(option);
        const showBtn = document.getElementById(show);
        const hideBtn = document.getElementById(hide)
        showBtn.style.display = "none";
        hideBtn.style.display = "inline"
        if (subCatList.style.display = "none")
            subCatList.style.display = "block";
    }
    function hideOptions(event, option, show, hide) {
        event.preventDefault();
        const subCatList = document.getElementById(option);
        const showBtn = document.getElementById(show);
        const hideBtn = document.getElementById(hide)
        showBtn.style.display = "inline";
        hideBtn.style.display = "none"
        if (subCatList.style.display = "block")
            subCatList.style.display = "none";
    } 
</script>


<script>
    function openPopup() {
        document.getElementById("popup_container").style.display = "block";
    }
    function closePopup(event) {
        event.preventDefault();
        document.getElementById("popup_container").style.display = "none";
    }
</script>

<script>
    $(document).on('change', '#product_option_select', function () {

        var selected_id = $(this).val();
        var unselected_ids = [];
        $("#product_option_select option:not(:selected)").each(function () {
            if ($(this).val() != '') {
                unselected_ids.push($(this).val());
            }
        });
        var html_to_append = ` <table class="product-option" id="option_table_${selected_id}">
                                        <thead>
                                            <tr>
                                                <th>Option Value</th>
                                                <th>Quantity</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                            
                                        </tbody>
                                    </table>  
                                        <i class="fa fa-plus-circle product-option-add-btn" data-toggle="modal" data-target="#product_modal" onclick="showOptionModal('option_table_${selected_id}')"></i>`;
        document.getElementById('option_list_row').insertAdjacentHTML('beforeend', html_to_append);
        var add_to_html = '';
        if (unselected_ids.length > 0) {
            $.ajax({
                url: "{{route('backend.product.get_option_list')}}",
                data: { 'ids': unselected_ids },
                type: "GET",
                success: function (response) {
                    add_to_html += '<option value="">--Select--</option>';
                    $("#product_option_select").empty();
                    response.data.forEach(function (item) {
                        add_to_html += '<option value="' + item.id + '">' + item.name + '</option>';
                    });
                    $("#product_option_select").append(add_to_html);
                }
            });
        }else {
            $("#product_option_select").empty();
        }
    });
</script>
<script>
    // Add an event listener to the select element
    document.getElementById('product_option_select').addEventListener('change', function ()
    {
        // Get the selected option element
        var selectedOption = this.options[this.selectedIndex];

        // Log the HTML of the selected option
        console.log(selectedOption.innerHTML);
    });
</script>

@endsection
@endsection