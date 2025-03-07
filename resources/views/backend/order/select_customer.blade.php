@extends('layouts/backend/main')
@section('main-section')

<div class="content-body">
    <div class="top-set">
    <section>
        <div class="container">

            <div class="card">
                <div class="card-body">
                    <div class="createOrderElement"> 
                        <form> 
                            <div class="row">  
                                <div class="col-md-12 mt-3 mb-3"> 
                                    <h3> Create Order</h3>
                                </div>
                                    
                                <div class="col-md-6 mb-3">
                                    <label class="control-label" for="name">Name</label>
                                    <input type="text" placeholder="Name" name="name" class="form-control" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="control-label" for="email">Email id</label>
                                    <input type="text" placeholder="Email id" name="email" class="form-control" required >
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="control-label" for="number">Phone Number</label>
                                    <input type="text" placeholder="Phone Number" name="number" class="form-control" required >
                                </div>

                                <div class="col-12 mb-3">
                                    <button class="btn btn-info">Search</button>
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
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>test@gmail.com</td>
                                        <td>8784545052</td>
                                        <td>
                                              <button type="button" class="btn btn-primary">Create Order</button>
                                        </td>
                                    </tr>
                                    
                                </tbody>
                        </table>
                         
                    </div> 

                </div> 
            </div> 

        </div>
</section>
    </div>
</div>
 

@section('javascript-section')

@endsection
@endsection
