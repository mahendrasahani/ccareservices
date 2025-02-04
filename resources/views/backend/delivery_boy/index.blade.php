@extends('layouts/backend/main')
@section('main-section') 

<div class="content-body">
            <div class="top-set">
                <div class="container  mt-5">
                    <div class="row">
                        <div class="col">
                           <h3 class="h4 pt-2"> All Delivery Boys</h3>
                        </div>
                        <div class="col text-right mb-3">
                            <a href="{{route('backend.delivery_boy.create')}}" class="btn btn-circle btn-info" style="background-color: #f5a100; border: none; border-radius: 50em;">
                                <span>Add New Delivery Boy</span>
                            </a>
                        </div>
                        <div class="col-md-12">
                            <div class="card" style="border: 1px solid #e8e8e8;">
                                <div class="card-header  d-flex align-items-center justify-content-between" style="border-bottom: 1px solid #e8e8e8;">
                                    <h5>Delivery Boys
                                    </h5>
                                    <div class="col-md-2">
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" id="search" name="search" placeholder="Search name">
                                </div>
                                </div>
                                </div>

                                
                                <div class="card-body">
                                   
                                        <table id="myTable" class="table aiz-table mb-0 footable footable-1 breakpoint-lg">
                                            <thead>
                                                <tr class="footable-header">
                                                    <th class="">#</th>
                                                    <th class="">Name</th>
                                                    <th class="">Email</th>
                                                    <th class="">Phone</th>
                                                    <th class="">Address</th>
                                                    <th>Father's Name</th>
                                                    <th>Aadhar No. </th>
                                                    
                                                    
                                                </tr>
                                            </thead>
            
                                            <tbody id="main_table_body">
                                                @php 
                                                    $sn = 1;
                                                @endphp
                                                @foreach($delivery_boy_list as $delivery_boy)
                                                <tr>
                                                    <td class="footable-first-visible" style="display: table-cell;">{{$sn++}}</td>
                                                    <td style="display: table-cell;">{{$delivery_boy->name}}</td>
                                                    <td style="display: table-cell;" class="">{{$delivery_boy->email}}</td>
                                                    <td style="display: table-cell;">+91-{{$delivery_boy->phone}}</td>
                                                    <td style="display: table-cell;" class=""> {{$delivery_boy->address ?? '-'}}</td>
                                                    <td class="" style="display: table-cell;">{{$delivery_boy->father_name ?? '-'}}</td>
                                                    <td class="" style="display: table-cell;">{{$delivery_boy->aadhar_number ?? '-'}}</td>
                                                    <td style="display: table-cell;">
                                                        <div class="dropdown vartical">
                                                            <a href="#" class="" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <span class="new-icon">  <i class="fa-solid fa-ellipsis-vertical"></i></span>
                                                            </a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                              <a class="dropdown-item" href="{{route('backend.delivery_boy.edit', [$delivery_boy->id])}}"> Edit</a> 
                                                            </div>
                                                          </div>
                                                    </td> 
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                         
                                    {{$delivery_boy_list->links('pagination::bootstrap-5')}}
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- #/ container -->
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
        @elseif(Session::has('updated'))
        <script> 
            Swal.fire({
            title: "Success!",
            text: "{{Session::get('updated')}}",
            icon: "success",
            timer: 5000,
            });
        </script>   
    @endif

        
<script>
    $(document).ready(function (){
        $(document).on('keydown', '#search', function (){
            const search_val = $(this).val();
            if (search_val === ''){
                $('#my_pagination').show();
            } else{ 
                $.ajax({
                    url: "{{route('backend.delivery_boy.search')}}",
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