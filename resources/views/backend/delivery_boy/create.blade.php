@extends('layouts/backend/main')
@section('main-section') 


<div class="content-body">
            <div class="top-set">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card" style="border: 1px solid #d7d7d7; border-radius: 0px; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                                <div class="card-header" style="border-bottom: 1px solid #d7d7d7;">
                                    <h3 class="h4">Delivery Boy Information
                                    </h3>
                                </div>
                               
                                <div class="crad-body">
                                    <form action="{{route('backend.delivery_boy.store')}}" method="POST" class="mt-5" style="padding: 0 16px 16px 16px;">
                                    @csrf      
                                    <div class="form-group">
                                            <label for="inputName">Name</label>
                                            <input type="text" class="form-control" id="inputName" name="name" placeholder="Your Name" value="{{ old('name') }}">
                                            @error('name')  
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group ">
                                            <label for="inputEmail">Email</label>
                                            <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Your Email" value="{{ old('email') }}">
                                            @error('email')  
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror  
                                        </div>

                                          <div class="form-group ">
                                            <label for="inputPhone">Phone</label>
                                            <input type="tel" class="form-control" id="inputPhone" name="phone" placeholder="Your Phone" value="{{ old('phone') }}">
                                            @error('phone')  
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
 

                                    <div class="form-group ">
                                            <label for="address">Address</label>
                                            <input type="text" class="form-control" id="address" name="address" placeholder="Your Address" value="{{ old('address') }}">
                                            @error('address')  
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror  
                                        </div> 

                                    <div class="form-group">
                                            <label for="father_name">Father's Name</label>
                                            <input type="text" class="form-control" id="father_name" name="father_name" placeholder="Father's Name" value="{{ old('father_name') }}">
                                            @error('father_name')  
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror  
                                        </div>  
                                            <div class="form-group ">
                                            <label for="aadhar_number">Aadhar No.</label>
                                            <input type="number" class="form-control" id="aadhar_number" name="aadhar_number" placeholder="Aadhar No." value="{{ old('aadhar_number') }}">
                                            @error('aadhar_number')  
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror  
                                        </div> 
                                        <button type="submit" class="btn btn-primary">Save</button>
                                      </form>
                                </div>
                            </div>
                        </div>
                        </div>
                </div>
                
            </div>
            </div>
            <!-- row -->

           
            <!-- #/ container -->
        </div>






@section('javascript-section')
    @if(Session::has('success'))
        <script> 
            Swal.fire({
            title: "Success!",
            text: "{{Session::get('success')}}",
            icon: "success",
            timer: 5000,
            });
        </script>
        @elseif(Session::has('update'))
        <script> 
            Swal.fire({
            title: "Success!",
            text: "{{Session::get('update')}}",
            icon: "success",
            timer: 5000,
            });
        </script>   
    @endif

        
@endsection
@endsection