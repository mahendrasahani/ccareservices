@extends('layouts/backend/main')
@section('main-section')

<div class="content-body">
    <div class="top-set">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-3 mb-3">
                    <h3>Edit Vendor</h3>
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

                            <form enctype="multipart/form-data" action="{{route('backend.vendor.update', [$vendor->id])}}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Name <span class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="vendor_name" placeholder="Vendor Name" id="product_name" value="{{$vendor->name}}" required> 
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Email</label>
                                        <div class="col-md-9">
                                             <input type="email" id="vendor_email" name="vendor_email" class="form-control" placeholder="Vendor Email" value="{{$vendor->email}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Phone no.</label>
                                        <div class="col-md-9">
                                             <input type="tel" id="vendor_phone" name="vendor_phone" class="form-control" placeholder="Your Phone Number" value="{{$vendor->phone}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Business Name</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="business_name" placeholder="Business Name" id="business_name" value="{{$vendor->business_name}}"> 
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Address</label>
                                        <div class="col-md-9">
                                            <input type="text" id="vendor_address" name="vendor_address" class="form-control" placeholder="Your Address" value="{{$vendor->address}}"> 
                                        </div>
                                    </div> 

                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">GST</label>
                                        <div class="col-md-9">
                                            <input type="text" id="vendor_gst" name="vendor_gst" class="form-control" placeholder="GST" value="{{$vendor->gst}}"> 
                                        </div>
                                    </div>

                                    <!-- <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Profile Picture<span class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="file" id="vendor_image" class="form-control" name="vendor_image">
                                            <div id="vendor_img_preview"></div>  
                                        </div> 
                                    </div>  -->
                                </div> 
                                <div class="container">
                                <div class="row">
                                <div class="col-md-12">
                                    <div class="text-end mb-3">
                                        <button type="submit" class="btn btn-primary">Save</button>
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