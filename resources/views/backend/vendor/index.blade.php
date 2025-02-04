@extends('layouts/backend/main')
@section('main-section')
 
<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
    <div class="top-set">
        <div class="container">
            <div class="row align-items-center mb-4">
                <div class="col-md-4">
                    <h1 class="h4">All Vendors</h1>
                </div>
                <div class="col-md-8 text-md-right">
                    <a href="{{route('backend.vendor.create')}}" class="btn btn-primary"
                        style="background-color: #f5a100; border: none; border-radius: 50em;">
                        <span>Add New Vendor</span>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card" style="border: 1px solid #dadada;">
                        <div class="d-flex align-items-center" style="border-bottom: 1px solid #ececec;height:53px">
                            <div class="col text-center text-md-left">
                                <h5 class="mb-md-0 h6">All Vendors</h5>
                            </div>
                            <div class="dropdown mb-2 mb-md-0" id="multiSelectActionBtn" style="display:none;">
                                <button class="btn border dropdown-toggle" type="button" data-toggle="dropdown"
                                    aria-expanded="false">
                                    Bulk Action
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item confirm-alert" href="javascript:void(0)"
                                        onclick="deleteSelection()"> Delete selection</a>
                                </div>
                            </div>
                            <!-- <form action="" method="GET" id="filter_form">
                            <div class="col-md-2 ml-auto">
                                <div class="form-group mt-2 mb-2">  
                                    <select class="form-control form-control-sm" name="sort_by" id="sort_by">
                                        <option value="">Sort by Name</option>
                                        <option value="asc">A to Z</option>
                                        <option value="desc">Z to A</option> 
                                    </select>
                                </div>
                            </div>
                            </form> -->
                            <div class="col-md-2">
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" id="search" name="search"
                                        placeholder="Search Name or Email">
                                </div>
                            </div>  
                        </div>
                        @php if(isset($_GET['page'])){$page_number = $_GET['page'];}else{ $page_number = 1;} $count = $page_number * 10 - 9;  @endphp 
                        <div class="card-body">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th style="display: table-cell;">S No.</th>
                                        <th style="display: table-cell;">Vendor Image</th>
                                        <th style="display: table-cell;">Vendor Name</th>
                                        <th style="display: table-cell;">Phone</th>
                                        <th style="display: table-cell;">Email</th>
                                        <th style="display: table-cell;">Business Name</th>
                                        <th style="display: table-cell;">Options</th>
                                    </tr>
                                </thead>
                                <tbody id="main_table_body">
                                   @foreach($vendor_list as $vendor)
                                    <tr id="vendor_list_{{$vendor->id}}">
                                        <td style="display: table-cell;">
                                             {{$count++}}
                                        </td>
                                        <td style="display: table-cell;"> 
                                            <div class="vendor_img">
                                                <img src="{{url($vendor->profile_image != "" ? $vendor->profile_image:"public\assets\backend\images\profile\default-user.png")}}">
                                            </div>   
                                        </td>
                                        <td style="display: table-cell;">
                                             {{$vendor->name}}    
                                        </td>
                                        <td style="display: table-cell;"> 
                                            {{$vendor->phone}}
                                        </td>
                                        <td>
                                             {{$vendor->email}}
                                        </td>
                                        <td> 
                                            {{$vendor->business_name}}
                                        </td>

                                        <td class="footable-last-visible ">
                                            <div class="d-flex "> 
                                            <a class="btn btn-soft-info btn-icon btn-circle btn-sm eye-2"
                                                href="{{route('backend.vendor.edit', [$vendor->id])}}" title="Edit">
                                                <i class="fa-regular fa-pen-to-square text-white"></i>
                                            </a> 
                                            <button value="{{$vendor->id}}" class="btn btn-icon btn-sm delete_ico"
                                            id="delete_btn"> <i class="fa-solid fa-trash-can"></i></button>
                                            </div>
                                        </td>
                                    </tr> 
                                    @endforeach
                                </tbody>
                            </table>
                            <div id="my_pagination">
                                        {{$vendor_list->links('pagination::bootstrap-5')}}
                                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 

@section('javascript-section')
@if(Session::has('vendor_created'))
        <script> 
            Swal.fire({
            title: "Success!",
            text: "{{Session::get('vendor_created')}}",
            icon: "success",
            timer: 5000,
            });
        </script>
        @elseif(Session::has('vendor_updated'))
        <script> 
            Swal.fire({
            title: "Success!",
            text: "{{Session::get('vendor_updated')}}",
            icon: "success",
            timer: 5000,
            });
        </script>   
        @endif

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
                            url: "{{route('backend.vendor.destroy')}}",
                            data:{'id':id},
                            type:"GET",
                            success:function(response){ 
                                if(response.message == 'deleted' && response.status == 200){
                                Swal.fire({
                                title: "Deleted!",
                                text: "Vendor has been deleted.",
                                icon: "success"
                                });
                                $("#vendor_list_"+id).hide(); 
                            }else if(response.message == 'already_in_use' && response.status == 400){ 
                                Swal.fire({
                                title: "Warning!",
                                text: "Vendor already used in stock!",
                                icon: "warning"
                                });
                            }else{
                                Swal.fire({
                                title: "Failed!",
                                text: "Something went wrong.",
                                icon: "error"
                                });
                            }

                    }
                })       
                    }
                    });  
            });
        </script>


<script> 
    document.addEventListener("DOMContentLoaded", function() {
        var selectElement = document.getElementById('sort_by');
        var formElement = document.getElementById('filter_form');
        selectElement.addEventListener('change', function() {
            formElement.submit();
        });
    }); 
</script>


<script>
    $(document).ready(function (){
        $(document).on('keydown', '#search', function (){
            const search_val = $(this).val();
            if (search_val === ''){
                $('#my_pagination').show();
            } else{ 
                $.ajax({
                    url: "{{route('backend.vendor.search')}}",
                    method: "GET",
                    data: { 'search_val': search_val },
                    success: function (result){ 
                        $("#main_table_body").html(result);
                        $('#my_pagination').hide();
                    }
                });
            }
        });
    }); 
</script>


@endsection
 
@endsection