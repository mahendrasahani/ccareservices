@extends('layouts/backend/main')
@section('main-section')

<style>
    .edit-img {
        width: 150px; 
        height:150px;
         margin: 10px 10px;
    }

    .edit-img img {
        width: 100%; 
        height:100%; 
        object-fit:cover;
    }
</style>

<div class="content-body">
    <div class="top-set">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-3 mb-3">
                    <h3>Edit Product</h3>
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
                                                placeholder="Product Name" id="product_name"
                                                value="{{$product_detail->product_name ?? ''}}" required>
                                            <span id="productNameError" class="formFiedllerror"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Minimum Purchase Qty <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="number" class="form-control" name="min_qty" min="1"
                                                value="{{$product_detail->min_purchase_qty ?? '1'}}" id="min_qty"
                                                placeholder="Product Minimum Purchase Qty." required>
                                            <small class="text-muted">Customer need to purchase this minimum
                                                quantity for this product. Minimum should be 1.</small>
                                            <span id="minQtyError" class="formFiedllerror"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Maximum Purchase Qty</label>
                                        <div class="col-md-9">
                                            <input type="number" class="form-control" name="max_qty" min="1"
                                                value="{{$product_detail->max_purchase_qty ?? '1'}}" id="max_qty"
                                                placeholder="Product Maximum Purchase Qty." required>
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
                                        Images<small>(500x500)</small></label>
                                    <div class="col-md-9">
                                        <div class="input-group" data-toggle="" data-type="image" data-multiple="true"> 
                                                <input type="file" class="form-control" id="product_images" name="product_images[]" multiple
                                                    onchange="displaySelectedImages(event)"> 
                                        </div>

                                        <div class="file-preview box sm d-flex" id="imagePreviewContainer" style="flex-wrap: wrap;">
                                            @if($product_detail->product_images != '')
                                            @foreach($product_detail->product_images as $image)
                                            <div class="img-wrapper d-flex">
                                                <div class="edit-img">
                                                    <img src="{{url('public/'.$image)}}">
                                                </div>
                                                <div class="remove">
                                                    <button class="btn btn-sm btn-link remove-attachment" type="button">
                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            @endforeach
                                            @else
                                            <p>No product images</p>
                                            @endif
                                        </div>
                                        <small class="text-muted">These images are visible in the product details
                                            page gallery. Use 600x600 or higher sizes images for better quality. But
                                            try to keep file size low as it'll increase page load time.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card" style="border: 1px solid #e8e8e8;">
                            <div class="card-header" style="border-bottom: 1px solid #e8e8e8;">
                                <h5 class="h6">Product Price, Stock, Tax</h5>
                            </div>
                            <div class="card-body hidden">
                                <div class="no_product_variant">
                                    <!-- <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Regular price <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="number" step="1" min="1"
                                                value="{{$product_detail->regular_price}}" placeholder="Product Price"
                                                name="product_price" id="product_price" class="form-control" required>
                                        </div>
                                    </div> -->
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">SKU</label>
                                        <div class="col-md-9">
                                            <input type="text" placeholder="SKU" name="sku" class="form-control"
                                                value="{{$product_detail->sku ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">In Stock <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <select class="form-control" id="stock_status" name="stock_status" required>
                                                <option value="1" {{$product_detail->stock_status == 1 ? 'selected' :
                                                    ''}}>In Stock</option>
                                                <option value="0" {{$product_detail->stock_status == 0 ? 'selected' :
                                                    ''}}>Out of Stock</option>
                                            </select> 
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Tax<span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <select class="form-control" id="tax" name="tax" required>
                                                <option value="">Select</option>
                                               @foreach($tax_rates as $tax_rate)
                                               <option value="{{$tax_rate->id}}" {{$product_detail->tax_id == $tax_rate->id ? "selected":""}}>{{$tax_rate->tax_name}}({{$tax_rate->tax_rate}}%)</option>
                                               @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="card" style="border: 1px solid #e8e8e8;">
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
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-from-label">Discount <span
                                            class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input type="number" min="1" step="1" placeholder="Discount" name="discount"
                                            class="form-control" required value="{{$product_detail->discount ?? ''}}">
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <select class="form-control" id="discount_type" name="discount_type">
                                                <option value="flat" {{$product_detail->discount_type == 'flat' ?
                                                    'selected' : ''}}>Flat</option>
                                                <option value="percent" {{$product_detail->discount_type == 'percent' ?
                                                    'selected' : ''}}>Percent</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="card" style="border: 1px solid #e8e8e8;">
                            <div class="card-header" style="border-bottom: 1px solid #e8e8e8;">
                                <h5 class="h6">Product Description</h5>
                                <p>Description </p>
                            </div>
                            <div class="card-body">
                                <div id="container">
                                    <textarea id="editor"
                                        name="product_description">{{$product_detail->product_description ?? ''}}</textarea>
                                </div>
                                <span id="editorError" class="formFiedllerror"></span>
                            </div>
                        </div>
                        <!-- <div class="card" style="border: 1px solid #e8e8e8;">
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
                                <div id="add_on">


                                    @php
                                    $attribute_name_list = App\Models\Backend\Attribute::whereIn('id',
                                    $product_detail->attribute_name)->get();
                                    @endphp

                                    @foreach($attribute_name_list as $key => $attr_name)
                                    <div class="row gutters-5" id="">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select class="asf selectpicker form-control" data-live-search="true"
                                                    title="Main Category" name="product_attributes[]">
                                                    <option selected value="{{$attr_name->id}}">{{$attr_name->name}}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        @php
                                        $arr = explode(",", $product_detail->attribute_value[$key]);
                                        $attribute_val_list = App\Models\Backend\AttributeValue::whereIn('id',
                                        $arr)->get();
                                        @endphp
                                        <div class="col">
                                            <div class="form-group">
                                                <select class="form-control selectpicker" name="filtering_attributes[]"
                                                    id="'+rowId+'" data-toggle="select2" data-placeholder="Choose ..."
                                                    data-live-search="true" multiple="">
                                                    @foreach($attribute_val_list as $val_name)
                                                    <option selected value="{{$val_name->id}}">{{$val_name->name}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button type="button" onclick=""
                                                class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger"
                                                style="background-color :#ef486a26; border-radius: 55px; color: #ef486a;">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @endforeach 
                                </div>
                            </div>
                        </div> -->
                        <div class="card" style="border: 1px solid #e8e8e8;">
                            <div class="card-header" style="border-bottom: 1px solid #e8e8e8;">
                                <h5 class="mb-0 h6">SEO Meta Tags</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-md-3 col-from-label">Meta Title</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="meta_title"
                                            placeholder="Meta Title" value="{{$product_detail->meta_title ?? ''}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-from-label">Description</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="meta_description" id="meta_description"
                                            row="8">{{$product_detail->meta_description ?? ''}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Slug</label>
                                    <div class="col-md-9">
                                        <input type="text" placeholder="Slug" id="slug" name="slug" class="form-control"
                                            value="{{$product_detail->slug ?? ''}}">
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="card-body"> 
                                <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="invoice_number">Select Tax</label>
                                    <div class="col-md-9">
                                        <div class="row"> 
                                        @if(count($taxes) > 0)
                                        @foreach($taxes as $tax)
                                        <div class="col-md-3">
                                        <label  class="col-form-label" for="tax">{{$tax->tax_name}} {{$tax->tax_rate}}% </label>
                                         <input type="checkbox" name="tax[]" class="mx-1" value="{{$tax->id}}" 
                                        @if($product_detail->tax_name != '')
                                         @foreach(json_decode($product_detail->tax_name) as $old_tax_name)
                                            @if($old_tax_name == $tax->tax_name)
                                            checked
                                            @endif
                                         @endforeach
                                         @endif
                                         >
                                        </div> 
                                        @endforeach
                                        @endif

                                        </div>
                                    </div>
                                </div>
                                
                                    
                            </div> --}}


                        </div>



                        <!-- <div class="card" style="border: 1px solid #e8e8e8;">
                            <div class="card-header d-flex justify-content-between"
                                style="border-bottom : 1px solid #e8e8e8;">
                                <h5 class="mb-0 pt-2">Product Option</h5>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-info">Add Option</div> 
                        
                                <div class="row">
                                    <label class="col-md-3 col-form-label" for="product_option">Select an option:</label>
                                    <div class="col-md-9">
                                       {{-- <select class="form-control" name="product_option_name"
                                            id="product_option_name">
                                            <option value="">--Select--</option>
                                            @if(count($attribute_list) > 0)
                                            @foreach($attribute_list as $attribute)
                                            <option value="{{$attribute->id}}" data-name="{{$attribute->name}}" {{$attribute->id == $product_detail->getStock->option_name ?'selected':''}}>{{$attribute->name}}</option>
                                            @endforeach
                                            @endif
                                        </select> --}}
                                    </div> 
                                </div>
                                <div class="row" id="option_list_row">
                                <div id="append_table_div_${selected_id}" class="w-100">
                                 <input type="hidden" name="product_option_id" id="product_option_id" value="${selected_id}">
                                 <i class="fa fa-minus-circle product-option-add-btn" aria-hidden="true" onclick="removeMainOption('append_table_div_${selected_id}')"></i>
                                 <div class="append_table">
                                 {{-- <p class="table_tag"><b>{{$option_name}}</b></p>   --}}
                                  </div> 
                                 <table class="product-option" id="option_table_${selected_id}">
                                    <thead>
                                        <tr>
                                            <th>Option Value</th>
                                            <th>Quantity</th>
                                            <th>Action</th> 
                                        </tr>
                                      
                                       {{-- @foreach($product_detail->getStock->option_value as $index => $stock)
                                        <tr id="option_value_list_${randomSixDigitNumber}">
                                        <td>
                                        @php
                                            $option_value = App\Models\Backend\AttributeValue::where('id', $stock)->first();
                                        @endphp
                                        {{$option_value->name}}
                                        <input type="hidden" name="option_value[]" value="{{$option_value->id}}"> 
                                        </td>
                                        <td>{{$product_detail->getStock->quantity[$index]}}
                                        <input type="hidden" name="option_qty[]" value="{{$product_detail->getStock->quantity[$index]}}"> 
                                        </td>  
                                        <td style="text-align:end">
                                        <i class="fa fa-minus-circle" aria-hidden="true" onclick="removeOptionValue('option_value_list_${randomSixDigitNumber}')"></i>
                                        <i class="fa fa-pencil-square mx-2" data-toggle="modal" data-target="#edit_product_modal" onclick="editOptionValue(${dataId}, ${product_qty}, '${prices}', 'option_value_list_${randomSixDigitNumber}')"></i>
                                        </td> 
                                        @php  
                                        $price_string = implode(',', $product_detail->getStock->price[$index]); 
                                        @endphp
                                        <input type="hidden" value="{{$price_string}}" id="price_list" name="price_list[]">
                                        </tr>
                                        @endforeach
                                      --}}
                                    </thead>
                                    <tbody> 
                                    </tbody>
                                </table>  
                             <i class="fa fa-plus-circle product-option-add-btn" data-toggle="modal" data-target="#product_modal" onclick="showOptionModal('option_table_${selected_id}', ${selected_id})"></i>
                             </div>

                                </div>
                            </div>
                        </div> -->
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mar-all mb-3">
                                        <button class="btn btn-primary">Update Product</button>
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
                                    <option value="1" {{$product_detail->product_status == 1 ? 'selected' :
                                        ''}}>Published</option>
                                    <option value="0" {{$product_detail->product_status == 0 ? 'selected' : ''}}>Draft
                                    </option>
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
                                    <option value="{{$brand->id}}" {{$product_detail->brand == $brand->id ? 'selected' :
                                        ''}}>{{$brand->name}}</option>
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
                                        <span class="main-category-info bg-info p-2 position-absolute d-none border">These
                                            will be used for Affiliate System.</span>
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
                                                            value="{{$main_cat->id}}" {{in_array($main_cat->id,
                                                        $product_detail->main_category) ? 'checked':''}}>
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
                                                                onchange="removeAllCheckBox('main_cat_{{$key}}', 'sub_checkbox_{{$key}}')"
                                                                {{in_array($sub_cat->id, $product_detail->sub_category)
                                                            ? 'checked':''}}>
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
                          
                    </div>
                </div>
            </div>

        </section>
    </div>
</div>

@section('javascript-section')
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

    function validateAndSubmit(event){
        event.preventDefault();
        var errorFields = document.getElementsByClassName('formFiedllerror');
        for (var i = 0; i < errorFields.length; i++){
            errorFields[i].innerText = '';
        }

        var formData = new FormData($('#create_product_form')[0]);
        var CatCheckboxes = document.querySelectorAll('.main_checkbox:checked');
        if (CatCheckboxes.length < 1){
            var EmptyCatCheckboxes = document.querySelectorAll('.main_checkbox');
            document.getElementById('categoryError').innerText = 'Select category.';
            EmptyCatCheckboxes[0].focus();
            return;
        }

        const editorValue = myEditor.getData();
        if (editorValue == ''){
            document.getElementById('editorError').innerText = 'Enter product description';
            myEditor.focus();
            return;
        } else{
            formData.append('product_description', editorValue);
        }

        // Append additional data to formData
        var attributeName = $('#add_on select[name^="product_attributes"]');
        attributeName.each(function (index, element){
            formData.append(element.name, $(element).val());
        });

        var attributeValue = $('#add_on select[name^="filtering_attributes"]');
        attributeValue.each(function (index, element){
            formData.append(element.name, $(element).val());
        });

        // Append productImagesValue to formData
        var productImagesInput = document.getElementById('product_images');
        var productImagesValue = productImagesInput.files;
        for (var i = 0; i < productImagesValue.length; i++){
            formData.append('product_images[]', productImagesValue[i].name);
        }

       


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('backend.product.update', [$product_detail->id])}}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response){
                console.log(response);
                if (response.status == 200 && response.message == "success"){
                    window.location.href = "{{route('backend.admin.product.index')}}";
                }
            },
            error: function (xhr, status, error) {
        console.log("Error:", error);
        console.log("Status:", status);
        console.log("Response:", xhr.responseText);
    }


        }); 
    }    
</script>

<script>
    function addAttribute()
    {

        var imageInput = document.getElementById('product_images');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var formData = $('#create_product_form').serializeArray();
        var attributeName = $('#add_on select[name^="product_attributes"]');
        attributeName.each(function (index, element)
        {
            formData.push({
                name: element.name,
                value: $(element).val()
            });
        });
        var attributeValue = $('#add_on select[name^="filtering_attributes"]');
        attributeValue.each(function (index, element)
        {
            formData.push({
                name: element.name,
                value: $(element).val()
            });
        });
        $.ajax({
            url: "{{route('backend.product.add_attribute')}}",
            type: "POST",
            data: formData,
            success: function (response)
            {
                console.log(response);
                // if(response.message == 'empty'){ 
                var appendIn = document.getElementById('add_on');
                var rowId = Date.now();
                var add_to_html = '<div class="row gutters-5" id="">' +
                    '<div class="col-md-3">' +
                    '<div class="form-group">' +
                    '<select onchange="get_attributes_values(this, ' + rowId + ')"  class="asf selectpicker form-control"  data-live-search="true" title="Main Category"name="product_attributes[]">';
                response.attributes.forEach(function (item)
                {
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
                    '<button type="button" onclick="removePageLink(\'' + rowId + '\')" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" style="background-color :#ef486a26; border-radius: 55px; color: #ef486a;">' +
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

    function get_attributes_values(e, selectId)
    {
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
            success: function (response)
            {
                var add_to_html = '';
                response.attributes_value.forEach(function (item)
                {
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
    $(document).ready(function ()
    {
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
    function calculate()
    {
        var amount = parseFloat(document.getElementById('amount').value);
        var vatRate = parseFloat(document.getElementById('vatRate').value);
        var taxRate = parseFloat(document.getElementById('taxRate').value);
        if (isNaN(amount) || isNaN(vatRate) || isNaN(taxRate))
        {
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
    $(document).ready(function ()
    {
        $('.selectpicker').selectpicker();
    });
</script>
<script>
    function checkAllBox(main, sub)
    {
        var mainCheckboxs = document.getElementById(main);
        var subCheckboxes = document.querySelectorAll('.' + sub);
        for (var i = 0; i < subCheckboxes.length; i++)
        {
            subCheckboxes[i].checked = mainCheckboxs.checked;
        }
    }
    function removeAllCheckBox(main, sub)
    {
        var mainCheckboxs = document.getElementById(main);
        var subCheckboxes = document.querySelectorAll('.' + sub + ':checked');
        if (subCheckboxes.length > 0)
        {
            mainCheckboxs.checked = true;
        } else
        {
            mainCheckboxs.checked = false;
        }
    }
    function showOptions(event, option, show, hide)
    {
        event.preventDefault();
        const subCatList = document.getElementById(option);
        const showBtn = document.getElementById(show);
        const hideBtn = document.getElementById(hide)
        showBtn.style.display = "none";
        hideBtn.style.display = "inline"
        if (subCatList.style.display = "none")
            subCatList.style.display = "block";
    }
    function hideOptions(event, option, show, hide)
    {
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
    function displaySelectedImages(event)
    {
        const input = event.target;
        const previewContainer = document.getElementById('imagePreviewContainer');

        // Loop through each selected file
        for (let i = 0; i < input.files.length; i++)
        {
            const file = input.files[i];
            const reader = new FileReader();

            // Read the file as a data URL
            reader.readAsDataURL(file);

            // When the file is loaded, create a preview element and append it to the preview container
            reader.onload = function ()
            {
                const imgWrapper = document.createElement('div');
                imgWrapper.classList.add('img-wrapper', 'd-flex');

                const editImgDiv = document.createElement('div');
                editImgDiv.classList.add('edit-img');

                const img = document.createElement('img');
                img.src = reader.result;

                editImgDiv.appendChild(img); // Append image to the 'edit-img' div

                const removeDiv = document.createElement('div');
                removeDiv.classList.add('remove');

                const removeBtn = document.createElement('button');
                removeBtn.classList.add('btn', 'btn-sm', 'btn-link', 'remove-attachment');
                removeBtn.setAttribute('type', 'button');
                removeBtn.innerHTML = '<i class="fa fa-times" aria-hidden="true"></i>';

                removeBtn.addEventListener('click', function ()
                {
                    imgWrapper.remove(); // Remove the image wrapper when the remove button is clicked
                });

                removeDiv.appendChild(removeBtn); // Append remove button to the 'remove' div

                imgWrapper.appendChild(editImgDiv); // Append 'edit-img' div to the 'img-wrapper' div
                imgWrapper.appendChild(removeDiv); // Append 'remove' div to the 'img-wrapper' div

                previewContainer.appendChild(imgWrapper); // Append 'img-wrapper' div to the preview container
            }
        }
    }
</script>

 <script>
    
    function productEditSOptionModal(table_id, option_id){ 

        var modal = document.getElementById('edit_product_modal');  
            var inputs = modal.querySelectorAll('input[type="number"]');  
            inputs.forEach(function(input){
            input.value = '';
            }); 

        var option_modal = document.getElementById('modal_option_value');
        var option_list ='';
            $.ajax({
                url: "{{route('backend.product.get_option_value_list')}}",
                data: {'id':option_id},
                type: "GET",
                success:function(response){
                     response.data.forEach(function(item){
                        option_list += `<option value="${item.name}" data-id="${item.id}">${item.name}</option>`
                     });
                     option_modal.innerHTML = option_list;
                }
            });

        $('#table_id').val(table_id);
        modal.style.display = "block";
    }
</script>



@endsection
@endsection