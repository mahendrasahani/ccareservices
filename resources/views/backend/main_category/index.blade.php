@extends('layouts/backend/main')
@section('main-section') 

<div class="content-body">
            <div class="top-set">
                
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="h4 mb-5">All categories</h4>
                        </div>
                            <div class="col-md-6">
                                <a href="{{route('backend.main_category.create')}}" class="btn btn-circle btn-info pull-right" style="background-color: #f5a100; border: none; border-radius: 50em;">
                                    <span>Add New category</span>
                                </a>
                            </div>
                        <div class="col-md-12">
                            <div class="card" style="border: 1px solid #e9e9e9;">
                                <div class="card-header d-flex" style="border-bottom: 1px solid #e9e9e9;">
                                    <div class="col text-center text-md-left">
                                        <h4 class="mb-md-0 h5 pt-3">Main Categories
                                        </h4>
                                    </div>
        
                                    <div class="col-md-2">
                                        <div class="form-group mb-0">
                                            <input type="text" class="form-control form-control-sm" id="search" name="search"
                                                placeholder="Type name & Enter">
                                        </div>
                                    </div>
                                </div> 
                                    <table id="myTable" class="table aiz-table mb-0 footable footable-1 breakpoint-lg">
                                        <thead>
                                            <tr class="footable-header">
                                                <!-- <th class="footable-first-visible">
                                                    <div class="form-group">
                                                        <div class="aiz-checkbox-inline">
                                                            <label class="aiz-checkbox">
                                                                <input type="checkbox" id="selectAllCheckbox">
                                                                <span class="aiz-square-check"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </th> -->
                                                <th class="col-xl-2">#</th>
                                                <th>Name</th> 
                                                <th>Order Number</th> 
                                                <th>Thumbnail</th>
                                                <th>Status</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>
        
                                        <tbody>
                                            @foreach($main_cat_list as $main_cat)
                                            <tr>
                                                <!-- <td class="footable-first-visible">
                                                    <div class="form-group d-inline-block">
                                                        <label class="aiz-checkbox">
                                                            <input type="checkbox" class="selectCheckbox">
                                                            <span class="aiz-square-check"></span>
                                                        </label>
                                                    </div>
                                                </td> -->
                                                <td style="display: table-cell;">1</td>
                                                <td>{{$main_cat->name}}</td>
                                                 
                                                <td>{{$main_cat->ordering_number}}</td>
                                                <td style="width:15%">
                                                    <img src="{{url($main_cat->thumbnail)}}" width="100%">
                                                </td>
                                                <td>
                                                    <label class="switch">
                                                        <input type="checkbox" {{$main_cat->status == 1 ? 'checked':''}} id="status" name="status" value="{{$main_cat->status}}" data-id="{{$main_cat->id}}">
                                                        <span class="slider"></span>
                                                    </label>
                                                </td>
                                                <td class="footable-last-visible">
                                                    <a class="btn btn-soft-info btn-icon btn-circle btn-sm eye-2" href="{{route('backend.main_category.edit', [$main_cat->id])}}" title="Edit"><i class="fa-regular fa-pen-to-square"></i></a>
                                                    <a href="javascript:void()"
                                                        class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete delete_ico"
                                                        title="Delete" data-toggle="modal"
                                                        data-target="#myModal">
                                                        <i class="fa-solid fa-trash-can"></i> 
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                  <div>
                                        {{$main_cat_list->links('pagination::bootstrap-5')}}
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

        <script>
            $(document).on('change', '#status', function(){
                var $toggleButton = $(this);
                var status = $toggleButton.prop('checked') ? '1':'0';
                var main_category_id = $(this).data('id');
                Swal.fire({
                    title: "Are you sure?",
                    text: "You want to change status !",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes"
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{route('backend.main_category.change_status')}}",
                            data: {'status':status, 'main_category_id':main_category_id},
                            type: "GET",
                            success: function(response){
                                if(response.status == 200){
                                    
                                }
                            }
                        });
                        // Swal.fire({
                        // title: "Deleted!",
                        // text: "Your file has been deleted.",
                        // icon: "success"
                        // });

                    }
                    });
                
            });
        </script>
@endsection
@endsection