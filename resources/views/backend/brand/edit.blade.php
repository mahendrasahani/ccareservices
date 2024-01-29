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
                            <h4 class="h5">Brand Information</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card" style="border: 1px solid #e0e0e0;">
                                <div class="card-header">
                                    <h5 class="h6"></h5>
                                </div>
                                <div class="card-body p-0">
                                    <form class="p-4" action="{{route('backend.brand.update')}}" method="POST" enctype="multipart/form-data" >
                                         @csrf
                                         <input type="hidden" value="{{$brand_detail->id}}" name="id">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="name">Name <i class="las la-language text-danger"></i></label>
                                            <div class="col-sm-9">
                                                <input type="text" placeholder="Enter Name" id="name" name="name" value="{{$brand_detail->name}}" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <label class=" control-label" for="name">Logo <small>(120x80)</small></label>
                                            </div>
                                            <div class="col-md-9"> 
                                                    <input type="file" name="logo">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mb-0">
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