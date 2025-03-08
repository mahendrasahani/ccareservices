@extends('layouts/backend/main')
@section('main-section')
 
<div class="content-body">
    <div class="top-set">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-3 mb-3">
                    <h3>Edit Customer</h3>
                </div>
            </div>
        </div>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card" style="border: 1px solid #e8e8e8;"> 
                            <div class="card-header" style="border-bottom: 1px solid #e8e8e8;">
                                <h4 class="mb-0 h6">User Information</h4>
                            </div> 
                            <form enctype="multipart/form-data" action="{{route('backend.customer.update', [$user->id])}}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Customer Name<span class="text-danger">*</span> </label>
                                        <div class="col-md-9">
                                             <input type="text" class="form-control" name="name" placeholder="Customer Name" value="{{$user->name ?? ''}}">   
                                            @error('name')
                                                <p style="color:red; font-weight:bold;">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Customer Email<span class="text-danger">*</span> </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="email" placeholder="Customer Email" value="{{$user->email ?? ''}}">   
                                            @error('email')
                                                    <p style="color:red; font-weight:bold;">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Customer Phone<span class="text-danger">*</span> </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="phone" placeholder="Customer Phone" value="{{$user->phone ?? ''}}">   
                                            @error('phone')
                                                <p style="color:red; font-weight:bold;">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label" for="address">Address</label>
                                        <div class="col-md-9">
                                        <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="{{$user->address_1 ?? ''}}"/> 
                                            @error('address')
                                                <p style="color:red; font-weight:bold;">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                               
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label" for="city">City</label>
                                        <div class="col-md-9">
                                        <input type="text" class="form-control" id="city" name="city" placeholder="City" value="{{$user->city ?? ''}}"/> 
                                            @error('city')
                                                <p style="color:red; font-weight:bold;">{{$message}}</p>
                                            @enderror
                                        </div> 
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label" for="postal_code">Postal Code</label>
                                        <div class="col-md-9">
                                        <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="Postal Code" value="{{$user->postal_code ?? ''}}"/> 
                                            @error('postal_code')
                                                <p style="color:red; font-weight:bold;">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="card" style="border: 1px solid #e8e8e8;">
                                        <div class="card-header d-flex justify-content-between" style="border-bottom : 1px solid #e8e8e8;">
                                            <h5 class="mb-0 pt-2">Shipping Address</h5>
                                        </div>
                                        <div class="card-body"> 

                                         <div class="form-group row">
                                                <label class="col-md-3 col-form-label" for="shipping_name">Name<span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                <input type="text" class="form-control" id="shipping_name" name="shipping_name" placeholder="Name" value="{{ $shipping_address->name ?? '' }}" required/> 
                                                    @error('shipping_name')
                                                        <p style="color:red; font-weight:bold;">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label" for="shipping_email">Email<span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                <input type="email" class="form-control" id="shipping_email" name="shipping_email" placeholder="Email" value="{{$shipping_address->email ?? ''}}" required/> 
                                                    @error('shipping_email')
                                                        <p style="color:red; font-weight:bold;">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Phone<span class="text-danger">*</span> </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="shipping_phone" required placeholder="Phone" value="{{$shipping_address->phone ?? ''}}" maxlength="10" pattern="\d{10}" required>   
                                            @error('shipping_phone')
                                                <p style="color:red; font-weight:bold;">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    
                                    <div class="form-group row">
                                                <label class="col-md-3 col-form-label" for="shipping_address">Address<span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                <input type="text" class="form-control" required id="shipping_address" name="shipping_address" placeholder="Address" value="{{$shipping_address->address ?? ''}}"/> 
                                                    @error('shipping_address')
                                                        <p style="color:red; font-weight:bold;">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                           
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label" for="shipping_city">City<span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" id="shipping_city" name="shipping_city" placeholder="City" value="{{ $shipping_address->city ?? '' }}"/> 
                                                    @error('shipping_city')
                                                        <p style="color:red; font-weight:bold;">{{$message}}</p>
                                                    @enderror
                                                </div> 
                                            </div>  
 
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label" for="shipping_postal_code">Postal Code</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" id="shipping_postal_code" name="shipping_postal_code" placeholder="Postal Code" value="{{ $shipping_address->zip_code ?? ''}}"/> 
                                                    @error('shipping_postal_code')
                                                        <p style="color:red; font-weight:bold;">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card" style="border: 1px solid #e8e8e8;">
                                        <div class="card-header d-flex justify-content-between" style="border-bottom : 1px solid #e8e8e8;"> 
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" checked name="billing_detail_check" data-toggle="collapse" href="#billingDetails_edit" role="button" id="billingDetails_checkbox_edit" aria-expanded="false" aria-controls="billingDetails_edit">
                                                <label class="form-check-label mb-0 h5" for="">
                                                    Billing address is different?
                                                </label>
                                            </div> 
                                        </div>
                                        <div class="card-body collapse show" id="billingDetails_edit"> 

                                             <div class="form-group row">
                                                <label class="col-md-3 col-form-label" for="billing_name">Name</label>
                                                <div class="col-md-9">
                                                   <input type="text" class="form-control" id="billing_name" name="billing_name" placeholder="Name" value="{{$billing_address->name ?? ''}}"/> 
                                                       @error('billing_name')
                                                         <p style="color:red; font-weight:bold;">{{$message}}</p>
                                                       @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label" for="billing_email">Email</label>
                                                <div class="col-md-9">
                                                <input type="email" class="form-control" id="billing_email" name="billing_email" placeholder="Email" value="{{$billing_address->email ?? ''}}"/> 
                                                    @error('billing_email')
                                                        <p style="color:red; font-weight:bold;">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label" for="billing_phone">Phone</label>
                                                <div class="col-md-9">
                                                <input type="text" class="form-control" id="billing_phone" name="billing_phone" placeholder="Phone" maxlength="10" pattern="\d{10}" value="{{$billing_address->phone ?? ''}}"/> 
                                                    @error('billing_phone')
                                                        <p style="color:red; font-weight:bold;">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label" for="billing_address">Address</label>
                                                <div class="col-md-9">
                                                <input type="text" class="form-control" id="billing_address" name="billing_address" placeholder="Address" value="{{$billing_address->address ?? ''}}"/> 
                                                    @error('billing_address')
                                                        <p style="color:red; font-weight:bold;">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                               
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label" for="billing_city">City</label>
                                                <div class="col-md-9">
                                                <input type="text" class="form-control" id="billing_city" name="billing_city" placeholder="City" value="{{$billing_address->city ?? ''  }}"/> 
                                                    @error('billing_city')
                                                        <p style="color:red; font-weight:bold;">{{$message}}</p>
                                                    @enderror
                                                </div> 
                                            </div>  
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label" for="billing_postal_code">Postal Code</label>
                                                <div class="col-md-9">
                                                <input type="text" class="form-control" id="billing_postal_code" name="billing_postal_code" placeholder="Postal Code" value="{{$billing_address->zip_code ?? ''}}"/> 
                                                    @error('billing_postal_code')
                                                        <p style="color:red; font-weight:bold;">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>
                                    </div> 

                                      
                                    <div class="card" style="border: 1px solid #e8e8e8;">
                                        <div class="card-header d-flex justify-content-between" style="border-bottom : 1px solid #e8e8e8;">
                                            <h5 class="mb-0 pt-2">Documents (Upload if you want to replace. Allowed Format: JPG, JPEG, PNG, PDF)</h5>
                                        </div>
                                        <div class="card-body">
                                            <!-- <div class="alert alert-info">Documents</div>   -->
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label" >Upload Aadhar Card Front </label>
                                                <div class="col-md-7">
                                                    <input type="file" class="form-control" id="aadhar_front" name="aadhar_front"  value="{{old('aadhar_front')}}" accept=".pdf, .jpg, .jpeg, .png"/> 
                                                    @error('aadhar_front')
                                                        <p style="color:red; font-weight:bold;">{{$message}}</p>
                                                    @enderror
                                                </div>
                                                
                                                @if($user->aadhar_front != '')
                                                    @php
                                                    $extension = pathinfo($user->aadhar_front, PATHINFO_EXTENSION);
                                                    @endphp

                                                    <div class="col-md-2">
                                                        @if($extension == 'pdf')
                                                            <a href="{{ url($user->aadhar_front) }}" 
                                                                style="padding: 5px 10px; border: 1px solid #7571f9; color: #7571f9;" 
                                                               >View pdf</a>

                                                        @elseif(in_array($extension, ['jpg', 'jpeg', 'png']))

                                                                <img 
                                                                    src="{{ url($user->aadhar_front) }}"
                                                                    class="w-50 showImages"
                                                                    data-label="Aadhar Card Front"
                                                                    data-toggle="modal" data-target="#exampleModalCenter"
                                                                > 
                                                        @endif 
                                                    </div>

                                                @endif


                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Upload Aadhar Card Back</label>
                                                <div class="col-md-7">
                                                    <input type="file" class="form-control" id="aadhar_back" name="aadhar_back" accept=".pdf, .jpg, .jpeg, .png"/> 
                                                    @error('aadhar_back')
                                                        <p style="color:red; font-weight:bold;">{{$message}}</p>
                                                    @enderror
                                                </div>  

                                                @if($user->aadhar_back != '') 
                                                @php
                                                $extension = pathinfo($user->aadhar_back, PATHINFO_EXTENSION);
                                                @endphp
                                                <div class="col-md-2"> 

                                                    @if($extension == 'pdf')
                                                        <a href="{{ url($user->aadhar_back) }}" 
                                                            style="padding: 5px 10px; border: 1px solid #7571f9; color: #7571f9;" 
                                                            >View pdf</a>

                                                    @elseif(in_array($extension, ['jpg', 'jpeg', 'png'])) 
                                                            <img src="{{ url($user->aadhar_back) }}" 
                                                                class="w-50 showImages" 
                                                                data-label="Aadhar Card Back"
                                                                data-toggle="modal" data-target="#exampleModalCenter"
                                                                style="cursor: pointer;"
                                                               >  
                                                    @endif
                                                </div>
                                               @endif
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label" >Upload Security Cheque</label>
                                                <div class="col-md-7">
                                                    <input type="file" class="form-control" id="security_cheque" name="security_cheque"  accept=".pdf, .jpg, .jpeg, .png"/> 
                                                    @error('security_cheque')
                                                        <p style="color:red; font-weight:bold;">{{$message}}</p>
                                                    @enderror
                                                </div> 
                                                @if($user->security_check != '')
                                                @php
                                                $extension = pathinfo($user->security_check, PATHINFO_EXTENSION);
                                                @endphp

                                               <div class="col-md-2 d-flex align-items-center">
                                                    @if($extension == 'pdf')  
                                                        <a href="{{ url($user->security_check) }}" 
                                                          style="padding: 5px 10px; border: 1px solid #7571f9; color: #7571f9;"
                                                          >View pdf</a>

                                                    @elseif(in_array($extension, ['jpg', 'jpeg', 'png']))
                                                
                                                            <img src="{{ url($user->security_check) }}"  
                                                                 class="w-50 showImages" 
                                                                 data-label="security Cheque"
                                                                 data-toggle="modal" data-target="#exampleModalCenter"  
                                                                 style="cursor: pointer;">  
                                                    
                                                    @endif
                                              </div>

                                               @endif
                                            </div>    
                                        </div>
                                    </div> 
                                </div>  

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="imgModal" aria-hidden="true" >
                                    <div class="modal-dialog modal-dialog-centered" role="document" style="width:50%">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="imgModal"></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                            <div class="modal-body">
                                                   <img src="" 
                                                    class="w-100 showmodalIMG">
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
@if(Session::has('upated'))
<script>
       Swal.fire({
            title: "Success",
            text: "{{ Session::get('upated') }}",
            icon: "success"
            });
    </script>
    @endif

<script> 
    $(document).ready(function(){
        $('.showImages').on('click', function(){ 
            let imgUrl = $(this).attr('src');   
            let imgName = $(this).data('label');  
            $('#imgModal').text(imgName);  
          $('.showmodalIMG').attr('src', imgUrl);
        }); 

        if($('#billingDetails_checkbox_edit').prop('checked')){
            $('#billingDetails_edit input').attr('required', true)
        }else{
            $('#billingDetails_edit input').attr('required', false)
        } 
        $('#billingDetails_checkbox_edit').on('change', function(){
            if($('#billingDetails_checkbox_edit').prop('checked')){ 
                $('#billingDetails_edit input').attr('required', true);
            }else{
                $('#billingDetails_edit input').attr('required', false);
            }
        }); 
    })
</script>



        @endsection
  
@endsection