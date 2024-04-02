@extends('layouts/backend/main')
@section('main-section')






<div class="content-body">
            <div class="top-set">
                <div class="container">
                    <div class="row mt-5 mb-3">
                        <div class="col-md-6">
                            <h4 class="pt-4"> Product Reviews</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card" style="border: 1px solid #e5e5e5;">
                                <div class="card-header d-flex" style="border-bottom: 1px solid #e5e5e5;">
                                <div class="col text-center text-md-left">
                                    <h4 class="mb-md-0 h5">Product Reviews</h4>
                                </div>
    
                                <div class="col-md-2">
                                    <div class="input-group enter">
                                        <input type="text" class="form-control form-control-sm" id="search" name="search"
                                            placeholder="Type Email or name &; Enter">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                
                                    <table id="myTable" class="table table-bordered mb-0">
                                        <thead>
                                            <tr> 
                                                <th class="col-xl-2">#</th>
                                                <th>Product</th>
                                                <th class="text-center">Customer</th>
                                                <th>Rating</th>
                                                <th>Comment</th> 
                                                <th class="text-right">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                 
                                                <td>1</td>
                                                <td>
                                                     <p>Apple iPhone 12 Pro, 128GB, 256GB, 512 GB Deep Purple</p>
                                                </td>
                                                <td class="lh-1-8">
                                                    <span class="d-block">Name: Christina Ashens</span>
                                                    <span class="d-block">Email: customer@example.com</span>
                                                    <span class="d-block">Phone: +1603-842-2079</span>
                                                    
                                                </td>
                                                <td>
                                                <span class="d-block">
                                                        Rating: <span class="rating"><i class="las la-star active"></i><i class="las la-star active"></i><i class="las la-star active"></i><i class="las la-star active"></i><i class="las la-star active"></i></span>
                                                    </span>
                                                </td>
                                                <td>
                                                    <p>This is my first iPhone bought by myself i worked for it and ummm I’m not going to lie I mean to purchase the Pro Max BUT I accidentally bought the Pro only so yup there it is But I must say the phone is still amazing and looks so nice like if I would've bought it from the apple store it had 100% battery life is 512GB thats so good to have that much space to install how many games or videos Id like and still have a toon of space overall I totally recommend this phone to anybody and it’s a great start before you get to the 13 Pro or Pro max because you don’t value stuff if you didn’t have something worse or less valuable before that definitely worth every penny.</p>
                                                </td>
                                                 
                                                <td>
                                                    <div class="custom-control custom-switch text-right">
                                                        <label class="switch"> <input type="checkbox"> <span class="slider"></span> </label>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                     
                           
                                
                            </div>
                            </div>
                        </div>
                    </div>
            <!-- #/ container -->
                 </div>
            </div>
            

            
            <!-- #/ container -->
        </div>








@section('javascript-section')
 

@endsection
@endsection