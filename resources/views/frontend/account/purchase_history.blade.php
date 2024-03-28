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
                            <th>Details</th>
                            <th>Info</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </tr>
                        @if(count($purchase_history) != 0)
                        @foreach($purchase_history as $p_history)
                        <tr>
                            <td><b>Order No. {{$p_history->order_id}}</b></td>
                            <td><b>{{count($p_history->getOrderProduct)}} products</b></td>
                            <td><b>₹{{number_format($p_history->total - $p_history->promo_discount, 2)}}/-</b> </td>
                            <td><a href="{{route('frontend.user.view_order_detail', [Crypt::encryptString($p_history->id)])}}" class="discount-details-btn ">View Details</a> </td>
                        </tr>
                        @endforeach 
                        @endif
                    </table>
                </div> 
            </section> 
        </div>
    </div>
</section>


@endsection