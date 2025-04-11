@extends('layouts/frontend/main')
@section('main-section')
 

<section class="dahboard-wrapper">
    <div class="container">
        <div class="row">
            
        @include('layouts/frontend/sidebar')

            <section class="discount-wrapper col-md-9">
                <div class="dashboard-heading">
                    <h3>Purchase History</h3>
                </div>
                <div class="discount-details">
    <table class="table-container">
        <tr>
            <th>Serial No.</th>
            <th>Ordre No</th>
            <th>Info</th>
            <th>Amount</th>
            <th>Action</th>
        </tr>
        @if(count($purchase_history) != 0)
        @php $serialNo = 1; @endphp        
        @foreach($purchase_history as $p_history)
        <tr>
            <td> {{ $serialNo++ }} </td> 
            <td> {{$p_history->order_id}} </td>
            <td> {{count($p_history->getOrderProduct)}} products </td>
            <td> ₹{{number_format($p_history->total - $p_history->promo_discount, 2)}}/-  </td>
            <td><a href="{{route('frontend.user.view_order_detail', [Crypt::encryptString($p_history->id)])}}" class="discount-details-btn ">View Details</a> </td>
        </tr>
        @endforeach 
        @endif
    </table> 
</div>
        <div class="my_pagination">
        {{$purchase_history->links('pagination::bootstrap-5')}}
        </div> 
            </section> 
        </div>
    </div>
</section>


@endsection