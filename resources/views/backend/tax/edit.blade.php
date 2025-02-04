@extends('layouts/backend/main')
@section('main-section')  
        <div class="content-body">
            <div class="top-set">
                <div class="container">
                    <div class="row mt-5">
                        <div class="col-md-12 mt-5 mx-auto">
                            <div class="card border">
                                <div class="card-header border-bottom">
                                    <div class="col text-center text-md-left">
                                        <h5 class="mb-md-0 h4">Tax Information</h5>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{route('backend.tax.update', [$tax->id])}}" enctype="multipart/form-data"> 
                                        @csrf
                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <label class="control-label" for="name">Tax Name</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" placeholder="Tax Name" name="tax_name" class="form-control" required value="{{$tax->tax_name}}" disabled>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <label class="control-label" for="name">Tax Rate</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" placeholder="Tax Rate" name="tax_rate" class="form-control" required value="{{$tax->tax_rate}}">
                                            </div>
                                        </div> 
                                        <div class="mb-0 text-right">
                                            <button type="submit" class="btn btn-primary" style="background-color: #f5a100; border: none;">Save</button>
                                        </div>
                                    </form>
                            
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div> 
    </div> 
@endsection