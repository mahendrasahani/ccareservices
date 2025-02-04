@extends('layouts/backend/main')
@section('main-section') 

<div class="content-body">
            <div class="top-set">
              <div class="container">   
                <div class="row">
                    <div class="col-md-12">
                        <div class="card" style="border: 1px solid #cccccc;">
                            <div class="card-header" style="border-bottom: 1px solid #cccccc;">
                                <h5 class="mb-0 h6">Category Information</h5>  
                            </div>
                            <div class="card-body">
                                <form class="p-4" action="{{route('backend.main_category.update', [$main_cat_detail->id])}}" method="POST" enctype="multipart/form-data">
                                     @csrf
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Name <i class="las la-language text-danger" title="Translatable"></i></label>
                                        <div class="col-md-9">
                                            <input type="text" name="name" value="{{$main_cat_detail->name}}" class="form-control" id="name" placeholder="Name" required>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">
                                            Ordering Number
                                        </label>
                                        <div class="col-md-9">
                                            <input type="number" name="ordering_number" value="{{$main_cat_detail->ordering_number}}" class="form-control" id="order_number" placeholder="Order Level" required>
                                            <small class="form-text text-muted">Higher number has high priority</small>
                                        </div>
                                    </div>  
                                    
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label" for="signinSrEmail">Thumbnail
                                            <small>(200x200)</small>
                                        </label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="thumbnail_image" name="thumbnail_image">
                                                    <label class="custom-file-label" for="thumbnail_image">Choose file</label>
                                                </div>
                                            </div>
                                            <div class="file-preview box sm mt-2">
                                                <div class=" " data-id="83" title="Sports-&amp;-outdoor.png">
                                                    <div class=" thumb">
                                                        <img src="{{$main_cat_detail->thumbnail != '' ? url($main_cat_detail->thumbnail):url('public/assets/both/placeholder/main_category.jpg')}}" class="img-fit" width="20%">
                                                        <h6 class="mt-2">
                                                            @php
                                                            $thumbnail_name = basename($main_cat_detail->thumbnail);
                                                            $thumbnail_size = filesize($main_cat_detail->thumbnail);
                                                            $thumbnail_size_in_kb = number_format($thumbnail_size/1024, 2);
                                                            @endphp
                                                            <span>{{$thumbnail_name}}</span>
                                                        </h6>
                                                        <p>{{$thumbnail_size_in_kb}} KB</p>
                                                    </div>  
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Slug</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="slug" value="{{$main_cat_detail->slug}}" placeholder="Slug" required>
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Meta Title</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="meta_title" value="{{$main_cat_detail->meta_title}}" placeholder="Meta Title" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Meta description</label>
                                        <div class="col-md-9">
                                            <textarea name="meta_description" rows="5" cols="50" required style="width:100%;padding:7px;border: 1px solid #ced4da;">{{$main_cat_detail->meta_description}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label" for="signinSrEmail">Meta Image
                                            <small>(200x200)</small>
                                        </label>
                                        <div class="col-md-9"> 
                                                <input type="file" class="form-control" name="meta_image" class="selected-files">
                                            <div class="file-preview box sm">
                                                <div data-id="83" title="Sports-&amp;-outdoor.png">
                                                    <div>
                                                        <img src="{{$main_cat_detail->meta_image != '' ? url($main_cat_detail->meta_image):url('public/assets/both/placeholder/main_category.jpg')}}" class="img-fit" width="20%">
                                                    </div> 
                                                    @php
                                                        $meta_image_name = basename($main_cat_detail->meta_image);
                                                        $meta_image_size = filesize($main_cat_detail->meta_image);
                                                        $meta_image_size_in_kb = number_format($meta_image_size/1024, 2);
                                                    @endphp
                                                        <h6 class="mt-2"><span >{{$meta_image_name}}</span></h6>
                                                        <p>{{$meta_image_size_in_kb}} KB</p> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                     <label class="col-md-3 col-form-label">Filtering Attributes</label>
                                       <div class="col-md-9">
                                         <div class="dropdown bootstrap-select show-tick form-control">
                                            <select class="selectpicker form-control" name="filtering_attributes[]" data-toggle="select2" data-placeholder="Choose ..." data-live-search="true" multiple="">
                                            @foreach($attribute_list as $attribute)
                                                <option value="{{$attribute->id}}" @if(in_array($attribute->id, $main_cat_detail->filtering_attribute)) selected @endif>{{$attribute->name}}</option> 
                                            @endforeach 
                                           </select>
                                        </div>
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
        </div>


@endsection