@extends('layouts/backend/main')
@section('main-section')
<div class="content-body">
    <div class="top-set">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-3 mb-3">
                    <h3>Add New Customer</h3>
                </div>
            </div>
        </div>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card" style="border: 1px solid #e8e8e8;">
                            <div class="card-header" style="border-bottom: 1px solid #e8e8e8;">
                                <h4 class="mb-0 h6">Customer Information</h4>
                            </div> 
                            <form enctype="multipart/form-data" action="{{route('backend.customer.store')}}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Customer Name<span class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                             <input type="text" class="form-control" name="name" placeholder="Customer Name" required value="{{old('name')}}">   
                                            @error('name')
                                                <p style="color:red; font-weight:bold;">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Customer Email<span class="text-danger">*</span> </label>
                                        <div class="col-md-9">
                                            <input type="email" class="form-control" name="email" placeholder="Customer Email" required value="{{old('email')}}">   
                                            @error('email')
                                                    <p style="color:red; font-weight:bold;">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Customer Phone<span class="text-danger">*</span> </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="phone" required placeholder="Customer Phone" value="{{old('phone')}}" maxlength="10" pattern="\d{10}">   
                                            @error('phone')
                                                <p style="color:red; font-weight:bold;">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                                <label class="col-md-3 col-form-label" for="address">Address</label>
                                                <div class="col-md-9">
                                                <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="{{old('address')}}"/> 
                                                    @error('address')
                                                        <p style="color:red; font-weight:bold;">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                               
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label" for="city">City</label>
                                                <div class="col-md-9">
                                                <input type="text" class="form-control" id="city" name="city" placeholder="City" value="{{old('city')}}"/> 
                                                    @error('city')
                                                        <p style="color:red; font-weight:bold;">{{$message}}</p>
                                                    @enderror
                                                </div> 
                                            </div> 
                                             


                                    <div class="card" style="border: 1px solid #e8e8e8;">
                                        <div class="card-header d-flex justify-content-between" style="border-bottom : 1px solid #e8e8e8;">
                                            <h5 class="mb-0 pt-2">Shipping Details</h5>
                                        </div>
                                        <div class="card-body"> 
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label" for="shipping_name">Name<span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                <input type="text" class="form-control" required id="shipping_name" name="shipping_name" placeholder="Name" value="{{old('shipping_name')}}"/> 
                                                    @error('shipping_name')
                                                        <p style="color:red; font-weight:bold;">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label" for="shipping_email">Email<span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                <input type="email" class="form-control" required id="shipping_email" name="shipping_email" placeholder="Email" value="{{old('shipping_email')}}"/> 
                                                    @error('shipping_email')
                                                        <p style="color:red; font-weight:bold;">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label" for="shipping_phone">Phone<span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                <input type="text" class="form-control" required id="shipping_phone" name="shipping_phone" placeholder="Phone" maxlength="10" pattern="\d{10}" value="{{old('shipping_phone')}}"/> 
                                                    @error('shipping_phone')
                                                        <p style="color:red; font-weight:bold;">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label" for="shipping_address">Address<span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                <input type="text" class="form-control" required id="shipping_address" name="shipping_address" placeholder="Address" value="{{old('shipping_address')}}"/> 
                                                    @error('shipping_address')
                                                        <p style="color:red; font-weight:bold;">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                               
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label" for="shipping_city">City<span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                <input type="text" class="form-control" required id="shipping_city" name="shipping_city" placeholder="City" value="{{old('shipping_city')}}"/> 
                                                    @error('shipping_city')
                                                        <p style="color:red; font-weight:bold;">{{$message}}</p>
                                                    @enderror
                                                </div> 
                                            </div> 
                                            

                                             
                                        </div>
                                    </div>

                                    <div class="card" style="border: 1px solid #e8e8e8;">
                                        <div class="card-header d-flex justify-content-between" style="border-bottom : 1px solid #e8e8e8;"> 
                                            <div class="form-check">
                                                <input class="form-check-input" {{old('billing_detail_check') ? 'checked' : ''}} type="checkbox" name="billing_detail_check" data-toggle="collapse" href="#billingDetails" role="button" id="billingDetails_checkbox" aria-expanded="false" aria-controls="billingDetails" {{ old('billing_detail_check') ? 'checked' : '' }}>
                                                <label class="form-check-label mb-0 h5" for="">
                                                    Billing address is different?
                                                </label>
                                            </div> 
                                        </div>
                                        <div class="card-body collapse" id="billingDetails"> 

                                             <div class="form-group row">
                                                <label class="col-md-3 col-form-label" for="billing_name">Name</label>
                                                <div class="col-md-9">
                                                <input type="text" class="form-control" id="billing_name" name="billing_name" placeholder="Name" value="{{old('billing_name')}}"/> 
                                                    @error('billing_name')
                                                        <p style="color:red; font-weight:bold;">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label" for="billing_email">Email</label>
                                                <div class="col-md-9">
                                                <input type="email" class="form-control" id="billing_email" name="billing_email" placeholder="Email" value="{{old('billing_email')}}"/> 
                                                    @error('billing_email')
                                                        <p style="color:red; font-weight:bold;">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label" for="billing_phone">Phone</label>
                                                <div class="col-md-9">
                                                <input type="text" class="form-control" id="billing_phone" name="billing_phone" placeholder="Phone" maxlength="10" pattern="\d{10}" value="{{old('billing_phone')}}"/> 
                                                    @error('billing_phone')
                                                        <p style="color:red; font-weight:bold;">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label" for="billing_address">Address</label>
                                                <div class="col-md-9">
                                                <input type="text" class="form-control" id="billing_address" name="billing_address" placeholder="Address" value="{{old('billing_address')}}"/> 
                                                    @error('billing_address')
                                                        <p style="color:red; font-weight:bold;">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                               
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label" for="billing_city">City</label>
                                                <div class="col-md-9">
                                                <input type="text" class="form-control" id="billing_city" name="billing_city" placeholder="City" value="{{old('billing_city')}}"/> 
                                                    @error('billing_city')
                                                        <p style="color:red; font-weight:bold;">{{$message}}</p>
                                                    @enderror
                                                </div> 
                                            </div>  
                                              
                                        </div>
                                    </div>
                                    <div class="card" style="border: 1px solid #e8e8e8;">
                                        <div class="card-header d-flex justify-content-between" style="border-bottom : 1px solid #e8e8e8;">
                                            <h5 class="mb-0 pt-2">Documents</h5>
                                        </div>
                                        <div class="card-body"> 
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label"  >Upload Aadhar Card Front</label>
                                                <div class="col-md-9">
                                                    <input type="file" class="form-control" id="aadhar_front" name="aadhar_front"  value="{{old('aadhar_front')}}" accept=".pdf, .jpg, .jpeg, .png"/> 
                                                    @error('aadhar_front')
                                                        <p style="color:red; font-weight:bold;">{{$message}}</p>
                                                    @enderror
                                                </div> 
                                            </div> 
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Upload Aadhar Card Back</label>
                                                <div class="col-md-9">
                                                    <input type="file" class="form-control" id="aadhar_back" name="aadhar_back"  accept=".pdf, .jpg, .jpeg, .png"/> 
                                                    @error('aadhar_back')
                                                        <p style="color:red; font-weight:bold;">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div> 
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label" >Upload Security Cheque</label>
                                                <div class="col-md-9">
                                                    <input type="file" class="form-control" id="security_check" name="security_check"  accept=".pdf, .jpg, .jpeg, .png"/> 
                                                    @error('security_check')
                                                        <p style="color:red; font-weight:bold;">{{$message}}</p>
                                                    @enderror
                                                </div> 
                                            </div> 
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
 
@section('javascript-section')
<script>
    $(document).ready(function(){

        let billingDetails_checkbox = $('#billingDetails_checkbox');
        
        if(billingDetails_checkbox.prop('checked')){ 
            $('#billingDetails').addClass('show'); 
        }else{ 
            $('#billingDetails').removeClass('show');
        }
        
        $('#billingDetails_checkbox').on('change', function(){
            let requiredValue = $('#billingDetails input'); 
            if(this.checked === true){
                requiredValue.prop('required', true); 
            }else{
                requiredValue.prop('required', false) 
            }
        }); 
    })
</script>
@endsection
@endsection
