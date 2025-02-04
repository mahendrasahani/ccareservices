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
                    <h1 class="h4">All Customers</h1>
                </div>
                <div class="col-md-8 text-md-right">
                    <a href="{{route('backend.customer.create')}}" class="btn btn-primary" style="background-color: #f5a100; border: none; border-radius: 50em;">
                        <span>Add New User</span>
                    </a>
                </div>
                 
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card" style="border: 1px solid #dadada;">
                        <div class="d-flex align-items-center" style="border-bottom: 1px solid #ececec;height:53px">
                            <div class="col text-center text-md-left">
                                <h5 class="mb-md-0 h6">All Customers</h5>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" id="search" name="search" placeholder="Search name or email">
                                </div>
                                </div>  
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr >
                                        <th style="display: table-cell;">S No.</th>
                                        <th style="display: table-cell;">Name</th>
                                        <th style="display: table-cell;">Email</th>
                                        <th style="display: table-cell;">Phone</th> 
                                        <th style="display: table-cell;">No of Order</th> 
                                        <th style="display: table-cell; text-align: center;">Address</th>  
                                        <th style="display: table-cell; text-align: center;">Option</th>  
                                    </tr>
                                </thead>
                                <tbody id="main_table_body"> 
                                    @php
                                        $sn = 1;
                                    @endphp
                                    @foreach($customers_list as $customers) 
                                    <tr id="row_id_{{$customers->id}}">
                                    <td>{{$sn++}}</td>
                                       <td>{{$customers->name}}</td>
                                       <td>{{$customers->email}}</td>
                                       <td>{{$customers->phone ?? ''}}</td>
                                       <td>{{$customers->get_user_order_count}}</td>
                                       <td>{{$customers->getShippingAddress->address ?? ''}}</td>
                                       <td>
                                       <a class="btn btn-soft-primary btn-icon btn-circle btn-sm ico_chnage" href="{{route('backend.customer.view', [$customers->id])}}" title="View">
                                           <i class="fa-regular fa-eye"></i>
                                          </a>
                                        </td>
                                         
                                    </tr> 
                                    @endforeach
                                </tbody>
                            </table>
                            <div id="my_pagination">
                                {{$customers_list->links('pagination::bootstrap-5')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
@section('javascript-section')
@if(Session::has('created'))
        <script> 
            Swal.fire({
            title: "Success!",
            text: "{{Session::get('created')}}",
            icon: "success",
            timer: 5000,
            });
        </script>
        @elseif(Session::has('stock_updated'))
        <script> 
            Swal.fire({
            title: "Success!",
            text: "{{Session::get('stock_updated')}}",
            icon: "success",
            timer: 5000,
            });
        </script>    
        @endif


        <script>
    $(document).on('click', '#delete_btn', function (){
        const id = $(this).val(); 
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) =>
        {
            if (result.isConfirmed){
                $.ajax({
                    url: "{{route('backend.stock.destroy')}}",
                    data: { 'id': id },
                    type: "GET",
                    success: function (response){
                        console.log(id);
                        Swal.fire({
                            title: "Deleted!",
                            text: "Stock has been deleted.",
                            icon: "success"
                        });
                        $("#row_id_" + id).hide();
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
            if (search_val === ''){
                $('#my_pagination').show();
            } else{ 
                $.ajax({
                    url: "{{route('backend.customer.search')}}",
                    method: "GET",
                    data: { 'search_val': search_val },
                    success: function (result){ 
                        console.log(result);
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