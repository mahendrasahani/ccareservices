@extends('layouts/frontend/main')
@section('main-section') 

 
<section id="banner-image">
  <!-- breadcrumb strat -->
  <div class="container">
    <div class="row">
      <div class="col-md-12 mt-2">
        <h2 class=" text-white pb-2 pt-5 text-center">Cart</h2>
        <nav aria-label="breadcrumb" style="margin: 0 auto;">
          <ol class="breadcrumb d-flex justify-content-center">
            <li class="breadcrumb-item"><a href="#" class="text-white">Home</a></li>
            <li class="breadcrumb-item active pt-1" aria-current="page" style="color: #01b7e0; font-size: 14px;">Cart
            </li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <!-- breadcrumb end -->
</section>
<!----------------------------------------------------- -Cart checkout-------------------------- -->
<section class=" ">
  <div class="container">
    <div class="row d-flex justify-content-center my-4">
      <div class="col-md-12">
        <div class="card mb-4">
          <div class="card-header py-3">
            <h5 class="mb-0">Cart - 1 items</h5>
          </div>
          <div class="card-body">
            <form class="">
              <table class="table aiz-table mb-0 footable footable-1 breakpoint-lg">
                <thead>
                  <tr class="">
                    <th class="footable-first-visible">Product Image</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th class="text-right">Subtotal</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="footable-first-visible">
                      <a href="#" target="_blank">
                        <div>
                          <img src="{{url('public/assets/frontend/images/categry/banner21.jpg')}}" alt=""
                            style="width: 204px">
                        </div>
                      </a>
                    </td>
                    <td>
                      <a href="single-product.html" target="_blank" class="product-name-default">
                        2 Ton Window Ac On Rent
                      </a>
                    </td>
                    <td>
                      Rs. 16000
                    </td>
                    <td>
                      <div class="col-lg-4">
                        <input type="number" min="0" step="1" class="form-control" name="commisson_amounts_2" value="0">
                      </div>
                    </td>
                    <td>
                      Rs. 16000
                    </td>
                  </tr>
                </tbody>
              </table>
              <br>
              <div class="col-md-12">
                <div class="row">
                  <form>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <div class="col-md-3">
                          <input type="text" name="coupon" placeholder="Coupon Code">
                        </div>
                        <div class="col-md-5">
                          <button type="button" class="btn btn-submit btn-primary btn-md"
                            style="background-color: #213854; border: none;">Apply coupon</button>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                      <button type="button" class="btn btn-submit btn-primary btn-md"
                        style="background-color: #213854; border: none;">Update cart</button>
                    </div>
                  </form>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="row"> 
      <div class="col-md-6">
        <div class="card ">
          <div class="card-header py-3">
            <h5 class="mb-0">Cart totals</h5>
          </div>
          <div class="card-body">
            <ul class="list-group list-group-flush">
              <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                Products
                <span>₹16000</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                Shipping
                <span>₹50</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                <div>
                  <strong>Total amount</strong>
                  <strong>
                    <p class="mb-0">(including VAT)</p>
                  </strong>
                </div>
                <span><strong>₹16050</strong></span>
              </li>
            </ul>

            <a href="{{route('frontend.checkout.view')}}" class="btn btn-checkout btn-primary  "
              style="background-color: #213854; border: none;">
              Go to checkout
            </a>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection