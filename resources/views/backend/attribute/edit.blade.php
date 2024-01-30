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
                        <h5 class="mb-0 h4">Attribute Information</h5>
                    </div>
                    <div class="col-md-12"> 
                            <div class="card mt-3" style="border: 1px solid #e3e3e3;">
                                <div class="card-body">
                                    <form class="p-4" action="{{route('backend.attribute.update', [$attribute_detail->id])}}" method="POST">
                                      @csrf
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="name">Attribute Value <i class="las la-language text-danger" title="Translatable"></i></label>
                                            <div class="col-sm-9">
                                                <input type="text" placeholder="Name" id="name" name="name" class="form-control" required="" value="{{$attribute_detail->name}}">
                                            </div>
                                        </div> 
                                        <div class="form-group mb-0 text-right">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div> 
                        
                    </div>
                </div>
              </div>
            </div>
            <!--**********************************
            Content body end
        ***********************************-->
        </div>

@endsection