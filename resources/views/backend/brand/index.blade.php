@extends('layouts/backend/main')
@section('main-section')
        <div class="content-body">
            <div class="top-set">
                <div class="container">
                    <div class="row mt-5 mb-3" style="padding: 0px 15px 0px 14px;">
                        <div class="col-md-6">
                            <h4 class="pt-4">All brands</h4>
                        </div>
                    </div>
                    <div class="row" style=" padding: 0px 15px 0px 16px;">
                        <div class="col-md-8">
                            <div class="card" style="border: 1px solid #e5e5e5;">
                                <div class="card-header d-flex justify-content-end" style="border-bottom: 1px solid #e5e5e5;">
                                <div class="">
                                    <div class="input-group enter">
                                        <input type="text" class="form-control form-control-sm" id="search" name="search"
                                            placeholder="Search by name">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="myTable" class="table aiz-table mb-0 footable footable-1 breakpoint-lg">
                                    <thead>
                                        <tr class="footable-header">
                                            <th class="col-xl-2">#</th>
                                            <th>Name</th>
                                            <!-- <th>Logo</th> -->
                                            <th class="">Options</th>
                                        </tr>
                                    </thead>
                                    @php if(isset($_GET['page'])){$page_number = $_GET['page'];}else{ $page_number = 1;} $count = $page_number * 10 - 9;  @endphp 
                                    <tbody id="brand_table_body">
                                        @foreach($brand_list as $brand)
                                        <tr>
                                            <td class="" style="display: table-cell;">{{$count++}}</td>
                                            <td style="display: table-cell;">{{$brand->name}}</td>
                                             <td class="">
                                                <a href="{{route('backend.brand.edit', [$brand->id])}}"><i class="fa-regular fa-pen-to-square text-white edit_icon"></i></a>
                                                <button value="{{$brand->id}}" class="btn btn-sm delete_ico delete_button"><i class="fa fa-trash-o"></i></button>
                                                <!-- <a href="javascript:void(0)" class="btn btn-sm delete_ico delete_button"><i class="fa-solid fa-trash-can"></i></a> -->
                                            </td>
                                        </tr>
                                        @endforeach
    
                                        
                                    </tbody>
                                </table>
                                <div>
                                {{$brand_list->links('pagination::bootstrap-5')}}
                                </div>
                            </div>
                           
                            </div>
                            
                        </div>
                        <div class="col-md-4"> 
                                <div class="card" style="border: 1px solid #e5e5e5;">
                                    <div class="card-header" style="border-bottom: 1px solid #e5e5e5;">
                                        <h5 class="mb-0">Add New Brand</h5>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{route('backend.brand.store')}}" method="POST" enctype="multipart/form-data" id="brand_form">
                                            @csrf 
                                            <div class="form-group mb-3">
                                                <label for="name">Name</label>
                                                <input type="text" placeholder="Enter brand name" id="name" name="name" class="form-control" required>
                                       
                                            </div>
                                            <!-- <div class="form-group mb-3">
                                                <label for="name">
                                                Logo
                                                <small>(120x80)</small>
                                                </label>
                                             <div class="input-group" data-toggle="aizuploader" data-type="image"> 
                                                    <input type="file" class="form-control" name="logo" class="selected-files" onchange="displaySelectedImages(event)" required >
                                                </div>  
                                                <div id="imagePreview"></div>
                                            </div> -->
                                            <div class="form-group mb-3 text-right">
                                                <button type="submit" class="btn btn-primary add-button" style="background-color: #f5a100; border: none;">Save</button>
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
        @elseif(Session::has('exist_in_product'))
        <script> 
            Swal.fire({
            title: "Warning!",
            text: "{{Session::get('exist_in_product')}}",
            icon: "warning",
            timer: 5000,
            });
        </script>   
        @endif

        <script>
              // delete category reques
    $(document).on('click', '.delete_button', function (){
      var brand_id = $(this).val();
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
            url: "{{route('backend.brand.destroy')}}",
            method: "GET",
            data: {id:brand_id},
            success: function (response){ 
                console.log(response);
                if(response.status == 200 && response.message == "deleted"){
                    Swal.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success"
                    }).then(function ()
                    {
                    window.location.reload();
                    }); 
                }else if(response.status == 400 && response.message == "exist_in_product"){
                    Swal.fire({
                    title: "Warning!",
                    text: "This brand is already used in product !",
                    icon: "warning", 
            });
        }
                
               
            }
        });

            }
        });
    }); 
</script>

    <script>
        $(document).ready(function (){
            $(document).on('keyup', '#search', function (){
                const search_val = $(this).val();  
                $.ajax({
                    url:"{{route('backend.brand.search')}}",
                    method: "GET", 
                    data: {'search_val': search_val},
                    success: function(result){
                        $("#brand_table_body").html(result);
                    }
                }); 
            });
        }); 
    </script>
        @endsection
@endsection