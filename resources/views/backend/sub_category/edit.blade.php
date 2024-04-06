@extends('layouts/backend/main')
@section('main-section')  
        <div class="content-body">
            <div class="top-set">
              <div class="container">   
                <div class="row">
                    <div class="col-md-12">
                        <div class="card" style="border: 1px solid #cccccc;">
                            <div class="card-header" style="border-bottom: 1px solid #cccccc;">
                                <h5 class="mb-0 h6">Sub Category</h5>  
                            </div>
                            <div class="card-body">
                                <form class="p-4" action="{{route('backend.sub_category.update', [$sub_cat_detail->id])}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Name</label>
                                        <div class="col-md-9">
                                            <input type="text" name="name"  class="form-control" id="name" value="{{$sub_cat_detail->name}}" placeholder="Sub category name" required>
                                        </div>
                                    </div> 
                                    <div class="form-group row mt-2">
                                        <label class="col-md-3 col-form-label">Main Category</label>
                                        <div class="col-md-9">
                                            <select class="selectpicker form-control" name="main_category" data-live-search="true" title="Main Category" required>
                                                @foreach($main_cat_list as $main_cat)
                                                <option value="{{$main_cat->id}}" {{$main_cat->id == $sub_cat_detail->main_category_id ? 'selected':''}}>{{$main_cat->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">
                                            Ordering Number
                                        </label>
                                        <div class="col-md-9">
                                            <input type="number" name="ordering_number" class="form-control" id="ordering_number" value="{{$sub_cat_detail->ordering_number}}" placeholder="Order Level">
                                            <small class="form-text text-muted">Higher number has high priority</small>
                                        </div>
                                    </div>  
                                    <!-- <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Type</label>
                                        <div class="col-md-9">
                                            <div class="dropdown">
                                                <select name="type" class="form-control">
                                                    <option value="">Select Type</option>
                                                    <option value="0">Physical</option>
                                                    <option value="1">Digital</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label" for="signinSrEmail">Thumbnail
                                            <small>(200x200)</small>
                                        </label>
                                        <div class="col-md-9">
                                            <div class="input-group" data-toggle="aizuploader" data-type="image">  
                                                <input type="file" class="selected-files form-control" name="thumbnail_image"> 
                                            </div> 
                                        </div>
                                    </div>
                                    {{-- <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Slug</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="slug" value="{{$sub_cat_detail->slug}}" placeholder="Slug" required>
                                            @error('slug')
                                            <span id="productNameError" class="formFiedllerror">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div> --}}

                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Meta Title</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" value="{{$sub_cat_detail->meta_title}}" name="meta_title" placeholder="Meta Title">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Meta description</label>
                                        <div class="col-md-9">
                                            <textarea name="meta_description" rows="5" class="form-control" placeholder="Meta Description">{{$sub_cat_detail->meta_description}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label" for="signinSrEmail">Meta Image
                                            <small>(200x200)</small>
                                        </label>
                                        <div class="col-md-9">
                                            <div class="input-group" data-toggle="aizuploader" data-type="image">  
                                                <input type="file" class="selected-files form-control" name="meta_image"> 
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Filtering Attributes</label>
                                        <div class="col-md-9">
                                            <div class="dropdown bootstrap-select show-tick select2 form-control aiz-">
                                                <select class="selectpicker form-control aiz-selectpicker" name="filtering_attributes[]" title="Select attributes" data-toggle="select2"  data-live-search="true"  multiple="">
                                                    @foreach($attribute_list as $attribute)
                                                    <option value="{{$attribute->id}}" @if(in_array($attribute->id, $sub_cat_detail->filtering_attribute)) selected @endif>{{$attribute->name}}</option> 
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0 text-right">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>                                                        
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
              </div>

            </div>
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

        <script>
            $(document).on('change', '#status', function(){
                var $toggleButton = $(this);
                var status = $toggleButton.prop('checked') ? '1':'0';
                var main_category_id = $(this).data('id');
                $.ajax({
                            url: "{{route('backend.main_category.change_status')}}",
                            data: {'status':status, 'main_category_id':main_category_id},
                            type: "GET",
                            success: function(response){
                                if(response.status == 200){
                                    Swal.fire({
                                        title: "Success!",
                                        text: "Status successfully updated.",
                                        icon: "success"
                                    });  
                                }
                            }
                        });
            });
        </script>

        <script> 
            $(document).on('click', '#delete_btn', function(){
                const id = $(this).val();

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                    url: "{{route('backend.main_category.destroy')}}",
                    data:{'id':id},
                    type:"GET",
                    success:function(response){
                        Swal.fire({
                        title: "Deleted!",
                        text: "Main category has been deleted.",
                        icon: "success"
                        });
                        $("#cat_list_"+id).hide(); 
                    }
                })

                        
                    }
                    });


                
            });
        </script>

    <script>
            $(document).ready(function (){
                $(document).on('keydown', '#search', function (){
                    const search_val = $(this).val();   
                    if(search_val === ''){
                        $('#my_pagination').show();

                    }else{
                    $.ajax({
                        url:"{{route('backend.main_category.search')}}",
                        method: "GET", 
                        data: {'search_val': search_val},
                        success: function(result){ 
                            $("#category_table_body").html(result);
                            $('#my_pagination').hide();
                        }
                    }); 
                }
                 
                });
            }); 
        </script>
@endsection
@endsection