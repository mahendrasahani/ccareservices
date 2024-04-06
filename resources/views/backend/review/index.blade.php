@extends('layouts/backend/main')
@section('main-section')  
<div class="content-body">
            <div class="top-set">
                <div class="container">
                    <div class="row mt-5 mb-3">
                        <div class="col-md-6">
                            <h4 class="pt-4"> Product Reviews</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card" style="border: 1px solid #e5e5e5;">
                                <div class="card-header d-flex" style="border-bottom: 1px solid #e5e5e5;">
                                <div class="col text-center text-md-left">
                                    <h4 class="mb-md-0 h5">Product Reviews</h4>
                                </div>
    
                                <div class="col-md-2">
                                    <div class="input-group enter">
                                        <input type="text" class="form-control form-control-sm" id="search" name="search"
                                            placeholder="Type Email or name &; Enter">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                    @php
                                    $sn = 1;
                                    @endphp
                                    <table id="myTable" class="table table-bordered mb-0">
                                        <thead>
                                            <tr> 
                                                <th class="col-xl-2">#</th>
                                                <th>Product</th>
                                                <th>Customer</th>
                                                <th>Rating</th>
                                                <th>Comment</th> 
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($reviews) > 0)
                                            @foreach($reviews as $review)
                                            <tr>
                                                 
                                                <td>{{$sn++}}</td>
                                                <td>
                                                     <p>{{$review->getProduct->product_name}}</p>
                                                </td>
                                                <td class="lh-1-8">
                                                    <span class="d-block">Name: {{$review->getUser->name ?? ''}}</span>
                                                    <span class="d-block">Email: {{$review->getUser->email ?? ''}}</span>
                                                    <span class="d-block">Phone: {{$review->getUser->phone ?? ''}}</span>
                                                    
                                                </td>
                                                <td>
                                                <div>
                                                   <span class="rating rating-sm my-2">
                                                        <i class="fa fa-star {{$review->rating >= 1?'c_yellow':''}}"></i>
                                                        <i class="fa-solid fa-star {{$review->rating >= 2?'c_yellow':''}}"></i>
                                                        <i class="fa-solid fa-star {{$review->rating >= 3?'c_yellow':''}}"></i>
                                                        <i class="fa-solid fa-star {{$review->rating >= 4?'c_yellow':''}}"></i>
                                                        <i class="fa-solid fa-star {{$review->rating >= 5?'c_yellow':''}}"></i>
                                                    </span>
                                                </div>
                                                </td>
                                                <td>
                                                    <p>{{$review->comment}}</p>
                                                </td>
                                                 
                                                <td>
                                                    <div class=" custom-switch ">
                                                        <label class="switch"> <input type="checkbox" name="status" id="status" data-id="{{$review->id}}" value="{{$review->status}}" {{$review->status == 1 ? 'checked':''}}> <span class="slider"></span> </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @else
                                            <p>No Review</p>
                                            @endif
                                        </tbody>
                                    </table>
                                     
                                {{$reviews->links('pagination::bootstrap-5')}}
                                
                            </div>
                            </div>
                        </div>
                    </div>
            <!-- #/ container -->
                 </div>
            </div>
            

            
            <!-- #/ container -->
        </div>

@section('javascript-section')
 <script>
    const updateStatusRoute = "{{ route('backend.review.update_status') }}";
$(document).on("change", "#status", async function(){ 
    var $toggleButton = $(this);
        var status = $toggleButton.prop('checked') ? '1' : '0';
        let review_id = $(this).data('id');
        let data = { 'status': status, 'review_id':review_id};
        try {
            const response = await fetch(updateStatusRoute, {
                method: 'POST',
                headers:{
                    'Content-Type':'application/json', 
                    'Authorization': 'Bearer 1|Tm9ARAVXh35wTxyL6tIjrMMb8yQXs7FkH5laTCJef22e300d',
                },
                body: JSON.stringify(data)
            }); 
            if(!response.ok){
                throw new Error('Network response was not ok');
            }
            const responseData = await response.json();
            Swal.fire({
                        title: "Success!",
                        text: "Status successfully updated.",
                        icon: "success"
                    }); 
        }catch (error) {
        console.error('There was a problem with the fetch operation:', error);
        throw error;
    } 
    }); 
</script>

@endsection
@endsection