@extends('layouts/backend/main')
@section('main-section') 
        <div class="content-body">
            <div class="top-set">
                <div class="container mt-5">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="h3 mb-5">All Values</h1>
                        </div>
                            <div class="col-md-8">
                                <form action="">
                                    <div class="card" style="border: 1px solid #dfdfdf;">
                                        <div class="card-header" style=" border-bottom: 1px solid #dfdfdf;">
                                    
                                        <h3 class="h5"> {{$attribute_detail->name}}</h3> 
                                       
                                        
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-bordered mb-0">
                                            @php if(isset($_GET['page'])){$page_number = $_GET['page'];}else{ $page_number = 1;} $count = $page_number * 10 - 9;  @endphp 
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Attribute Value</th>
                                                        <th>Attribute</th>
                                                        <th>Sort Order</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody> 
                                                @foreach($attribute_value_list as $value)
                                                    <tr>
                                                        <td>{{$count++}}</td>
                                                        <td>{{$value->attribute->name}}</td>
                                                        <td>{{$value->name}}</td>
                                                        <td>{{$value->sort_order}}</td>
                                                        <td >
                                                            <a href="{{route('backend.attribute_value.edit', [$value->id])}}"><i class="fa-regular fa-pen-to-square edit_icon text-white"></i></a>
                                                        </td>
                                                    </tr>
                                                    @endforeach 
                                                </tbody> 
                                            </table>
                                            <div>{{$attribute_value_list->links('pagination::bootstrap-5')}}</div>
                                            
                                        </div>
                                    </div>
                                </form>
                                
                            </div>
                        <div class="col-md-4">
                            <div class="row">
                               
                                    <div class="card" style="border: 1px solid #e5e5e5;">
                                        <div class="card-header" style="border-bottom: 1px solid #e5e5e5;">
                                            <h5 class="mb-0 h6">Add New Values
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{route('backend.attribute_value.store')}}" method="POST"> 
                                                @csrf
                                                <div class="alert alert-info">
                                                    Attribute values are non-deletable. You can only add or edit.
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="name">Attribute</label>
                                                    <input type="hidden" name="attribute_id" class="form-control" value="{{$attribute_detail->id}}" readonly> 
                                                    <div class="form-control" readonly>{{$attribute_detail->name}}</div>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="name">Attribute Value Name</label>
                                                    <input type="text" placeholder="Attribute Value" id="attribute_value" name="attribute_value" class="form-control" required>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="name">Sort Order</label>
                                                    <input type="number" placeholder="Sort Order" id="sort_order" name="sort_order" class="form-control" value="0" required>
                                                </div>
                                                <div class="form-group mb-3 text-right">
                                                    <button type="submit" class="btn btn-primary">Add</button>
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
@endsection
@endsection