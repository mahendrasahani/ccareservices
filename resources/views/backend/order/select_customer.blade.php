@extends('layouts/backend/main')
@section('main-section')

<div class="content-body">
    <div class="top-set">
    <section>
        <div class="container">

            <div class="card">
                <div class="card-body">
                    <div class="createOrderElement"> 
                        <form action="{{ route('backend.order.select_customer') }}" method="GET"> 
                            <div class="row">  
                                <div class="col-md-12 mt-3 mb-3"> 
                                    <h3> Create Order</h3>
                                </div>
                                    
                                <div class="col-md-6 mb-3">
                                    <label class="control-label" for="name">Name</label>
                                    <input type="text" placeholder="Name" name="name" class="form-control" value="{{ isset($_GET['name']) && $_GET['name'] != '' ? $_GET['name'] : '' }}">
                                    @error('name')
                                    <p style="color:red;">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="control-label" for="email">Email id</label>
                                    <input type="text" placeholder="Email id" name="email" class="form-control" value="{{ isset($_GET['email']) && $_GET['email'] != '' ? $_GET['email'] : '' }}">
                                    @error('email')
                                    <p style="color:red;">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="control-label" for="number">Phone Number</label>
                                    <input type="text" placeholder="Phone Number" name="phone" class="form-control" value="{{ isset($_GET['phone']) && $_GET['phone'] != '' ? $_GET['phone'] : '' }}">
                                    @error('phone')
                                    <p style="color:red;">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-12 mb-3 d-flex justify-content-between">
                                    <button class="btn btn-info">Search</button>
                                    <a href="{{ route('backend.order.select_customer') }}" class="btn btn-danger">Clear</a>
                                </div>

                            </div>
                        </form>  
                    </div>

                    @if(count($customers) > 0)
                    <div class="createOrderElement mt-3">
                        <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email id</th>
                                    <th scope="col">Mobil Number</th>
                                    <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($customers as $customer)
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>{{ $customer->name ?? '' }}</td>
                                        <td>{{ $customer->email ?? '' }}</td>
                                        <td>{{ $customer->phone ?? '' }}</td>
                                        <td>
                                              <a href="{{ route('backend.order.create_order') }}?customer={{ $customer->id }}"  class="btn btn-info">Create Order</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                        </table> 
                        


                        
                         
                    </div> 
                    @else
                        
                        @if($found_status == true)
                        <center><h3>No Customer Found</h3></center>
                        @endif
                        
                        @endif

                </div> 
            </div> 

        </div>
</section>
    </div>
</div>
 

@section('javascript-section')

@endsection
@endsection
