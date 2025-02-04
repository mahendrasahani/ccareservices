@extends('layouts/backend/main')
@section('main-section')

<style>

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
                                    <!-- <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Minimum Purchase Qty <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="number" class="form-control" name="min_qty" min="1" value="1"
                                                id="min_qty" placeholder="Product Minimum Purchase Qty." required>
                                            <small class="text-muted">Customer need to purchase this minimum
                                                quantity for this product. Minimum should be 1.</small>
                                            <span id="minQtyError" class="formFiedllerror"></span>
                                        </div>
                                    </div> -->
                                    <!-- <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Maximum Purchase Qty</label>
                                        <div class="col-md-9">
                                            <input type="number" class="form-control" name="max_qty" min="1" value="1"
                                                id="max_qty" placeholder="Product Maximum Purchase Qty." required>
                                            <small class="text-muted">Customer will be able to purchase this
                                                maximum quantity for this product. Default empty for
                                                unlimited.</small>
                                        </div>
                                    </div> -->
                                </div>

                        </div>
                        <div class="card" style="border: 1px solid #e8e8e8;">
                            <div class="card-header" style="border-bottom: 1px solid #e8e8e8;">
                                <h4 class="mb-0 h6">Product Images <span style="color:orange;">(The image dimensions must be exactly 500X500 pixels)</span></h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="signinSrEmail">Product
                                        Images<small>(500x500)</small></label>
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
                                <h5 class="h6">Product Price, Stock, Tax
                                </h5>
                            </div>

                            <div class="card-body hidden">
                                <div class="no_product_variant">
                                    <!-- <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Regular price <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="number" step="1" min="1" placeholder="Product Price"
                                                name="product_price" id="product_price" class="form-control">
                                        </div>
                                    </div> -->
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

                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Tax<span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <select class="form-control" id="tax" name="tax" required>
                                                <option value="">Select</option>
                                               @foreach($tax_rates as $tax_rate)
                                               <option value="{{$tax_rate->id}}">{{$tax_rate->tax_name}}({{$tax_rate->tax_rate}}%)</option>
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
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-from-label">Discount <span
                                            class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input type="number" lang="en" min="1" step="1" placeholder="Discount"
                                            name="discount" class="form-control">
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
                        </div> -->
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
                                <div id="add_on"></div>
                                <p class="input_error" id="attribute_error"></p>
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

            <!------------- this is  add option cod which has been removed now (start) ------->

                    {{--    <div class="card" style="border: 1px solid #e8e8e8;">
                            <div class="card-header d-flex justify-content-between"
                                style="border-bottom : 1px solid #e8e8e8;">
                                <h5 class="mb-0 pt-2">Product Option</h5>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-info">Add Option</div> 
                        
                                <div class="row">
                                    <label class="col-md-3 col-form-label" for="product_option">Select an option:</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="product_option_name"
                                            id="product_option_name">
                                            <option value="">--Select--</option>
                                            @if(count($attribute_list) > 0)
                                            @foreach($attribute_list as $attribute)
                                            <option value="{{$attribute->id}}" data-name="{{$attribute->name}}">{{$attribute->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div> 
                                </div>
                                <div class="row" id="option_list_row"></div>
                            </div>
                        </div> --}}
            <!------------- this is  add option cod which has been removed now (end) --------->

            <!------------------------------------ Modal start -------------------------------->
                        <!-- this is option modal which has been removed now (start) -->
                        <!-- <div class="modal fade" id="product_modal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Product Options</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body crete_option_modal">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="product-details">
                                                    <input type="hidden" name="table_id" id="table_id">
                                                    <label for="option_value" class="popup_label">Option Value</label>
                                                    <select class="form-control" name="modal_option_value" id="modal_option_value">
                                                     
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="product-details">
                                                    <label for="option_value" class="popup_label">Quantity</label><br>
                                                    <input type="number" min="1" style="width:100%" class="form-control" id="product_qty">
                                                    <p class="input_error" id="qty_error"></p>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="product-details">
                                                    <div class="price ">
                                                        <label for="price" class="popup_label">Month</label>
                                                        <label for="price" class="popup_label">Price</label>
                                                    </div>
                                                    <div class="">
                                                        <div class="month">
                                                            <div class="price">
                                                            <input type="text" class="form-control" style="width:100%" name="month[]" disabled value="1" id="month_1"> 
                                                            <input type="number" min="0" style="width:100%" class="form-control" id="modal_price_1" name="price_1">
                                                            </div>
                                                            <p class="input_error" id="price_1_error" ></p>

                                                            <div class="price">
                                                            <input type="text" class="form-control" style="width:100%" name="month[]" disabled value="2" id="month_2"> 
                                                            <input type="number" min="0" style="width:100%" class="form-control" id="modal_price_2" name="price_2">
                                                            </div>
                                                            <p class="input_error" id="price_2_error"></p>

                                                            
                                                            <div class="price">
                                                            <input type="text" class="form-control" style="width:100%" name="month[]" disabled value="3" id="month_3"> 
                                                            <input type="number" min="0" style="width:100%" class="form-control" id="modal_price_3" name="price_3">                                                            </div>
                                                            <p class="input_error" id="price_3_error"></p>

                                                            
                                                            <div class="price">
                                                            <input type="text" class="form-control" style="width:100%" name="month[]" disabled value="4" id="month_4"> 
                                                            <input type="number" min="0" style="width:100%" class="form-control" id="modal_price_4" name="price_4"> 
                                                             </div>
                                                            <p class="input_error" id="price_4_error"></p>

                                                            <div class="price">
                                                            <input type="text" class="form-control" style="width:100%" name="month[]" disabled value="5" id="month_5"> 
                                                            <input type="number" min="0" style="width:100%" class="form-control" id="modal_price_5" name="price_5"> 
                                                             </div>
                                                            <p class="input_error" id="price_5_error"></p>

                                                            <div class="price">
                                                            <input type="text" class="form-control" style="width:100%" name="month[]" disabled value="6" id="month_6">  
                                                            <input type="number" min="0" style="width:100%" class="form-control" id="modal_price_6" name="price_6"> 
                                                             </div>
                                                            <p class="input_error" id="price_6_error"></p>
 
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

                                                    <div class="">
                                                    <div class="month">
                                                                <div class="price">
                                                                <input type="text" class="form-control" style="width:100%" name="month[]" disabled value="7" id="month_7"> 
                                                                <input type="number" min="0" style="width:100%" class="form-control" id="modal_price_7" name="price_7">
                                                                </div>
                                                                <p class="input_error" id="price_7_error"></p>

                                                                <div class="price">
                                                                <input type="text" class="form-control" style="width:100%" name="month[]" disabled value="8" id="month_8"> 
                                                                <input type="number" min="0" style="width:100%" class="form-control" id="modal_price_8" name="price_8">
                                                                </div>
                                                                <p class="input_error" id="price_8_error"></p>

                                                                <div class="price">
                                                                <input type="text" class="form-control" style="width:100%" name="month[]" disabled value="9" id="month_9"> 
                                                                <input type="number" min="0" style="width:100%" class="form-control" id="modal_price_9" name="price_9">
                                                                </div>
                                                                <p class="input_error" id="price_9_error"></p>

                                                                <div class="price">
                                                                <input type="text" class="form-control" style="width:100%" name="month[]" disabled value="10" id="month_10"> 
                                                                <input type="number" min="0" style="width:100%" class="form-control" id="modal_price_10" name="price_10">
                                                                </div>
                                                                <p class="input_error" id="price_10_error"></p>

                                                                <div class="price">
                                                                <input type="text" class="form-control" style="width:100%" name="month[]" disabled value="11" id="month_11"> 
                                                                <input type="number" min="0" style="width:100%" class="form-control" id="modal_price_11" name="price_11"> 
                                                                </div>
                                                                <p class="input_error" id="price_11_error"></p>

                                                                <div class="price">
                                                                <input type="text" class="form-control" style="width:100%" name="month[]" disabled value="12" id="month_12">  
                                                                <input type="number" min="0" style="width:100%" class="form-control" id="modal_price_12" name="price_12"> 
                                                                </div>
                                                                <p class="input_error" id="price_12_error"></p> 
                                                                
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
                        </div> -->
                        <!-- this is option modal which has been removed now (end) -->

            <!------------------------------------ Modal End ---------------------------------->

          


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
                        <!-- <div class="card" style="border: 1px solid #e8e8e8;">
                            <div class="card-header" style="border-bottom: 1px solid #e8e8e8;">
                                <h4>VAT & Tax</h4>
                            </div>
                            <div class="card-body">
                                 
                                    <div class="form-group">
                                        <label for="amount">Amount:</label>
                                        <input type="number" class="form-control" id="amount" placeholder="Enter amount"
                                            required>
                                    </div> 
                                    @foreach($tax_rates as $tax)
                                    <div class="form-group">
                                        <label for="taxRate">{{$tax->tax_name}} ({{$tax->tax_rate}}%):</label>
                                        <input type="number" class="form-control tax_rate" id="{{$tax->tax_name}}"
                                            placeholder="{{$tax->tax_name}}" required disabled value="">
                                            <input type="hidden" class="tax_value" value="{{ $tax->tax_rate }}">
                                    </div> 
                                    @endforeach
                                    <button type="button" class="btn btn-primary" onclick="calculate()">Calculate</button>
 
                                    <!-- <div class="form-group">
                                        <label for="vatRate">VAT Rate (%):</label>
                                        <input type="number" class="form-control" id="vatRate"
                                            placeholder="Enter VAT rate" required>
                                    </div>  -->
                                  
                                    <!-- <div class="form-group">
                                        <label for="taxRate">Tax Rate (%):</label>
                                        <input type="number" class="form-control" id="taxRate"
                                            placeholder="Enter Tax rate" required>
                                    </div>  -->
                                   
                             
                            </div>
                            <div id="result" class="mt-4 mx-4"></div>
                        </div> 
                    </div>
                </div>
            </div>

        </section>
    </div>
</div>
 <!------------------------------------Edit Modal start -------------------------------->
 <div class="modal fade" id="edit_product_modal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Product Options</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                   <input type="hidden" id="edit_row_id">
                                    <div class="modal-body edit_option_modal">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="product-details"> 
                                                    <label for="option_value" class="popup_label">Option Value</label>
                                                    <select class="form-control" name="edit_modal_option_value" id="edit_modal_option_value">
                                                     
                                                    </select>
                                                </div>
                                            </div>
                                         
                                            <div class="col-md-6">
                                                <div class="product-details">
                                                    <label for="option_value" class="popup_label">Quantity</label><br>
                                                    <input type="number" min="1" style="width:100%" class="form-control" id="edit_product_qty">
                                                    <p class="input_error" id="edit_qty_error"></p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="product-details">  
                                                    <div class="price ">
                                                        <label for="price" class="popup_label">Month</label>
                                                        <label for="price" class="popup_label">Price</label>
                                                    </div>
                                                    <div class=" ">
                                                        <div class="month">

                                                    <div class="price">
                                                    <input type="text" class="form-control" style="width:100%" name="month[]" disabled value="1" id="month_1"> 
                                                    <input type="number" min="0" style="width:100%" class="form-control" id="edit_price_1" name="edit_price[]">
                                                    </div>
                                                    <p class="input_error" id="edit_price_1_error"></p>
                                                    <div class="price">
                                                    <input type="text" class="form-control" style="width:100%" name="month[]" disabled value="2" id="month_2"> 
                                                    <input type="number" min="0" style="width:100%" class="form-control" id="edit_price_2" name="edit_price[]">
                                                    </div>
                                                    <p class="input_error" id="edit_price_2_error"></p>

                                                    <div class="price">
                                                    <input type="text" class="form-control" style="width:100%" name="month[]" disabled value="3" id="month_3"> 
                                                    <input type="number" min="0" style="width:100%" class="form-control" id="edit_price_3" name="edit_price[]">
                                                    </div>
                                                    <p class="input_error" id="edit_price_3_error"></p>

                                                    <div class="price">
                                                    <input type="text" class="form-control" style="width:100%" name="month[]" disabled value="4" id="month_4"> 
                                                    <input type="number" min="0" style="width:100%" class="form-control" id="edit_price_4" name="edit_price[]">
                                                    </div>
                                                    <p class="input_error" id="edit_price_4_error"></p>

                                                    <div class="price">
                                                    <input type="text" class="form-control" style="width:100%" name="month[]" disabled value="5" id="month_5"> 
                                                    <input type="number" min="0" style="width:100%" class="form-control" id="edit_price_5" name="edit_price[]"> 
                                                    </div>
                                                    <p class="input_error" id="edit_price_5_error"></p>

                                                    <div class="price">
                                                    <input type="text" class="form-control" style="width:100%" name="month[]" disabled value="6" id="month_6">  
                                                    <input type="number" min="0" style="width:100%" class="form-control" id="edit_price_6" name="edit_price[]"> 
                                                    </div>
                                                    <p class="input_error" id="edit_price_6_error"></p> 
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
                                                    <div class="">
                                                    <div class="month">

                                                    <div class="price">
                                                    <input type="text" class="form-control" style="width:100%" name="month[]" disabled value="7" id="month_7"> 
                                                    <input type="number" min="0" style="width:100%" class="form-control" id="edit_price_7" name="edit_price[]">
                                                    </div>
                                                    <p class="input_error" id="edit_price_7_error"></p>

                                                    <div class="price">
                                                    <input type="text" class="form-control" style="width:100%" name="month[]" disabled value="8" id="month_8"> 
                                                    <input type="number" min="0" style="width:100%" class="form-control" id="edit_price_8" name="edit_price[]">
                                                    </div>
                                                    <p class="input_error" id="edit_price_8_error"></p>

                                                    <div class="price">
                                                    <input type="text" class="form-control" style="width:100%" name="month[]" disabled value="9" id="month_9"> 
                                                    <input type="number" min="0" style="width:100%" class="form-control" id="edit_price_9" name="edit_price[]">
                                                    </div>
                                                    <p class="input_error" id="edit_price_9_error"></p>

                                                    <div class="price">
                                                    <input type="text" class="form-control" style="width:100%" name="month[]" disabled value="10" id="month_10"> 
                                                    <input type="number" min="0" style="width:100%" class="form-control" id="edit_price_10" name="edit_price[]">
                                                    </div>
                                                    <p class="input_error" id="edit_price_10_error"></p>

                                                    <div class="price">
                                                    <input type="text" class="form-control" style="width:100%" name="month[]" disabled value="11" id="month_11"> 
                                                    <input type="number" min="0" style="width:100%" class="form-control" id="edit_price_11" name="edit_price[]"> 
                                                    </div>
                                                    <p class="input_error" id="edit_price_11_error"></p>

                                                    <div class="price">
                                                    <input type="text" class="form-control" style="width:100%" name="month[]" disabled value="12" id="month_12">  
                                                    <input type="number" min="0" style="width:100%" class="form-control" id="edit_price_12" name="edit_price[]"> 
                                                    </div>
                                                    <p class="input_error" id="edit_price_12_error"></p> 
                                                        </div>
                                                         
                                                        
                                                    </div>

                                                </div>
                                            </div>
                                             
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" onclick="validateEditOptionModal()">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!------------------------------Edit Modal End --------------------->
@section('javascript-section')
<script>
    var optionValueListRoute = "{{ route('backend.product.get_option_value_list') }}";
</script> 
 
<!-- this code is for option modal system which have removed now (start) -->
        <!-- <script> 
            function showOptionModal(table_id, option_id){  
                var modal = document.getElementById('product_modal');  
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
        </script> -->
        <!-- <script>
            function validateOptionModal(){ 
                var crete_option_modal = document.querySelector('.crete_option_modal'); 
                var all_errors = crete_option_modal.querySelectorAll('p.input_error');
                all_errors.forEach(function(error_p){
                    error_p.innerHTML = "";
                });

                var product_qty = document.getElementById('product_qty').value;
                if(product_qty <= 0 || product_qty == ''){
                    document.getElementById('qty_error').innerHTML = "Quantity is required.";
                    document.getElementById('product_qty').focus();
                    return false;
                } 
            
        
                for(var i = 1; i <= 12; i++){
                    var price = document.getElementById('modal_price_'+i).value;
                if(price <= 0 || price == ''){
                    document.getElementById('price_'+i+'_error').innerHTML = "Price is required.";
                    document.getElementById('modal_price_'+i).focus();
                    return false;
                }
            }


                var tableId = document.getElementById('table_id').value;
                var optionVal = document.getElementById('modal_option_value');
                var selectedOption = optionVal.options[optionVal.selectedIndex];
                var dataId = selectedOption.getAttribute('data-id'); 
                var product_qty = document.getElementById('product_qty').value; 
                var price_1 = document.getElementById('modal_price_1').value; 
                var price_2 = document.getElementById('modal_price_2').value; 
                var price_3 = document.getElementById('modal_price_3').value; 
                var price_4 = document.getElementById('modal_price_4').value; 
                var price_5 = document.getElementById('modal_price_5').value; 
                var price_6 = document.getElementById('modal_price_6').value; 
                var price_7 = document.getElementById('modal_price_7').value; 
                var price_8 = document.getElementById('modal_price_8').value; 
                var price_9 = document.getElementById('modal_price_9').value; 
                var price_10 = document.getElementById('modal_price_10').value; 
                var price_11 = document.getElementById('modal_price_11').value; 
                var price_12 = document.getElementById('modal_price_12').value;   

                
                var min = 100000; 
                var max = 999999; 
                var randomSixDigitNumber = Math.floor(Math.random() * (max - min + 1)) + min;

                var prices = [];
                    $('input[name="price[]"]').each(function() {
                        prices.push($(this).val());
                    });
                var html_to_append = `<tr id="option_value_list_${randomSixDigitNumber}">
                                    <td>${optionVal.value}
                                    <input type="hidden" name="option_value[]" value="${dataId}"> 
                                    </td>
                                    <td>${product_qty}
                                    <input type="hidden" name="option_qty[]" value="${product_qty}"> 
                                    </td>  
                                    <td style="text-align:end">
                                    <i class="fa fa-minus-circle" aria-hidden="true" onclick="removeOptionValue('option_value_list_${randomSixDigitNumber}')"></i>
                                    <i class="fa fa-pencil-square mx-2" data-toggle="modal" data-target="#edit_product_modal" onclick="editOptionValue(${dataId}, ${product_qty}, '${prices}', 'option_value_list_${randomSixDigitNumber}')"></i>
                                    </td> 
                                    
                                    <input type="hidden" value="${price_1}" id="price_1" name="price_1[]">
                                    <input type="hidden" value="${price_2}" id="price_2" name="price_2[]">
                                    <input type="hidden" value="${price_3}" id="price_3" name="price_3[]">
                                    <input type="hidden" value="${price_4}" id="price_4" name="price_4[]">
                                    <input type="hidden" value="${price_5}" id="price_5" name="price_5[]">
                                    <input type="hidden" value="${price_6}" id="price_6" name="price_6[]">
                                    <input type="hidden" value="${price_7}" id="price_7" name="price_7[]">
                                    <input type="hidden" value="${price_8}" id="price_8" name="price_8[]">
                                    <input type="hidden" value="${price_9}" id="price_9" name="price_9[]">
                                    <input type="hidden" value="${price_10}" id="price_10" name="price_10[]">
                                    <input type="hidden" value="${price_11}" id="price_11" name="price_11[]">
                                    <input type="hidden" value="${price_12}" id="price_12" name="price_12[]"> 

                                    </tr>`;
                    document.getElementById(tableId).insertAdjacentHTML('beforeend', html_to_append);
                    var modal = document.getElementById('product_modal');  
                    var inputs = modal.querySelectorAll('input[type="number"]');  
                    inputs.forEach(function(input){
                    input.value = '';
                    }); 

                    $('#product_modal').modal('hide');
            }
        </script> -->
<!-- this code is for option modal system which have removed now (end) -->

<script>
    //  product description editor (start)
        let myEditor; 
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                myEditor = editor;

            }).catch(error => {
                console.error(error);
            });
    //  product description editor (start)

    function validateAndSubmit(event) {
        event.preventDefault();
        var errorFields = document.getElementsByClassName('formFiedllerror');
        for (var i = 0; i < errorFields.length; i++) {
            errorFields[i].innerText = '';
        }
        var formData = new FormData($('#create_product_form')[0]);  

        // commented for testing purpose (start)
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
        }else {
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
        // commented for testing purpose (end)

        //option value option removed 
        // var option_value = $('input[name="option_value[]"]'); 
        // for (var i = 0; i < option_value.length; i++) { 
        //     formData.append('option_value[]', option_value[i].value);
        // } 

        // var option_qty = $('input[name="option_qty[]"]'); 
        // for (var i = 0; i < option_qty.length; i++) { 
        //     formData.append('option_qty[]', option_qty[i].value);
        // } 

        // var price_1 = $('input[name="price_1[]"]'); 
        // for (var i = 0; i < price_1.length; i++) { 
        //     formData.append('price_1[]', price_1[i].value);
        // } 

        // var price_2 = $('input[name="price_2[]"]'); 
        // for (var i = 0; i < price_2.length; i++) { 
        //     formData.append('price_2[]', price_2[i].value);
        // } 

        // var price_3 = $('input[name="price_3[]"]'); 
        // for (var i = 0; i < price_3.length; i++) { 
        //     formData.append('price_3[]', price_3[i].value);
        // } 

        // var price_4 = $('input[name="price_4[]"]'); 
        // for (var i = 0; i < price_4.length; i++) { 
        //     formData.append('price_4[]', price_4[i].value);
        // } 

        // var price_5 = $('input[name="price_5[]"]'); 
        // for (var i = 0; i < price_5.length; i++) { 
        //     formData.append('price_5[]', price_5[i].value);
        // } 
        // var price_6 = $('input[name="price_6[]"]'); 
        // for (var i = 0; i < price_6.length; i++) { 
        //     formData.append('price_6[]', price_6[i].value);
        // } 
        // var price_7 = $('input[name="price_7[]"]'); 
        // for (var i = 0; i < price_7.length; i++) { 
        //     formData.append('price_7[]', price_7[i].value);
        // } 
        // var price_8 = $('input[name="price_8[]"]'); 
        // for (var i = 0; i < price_8.length; i++) { 
        //     formData.append('price_8[]', price_8[i].value);
        // } 
        // var price_9 = $('input[name="price_9[]"]'); 
        // for (var i = 0; i < price_9.length; i++) { 
        //     formData.append('price_9[]', price_9[i].value);
        // } 
        // var price_10 = $('input[name="price_10[]"]'); 
        // for (var i = 0; i < price_10.length; i++) { 
        //     formData.append('price_10[]', price_10[i].value);
        // } 
        // var price_11 = $('input[name="price_11[]"]'); 
        // for (var i = 0; i < price_11.length; i++) { 
        //     formData.append('price_11[]', price_11[i].value);
        // } 
        // var price_12 = $('input[name="price_12[]"]'); 
        // for (var i = 0; i < price_12.length; i++) { 
        //     formData.append('price_12[]', price_12[i].value);
        // } 


        // commented for new changes
        // var price_list = $('input[name="price_list"]'); 
        // for (var i = 0; i < price_list.length; i++) { 
        //     formData.append('price_list[]', price_list[i].value);
        // }  

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
                console.log(response);
            }
        });
    }    
</script>

<script>
 function removeAttr(selected_row){ 
     var removeble_row = document.getElementById(selected_row);
     removeble_row.remove();
 }
    
    function addAttribute() { 
        var parentElement = document.getElementById('add_on');  
        var numberOfChildNodes = parentElement.childNodes.length;
        var lastChild = parentElement.lastElementChild;  

        if(numberOfChildNodes > 0){
        document.getElementById('attribute_error').innerHTML = ""; 
            var lastChild = parentElement.lastElementChild;  
            var selectElement = lastChild.querySelector('select[name="filtering_attributes[]"]');
            var selectedOptions = selectElement.selectedOptions;
                if (selectedOptions.length === 0) {
                    document.getElementById('attribute_error').innerHTML = "Please select attribute value";
                    // console.log("Error: No options selected in filtering attributes.");
                    return false;
                } 
        } 
 
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

        var min = 100000;
        var max = 999999;
        var randomSixDigitNumber = Math.floor(Math.random() * (max - min + 1)) + min; 
        var attribute_row_id = 'attribute_row_'+randomSixDigitNumber;
        $.ajax({
            url: "{{route('backend.product.add_attribute')}}",
            type: "POST",
            data: formData,
            success: function (response) {  
                // if(response.message == 'empty'){ 
                var appendIn = document.getElementById('add_on');
                var rowId = Date.now();
                var add_to_html = '<div class="row gutters-5" id="'+attribute_row_id+'">' +
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
                    '<i class="fa-solid fa-xmark" onclick="removeAttr(\'' + attribute_row_id + '\')"></i>' +
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
        $('.selectpicker').selectpicker();
    });
</script> 
<script>
    // function openPopup() {
    //     document.getElementById("popup_container").style.display = "block";
    // }
    // function closePopup(event) {
    //     event.preventDefault();
    //     document.getElementById("popup_container").style.display = "none";
    // }
</script> 

 

@endsection
@endsection