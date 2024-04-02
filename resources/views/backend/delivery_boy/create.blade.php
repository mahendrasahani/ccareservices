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
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="crad-body">
                                    <form action="{{route('backend.delivery_boy.store')}}" method="POST" class="mt-5" style="padding: 0 16px 16px 16px;">
                                    @csrf      
                                    <div class="form-group">
                                            <label for="inputName">Name</label>
                                            <input type="text" class="form-control" id="inputName" name="name" placeholder="Your Name">
                                          </div>

                                        <div class="form-group ">
                                            <label for="inputEmail">Email</label>
                                            <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Your Email">
                                          </div>
                                      
                                          <div class="form-group ">
                                            <label for="inputPhone">Phone</label>
                                            <input type="tel" class="form-control" id="inputPhone" name="phone" placeholder="Your Phone">
                                          </div>
                                         
                                        
                                        <div class="form-group ">
                                            <label for="inputPassword">Password</label>
                                            <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Your Password">
                                          </div>

                                          <div class="form-group ">
                                            <label for="inputPassword">Password</label>
                                            <input type="password" class="form-control" id="inputPassword" name="password_confirmation" placeholder="Your Password">
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