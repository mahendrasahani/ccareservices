@extends('layouts/backend/main')
@section('main-section') 
<div class="content-body">
    <div class="top-set">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-3 mb-3"> 
                    <h3>Create Product Return</h3>
                </div>
            </div>
        </div>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card" style="border: 1px solid #e8e8e8;">
                            <div class="card-header" style="border-bottom: 1px solid #e8e8e8;">
                                <h4 class="mb-0 h6">Create Product Return</h4>
                            </div> 
                            <form enctype="multipart/form-data" action="{{route('backend.return.store')}}" method="POST">
                                @csrf
                                <div class="card-body"> 
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="order_id">Order Id<span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                    <select name="order_id" id="order_id" class="form-control" required >
                                            <option value="">Select</option>  
                                            @foreach($orders as $order)
                                            <option value="{{$order->id}}">{{$order->order_id}}</option> 
                                            @endforeach
                                    </select> 
                                    <input type="hidden" name="order_number" id="order_number">
                                    </div> 
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="date_of_purchase">Date of Purchase:</label>
                                    <div class="col-md-9">
                                        <input type="date" id="date_of_purchase" name="date_of_purchase" class="form-control" value=" " required>
                                    </div> 
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="customer_name">Customer Name<span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text"  name="name" id="name" class="form-control" >
                                        <input type="hidden"  name="user_id" id="user_id" class="form-control" >
                                    </div> 
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="customer_email">Customer Email<span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="email"  name="email" id="email" class="form-control" >
                                    </div> 
                                </div>
                                <div class="form-group row"> 
                                    <label class="col-md-3 col-form-label" for="customer_no">Phone no.<span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="tel"  name="phone" id="phone" class="form-control">
                                    </div> 
                                </div> 
                                </div>  
                                <div class="card" style="border: 1px solid #e8e8e8;">
                                <div class="card-header d-flex justify-content-between" style="border-bottom : 1px solid #e8e8e8;">
                                <h5 class="mb-0 pt-2">Product Information and Reason For Return</h5>
                            </div>
                            <div class="card-body"> 
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="product">Product Name<span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                    <select name="product" id="product" class="form-control" required >
                                            <option value="">Select</option>   
                                    </select> 
                                    <input type="hidden" name="product_name" id="product_name">
                                    <input type="hidden" name="stock_id" id="stock_id">
                                    </div> 
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="attribute">Attribute<span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" name="attribute" id="attribute" class="form-control" required> 
                                    </div> 
                                </div> 
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="attribute_value">Attribute Value<span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" name="attribute_value" id="attribute_value" class="form-control" required>
                                    </div> 
                                </div> 
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="product_quantity">Quantity:</label>
                                    <div class="col-md-9">
                                        <input type="number" name="quantity" id="quantity" class="form-control" required>
                                    </div> 
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="return_reason">Return Reason:</label>
                                    <div class="col-md-9">
                                        <input type="text" name="return_reson" id="return_reson" class="form-control" required>
                                    </div> 
                                </div>
                                <!-- <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Opened</label>
                                        <div class="col-md-9">
                                             <select class="form-control" name="select_variant_type">  
                                                    <option value=" " >Opened</option>   
                                                    <option value=" " >Closed</option>   
                                            </select> 
                                        </div>
                                    </div> -->
                               <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="comment">Comment:</label>
                                    <div class="col-md-9">
                                        <input type="text"   name="comment" id="comment" class="form-control"  required>
                                    </div> 
                                </div> 
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="action">Return Action:</label>
                                    <div class="col-md-9" >
                                          <select name="return_action" id="return_action" class="form-control">
                                            <option value="1">Inventory</option>
                                            <option value="0">Destroy</option>
                                          </select>
                                    </div> 
                                </div> 
                            </div>
                        </div>  
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12"> 
                                    <div class="text-end mb-3">
                                        <button class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                            </form>
                        </div>   
                </div>
            </div> 
        </div>
      </section>
    </div>
</div>  

@section('javascript-section')
    <script>
        $order_detail_api_url = "{{route('backend.return.order_detail')}}";
        $product_list_from_order_api_url = "{{route('backend.return.get_product_list_from_order')}}";
        $one_product_from_order_api_url = "{{route('backend.return.get_one_product_from_order')}}";
        $(document).on("change", "#order_id", async function(){
            let order_id = $(this).val();
            let orderResponse = await fetch($order_detail_api_url, {
                method:"POST",
                headers:{
                    'Content-Type':'application/json',
                    'Authorization':'Bearer 1|Tm9ARAVXh35wTxyL6tIjrMMb8yQXs7FkH5laTCJef22e300d'
                },
                body:JSON.stringify({order_id:order_id})
            }); 
            if(orderResponse.ok){
                let orderResponseData = await orderResponse.json();  
                $("#name").val(orderResponseData.order.shipping_name);
                $("#user_id").val(orderResponseData.order.user_id);
                $("#email").val(orderResponseData.order.shipping_email);
                $("#phone").val(orderResponseData.order.shipping_phone);
                $("#order_number").val(orderResponseData.order.order_id); 
                let createdAt = new Date(orderResponseData.order.created_at); 

                let year = createdAt.getFullYear();
                let month = String(createdAt.getMonth() + 1).padStart(2, '0');  
                let day = String(createdAt.getDate()).padStart(2, '0'); 
                let formattedDate = `${year}-${month}-${day}`; 
                $("#date_of_purchase").val(formattedDate);
               let productResponse = await fetch($product_list_from_order_api_url, {
                    method:"POST",
                    headers:{
                        'Content-Type':'application/json',
                        'Authorization':'Bearer 1|Tm9ARAVXh35wTxyL6tIjrMMb8yQXs7FkH5laTCJef22e300d'
                    },
                    body:JSON.stringify({order_id:orderResponseData.order.id})
               }); 
               let productResponseData = await productResponse.json(); 
               let product_list = '<option value="">Select Product</option>';
               productResponseData.order_product.forEach(item =>{
               product_list += `<option value="${item.product_id}">${item.product_name}</option>`;
               }); 
               $("#product").html(product_list);  
               $("#attribute").val('');
            $("#attribute_value").val('');
            }else{
                console.log('Somethig went wrong!');
            } 
        }); 

            $(document).on("change", "#product", async function(){
                let order_product = $("#order_id").val();  
                let product_id = $("#product").val();  
                let oneProductResponse = await fetch($one_product_from_order_api_url, {
                    method:"POST",
                    headers:{
                        "Content-Type" : "application/json",
                        "Authorization" : "Bearer 1|Tm9ARAVXh35wTxyL6tIjrMMb8yQXs7FkH5laTCJef22e300d"
                    },
                    body:JSON.stringify({order_product:order_product, product_id:product_id})
            });
            let oneProductResponseData = await oneProductResponse.json(); 
            $("#product_name").val(oneProductResponseData.single_order_product.product_name);
            $("#attribute").val(oneProductResponseData.single_order_product.option_id);
            $("#attribute_value").val(oneProductResponseData.single_order_product.option_value_id);
            $("#quantity").val(oneProductResponseData.single_order_product.quantity);
            $("#stock_id").val(oneProductResponseData.single_order_product.stock_id);

            });
    </script>
@endsection

@endsection