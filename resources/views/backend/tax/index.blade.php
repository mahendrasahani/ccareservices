@extends('layouts/backend/main')
@section('main-section') 

<div class="content-body">
            <div class="top-set">
                
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="h4 mb-5">All Tax</h4>
                        </div>
                            <!-- <div class="col-md-6">
                                <a href="{{route('backend.tax.create')}}" class="btn btn-circle btn-info pull-right" style="background-color: #f5a100; border: none; border-radius: 50em;">
                                    <span>Add New Tax</span>
                                </a>
                            </div> -->
                        <div class="col-md-12">
                            <div class="card" style="border: 1px solid #e9e9e9;">
                            <div class="d-flex align-items-center" style="border-bottom: 1px solid #ececec;height:53px">
                            <div class="col text-center text-md-left">
                                <h5 class="mb-md-0 h6">Tax Rates</h5>
                            </div>
                           
                        </div>
                                @php if(isset($_GET['page'])){$page_number = $_GET['page'];}else{ $page_number = 1;} $count = $page_number * 10 - 9;  @endphp 

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
                                                <th>Tax Name</th> 
                                                <th>Tax Rate</th>  
                                                <!-- <th>Status</th> -->
                                                <th>Options</th>
                                            </tr>
                                        </thead>
        
                                        <tbody id="category_table_body">
                                            
                                            @if(count($taxes) > 0)
                                                @foreach($taxes as $tax)
                                                    <tr>
                                                        <td>{{$count++}}</td>
                                                        <td>{{$tax->tax_name}}</td>
                                                        <td>{{$tax->tax_rate}}%</td>
                                                        <!-- <td> <label class="switch">
                                                        <input type="checkbox" {{$tax->status == 1 ? 'checked':''}} id="status" name="status" value="{{$tax->status}}" data-id="{{$tax->id}}">
                                                        <span class="slider"></span>
                                                    </label></td> -->
                                                        <td><a class="btn btn-soft-info btn-icon btn-circle btn-sm eye-2" href="{{route('backend.tax.edit', [$tax->id])}}" title="Edit"><i class="fa-regular fa-pen-to-square text-white"></i></a></td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                  <div id="my_pagination">
                                       
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
                var tax_id = $(this).data('id');
                $.ajax({
                            url: "{{route('backend.tax.change_status')}}",
                            data: {'status':status, 'tax_id':tax_id},
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
                       if(response.status == 200 && response.message == "deleted"){
                            Swal.fire({
                            title: "Deleted!",
                            text: "Main category has been deleted !",
                            icon: "success"
                            });
                            $("#cat_list_"+id).hide(); 
                    }else if(response.status == 400 && response.message == "exist_in_product"){
                        Swal.fire({
                            title: "Warning!",
                            text: "This main category is used in product !",
                            icon: "warning"
                            });
                    }else if(response.status == 400 && response.message == "exist_in_s_cat"){
                        Swal.fire({
                            title: "Warning!",
                            text: "This main category is used in sub category !",
                            icon: "warning"
                            });
                    }
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