@extends('layouts/backend/main')
@section('main-section')
 
<div class="content-body">
    <div class="top-set">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-3 mb-3">
                    <h3>Add new Stock</h3>
                </div>
            </div>
        </div>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card" style="border: 1px solid #e8e8e8;"> 
                            <div class="card-header" style="border-bottom: 1px solid #e8e8e8;">
                                <h4 class="mb-0 h6">Stock Information</h4>
                            </div>
                         
                            <form enctype="multipart/form-data" action="{{route('backend.stock.store')}}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Select Product<span class="text-danger">*</span> </label>
                                        <div class="col-md-9">
                                             <select id="select_product" class="form-control" name="product" required>
                                             <option value="">--Select Product--</option>  
                                                @foreach($product_list as $product)
                                                    <option value="{{$product->id}}">{{$product->product_name}}</option> 
                                                    @endforeach
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Select Variant Type <span class="text-danger">*</span> </label>
                                        <div class="col-md-9">
                                             <select id="select_variant_type" class="form-control" name="select_variant_type" required>
                                                    <option value="">--Select Variant Type--</option> 
                                                    @foreach($variant_type as $variant)
                                                    <option value="{{$variant->id}}">{{$variant->name}}</option> 
                                                    @endforeach
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Select Variant Value<span class="text-danger">*</span> </label>
                                        <div class="col-md-9">
                                             <select id="select_option_value" class="form-control" name="select_option_value" required>
                                                    <option value="">--Select Variant Value--</option> 
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Quantity<span class="text-danger">*</span> </label>
                                        <div class="col-md-9">
                                             <input type="number" id="quantity" name="quantity" class="form-control" min="0" placeholder="Stock quantity" required> 
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Price<span class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="month">
                                                            <div class="price">
                                                            <input type="text" class="form-control" style="width:100%" name="month_1" disabled value="1" id="month_1"> 
                                                            <input type="number" min="0" style="width:100%" class="form-control" id="price_1" name="price_1" required>
                                                            </div> 

                                                            <div class="price">
                                                            <input type="text" class="form-control" style="width:100%" name="month_2" disabled value="2" id="month_2"> 
                                                            <input type="number" min="0" style="width:100%" class="form-control" id="price_2" name="price_2" required>
                                                            </div> 

                                                            
                                                            <div class="price">
                                                            <input type="text" class="form-control" style="width:100%" name="month_3" disabled value="3" id="month_3"> 
                                                            <input type="number" min="0" style="width:100%" class="form-control" id="price_3" name="price_3" required>        
                                                             </div> 
                                                            
                                                            <div class="price">
                                                            <input type="text" class="form-control" style="width:100%" name="month_4" disabled value="4" id="month_4"> 
                                                            <input type="number" min="0" style="width:100%" class="form-control" id="price_4" name="price_4" required> 
                                                             </div> 

                                                            <div class="price">
                                                            <input type="text" class="form-control" style="width:100%" name="month_5" disabled value="5" id="month_5"> 
                                                            <input type="number" min="0" style="width:100%" class="form-control" id="price_5" name="price_5" required> 
                                                             </div> 

                                                            <div class="price">
                                                            <input type="text" class="form-control" style="width:100%" name="month_6" disabled value="6" id="month_6">  
                                                            <input type="number" min="0" style="width:100%" class="form-control" id="price_6" name="price_6" required> 
                                                             </div> 
                                                        </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="month">
                                                                <div class="price">
                                                                <input type="text" class="form-control" style="width:100%" name="month_7" disabled value="7" id="month_7"> 
                                                                <input type="number" min="0" style="width:100%" class="form-control" id="price_7" name="price_7" required>
                                                                </div> 

                                                                <div class="price">
                                                                <input type="text" class="form-control" style="width:100%" name="month_8" disabled value="8" id="month_8"> 
                                                                <input type="number" min="0" style="width:100%" class="form-control" id="price_8" name="price_8" required>
                                                                </div> 

                                                                <div class="price">
                                                                <input type="text" class="form-control" style="width:100%" name="month_9" disabled value="9" id="month_9"> 
                                                                <input type="number" min="0" style="width:100%" class="form-control" id="price_9" name="price_9" required>
                                                                </div> 

                                                                <div class="price">
                                                                <input type="text" class="form-control" style="width:100%" name="month_10" disabled value="10" id="month_10"> 
                                                                <input type="number" min="0" style="width:100%" class="form-control" id="price_10" name="price_10" required>
                                                                </div> 

                                                                <div class="price">
                                                                <input type="text" class="form-control" style="width:100%" name="month_11" disabled value="11" id="month_11"> 
                                                                <input type="number" min="0" style="width:100%" class="form-control" id="price_11" name="price_11" required> 
                                                                </div> 

                                                                <div class="price">
                                                                <input type="text" class="form-control" style="width:100%" name="month_12" disabled value="12" id="month_12">  
                                                                <input type="number" min="0" style="width:100%" class="form-control" id="price_12" name="price_12" required> 
                                                                </div> 
                                                       </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>  


                                    <!--------------------------------- inventory code (start) ------------------------->
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
                                                <option value="{{$vendor->id}}">{{$vendor->name}}</option> 
                                            @endforeach
                                        </select>
                                    </div> 
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="date_of_purchase">Date of Purchase:</label>
                                    <div class="col-md-9">
                                        <input type="date" id="date_of_purchase" name="date_of_purchase" class="form-control" required>
                                    </div> 
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="purchase_amount">Purchase Amount:</label>
                                    <div class="col-md-9">
                                         <input type="number" id="purchase_amount" name="purchase_amount" class="form-control" required>
                                    </div> 
                                </div> 

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="invoice_number">Invoice Number</label>
                                    <div class="col-md-9">
                                         <input type="text" id="invoice_number" name="invoice_number" class="form-control" required>
                                    </div> 
                                </div> 

                                <!-- <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="invoice_number">Select Tax</label>
                                    <div class="col-md-9">
                                        <div class="row">

                                        @if(count($taxes) > 0)
                                        @foreach($taxes as $tax)
                                        <div class="col-md-3">
                                        <label  class="col-form-label" for="tax">{{$tax->tax_name}} {{$tax->tax_rate}}%</label>
                                         <input type="checkbox" name="tax[]" class="mx-1" value="{{$tax->id}}">
                                        </div> 
                                        @endforeach
                                        @endif

                                        </div>
                                    </div> 
                                </div>  -->
                            </div>
                        </div>
            <!-------------------------------- inventory code (end) ------------------------------>

            
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