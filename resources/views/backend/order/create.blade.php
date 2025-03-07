@extends('layouts/backend/main')
@section('main-section') 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<div class="content-body">
    <div class="top-set">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    
                    <div class="">
                        <form method="POST" action="{{ route('backend.order.new_order_store') }}" id="handalAdmin_orderForm">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id ?? '' }}">
                            <div class="col-md-12"> 

                                <div class="card-body">
                                        
                                    <div class="row">
                                        <div class="col-md-3 pl-2 pr-2">
                                            <div class="cotegoryH3 mb-3">
                                                <h3>Select your Product Cutegory</h3>
                                            </div>
                                            <ul class="list-unstyled ps-0">
                                                @foreach($main_categories as $main) 
                                                    <li class="mb-1 adminCotegories" id="{{$main->id}}">
                                                        <span class="btn-toggle w-100 d-inline-flex align-items-center justify-content-between rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#{{str_replace(' ', '', $main->name)}}" aria-expanded="false">
                                                            <span>{{$main->name}}</span>
                                                            <i class="fas fa-chevron-down"></i>
                                                        </span>
                                                        <div class="collapse" id="{{str_replace(' ', '', $main->name)}}" style="">
                                                            @if(count($main->subCategory) > 0)
                                                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small subLIstMenu">
                                                                    @foreach($main->subCategory as $sub)
                                                                        <li id="{{$sub->id}}" onclick="fetchProduct('{{$main->id}}','{{$sub->id}}')"><a href="javascript:void(0)" class="link-body-emphasis d-inline-flex text-decoration-none rounded">{{$sub->name}}</a></li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </div> 
                                                    </li>
                                                @endforeach 
                                            </ul>
                                        </div> 
                                        <div class="col-md-9 pl-2 pr-2 overflowElement">
                                            <div class="row" id="products">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- your all data cotegory section start -->
                                    <div class="card p-2 mt-5 mb-5" style="border: 1px solid #01316b;">
                                        <table class="table table-bordered mt-4 mb-4">
                                            <thead>
                                                <tr style="font-size: 12px;">
                                                    <th width="30%">Product</th>
                                                    <th>Variant</th>
                                                    <th>QTY</th>
                                                    <th>Month</th>
                                                    <th>Unit price</th>
                                                    <th>Tax</th>
                                                    <th>Total</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="CartProduct">
                                            </tbody>
                                        </table>
                                            <!-- total with gst and etc counts details start -->
                                        <table class="table table-bordered table-details">
                                            <thead>
                                                <tr style="font-size: 12px;">
                                                    <th>Sub Total :</th>
                                                    <th>Shipping :</th>
                                                    <th>Total :</th>
                                                </tr>
                                            </thead>
                                            <tbody id="shipping_total">
                                            </tbody>
                                        </table>
                                        <!-- total with gst and etc counts details end-->
                                    </div>
                                    <!-- your all data cotegory section end -->  
                                </div>  

                                    <h2 class="h4 mb-2">Order Details</h2>
                                    <div class="card" style="border: 1px solid #e5e5e5;">
                                   
                                        <div class="card-header" style="border-bottom: 1px solid #e5e5e5;">
                                            <h2 class="h6 font-size-16 font-weight-bold mb-0"> Customer info</h2>
                                        </div>
                                        <div class="card-header" style="border-bottom: 1px solid #e5e5e5;">
                                            <div class="row">
                                                <div class="col-md mb-3">
                                                    <div>
                                                        <div class="font-size-10 font-weight-bold mb-2" style="font-size: 12px;">Name</div>
                                                        <div style="font-size: 12px;">{{ $user->name }}</div> 
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-xl-4" style="font-size: 12px;">
                                                    <div>
                                                        <div class="font-size-10 font-weight-bold mb-2" style="font-size: 12px;">Email</div>
                                                        <div style="font-size: 12px;">{{ $user->email }}</div> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-header" style="border-bottom: 1px solid #e5e5e5;">
                                                <div class="row align-items-start">

                                                    <div class="col-md-4" style="font-size: 12px;">
                                                        <div class="mb-3">
                                                            <label class="mb-0">Payment Status</label>
                                                            <select class="form-control" id="payment_status" name="payment_status" style="font-size: 12px;" required>
                                                                <option value="">--Select--</option>
                                                                <option value="paid">Paid</option>
                                                                <option value="unpaid" >Unpaid</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4" style="font-size: 12px;">
                                                        <div class="mb-3" id="order_status_area">
                                                            <label class="mb-0">Payment Method</label>
                                                            <select class="form-control" id="payment_method" name="payment_method" style="font-size: 12px;" required>
                                                                <option value="" >--Select--</option> 
                                                                <option value="cash_on_delivery">Cash On Delivery</option> 
                                                                <option value="razorpay">Razorpay</option>   
                                                            </select>
                                                        </div>  
                                                    </div>  
                                                    <div class="col-md-4" style="font-size: 12px;">
                                                        <div class="mb-3" id="order_status_area">
                                                            <label class="mb-0">Order Status</label>
                                                            <select class="form-control" id="order_status" name="order_status" style="font-size: 12px;" required>
                                                                <option value="">--Select--</option> 
                                                                <option value="ordered">Ordered</option> 
                                                                <option value="accepted">Accept</option> 
                                                                <option value="canceled">Cancel</option> 
                                                                <option value="shipped">Shipped</option> 
                                                                <option value="delivered">Delivered</option> 
                                                            </select>
                                                        </div>  
                                                    </div>  
                                                    <div class="col-md-4" style="font-size: 12px;">
                                                        <div class="mb-3">
                                                            <label for="delivery_date">Order Date</label>
                                                            <input type="date" name="order_date" id="order_date" class="form-control" value="" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4" style="font-size: 12px;">
                                                        <div class="mb-3">
                                                            <label for="delivery_date">Delivery Date</label>
                                                            <input type="date" name="delivery_date" id="delivery_date" class="form-control" value="" required disabled>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row align-items-start">
                                                    <div class="card-header" style="border-bottom: 1px solid #e5e5e5;">
                                                        <h2 class="h6 font-size-16 font-weight-bold mb-0"> Shipping Info</h2>
                                                    </div>
                                                    <div class="col-md-4" style="font-size: 12px;">
                                                        <div class="mb-3">
                                                            <label class="mb-0">Name</label>
                                                            <input type="text" value="{{ $shipping_info->name ?? '' }}" name="shipping_name" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4" style="font-size: 12px;">
                                                        <div class="mb-3" id="order_status_area">
                                                            <label class="mb-0">Email</label>
                                                            <input type="email" value="{{ $shipping_info->email ?? '' }}" name="shipping_email" class="form-control" required>
                                                        </div>  
                                                    </div>  
                                                    <div class="col-md-4" style="font-size: 12px;">
                                                        <div class="mb-3" id="order_status_area">
                                                            <label class="mb-0">Phone</label>
                                                            <input type="text" value="{{ $shipping_info->phone ?? '' }}" name="shipping_phone" class="form-control" required>
                                                        </div>  
                                                    </div>  
                                                    <div class="col-md-4" style="font-size: 12px;">
                                                        <div class="mb-3">
                                                            <label for="delivery_date">Address</label>
                                                            <input type="text" name="shipping_address" value="{{ $shipping_info->address ?? '' }}" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4" style="font-size: 12px;">
                                                        <div class="mb-3">
                                                            <label for="delivery_date">City</label>
                                                            <input type="text" name="shipping_city" value="{{ $shipping_info->city ?? '' }}" class="form-control" required>
                                                        </div>
                                                    </div> 
                                                    <div class="col-md-4" style="font-size: 12px;">
                                                        <div class="mb-3">
                                                            <label for="Zip Code">Zip Code</label>
                                                            <input type="text" name="shipping_zip_code" value="{{ $shipping_info->zip_code ?? '' }}" class="form-control"  required>
                                                        </div>
                                                    </div> 
                                                </div> 

                                                    <div class="row align-items-start">
                                                            <div class="card-header" style="border-bottom: 1px solid #e5e5e5;">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" value="" name="billingDetails_check" id="adminBilling_chechbox"  data-toggle="collapse" href="#billingInfo" role="button" aria-expanded="false" aria-controls="billingInfo">
                                                                    <label class="form-check-label h6 font-size-16 font-weight-bold mb-0" for="">
                                                                        Billing address is different?
                                                                    </label>
                                                                </div> 
                                                            </div>
                                                            
                                                            <div class="collapse row" id="billingInfo"> 
                                                                <div class="col-md-4" style="font-size: 12px;">
                                                                    <div class="mb-3">
                                                                        <label class="mb-0">Name</label>
                                                                        <input type="text" value="{{ $billing_info->name ?? '' }}" name="billing_name" class="form-control" >
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4" style="font-size: 12px;">
                                                                    <div class="mb-3" id="order_status_area">
                                                                        <label class="mb-0">Email</label>
                                                                        <input type="text" value="{{ $billing_info->email ?? '' }}" name="billing_email" class="form-control" >
                                                                    </div>  
                                                                </div>  
                                                                <div class="col-md-4" style="font-size: 12px;">
                                                                    <div class="mb-3" id="order_status_area">
                                                                        <label class="mb-0">Phone</label>
                                                                        <input type="text" value="{{ $billing_info->phone ?? '' }}" name="billing_phone" class="form-control" >
                                                                    </div>  
                                                                </div>  
                                                                <div class="col-md-4" style="font-size: 12px;">
                                                                    <div class="mb-3">
                                                                        <label for="delivery_date">Address</label>
                                                                        <input type="text" name="billing_address" value="{{ $billing_info->address ?? '' }}" class="form-control" >
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4" style="font-size: 12px;">
                                                                    <div class="mb-3">
                                                                        <label for="delivery_date">City</label>
                                                                        <input type="text" name="billing_city" value="{{ $billing_info->city ?? '' }}" class="form-control" >
                                                                    </div>
                                                                </div> 
                                                                <div class="col-md-4" style="font-size: 12px;">
                                                                    <div class="mb-3">
                                                                        <label for="billing_zip_code">Zip Code</label>
                                                                        <input type="text" value="{{ $billing_info->zip_code ?? '' }}"  name="billing_zip_code"  class="form-control" >
                                                                    </div>
                                                                </div> 
                                                        </div>
                                                    </div> 

                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-xl-4 col-md-6">
                                            <input type="submit" value="Book Order" class="btn btn-primary"  style="background-color: #f5a100;border:0;">
                                        </div>
                                     </div>
                                    
                                </div>
                            </div>
                        </form> 
                    </div>
                </div>   
            </div>
        </div>
    </div> 
</div>
@section('javascript-section')
<script>
    let all_prodcts_data;
    let cartArray = [];

    const fetchProduct = async (main_cat, sub_cat) => {
        const url = "{{route('backend.get_product_list_to_create_order')}}";
        const products = document.getElementById("products");
        try {
            const response = await fetch(`${url}?main_category=${main_cat}&sub_category=${sub_cat}`);
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            const myresponse = await response.json();
            all_prodcts_data = myresponse.data;  
            let append_html = "";  
            let add_btn_text = 'Add'; 
           
            myresponse.data.forEach(element => {
                if (document.getElementById(`cart_row_${element.id}`)) { 
                    add_btn_text = 'Added';
                } 
                const prices = element.get_stock[0].prices;
                append_html += `
                    <div class="col-md-3 pl-1 pr-1">
                        <div class="card cardBorder p-2 h-100">
                            <img src="{{url('public/')}}/${element.product_images[0]}"
                                 class="w-100 adminProductIMG">
                            <div>
                                <h6>${element.product_name}</h6>
                                <div class="d-flex justify-content-between"> 
                                    <a href="javascript:void(0)" class="cartSectin" id="productBTN_${element.id}" data-prices='${JSON.stringify(prices)}' data-stocks='${JSON.stringify(element.get_stock)}' onclick="addToCartByAdmin(${element.id}, '${element.product_images[0]}', '${element.product_name}', '${element.tax_rate}', '${element.tax_name}', this)">${add_btn_text}</a>
                                </div>
                            </div>
                        </div>
                    </div>`;
            });
            products.innerHTML = append_html; 
        } catch (error) {
            console.log('Error fetching data:', error);
        }
    };

    const addToCartByAdmin = (p_id, p_img, p_name, tax_rate, tax_name, element) => {
            let variant_html = '';
            const prices = JSON.parse(element.dataset.prices);  
            const CartProduct = document.getElementById('CartProduct');
            let product = {
                id: p_id,
                p_img: p_img,
                p_name: p_name,
                tax_rate: parseFloat(tax_rate), 
                tax_name: tax_name, 
                prices: prices,  
                qty: 1, 
                selectedMonth: 1 
            };
            cartArray.push(product);
            // Check if the product already exists to avoid duplicate entries
            if (document.getElementById(`cart_row_${p_id}`)) {
                return;
            }
            $("#productBTN_"+p_id).text('Added');
            const initialPrice = prices[`price_1`] || prices.price_1;
            const totalPriceWithoutTax = product.qty * initialPrice;
            const tax = (totalPriceWithoutTax * product.tax_rate) / 100;
            const totalPrice = totalPriceWithoutTax + tax; 

            let newRow = document.createElement('tr');
            newRow.id = `cart_row_${p_id}`;
            newRow.style.fontSize = "12px";
            newRow.innerHTML = `
                <td>
                    <div class="media">
                        <img src="{{url('public/')}}/${p_img}" class="" width="65px" style="border-radius: 5px;"> 
                        <div class="media-body mx-2">
                            <p class="mb-0"><b>${p_name}</b></p>
                        </div>
                    </div>
                </td>
                <td style="width:150px">
                    <div>
                        <select class="form-control" id="variant_${p_id}" onchange="variantCangeFunction(${p_id}, this)" name="variant[]">
                        
                        </select>
                    </div>
                </td>
                <td style="width: 80px;">
                    <input type="number" value="1" min="1" name="product_qty[]"
                        style="border: 1px solid gray; font-size:16px;" class="p-2 w-100 font-weight-bold"
                        onchange="productQuty(${p_id}, this)" id="productQutys_${p_id}">
                </td>
                <td>
                    <div>
                        <select class="form-control monthSelect" onchange="productQuty(${p_id}, this)" id="selected_month_${p_id}" name="selected_month[]">
                            <option value="1" data-price="${prices.price_1}">1 Month</option>
                            <option value="2" data-price="${prices.price_2}">2 Months</option>
                            <option value="3" data-price="${prices.price_3}">3 Months</option>
                            <option value="4" data-price="${prices.price_4}">4 Months</option>
                            <option value="5" data-price="${prices.price_5}">5 Months</option>
                            <option value="6" data-price="${prices.price_6}">6 Months</option>
                            <option value="7" data-price="${prices.price_7}">7 Months</option>
                            <option value="8" data-price="${prices.price_8}">8 Months</option>
                            <option value="9" data-price="${prices.price_9}">9 Months</option>
                            <option value="10" data-price="${prices.price_10}">10 Months</option>
                            <option value="11" data-price="${prices.price_11}">11 Months</option>
                            <option value="12" data-price="${prices.price_12}">12 Months</option>
                        </select>
                    </div>
                </td>
                <td style="width: 120px;">₹ <span id="price_${p_id}">${initialPrice}</span></td>
                <td class="tax_rate"><span>${product.tax_name} ${product.tax_rate}%  </span> (<span id="tax_rate_span_${p_id}">₹ ${tax.toFixed(2)}</span>)</td> 
                <td><b>₹ <span id="totalprice_${p_id}">${totalPrice.toFixed(2)}</span> </b></td>  
                <td>
                    <span class="btn btn-danger btn-sm" onclick="removeFromCart(${p_id})">Delete</span>
                </td>
                <input type="hidden" id="product_id_${p_id}" value="${product.id}" name="product_id[]">
                <input type="hidden" id="tax_rate_${p_id}" value="${product.tax_rate}">
                <input type="hidden" id="price_input_${p_id}" value="${initialPrice}" name="unit_price[]">
                <input type="hidden" id="single_product_total_price_${p_id}" value="${totalPrice.toFixed(2)}">`; 
            CartProduct.appendChild(newRow); 
            const stocks = JSON.parse(element.dataset.stocks);
            stocks.forEach(stock => {
                variant_html += `<option value="${stock.get_attr_value.id}">${stock.get_attr_value.name}</option>`;
            }); 
            document.getElementById(`variant_${p_id}`).innerHTML = variant_html; 
            shipping_totalFunction();
    }; 

    // //handal Admin_ order Form
      $(document).ready(function(){
        $('#handalAdmin_orderForm').on('submit', function(e){

            console.log(cartArray, "array data")
            console.log(cartArray.length, "array length")

            if(cartArray.length === 0){
                e.preventDefault();
                alert("Please add items..!")
                return;
            };
        });
      });

    const productQuty = (id, inputElement) => { 
        let new_qty = parseInt($("#productQutys_" + id).val()); 
        let tax_rate = parseInt($("#tax_rate_" + id).val());  
        let selectedOption = $("#selected_month_" + id).find(":selected");
        let price = parseInt(selectedOption.data('price'));
        let total_without_tax = new_qty * price;
        let tax_amount = (total_without_tax * tax_rate) / 100;
        let total_with_tax = total_without_tax + tax_amount;
        $("#tax_rate_span_" + id).text(tax_amount.toFixed(2)); 
        $("#totalprice_" + id).text(total_with_tax.toFixed(2)); 
        $("#price_" + id).text(price); 
        $("#price_input_" + id).val(price); 
        $("#product_id_" + id).val(id); 
        $("#single_product_total_price_"+id).val(total_with_tax.toFixed(2)); 
        shipping_totalFunction();
    };
   
    const variantCangeFunction = async (p_id, element) => {
        const url = "{{route('backend.get_variant_stock')}}";
        const attr_value_id = $(element).val();   
        try {
            const response = await fetch(`${url}?product_id=${p_id}&attr_val_id=${attr_value_id}`);
            if(!response.ok){
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            const responseData = await response.json(); 
            let month_html = '';
            let selected_qty = parseInt($("#productQutys_" + p_id).val()); 
            let month = parseInt($("#selected_month_" + p_id).val()); 
            let tax_rate = parseInt($("#tax_rate_" + p_id).val()); 
            let new_price = parseInt(responseData.data['price_'+month]); 
            month_html = `
            <option value="1" data-price="${responseData.data['price_1']}" ${month == 1 ? 'selected':''}>1 Month</option>
            <option value="2" data-price="${responseData.data['price_2']}" ${month == 2 ? 'selected':''}>2 Month</option>
            <option value="3" data-price="${responseData.data['price_3']}" ${month == 3 ? 'selected':''}>3 Month</option>
            <option value="4" data-price="${responseData.data['price_4']}" ${month == 4 ? 'selected':''}>4 Month</option>
            <option value="5" data-price="${responseData.data['price_5']}" ${month == 5 ? 'selected':''}>5 Month</option>
            <option value="6" data-price="${responseData.data['price_6']}" ${month == 6 ? 'selected':''}>6 Month</option>
            <option value="7" data-price="${responseData.data['price_7']}" ${month == 7 ? 'selected':''}>7 Month</option>
            <option value="8" data-price="${responseData.data['price_8']}" ${month == 8 ? 'selected':''}>8 Month</option>
            <option value="9" data-price="${responseData.data['price_9']}" ${month == 9 ? 'selected':''}>9 Month</option>
            <option value="10" data-price="${responseData.data['price_10']}" ${month == 10 ? 'selected':''}>10 Month</option>
            <option value="11" data-price="${responseData.data['price_']}" ${month == 11 ? 'selected':''}>11 Month</option>
            <option value="12" data-price="${responseData.data['price_12']}" ${month == 12 ? 'selected':''}>12 Month</option>`;
            $("#selected_month_"+p_id).html(month_html);
            let total_without_tax = new_price * selected_qty;
            let new_tax = (total_without_tax * tax_rate) / 100;
            let total_with_tax = total_without_tax + new_tax;
            $("#totalprice_" + p_id).text(total_with_tax.toFixed(2)); 
            $("#price_" + p_id).text(new_price); 
            $("#price_input_" + p_id).val(new_price); 
            $("#tax_rate_span_" + p_id).text(new_tax);
            $("#single_product_total_price_"+p_id).val(total_with_tax);
            $("#product_id_"+p_id).val(p_id);
            shipping_totalFunction();
        }catch(error){
            console.log('Error fetching data:', error);
        }
    };

    const shipping_totalFunction = async () => {
        const shipping_total = document.getElementById('shipping_total');
        let total_price_without_shipping_charge = 0;
        let total_price_with_shipping_charge = 0;
        let shipping_charge = 0;
        cartArray.forEach(product => { 
            total_price_without_shipping_charge += parseFloat(document.getElementById(`single_product_total_price_${product.id}`).value);
        });
        try {
            let shipping_url = "{{ route('backend.get_active_shipping_charge') }}";
            let shipping_charge_res = await fetch(shipping_url);
            let shipping_charge_res_data = await shipping_charge_res.json(); 
            if(shipping_charge_res_data.status == 'success'){
                shipping_charge = shipping_charge+parseInt(shipping_charge_res_data.shipping_charge);
                total_price_with_shipping_charge = total_price_without_shipping_charge+shipping_charge;
            }
        } catch (error) {
            console.error("Error fetching shipping charge:", error);
            return 0;
        }
        shipping_total.innerHTML = `
            <tr style="font-size: 12px;">
                <td id="subTotalPrice"><b>₹ ${total_price_without_shipping_charge.toFixed(2)}</b></td>
                <td><b>₹ ${shipping_charge}</b></td>
                <td><b style="font-size: 16px;">₹ ${total_price_with_shipping_charge.toFixed(2)}</b></td>
            </tr>`;
    };

    const removeFromCart = (id) => {
        cartArray = cartArray.filter(item => item.id !== id);
        $("#cart_row_"+id).remove();
        shipping_totalFunction();
        $("#productBTN_"+id).text('Add');
    };


   
    document.getElementById('order_date').addEventListener('change', function () {
            let orderDate = this.value;
            let deliveryDateField = document.getElementById('delivery_date');

            if (orderDate) {
                deliveryDateField.disabled = false;
                deliveryDateField.min = orderDate; // Ensure delivery_date is not earlier than order_date
                deliveryDateField.value = ""; // Clear selected delivery date when order_date changes
            } else {
                deliveryDateField.disabled = true;
                deliveryDateField.value = ""; // Clear delivery date if order_date is cleared
            }
        });

        $(document).ready(function(){
            $('#adminBilling_chechbox').on('change', function(){
                let billingInfo_input = $('#billingInfo input');

                if(this.checked === true){
                    billingInfo_input.prop('required', true);
                }else{
                    billingInfo_input.prop('required', false);
                }
            }); 
            
        });
    
</script>

@endsection
@endsection