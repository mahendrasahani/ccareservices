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
                                        <h5 class="mb-md-0 h4">Category Information</h5>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{route('backend.main_category.store')}}" enctype="multipart/form-data"> 
                                        @csrf
                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <label class="control-label" for="name">Name</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" placeholder="Name" name="name" class="form-control" required>
                                            </div>
                                        </div>
                            
                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <label class="control-label" for="date">Ordering Number</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="number" placeholder="Order Number" name="order_number" class="form-control" required>
                                                <small>Higher number has high priority</small>
                                            </div>
                                        </div>
                            
                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <label class="control-label" for="password">Thumbnail<small>(200x300)</small></label>
                                            </div>
                                            <div class="col-md-9">
                                                    <input type="file" name="thumbnail_img" required>
                                            </div>
                                        </div>
                            
                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <label class="control-label" for="">Meta Title</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" placeholder="Meta Title" name="meta_title" class="form-control" required>
                                            </div>
                                        </div>
                            
                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <label class="control-label" for="">Meta description</label>
                                            </div>
                                            <div class="col-md-9">
                                                <textarea name="meta_description" class="form-control" rows="10" required></textarea>
                                            </div>
                                        </div>
                            
                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <label class="control-label" for="password">Meta Image</label>
                                            </div>
                                            <div class="col-md-9"> 
                                                    <input type="file" name="meta_img" required>
                                            </div>
                                        </div>
                            
                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <label class="control-label" for="">Filtering Attributes</label>
                                            </div>
                                            <div class="col-md-9">
                                         <div class="dropdown bootstrap-select show-tick form-control">
                                            <select class="selectpicker form-control" name="filtering_attributes[]" data-toggle="select2" data-placeholder="Choose ..." data-live-search="true" multiple="">
                                                    @foreach($attribute_list as $attribute)
                                                    <option value="{{$attribute->id}}">{{$attribute->name}}</option> 
                                                    @endforeach
                                           </select>
                                        </div>
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