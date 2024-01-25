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
                        <tr>
                            <td><b>20230927-05154224</b> <br> <span>Jan 24,2024</span> </td>
                            <td><b>1 products</b> <br> <span>from 1 shops</span> </td>
                            <td><b>$186.11</b> </td>
                            <td><a href="{{route('frontend.user.view_product_detail.view')}}" class="discount-details-btn ">View Details</a> </td>
                        </tr>
                        <tr>
                            <td><b>20230927-05154224</b> <br> <span>Jan 24,2024</span> </td>
                            <td><b>1 products</b> <br> <span>from 1 shops</span> </td>
                            <td><b>$186.11</b> </td>
                            <td><a href="{{route('frontend.user.purchase_history.view')}}" class="discount-details-btn ">View Details</a> </td>
                        </tr>
                        <tr>
                            <td><b>20230927-05154224</b> <br> <span>Jan 24,2024</span> </td>
                            <td><b>1 products</b> <br> <span>from 1 shops</span> </td>
                            <td><b>$186.11</b> </td>
                            <td><a href="{{route('frontend.user.view_product_detail.view')}}" class="discount-details-btn ">View Details</a> </td>
                        </tr>
                        <tr>
                            <td><b>20230927-05154224</b> <br> <span>Jan 24,2024</span> </td>
                            <td><b>1 products</b> <br> <span>from 1 shops</span> </td>
                            <td><b>$186.11</b> </td>
                            <td><a href="{{route('frontend.user.view_product_detail.view')}}" class="discount-details-btn ">View Details</a> </td>
                        </tr>
                        <tr>
                            <td><b>20230927-05154224</b> <br> <span>Jan 24,2024</span> </td>
                            <td><b>1 products</b> <br> <span>from 1 shops</span> </td>
                            <td><b>$186.11</b> </td>
                            <td><a href="{{route('frontend.user.view_product_detail.view')}}" class="discount-details-btn ">View Details</a> </td>
                        </tr>
                        <tr>
                            <td><b>20230927-05154224</b> <br> <span>Jan 24,2024</span> </td>
                            <td><b>1 products</b> <br> <span>from 1 shops</span> </td>
                            <td><b>$186.11</b> </td>
                            <td><a href="{{route('frontend.user.view_product_detail.view')}}" class="discount-details-btn ">View Details</a> </td>
                        </tr>
                          
                    </table>
                </div>

              <div class="pagination mt-3  justify-content-end">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
              </div> 
            </section>


        </div>
    </div>
</section>


@endsection