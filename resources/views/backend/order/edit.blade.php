@extends('layouts/backend/main')
@section('main-section')
 
  

<div class="content-body">
            <div class="top-set">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card art_card">
                                <div class="card-body">
                                     <div class="row p-2">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="product-inquery">
                                        <p><b>Order Code :</b></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="product-answer">
                                        <p>CCS100010</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="product-inquery">
                                        <p><b>Name :</b></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="product-answer">
                                        <p>ghs</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="product-inquery">
                                        <p><b>Email :</b></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="product-answer">
                                        <p>gadfd@w.gbd</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="product-inquery">
                                        <p><b>Shipping Address :</b></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="product-answer">
                                        <p>vfsd fds 258741 India</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="product-inquery">
                                        <p><b>Total Order Amount :</b></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="product-answer">
                                        <p>₹5,000.00/-</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="product-inquery">
                                        <p><b>Payment Method :</b></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="product-answer">
                                        <p>Cash On Delivery</p>
                                    </div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="product-inquery">
                                        <p><b>Billing Address :</b></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="product-answer">
                                        <p>vfsd fds 258741 India</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="row">
                        
                        <div class="col-md-12">  
                            <div class="card art_card">
                                <div class="card-header">
                                    <h5 class="mb-0 h6">Product Description</h5>
                                </div>
                                <div class="card-body">
                            <div class="order-details">
                        <table class="order-container">
                            <tbody><tr>
                                <th>#</th>
                                <th>Product</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Total</th>
                            </tr>
                                                                                    <tr>
                                <td><b>1</b></td>
                                <td class="order-products-img">
                                    <img src="http://localhost/ccareservices/public/assets/backend/upload/products/0_1709279843.webp" alt="Bharat Lifestyle Oman Engineered Wood  Box Bed"> 
                                     </td>
 
                                <td class="track-order-name"> Bharat Lifestyle Oman Engineered Wood  Box Bed<br> <b></b> </td>
                                <td><b>1</b></td>
                                <td><b>₹5,000.00</b></td>
                                <td><b>₹5,000.00</b></td>
                            </tr>
                                                      </tbody></table>
                    </div>
                                </div>
                            </div>
                
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card art_card">
                                <div class="card-body">
                                    <div class="mb-3 d-flex justify-content-between">
                                        <span class="mr-2 ml-0">Order Status:</span>
                                        <div class="col-md-6">
                            <div class="row justify-content-between">
                                <div class="order-tracking completed">
                                    <span class="is-complete"></span>
                                    <p>Ordered<br><span>Mon, June 24</span></p>
                                </div>
                                <div class="order-tracking completed">
                                    <span class="is-complete"></span>
                                    <p>Shipped<br><span>Tue, June 25</span></p>
                                </div>
                                <div class="order-tracking ">
                                    <span class="is-complete"></span>
                                    <p>Delivered<br><span>Fri, June 28</span></p>
                                </div>
                            </div>
                            
                        </div>
                        <div class="order_edit_dropdown " >
                                            <select name="order_edit_status" class="form-control">
                                                <option value="ordered">Ordered</option>
                                                <option value="shipped">Shipped</option> 
                                                <option value="deliverd">Deliverd</option> 
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 d-flex justify-content-between">
                                        <span class="mr-2 ml-0">Payment Status:</span>
                                        <div class="payment_status"> 
                                            <span class=" bg-danger">Unpaid</span> 
                                            <span class=" bg-success">Paid</span> 
                                        </div>
                                        <div class="order_edit_dropdown">
                                            <select name="order_edit_payment" class="form-control">
                                                <option value="paid">Paid</option>
                                                <option value="unpaid">Unpaid</option> 
                                            </select>
                                        </div>
                                    </div> 
                                     
                                </div>
                            </div> 
                        </div>

                        <div class="col-md-4 card p-4 card art_card">
                                <div class="final-order-details">
                                    <div class="order_view_final">
                                        <p><b>Sub Total:</b></p>
                                        <p><b>₹5,000.00</b></p>
                                    </div>
                                </div> 
                                <div class="final-order-details">
                                    <div class="order_view_final">
                                        <p><b>Shipping Charge :</b></p>
                                        <p><b>₹0.00</b></p>
                                    </div>
                                </div>
                                <div class="final-order-details">
                                    <div class="order_view_final">
                                        <p><b>Discount :</b></p>
                                        <input type="number" placeholder="Enter Discount Here" min="0">
                                    </div>
                                </div>
                                <div class="final-order-details total-final">
                                    <div class="order_view_final">
                                        <p><b>Total :</b></p>
                                        <p><b>₹5,000.00</b></p>
                                    </div>
                                </div>
                                 
                            </div>
                    </div>
                    
                    <button class="btn btn-primary">Update Order</button>
                </div> 
            </div> 
        </div>

@endsection