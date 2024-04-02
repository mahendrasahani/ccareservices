@extends('layouts/backend/main')
@section('main-section')
 	
<div class="content-body">
            <div class="top-set">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row ">
                                <div class="col-md-6">
                                    <div class="card" style="border: 1px solid #e5e5e5;">
                                        <div class="card-header" style="border-bottom: 1px solid #e5e5e5;">
                                            <h4 class="h5">Cash Payment Activation</h4>
                                        </div>
                                        <div class="card-body">
                                            <form class="form-horizontal" method="POST">
                                                <input type="hidden" name="_token" value="">
                                                <div class="form-group row">
                                                    <div class="col-md-4">
                                                        <label class="col-form-control">Activation</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <label class="switch">
                                                            <input data-id="{{$cod->id}}" type="checkbox" {{$cod->status == 1 ? 'checked':''}} id="cod_switch">
                                                            <span class="slider"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="h5">RazorPay Credential</h4>
                                        </div>
                                        <div class="card-body">
                                            <form class="form-horizontal" method="POST" action="{{route('backend.update_razorpya_credentials', [$razorpay->id])}}">
                                                @csrf
                                            <div class="form-group row">
                                                    <div class="col-md-4">
                                                        <label class="col-form-label">Activation</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <label class="switch">
                                                            <input type="checkbox" data-id="{{$razorpay->id}}" {{$razorpay->status == 1 ? 'checked':''}} id="razorpay">
                                                            <span class="slider"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group row"> 
                                                    <div class="col-md-4">
                                                        <label class="col-form-label">Razorpay Key</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" name="razorpay_key" value="{{$razorpay->key ?? ''}}" placeholder="Key">
                                                    </div>
                                                </div>
                                                <div class="form-group row"> 
                                                    <div class="col-md-4">
                                                        <label class="col-form-label">Razorpay Secret</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" name="razorpay_secret" value="{{$razorpay->secret ?? ''}}" placeholder="secret">
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <!-- row -->

           
            <!-- #/ container -->
        </div>


@section('javascript-section') 
@if(Session::has('credentials_updated'))
        <script> 
            Swal.fire({
            title: "Success!",
            text: "{{Session::get('credentials_updated')}}",
            icon: "success",
            timer: 5000,
            });
        </script>    
        @endif


<script>
    $(document).on("change", "#cod_switch", async function(){
        var $toggleButton = $(this);
        var paymentMethodStatus = $toggleButton.prop('checked') ? 1 : 0;
        var paymentMethodId = $(this).data('id');
        const data = {
            paymentMethodStatus: paymentMethodStatus,
            paymentMethodId: paymentMethodId
        };

        try {
            let paymentStatus = await fetch("{{ route('frontend.update_status') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json' 
                },
                body: JSON.stringify(data)
            });

            let paymentStatusResponse = await paymentStatus.json();

            console.log(paymentStatusResponse);
            } catch (error) {
                console.error('Error occurred:', error); 
            }
    });
</script>

<script>
    $(document).on("change", "#razorpay", async function(){
        var $toggleButton = $(this);
        var paymentMethodStatus = $toggleButton.prop('checked') ? 1 : 0;
        var paymentMethodId = $(this).data('id');
        const data = {
            paymentMethodStatus: paymentMethodStatus,
            paymentMethodId: paymentMethodId
        };

        try {
            let paymentStatus = await fetch("{{ route('frontend.update_status') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json' 
                },
                body: JSON.stringify(data)
            });

            let paymentStatusResponse = await paymentStatus.json();
            console.log(paymentStatusResponse);
            } catch (error) {
                console.error('Error occurred:', error); 
            }
    });
</script>
@endsection
@endsection