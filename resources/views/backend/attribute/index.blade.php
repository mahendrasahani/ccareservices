@extends('layouts/backend/main')
@section('main-section')


<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="top-set">
                <div class="container  mt-5">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="h3 mb-5">All Attributes</h1>
                        </div>
                            <div class="col-md-8">
                                <form action="">
                                    <div class="card" style="border: 1px solid #e7e6e6;">
                                        <div class="card-header" style="border-bottom: 1px solid #e7e6e6;">
                                            <h1 class="h5">Attributes</h1>
                                        </div>  
                                        <div class="card-body">
                                            @php if(isset($_GET['page'])){$page_number = $_GET['page'];}else{ $page_number = 1;} $count = $page_number * 10 - 9;  @endphp 
                                            <table class="table table-bordered mb-0">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Values</th>
                                                        <th>Actions</th>
                                                    </tr> 
                                                    @foreach($attribute_list as $attribute)
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>{{$count++}}</td>
                                                        <td>{{$attribute->name}}</td>
                                                        <td>
                                                            @foreach($attribute->attributeValues as $value)
                                                            <span class="badge badge-dark mb-1">{{$value->name}}</span> 
                                                            @endforeach
                                                        </td>
                                                        <td class="d-flex" style="border: 0;">
                                                            <a href="{{route('backend.attribute_value.index', [$attribute->id])}}"><i class="fa-solid fa-gear text-white set_1"></i></a>
                                                            <a href="{{route('backend.attribute.edit', [$attribute->id])}}"><i class="fa-regular fa-pen-to-square text-white edit_icon"></i></a>
                                                        </td>
                                                    </tr>
                                                    @endforeach 
                                                </tbody>
                                            </table>
                                            <div>{{$attribute_list->links('pagination::bootstrap-5')}}</div>
                                        </div>
                                    </div>
                                </form>
                                
                            </div>
                        <div class="col-md-4"> 
                                    <div class="card" style="border: 1px solid #e5e5e5;">
                                        <div class="card-header" style="border-bottom: 1px solid #e5e5e5;">
                                            <h5 class="mb-0 h6">Add new attribute</h5>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{route('backend.attribute.store')}}" method="POST">
                                                @csrf
                                                <div class="alert alert-info">
                                                    Attributes are non deletable. You can only add or edit.
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="name">Name</label>
                                                    <input type="text" placeholder="Name" id="name" name="name"
                                                        class="form-control" required>
                                                </div>
                                                <div class="form-group mb-3 text-right">
                                                    <button type="submit" class="btn btn-primary add-button">Update</button>
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
@endsection
@endsection