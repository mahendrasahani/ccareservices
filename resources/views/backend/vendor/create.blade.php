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
                         
                            <form enctype="multipart/form-data" action="{{route('backend.vendor.store')}}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Name <span class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" value="{{ old('vendor_name') }}" name="vendor_name" placeholder="Vendor Name" id="product_name" required> 
                                            @error('vendor_name')
                                                <p style="color:red;">{{ $message }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Email <span class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                             <input type="email" id="vendor_email" value="{{ old('vendor_email') }}" name="vendor_email" class="form-control" placeholder="Vendor Email">
                                             @error('vendor_email')
                                                <p style="color:red;">{{ $message }}</p>
                                            @endif
                                            </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Phone no.<span class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                             <input type="tel" id="vendor_phone" value="{{ old('vendor_phone') }}" name="vendor_phone" class="form-control" placeholder="Your Phone Number">
                                             @error('vendor_phone')
                                                <p style="color:red;">{{ $message }}</p>
                                            @endif
                                            </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Business Name <span class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" value="{{ old('business_name') }}" name="business_name" placeholder="Business Name" id="business_name"> 
                                            @error('business_name')
                                                <p style="color:red;">{{ $message }}</p>
                                            @endif
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Address<span class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" id="vendor_address" value="{{ old('vendor_address') }}" name="vendor_address" class="form-control" placeholder="Your Address"> 
                                            @error('vendor_address')
                                                <p style="color:red;">{{ $message }}</p>
                                            @endif
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">GST<span class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" id="vendor_gst" value="{{ old('vendor_gst') }}" name="vendor_gst" class="form-control" placeholder="GST"> 
                                            @error('vendor_gst')
                                                <p style="color:red;">{{ $message }}</p>
                                            @endif
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