@extends('layouts/backend/main')
@section('main-section')
 
<div class="content-body">
    <div class="top-set">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-3 mb-3">
                    <h3>Add new Vendors</h3>
                </div>
            </div>
        </div>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card" style="border: 1px solid #e8e8e8;">
                            <div class="card-header" style="border-bottom: 1px solid #e8e8e8;">
                                <h4 class="mb-0 h6">Vendor Information</h4>
                            </div>
                         
                            <form enctype="multipart/form-data" id="create_product_form"
                                onsubmit="validateAndSubmit(event)">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Vendor Name <span
                                                class="text-danger">*</span> <i class="las la-language text-danger"
                                                title="Translatable"></i></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="product_name"
                                                placeholder="Your Name" id="product_name" >
                                            <span id="productNameError" class="formFiedllerror"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Email <span
                                                class="text-danger">*</span> <i class="las la-language text-danger"
                                                title="Translatable"></i></label>
                                        <div class="col-md-9">
                                             <input type="email" id="emailInput" name="emailInput" class="form-control" placeholder="Your Email">
                                            <span id="productNameError" class="formFiedllerror"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Phone no.     <span
                                                class="text-danger">*</span> <i class="las la-language text-danger"
                                                title="Translatable"></i></label>
                                        <div class="col-md-9">
                                             <input type="tel" id="phoneInput" name="phoneInput" class="form-control" placeholder="Your Phone Number">
                                            <span id="productNameError" class="formFiedllerror"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Business Name <span
                                                class="text-danger">*</span> <i class="las la-language text-danger"
                                                title="Translatable"></i></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="Business_name"
                                                placeholder="Business Name" id="product_name" >
                                            <span id="productNameError" class="formFiedllerror"></span>
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Address<span
                                                class="text-danger">*</span> <i class="las la-language text-danger"
                                                title="Translatable"></i></label>
                                        <div class="col-md-9">
                                            <input type="text" id="addressInput" name="addressInput" class="form-control" placeholder="Your Address">
                                            <span id="productNameError" class="formFiedllerror"></span>
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Upload Image<span
                                                class="text-danger">*</span> <i class="las la-language text-danger"
                                                title="Translatable"></i></label>
                                        <div class="col-md-9">
                                            <input type="file" id="vendor_image" class="form-control" name="vendor_image[]" multiple>
                                            <div id="vendor_img_preview"></div>  
                                            <span id="productNameError" class="formFiedllerror"></span>
                                        </div>
                                        
                                    </div> 
                                </div> 
                                <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="text-end mb-3">
                                        <button class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                            </form>
                        </div>   
                </div>
            </div> 
</div>
        </section>
    </div>
</div> 
 
@endsection