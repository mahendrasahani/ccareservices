@extends('layouts/backend/main')
@section('main-section') 
<div class="content-body">
            <div class="top-set">
                    <div class="container">                       
                        <div class="row" style=" padding: 0px 15px 0px 16px;">
                            <div class="col-md-12">
                                    <div class="card" style="border: 1px solid #d0d0d0;">
                                        <div class="card-header d-flex align-items-center" style="border-bottom: 1px solid #d0d0d0;gap:20px">
                                            <div class="col text-center text-md-left">
                                                <h4 class="mb-md-0 h5">Recent Activity</h4>
                                            </div>
                                         
                                <div class="col-md-4">
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" id="search" name="search" placeholder="Search name, email, city or country">
                                </div>
                                </div>

                                             
        
                                             
                                            </form>
                                            <!-- <div class="col-xl-2 col-md-3">
                                                <input type="text" class="form-control form-control-sm" id="search"
                                                    name="search" placeholder="Type Order code & hit Enter">
                                            </div> -->
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                               
                                                        <table class="table aiz-table mb-0 footable footable-1 breakpoint-lg">
                                                            <thead>
                                                                <tr class="footable-header">
                                                                    <!-- <th class="footable-first-visible">
                                                                        <div class="form-group">
                                                                            <div class="aiz-checkbox-inline">
                                                                                <label class="aiz-checkbox">
                                                                                    <input type="checkbox" id="selectAllCheckbox">
                                                                                    <span class="aiz-square-check"></span>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </th> -->
                                                                    <th class="col-xl-2">User Name</th> 
                                                                    <th>User Email </th>
                                                                    <th >Country</th>
                                                                    <th>Region</th>
                                                                    <th>City</th>
                                                                    <th>Zip</th>
                                                                    <th>Date</th>
                                                                </tr>
                                                            </thead>
                        
                                                            <tbody id="main_table_body">
                                                                @if(count($recent_activies) > 0)
                                                                @foreach($recent_activies as $activity)
                                                                <tr>
                                                                    <td>{{$activity->user_name}}</td>
                                                                    <td>{{$activity->user_email}}</td>
                                                                    <td>{{$activity->country}}</td>
                                                                    <td>{{$activity->region}}</td>
                                                                    <td>{{$activity->city}}</td>
                                                                    <td>{{$activity->zip}}</td>
                                                                    <td>{{\Carbon\Carbon::parse($activity->created_at)->format('d M, Y')}}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                @endif
                                                            </tbody>
                                                        </table>
                                                         
                                                        {{$recent_activies->links('pagination::bootstrap-5')}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
              
                </div>
        </div> 

@section('javascript-section') 
<script>
    $(document).ready(function (){
        $(document).on('keydown', '#search', function (){
            const search_val = $(this).val();
            if (search_val === ''){
                $('#my_pagination').show();
            } else{ 
                $.ajax({
                    url: "{{route('backend.recent_activity.search')}}",
                    method: "GET",
                    data: { 'search_val': search_val },
                    success: function (result){ 
                        $("#main_table_body").html(result);
                        $('#my_pagination').hide();
                    }
                });
            }
        });
    }); 
</script>
 
@endsection
@endsection