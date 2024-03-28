@extends('layouts/backend/main')
@section('main-section')
 
<div class="content-body">
    <div class="top-set">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-3 mb-3">
                    <h3>Edit Stock</h3>
                </div>
            </div>
        </div>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card" style="border: 1px solid #e8e8e8;">
                            <div class="card-header" style="border-bottom: 1px solid #e8e8e8;">
                                <h4 class="mb-0 h6">Edit Stock Information</h4>
                            </div>
                         
                            <form enctype="multipart/form-data" action="{{route('backend.stock.update', [$stock->id])}}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Select Product<span class="text-danger">*</span> </label>
                                        <div class="col-md-9">
                                             <select id="select_product" class="form-control" name="product">
                                                @foreach($product_list as $product)
                                                    <option value="{{$product->id}}" {{$stock->product_id == $product->id ? 'selected':''}}>{{$product->product_name}}</option> 
                                                    @endforeach
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Select Option <span class="text-danger">*</span> </label>
                                        <div class="col-md-9">
                                             <select id="select_variant_type" class="form-control" name="select_variant_type">
                                                @foreach($variant_type as $variant)
                                                    <option value="{{$variant->id}}" {{$stock->attribute_id == $variant->id ? 'selected':''}}>{{$variant->name}}</option> 
                                                    @endforeach
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Select Option Value<span class="text-danger">*</span> </label>
                                        <div class="col-md-9">
                                             <select id="select_option_value" name="select_option_value" class="form-control">
                                                @foreach($variant_value as $value)
                                                    <option value="{{$value->id}}" {{$stock->attribute_value_id == $value->id ? 'selected':''}}>{{$value->name}}</option> 
                                                    @endforeach
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Quantity<span class="text-danger">*</span> </label>
                                        <div class="col-md-9">
                                             <input type="number" id="stock_quantity" name="quantity" value="{{$stock->quantity}}" class="form-control" min="0">
                                            <span id="productNameError" class="formFiedllerror"></span>
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Price<span class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="month">
                                                            <div class="price">
                                                            <input type="text" class="form-control" style="width:100%" name="month[]" disabled value="1" id="month_1"> 
                                                            <input type="number" min="0" style="width:100%" class="form-control" id="modal_price_1" name="price_1" value="{{$stock->price_1}}" required>
                                                            </div> 

                                                            <div class="price">
                                                            <input type="text" class="form-control" style="width:100%" name="month[]" disabled value="2" id="month_2"> 
                                                            <input type="number" min="0" style="width:100%" class="form-control" id="modal_price_2" name="price_2" value="{{$stock->price_2}}" required>
                                                            </div> 

                                                            
                                                            <div class="price">
                                                            <input type="text" class="form-control" style="width:100%" name="month[]" disabled value="3" id="month_3"> 
                                                            <input type="number" min="0" style="width:100%" class="form-control" id="modal_price_3" name="price_3" value="{{$stock->price_3}}" required>        
                                                             </div> 
                                                            
                                                            <div class="price">
                                                            <input type="text" class="form-control" style="width:100%" name="month[]" disabled value="4" id="month_4"> 
                                                            <input type="number" min="0" style="width:100%" class="form-control" id="modal_price_4" name="price_4" value="{{$stock->price_4}}" required> 
                                                             </div> 

                                                            <div class="price">
                                                            <input type="text" class="form-control" style="width:100%" name="month[]" disabled value="5" id="month_5"> 
                                                            <input type="number" min="0" style="width:100%" class="form-control" id="modal_price_5" name="price_5" value="{{$stock->price_5}}" required> 
                                                             </div> 

                                                            <div class="price">
                                                            <input type="text" class="form-control" style="width:100%" name="month[]" disabled value="6" id="month_6">  
                                                            <input type="number" min="0" style="width:100%" class="form-control" id="modal_price_6" name="price_6" value="{{$stock->price_6}}" required> 
                                                             </div> 
                                                        </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="month">
                                                                <div class="price">
                                                                <input type="text" class="form-control" style="width:100%" name="month[]" disabled value="7" id="month_7"> 
                                                                <input type="number" min="0" style="width:100%" class="form-control" id="modal_price_7" name="price_7" value="{{$stock->price_7}}" required>
                                                                </div> 

                                                                <div class="price">
                                                                <input type="text" class="form-control" style="width:100%" name="month[]" disabled value="8" id="month_8"> 
                                                                <input type="number" min="0" style="width:100%" class="form-control" id="modal_price_8" name="price_8" value="{{$stock->price_8}}" required>
                                                                </div> 

                                                                <div class="price">
                                                                <input type="text" class="form-control" style="width:100%" name="month[]" disabled value="9" id="month_9"> 
                                                                <input type="number" min="0" style="width:100%" class="form-control" id="modal_price_9" name="price_9" value="{{$stock->price_9}}" required>
                                                                </div> 

                                                                <div class="price">
                                                                <input type="text" class="form-control" style="width:100%" name="month[]" disabled value="10" id="month_10"> 
                                                                <input type="number" min="0" style="width:100%" class="form-control" id="modal_price_10" name="price_10" value="{{$stock->price_10}}" required>
                                                                </div> 

                                                                <div class="price">
                                                                <input type="text" class="form-control" style="width:100%" name="month[]" disabled value="11" id="month_11"> 
                                                                <input type="number" min="0" style="width:100%" class="form-control" id="modal_price_11" name="price_11" value="{{$stock->price_11}}" required> 
                                                                </div> 

                                                                <div class="price">
                                                                <input type="text" class="form-control" style="width:100%" name="month[]" disabled value="12" id="month_12">  
                                                                <input type="number" min="0" style="width:100%" class="form-control" id="modal_price_12" name="price_12" value="{{$stock->price_12}}" required> 
                                                                </div> 
                                                       </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>  
                                </div> 

                                <div class="card" style="border: 1px solid #e8e8e8;">
                            <div class="card-header d-flex justify-content-between"
                                style="border-bottom : 1px solid #e8e8e8;">
                                <h5 class="mb-0 pt-2">Inventory</h5>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-info">Inventory Option</div>  
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="vendor_name">Vendor Name:</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="vendor_name" required>
                                            <option value="">--Select--</option> 
                                            @foreach($vendor_list as $vendor)
                                                <option value="{{$vendor->id}}" {{$stock->vendor_id == $vendor  ->id ? 'selected':''}}>{{$vendor->name}}</option> 
                                            @endforeach
                                        </select>
                                    </div> 
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="date_of_purchase">Date of Purchase:</label>
                                    <div class="col-md-9">
                                        <input type="date" id="date_of_purchase" name="date_of_purchase" class="form-control" value="{{$stock->date_of_purchase}}" required>
                                    </div> 
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="purchase_amount">Purchase Amount:</label>
                                    <div class="col-md-9">
                                         <input type="number" id="purchase_amount" name="purchase_amount" class="form-control" value="{{$stock->purchase_amount}}" required>
                                    </div> 
                                </div> 
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="invoice_number">Invoice Number</label>
                                    <div class="col-md-9">
                                         <input type="text" id="invoice_number" name="invoice_number" class="form-control" value="{{$stock->invoice_no}}" required>
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
 async function selectVariantType(){
    let select_variant_type = $('#select_variant_type').val(); 
    let variant_list = await fetch("{{route('backend.stock.get_variant_value_list')}}?variant_id="+select_variant_type, )
    let response = await variant_list.json();    
    let html_to_append = '<option value="">--Select Variant Value--</option>';
    if(response.status === 200 && response.message === "success"){
        response.data.forEach(function(item){
            html_to_append += `<option value="${item.id}">${item.name}</option>`;
        });
        $("#select_option_value").html(html_to_append); 
    } 
 } 
 $(document).on("change", "#select_variant_type", selectVariantType); 
</script>
@endsection

@endsection