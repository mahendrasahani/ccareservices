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
<!------------------------------------------------------Cart checkout-------------------------- -->
@if($cart_product != '')
<section class="">  
  <div class="container"> 
    <div class="row d-flex justify-content-center my-4">
      <div class="col-md-12">
        <div class="card mb-4">
          <div class="card-header py-3">
            <h5 class="mb-0">Cart - {{$cart_product == '' ? 0:count($cart_product)}} items</h5>
          </div>
          <div class="card-body"> 
              <table class="table aiz-table mb-0 footable footable-1 breakpoint-lg">
                <thead>
                  <tr class="cart_table">
                    <th class="footable-first-visible">Product Image</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Month</th>
                    <th>Quantity</th>
                    <th class="text-right">Subtotal</th>
                  </tr>
                </thead>
                <tbody>
                  @if(Auth::check())
                  @php
                  $final_price = 0;
                  @endphp
                  @foreach($cart_product as $product)
                  @php
                  $final_price += $product->price * $product->quantity;
                  @endphp
                  <tr class="cart_table">
                    <td class="footable-first-visible">
                      <a href="{{route('frontend.product.single_product', [$product->getProduct->slug])}}" target="_blank"> 
                          <div class="cart_img_wrap">
                          <img src="{{$product->getProduct->product_images == '' ? url('public/assets/both/placeholder/product.jpg') : url('public/'.$product->getProduct->product_images[0])}}" alt="">  
                        </div>
                      </a>
                    </td> 
                    <td>
                      <a href="{{route('frontend.product.single_product', [$product->getProduct->slug])}}" target="_blank" class="product-name-default">{{$product->getProduct->product_name}}</a>
                    </td>
                    <td> ₹ {{number_format($product->price, 2)}}/- </td>
                    <td>{{$product->month}} Month </td>
                    <td>
                       {{$product->quantity}}
                    </td> 
                    <td>₹ {{number_format($product->price * $product->quantity, 2)}}/- <br><button class="remover_cart" id="remove_cart_item" data-product_id="{{$product->product_id}}" onclick="deleteProduct()">Delete</button></td>
                  </tr>
                  @endforeach

                  @else
                  @php
                  $final_price = 0;
                  @endphp
                  @if($cart_product != null)
                  @foreach($cart_product as $product) 
                  @php
                   $final_price += $product['price'] * $product['quantity'];
                  $product_detail = App\Models\Backend\Product::where('id', $product['product_id'])->first();
                  @endphp
                  <tr class="cart_table">
                    <td class="footable-first-visible">
                      <a href="{{route('frontend.product.single_product', [Str::slug($product_detail->product_name)])}}" target="_blank">
                        <div>
                        <img src="{{$product_detail->product_images == '' ? url('public/assets/both/placeholder/product.jpg') : url('public/'.$product_detail->product_images[0])}}" alt="" style="width: 204px">  
                        </div>
                      </a>
                    </td>
                    <td>
                      <a href="{{route('frontend.product.single_product', [Str::slug($product_detail->product_name)])}}" target="_blank" class="product-name-default">{{$product_detail->product_name}}</a>
                    </td>
                    <td>₹ {{number_format($product['price'], 2)}}/-</td>
                    <td>{{$product['month']}} Month</td>
                    <td>
                      <div class="col-lg-4">
                        <input type="number" min="0" step="1" class="form-control" name="commisson_amounts_2" value="{{$product['quantity']}}">
                      </div>
                    </td>
                    <td>₹ {{number_format($product['price'] * $product['quantity'], 2)}}/- <br><button class="remover_cart" id="remove_cart_item" data-product_id="{{$product['product_id']}}" onclick="deleteProduct()">Delete</button></td>
                  </tr>
                  @endforeach
                  @endif
                  @endif


                </tbody>
              </table>
              <br>
              <!-- <div class="col-md-12">
                <div class="row"> 
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
                    </div> --> 
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
           
            @if(Auth::check())
            <ul class="list-group list-group-flush">
              <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                Products
                <span>₹ {{number_format($final_price, 2)}}/-</span>
              </li>
              <!-- <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                Shipping <span>₹ {{number_format(50, 2)}}/-</span>
              </li> -->
              <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                <div>
                  <strong>Total amount</strong>
                  <!-- <strong>
                    <p class="mb-0">(including VAT)</p>
                  </strong> -->
                </div>
                <span><strong>₹ {{number_format($final_price, 2)}}/-</strong></span>
              </li>
            </ul>
            @else
            <ul class="list-group list-group-flush">
              <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                Products
                <span>₹ {{number_format($final_price, 2)}}/-</span>
              </li>
              <!-- <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                Shipping <span>₹ {{number_format(50, 2)}}/-</span>
              </li> -->
              <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                <div>
                  <strong>Total amount</strong>
                  <!-- <strong>
                    <p class="mb-0">(including VAT)</p>
                  </strong> -->
                </div>
                <span><strong>₹ {{number_format($final_price, 2)}}/-</strong></span>
              </li>
            </ul> 
            @endif

            <a href="{{route('frontend.checkout.view')}}" class="btn btn-checkout btn-primary  "
              style="background-color: #213854; border: none;">
              Go to checkout
            </a>

          </div>
        </div>
      </div>
    </div>
    

      </div>
    </div>
    
  </div>
</section>
@else

<div class="container mt-5">
  <div class="row">
    <div class="card p-5">
      <h3 class="text-center">Your cart is empty</h3>
    </div> 
  </div>
</div>


@endif
@section('javascript-section')
<script>
  function deleteProduct(){
    setTimeout(function(){
      window.location.reload();
    },50);
  }
</script>
@endsection


@endsection