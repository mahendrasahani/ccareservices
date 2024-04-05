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
                            <form enctype="multipart/form-data" action=" ">
                                @csrf
                                <div class="card-body"> 
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="order_id">Order Id<span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="number"  name="order_id" class="form-control" value=" " required>
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
                                        <input type="text"  name="customer_name" value=" " class="form-control" >
                                    </div> 
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="customer_email">Customer Email<span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="email"  name="customer_email" value=" " class="form-control" >
                                    </div> 
                                </div>
                                <div class="form-group row"> 
                                    <label class="col-md-3 col-form-label" for="customer_no">Phone no.<span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="tel"  name="customer_no" value=" " class="form-control">
                                    </div> 
                                </div> 
                                </div>  
                                <div class="card" style="border: 1px solid #e8e8e8;">
                            <div class="card-header d-flex justify-content-between"
                                style="border-bottom : 1px solid #e8e8e8;">
                                <h5 class="mb-0 pt-2">Product Information and Reason For Return</h5>
                            </div>
                            <div class="card-body"> 
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="product_name">Product Name<span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text"   name="product_name" class="form-control" value=" " required>
                                    </div> 
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="product_model">Product Model<span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text"   name="product_model" class="form-control" value=" " required>
                                    </div> 
                                </div> 
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="product_quantity">Quantity:</label>
                                    <div class="col-md-9">
                                        <input type="number"   name="product_quantity" class="form-control" value=" " required>
                                    </div> 
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="return_reason">Return Reason:</label>
                                    <div class="col-md-9">
                                        <input type="text" name="return_reason" class="form-control" value=" " required>
                                    </div> 
                                </div>
                                <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Opened</label>
                                        <div class="col-md-9">
                                             <select class="form-control" name="select_variant_type">  
                                                    <option value=" " >Opened</option>   
                                                    <option value=" " >Closed</option>   
                                            </select> 
                                        </div>
                                    </div>
                               <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="comment">Comment:</label>
                                    <div class="col-md-9">
                                        <input type="text"   name="comment" class="form-control" value=" " required>
                                    </div> 
                                </div> 
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="action">Return Action:</label>
                                    <div class="col-md-9" >
                                          <select name="action" class="form-control">
                                            <option value="">Inventory</option>
                                            <option value="">Destroy</option>
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

@endsection