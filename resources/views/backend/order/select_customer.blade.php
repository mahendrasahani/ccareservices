@extends('layouts/backend/main')
@section('main-section')

<div class="content-body">
    <div class="top-set">
    <section>
        <div class="container">

            <div class="card">
                <div class="card-body">
                    <div class="createOrderElement"> 
                        <form action="{{ route('backend.order.select_customer') }}" method="GET"> 
                            <div class="row">  
                                <div class="col-md-12 mt-3 mb-3"> 
                                    <h3> Create Order</h3>
                                </div>
                                    
                                
                                
                                <div class="col-md-6 mb-3">
                                    <label class="control-label" for="search">Search by Name, Email or Number</label>
                                    <input type="text" 
                                       placeholder="Search by Name, Email or Number" 
                                       name="search" class="form-control" 
                                       value="{{ isset($_GET['search']) && $_GET['search'] != '' ? $_GET['search'] : '' }}"
                                       id="handalInput"
                                       >
                                    @error('phone')
                                    <p style="color:red;">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-12 mb-3 d-flex justify-content-between">
                                    <button class="btn btn-info">Search</button>
                                    <a href="{{ route('backend.order.select_customer') }}" class="btn btn-danger">Clear</a>
                                </div>

                            </div>
                        </form>  
                    </div>

                    @if(count($customers) > 0)
                    <div class="createOrderElement mt-3">
                        <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email id</th>
                                    <th scope="col">Mobil Number</th>
                                    <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php 
                                    $sn=1;
                                    @endphp
                                    @foreach($customers as $customer)
                                    <tr>
                                        <th scope="row">{{ $sn++ }}</th>
                                        <td>{{ $customer->name ?? '' }}</td>
                                        <td>{{ $customer->email ?? '' }}</td>
                                        <td>{{ $customer->phone ?? '' }}</td>
                                        <td>
                                              <a href="{{ route('backend.order.create_order') }}?customer={{ $customer->id }}"  class="btn btn-info">Create Order</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                        </table> 

                    </div> 
                    @else
                        
                        @if($found_status == true)
                        <center><h3>No Customer Found</h3></center>
                        @endif
                        
                        @endif

                </div> 
            </div> 

            <!------------------------------------------------------------------>
            <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email id</th>
                            <th scope="col">Mobil Number</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="orderList"> 
                        
                    
                    </tbody>
            </table> 
            <!------------------------------------------------------------------>

        </div>
</section>
    </div>
</div>

@section('javascript-section')


<script>

    const handalInputOrderSearch = async () =>{
           let searchInputValue =  document.getElementById('handalInput').value;  
           let orderList = document.getElementById('orderList');

           let url = "{{ route('backend.customer.get_all_customers_list') }}"; 

           try{
                let response = await fetch(url)
                if(!response.ok){
                    console.log("Network error")
                }
                let data = await response.json();
                let customersData = data.customers;
                console.log(customersData)

                let filteredCustomers = customersData.filter(customer => customer.name);

                 let append_html = "";

                 filteredCustomers.forEach((element, index) => {  
                    append_html += `
                        <tr>
                            <th scope="row">${index+1}</th>
                            <td>${element.name}</td>
                            <td> ${element.email}</td>
                            <td> ${element.phone}</td>
                            <td>
                              <a href=" "  class="btn btn-info">Create Order</a>
                            </td>
                        </tr>
                    `  
                 }); 
                 orderList.innerHTML = append_html;

           }catch(error){
                console.log(error)
           }  
           
    };

    document.getElementById('handalInput').addEventListener('input', function(){
        handalInputOrderSearch();
    });

</script>


@endsection
@endsection
