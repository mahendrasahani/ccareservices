@extends('layouts/frontend/main')
@section('main-section')

<style>
    table {
        width: 100%;
        border: 1px solid #ddd;
    }

    th,
    td {
        padding: 10px;
        text-align: center;
    }

    th {
        background-color: #f2f2f2;
    }

    tr {
        border-bottom: 1px solid #ddd;
    }

    .discount-details .discount-details-btn {
        background-color: #01316b;
        color: white;
        border: none;
        padding: 5px 18px;
        border-radius: 0;
        font-size: 12px;
        text-decoration: none;
    }

    .discount-details .discount-details-btn:hover {
        background-color: #02b8df;
    }
    .pagination li a{
        color: #01316b;
    }
</style>

<section class="dahboard-wrapper">
    <div class="container">
        <div class="row">
            
        @include('layouts/frontend/sidebar')

             


        </div>
    </div>
</section>


@endsection