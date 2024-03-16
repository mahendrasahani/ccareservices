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
                         
                            <form enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Select Product<span class="text-danger">*</span> </label>
                                        <div class="col-md-9">
                                             <select id="select_product" class="form-control">
                                                    <option value="option1">Option 1</option>
                                                    <option value="option2">Option 2</option>
                                                    <option value="option3">Option 3</option>
                                                    <option value="option4">Option 4</option>
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Select Option <span class="text-danger">*</span> </label>
                                        <div class="col-md-9">
                                             <select id="select_option" class="form-control">
                                                    <option value="option1">Option 1</option>
                                                    <option value="option2">Option 2</option>
                                                    <option value="option3">Option 3</option>
                                                    <option value="option4">Option 4</option>
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Select Option Value<span class="text-danger">*</span> </label>
                                        <div class="col-md-9">
                                             <select id="select_option_value" class="form-control">
                                                    <option value="option1">Option 1</option>
                                                    <option value="option2">Option 2</option>
                                                    <option value="option3">Option 3</option>
                                                    <option value="option4">Option 4</option>
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Quantity<span class="text-danger">*</span> </label>
                                        <div class="col-md-9">
                                             <input type="number" id="stock_quantity" name="stock_quantity" class="form-control" min="0">
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
                                                            <input type="number" min="0" style="width:100%" class="form-control" id="modal_price_1" name="price_1" required>
                                                            </div> 

                                                            <div class="price">
                                                            <input type="text" class="form-control" style="width:100%" name="month[]" disabled value="2" id="month_2"> 
                                                            <input type="number" min="0" style="width:100%" class="form-control" id="modal_price_2" name="price_2" required>
                                                            </div> 

                                                            
                                                            <div class="price">
                                                            <input type="text" class="form-control" style="width:100%" name="month[]" disabled value="3" id="month_3"> 
                                                            <input type="number" min="0" style="width:100%" class="form-control" id="modal_price_3" name="price_3" required>        
                                                             </div> 
                                                            
                                                            <div class="price">
                                                            <input type="text" class="form-control" style="width:100%" name="month[]" disabled value="4" id="month_4"> 
                                                            <input type="number" min="0" style="width:100%" class="form-control" id="modal_price_4" name="price_4" required> 
                                                             </div> 

                                                            <div class="price">
                                                            <input type="text" class="form-control" style="width:100%" name="month[]" disabled value="5" id="month_5"> 
                                                            <input type="number" min="0" style="width:100%" class="form-control" id="modal_price_5" name="price_5" required> 
                                                             </div> 

                                                            <div class="price">
                                                            <input type="text" class="form-control" style="width:100%" name="month[]" disabled value="6" id="month_6">  
                                                            <input type="number" min="0" style="width:100%" class="form-control" id="modal_price_6" name="price_6" required> 
                                                             </div> 
                                                        </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="month">
                                                                <div class="price">
                                                                <input type="text" class="form-control" style="width:100%" name="month[]" disabled value="7" id="month_7"> 
                                                                <input type="number" min="0" style="width:100%" class="form-control" id="modal_price_7" name="price_7" required>
                                                                </div> 

                                                                <div class="price">
                                                                <input type="text" class="form-control" style="width:100%" name="month[]" disabled value="8" id="month_8"> 
                                                                <input type="number" min="0" style="width:100%" class="form-control" id="modal_price_8" name="price_8" required>
                                                                </div> 

                                                                <div class="price">
                                                                <input type="text" class="form-control" style="width:100%" name="month[]" disabled value="9" id="month_9"> 
                                                                <input type="number" min="0" style="width:100%" class="form-control" id="modal_price_9" name="price_9" required>
                                                                </div> 

                                                                <div class="price">
                                                                <input type="text" class="form-control" style="width:100%" name="month[]" disabled value="10" id="month_10"> 
                                                                <input type="number" min="0" style="width:100%" class="form-control" id="modal_price_10" name="price_10" required>
                                                                </div> 

                                                                <div class="price">
                                                                <input type="text" class="form-control" style="width:100%" name="month[]" disabled value="11" id="month_11"> 
                                                                <input type="number" min="0" style="width:100%" class="form-control" id="modal_price_11" name="price_11" required> 
                                                                </div> 

                                                                <div class="price">
                                                                <input type="text" class="form-control" style="width:100%" name="month[]" disabled value="12" id="month_12">  
                                                                <input type="number" min="0" style="width:100%" class="form-control" id="modal_price_12" name="price_12" required> 
                                                                </div> 
                                                       </div>
                                                </div>
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