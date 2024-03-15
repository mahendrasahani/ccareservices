@extends('layouts/backend/main')
@section('main-section')
        <div class="content-body">
            <div class="top-set">
                <div class="container">
                    <div class="row mt-5 mb-3" style="padding: 0px 15px 0px 14px;">
                        <div class="col-md-6">
                            <h4 class="pt-4">All Shipping Charges</h4>
                        </div>
                    </div>
                    <div class="row" style=" padding: 0px 15px 0px 16px;">
                        <div class="col-md-7">
                            <div class="card" style="border: 1px solid #e5e5e5;">
                                <div class="card-header d-flex" style="border-bottom: 1px solid #e5e5e5;">
                                <div class="col text-center text-md-left">
                                    <h5 class="mb-md-0 h6">Shipping Charges</h5>
                                </div>
    
                                <!-- <div class="">
                                    <div class="input-group enter">
                                        <input type="text" class="form-control form-control-sm" id="search" name="search"
                                            placeholder="Search by name">
                                    </div>
                                </div> -->
                            </div>
                            <div class="card-body">
                                <table id="myTable" class="table aiz-table mb-0 footable footable-1 breakpoint-lg">
                                    <thead>
                                        <tr class="footable-header">
                                            <th class="col-xl-2">#</th>
                                            <th>Name</th>
                                            <th class="text-center">Amount</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-right">Options</th>
                                        </tr>
                                    </thead>
                                    @php 
                                        $i = 1;
                                    @endphp
                                    @foreach($shipping_charges as $charges)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$charges->name}}</td>
                                            <td>Rs. {{ number_format($charges->amount, 2)}}/-</td>
                                            <td>
                                            <label class="switch">
                                                <input type="checkbox" {{$charges->status == 1 ? 'checked':''}}
                                                id="shipping_charge_status" name="shipping_charge_status"
                                                value="{{$charges->status}}" data-id="{{$charges->id}}">
                                                <span class="slider"></span></label>
                                            </td>
                                            <td>  
                                                @if($charges->id != 1)
                                                <a class="btn btn-soft-info btn-icon btn-circle btn-sm eye-2" href="{{route('backend.shipping_charge.edit', [$charges->id])}}" title="Edit"> <i class="fa-regular fa-pen-to-square text-white"></i></a>
                                                <button value="{{$charges->id}}" class="btn btn-icon btn-sm delete_ico " id="delete_btn"> <i class="fa-solid fa-trash-can"></i></button>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div>
                           {{--     {{$brand_list->links('pagination::bootstrap-5')}} --}}
                                </div>
                            </div>
                            </div>
                            
                        </div>
                        <div class="col-md-5">
                            <div class="row">
                                <div class="card" style="border: 1px solid #e5e5e5;">
                                    <div class="card-header" style="border-bottom: 1px solid #e5e5e5;">
                                        <h5 class="mb-0">Add New Shipping Method</h5>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{route('backend.shipping_charge.store')}}" method="POST" id="shipping_method_form">
                                            @csrf 
                                            <div class="form-group mb-3">
                                                <label for="name">Name</label>
                                                <input type="text" placeholder="Enter shipping method name" id="name" name="name" class="form-control" required>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="name">Amount</label> 
                                                <input type="number" class="form-control" name="amount" class="selected-files"> 
                                            </div>
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
        </div>
        @section('javascript-section')
        @if(Session::has('added'))
        <script> 
            Swal.fire({
            title: "Success!",
            text: "{{Session::get('added')}}",
            icon: "success",
            timer: 5000,
            });
        </script>
        @elseif(Session::has('shipping_charge'))
        <script> 
            Swal.fire({
            title: "Sorry!",
            text: "{{Session::get('shipping_charge')}}",
            icon: "warning",
            timer: 5000,
            });
        </script>   
        @elseif(Session::has('updated'))
        <script> 
            Swal.fire({
            title: "Success",
            text: "{{Session::get('updated')}}",
            icon: "success",
            timer: 5000,
            });
        </script> 
           @elseif(Session::has('deleted'))
        <script> 
            Swal.fire({
            title: "Success",
            text: "{{Session::get('deleted')}}",
            icon: "success",
            timer: 5000,
            });
        </script> 
        @endif

        <script>
              // delete category reques
    $(document).on('click', '#delete_btn', function (){
      var id = $(this).val();
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
            url: "{{route('backend.shipping_charge.destroy')}}",
            method: "GET",
            data: {id:id},
            success: function (response){ 
                Swal.fire({
                title: "Deleted!",
                text: "You have delete successfully!",
                icon: "success"
                }).then(function ()
                {
                  window.location.reload();
                }); 
            }
        });

            }
        });
    }); 
</script>
 
<script>
    $(document).on('change', '#shipping_charge_status', function (){
        var $toggleButton = $(this);
        var status = $toggleButton.prop('checked') ? '1' : '0';
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('backend.shipping_charge.change_status')}}",
            data: { 'shipping_charge_status': status, 'shipping_charge_id': id },
            type: "GET",
            success: function (response){
                if (response.status == 200){
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

        @endsection
@endsection