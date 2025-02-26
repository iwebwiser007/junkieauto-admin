<x-header></x-header>
<x-nav></x-nav>
<?php use Carbon\Carbon; ?>


  <div class="page-body">
          <!-- Container-fluid starts-->
          <div class="container-fluid">
          <div class="row">
          <div class="col-12">
            <div class="card">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h5>Bid Detail</h5>
                    
                    <div>
                    <a href="{{url('seller_detail',$all_bids->user_id)}}" class="btn btn-success me-2"> 
                        View Dealer</a>
                    <a href="{{url('auction_detail',$owner->id)}}" class="btn btn-primary">View Auction</a>
                </div>
                </div>
              <div class="p-4 row justify-content-between mx-0">
                <div class="d-1 col-3">
                    <a href="{{url('seller_detail',$all_bids->user_id)}}"><h6>Dealer Name</h6>
                      <p>{{$all_bids->user->first_name}} {{$all_bids->user->last_name}}</p>
                    </a>
                </div>

                <div class="d-2 col-3">
                  <h6>Mobile No.</h6>
                  <a href="tel:{{$owner->user->mobile_number}}">{{$all_bids->user->mobile_number}}</a>
                </div>

                <div class="d-2 col-3">
                  <h6>Email Address</h6>
                  <a href="mailto:{{$all_bids->user->email}}">{{$all_bids->user->email}}</a>
                </div>

                <div class="d-2 col-3">
                  <h6>Dealer Address</h6>
                  <address>{{$all_bids->user->address ?? ''}} {{$all_bids->user->street ?? ''}}<br>{{$all_bids->user->city ?? ''}} {{$all_bids->user->state ?? ''}}<br>{{$all_bids->user->country ?? ''}}</address>
                </div>

                <div class="d-2 col-3">
                  <h6>Bid Price</h6>
                  <p>$ {{$all_bids->bid_amount ?? ''}}</p>
                </div>

                <div class="d-2 col-3">
                  <h6>Bid Type</h6>
                    @if($all_bids->type == 'bid')
                        <span class="badge badge-info">Bid</span>
                    @elseif($all_bids->type == 'pre_bid')
                        <span class="badge badge-dark">Pre Bid</span>
                    @elseif($all_bids->type == 'direct_buy')
                        <span class="badge badge-dark">Make Offer</span>
                    @endif
                </div>
                
                <div class="d-2 col-3">
                  <h6>Bid Status</h6>
                    @if($all_bids->status == '1')
                        <span class="badge badge-success">Active</span>
                    @elseif($all_bids->status == '0')
                        <span class="badge badge-danger">Rejected</span>
                    @elseif($all_bids->status == '2')
                        <span class="badge badge-primary">Win</span>
                    @endif
                </div>

                <div class="d-2 col-3">
                  <h6>Bid Date</h6>
                  <p>{{Carbon::parse($all_bids->created_at)->isoFormat('MMM Do YYYY') ?? ''}}</p>
                </div>
                
                
              </div>

              <div class="card-body">
                <ul class="nav nav-tabs border-tab nav-primary mb-3" id="info-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="info-home-tab" data-bs-toggle="tab" href="#info-home" role="tab"
                      aria-controls="info-home" aria-selected="true">Auction Details</a>
                      
                  </li>
                  
                  
                  
                </ul>

                <div class="tab-content" id="info-tabContent">
                  <div class="tab-pane fade show active" id="info-home" role="tabpanel" aria-labelledby="info-home-tab">
                    <!-- Container-fluid starts-->
                    <div class="container-fluid p-0">
                      <div class="row">
                        <!-- Default ordering (sorting) Starts-->
                        <div class="col-sm-12">
                          <div class="card border-0">
                            <div class="card-body p-1">
                            <div class="table-responsive">
                                
                                <table class="display dataTable" id="basic-3">
                                   
                                  <tbody>
                                      
                                    <tr>
                                        <th>Seller Name</th>
                                        <td>
                                            <a href="{{url('auction_detail',$owner->id)}}">
                                                {{$owner->user->first_name ?? 'N/A'}} {{$owner->user->last_name ?? 'N/A'}}
                                            </a>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                      <th>Address</th>
                                      <td>
                                      <address>{{$owner->address ?? 'N/A'}},<br>{{$owner->city ?? 'N/A'}}, {{$owner->state ?? 'N/A'}},<br>{{$owner->country ?? 'N/A'}}</address>
                                    </tr>
                                    <tr>
                                      <th>Longitude</th>
                                      <td>{{$owner->lng ?? 'N/A'}}
                                    </tr>
                                    <tr>
                                      <th>Latitude</th>
                                      <td>{{$owner->lat ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>

                                      <th>Make</th>
                                      <td>{{$owner->category_translation->name ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                      <th>Model</th>
                                      <td>{{$owner->models->name ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                      <th>Year of Purchase</th>
                                      <td>{{$owner->year ?? 'N/A'}}</td>
                                    </tr>  
                                    <tr>
                                      <th>Engine Power</th>
                                      <td>{{$owner->engine ?? 'N/A'}}</td>
                                    </tr>  
                                    <tr>
                                      <th>Mileage</th>
                                      <td>{{$owner->mileage ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                      <th>VIN</th>
                                      <td>{{$owner->vin ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                      <th>Color</th>
                                      <td>{{$owner->colors->name ?? 'N/A'}}</td>
                                    </tr>

                                    <tr>
                                      <th>Fuel Type</th>
                                      <td>{{$owner->fuels->name ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                      <th>Used Type</th>
                                      <td>{{$owner->uses->name ?? 'N/A'}}</td>
                                    </tr> 
                                    
                                    <tr>
                                      <th>Bid Start Price</th>
                                      <td>$ {{number_format($owner->bid_price,2) ?? 'N/A'}}</td> 
                                    </tr>  
                                    <tr>  
                                      <th>Bid End Price</th>
                                      <td>$ {{number_format($owner->bid_closed_price,2) ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                      <th>Bid Closed Price</th>
                                      <td>$ {{number_format($owner->sale_price,2) ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                      <th>Bid Start Date</th>
                                      <td>{{Carbon::parse($owner->bid_start)->isoFormat('MMM Do YYYY')}}</td>
                                    </tr>  
                                    <tr>  
                                      <th>Bid End Date</th>
                                      <td>{{Carbon::parse($owner->bid_end)->isoFormat('MMM Do YYYY')}}</td>
                                    </tr>
                                    <tr>
                                      <th>Damage Type</th>
                                      <td>{{$owner->damages->name ?? 'N/A'}}</td>
                                    </tr> 
                                    <tr>
                                      <th>Secondary Damage Type</th>
                                      <td>{{$owner->sec_damages->name ?? 'N/A'}}</td>
                                    </tr> 
                                    <tr>
                                      <th>Driverline Type</th>
                                      <td>{{$owner->drivelines->name ?? 'N/A'}}</td>
                                    </tr> 
                                    <tr>
                                      <th>Body Type</th>
                                      <td>{{$owner->bodies->name ?? 'N/A'}}</td>
                                    </tr> 
                                    <tr>
                                      <th>Transmission</th>
                                      <td>{{$owner->transmissions->name ?? 'N/A'}}</td>
                                    </tr> 
                                    <tr>
                                      <th>Catalytic Convertor</th>
                                      <td>{{$owner->catalytics->name ?? 'N/A'}}</td>
                                    </tr> 
                                    <tr>
                                      <th>About</th>
                                      <td>{{$owner->details ?? 'N/A'}}</td>
                                    </tr> 
                                    @if($owner->status == '0')
                                    <tr>
                                      <th>Cancel Reason</th>
                                      <td> {{$owner->cancel_reason ?? 'N/A'}}</td>
                                    </tr>
                                    @endif

                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- Default ordering (sorting) Ends-->
                      </div>
                    </div>
                    <!-- Container-fluid Ends-->
                  </div>

                  

                  

                </div>
              </div>
            </div>
          </div>
        </div>
          </div>
        </div>
        <!-- Container-fluid Ends-->
      </div>

<x-footer></x-footer>

<script>
  function select(id){
        $('#auction_type').submit();
    }
</script>
