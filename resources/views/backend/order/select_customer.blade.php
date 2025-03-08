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
                                       id="handalInput"
                                       > 
                                </div> 

                            </div>
                        </form>  
                    </div> 
                  
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
                                <tbody id="orderList"> </tbody>
                        </table>  
                    </div>  
                </div> 
            </div>  
        </div>
</section>
    </div>
</div>

@section('javascript-section')


<script>

    // fatch api data function
    let customersData = [];
    const fetchCustomerdata = async () =>{
        let url = "{{ route('backend.customer.get_all_customers_list') }}"; 
        try{ 
            let response = await fetch(url);
            if(!response.ok){
                console.log("Network error");
                return;
            }
            let data = await response.json();
             customersData = data.customers; 

        }catch(error){
            console.log(error);
        }
    }

    // filter data function
    const filterCustomerResponse = () =>{
        let orderList = document.getElementById('orderList');
        let searchInputValue =  document.getElementById('handalInput').value.toLowerCase().trim(); 
         
        if(searchInputValue === ""){
            orderList.innerHTML = "";
            return;
         }

        const filterCustomerData = customersData.filter(customer =>
            customer.name && customer.name.toLowerCase().includes(searchInputValue) ||
            customer.phone && customer.phone.toString().includes(searchInputValue) ||
            customer.email && customer.email.toLowerCase().includes(searchInputValue)
        )  
       
        let append_html = '';
        filterCustomerData.forEach((element, index)=>{
            append_html += ` 
                    <tr>
                        <th scope="row">${index+1}</th>
                         <td>${element.name}</td>
                        <td> ${element.email}</td>
                        <td> ${element.phone}</td>
                        <td>
                            <a href="{{ route('backend.order.create_order') }}?customer=${element.id}" class="btn btn-info">Create Order</a>
                        </td>
                    </tr> 
                `
        }) 
        orderList.innerHTML = append_html; 
    }

    window.addEventListener('DOMContentLoaded', async() =>{
        fetchCustomerdata();
    }); 
    document.getElementById('handalInput').addEventListener('input', filterCustomerResponse); 
</script> 


@endsection
@endsection
