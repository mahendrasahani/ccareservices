@extends('layouts/backend/main')
@section('main-section')
   <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="top-set">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="h5">Shipping Charge</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card" style="border: 1px solid #e0e0e0;">
                                <div class="card-header">
                                    <h5 class="h6"></h5>
                                </div>
                                <div class="card-body p-0">
                                    <form class="p-4" action="{{route('backend.shipping_charge.update', $shipping_charge->id)}}" method="POST">
                                         @csrf 
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="name">Name <i class="las la-language text-danger"></i></label>
                                            <div class="col-sm-9">
                                                <input type="text" placeholder="Enter Name" id="name" name="name" value="{{$shipping_charge->name}}" class="form-control" required >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <label class=" control-label" for="amount">Amount</label>
                                            </div>
                                            <div class="col-md-9"> 
                                            <input type="number" placeholder="Enter Amount" id="amount" name="amount" value="{{$shipping_charge->amount}}" min="1" class="form-control" required >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3 mr-2 text-right">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #/ container end-->
        </div>
        <!--**********************************
            Content body end
        ***********************************--> 
@section('javascript-section') 
@endsection
@endsection