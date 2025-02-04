@extends('layouts/backend/main')
@section('main-section')
 
<div class="content-body">
    <div class="top-set">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-3 mb-3">
                    <h3>Add New User</h3>
                </div>
            </div>
        </div>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card" style="border: 1px solid #e8e8e8;"> 
                            <div class="card-header" style="border-bottom: 1px solid #e8e8e8;">
                                <h4 class="mb-0 h6">User Information</h4>
                            </div>
                         
                            <form enctype="multipart/form-data" action="{{route('backend.customer.store')}}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">User Name<span class="text-danger">*</span> </label>
                                        <div class="col-md-9">
                                             <input type="text" class="form-control" name="name" placeholder="User Name" value="{{old('name')}}">   
                                            @error('name')
                                                <p style="color:red; font-weight:bold;">{{$message}}</p>
                                            @enderror
                                            </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">User Email<span class="text-danger">*</span> </label>
                                        <div class="col-md-9">
                                        <input type="text" class="form-control" name="email" placeholder="User Email" value="{{old('email')}}">   
                                        @error('email')
                                                <p style="color:red; font-weight:bold;">{{$message}}</p>
                                            @enderror
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">User Phone<span class="text-danger">*</span> </label>
                                        <div class="col-md-9">
                                        <input type="text" class="form-control" name="phone" placeholder="User Phone" value="{{old('phone')}}">   
                                        @error('phone')
                                                <p style="color:red; font-weight:bold;">{{$message}}</p>
                                            @enderror
                                    </div>
                                    </div>
                                     
                             
                      <div class="card" style="border: 1px solid #e8e8e8;">
                            <diAv class="card-header d-flex justify-content-between"
                                style="border-bottom : 1px solid #e8e8e8;">
                                <h5 class="mb-0 pt-2">Documents</h5>
                            </diAv>
                            <div class="card-body">
                                <!-- <div class="alert alert-info">Documents</div>   -->
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="aadhar_front">Upload Aadhar Card Front<span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                    <input type="file" class="form-control" id="aadhar_front" name="aadhar_front"  value="{{old('aadhar_front')}}"/> 
                                    @error('aadhar_front')
                                        <p style="color:red; font-weight:bold;">{{$message}}</p>
                                    @enderror
                                </div> 
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="aadhar_back">Upload Aadhar Card Back<span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                    <input type="file" class="form-control" id="aadhar_back" name="aadhar_back"  /> 
                                    @error('aadhar_back')
                                                <p style="color:red; font-weight:bold;">{{$message}}</p>
                                            @enderror
                                </div> 
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="security_check">Upload Security Cheque<span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                    <input type="file" class="form-control" id="security_check" name="security_check"  /> 
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
  
@endsection