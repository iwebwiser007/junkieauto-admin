<x-header></x-header>
<x-nav ></x-nav  >
<?php use Carbon\Carbon; 
 $current = now()->format('Y-m-d'); ?>


  <div class="page-body">
          <!-- Container-fluid starts-->
          <div class="container-fluid">
          <div class="row">
          <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                <h5>Auction Details</h5>
              </div>
              <div class="card-body">
                <div class="user-profile">
                  <div class="row align-items-center">
                    <!-- user profile header start-->
                    <div class="col-sm-12">
                      <div class="card-header row justify-content-between">
                        <div class="d-1 col-3">
                          <h6>Seller Name</h6>
                          <p>{{$auction->user->first_name ?? 'N/A'}} {{$auction->user->last_name ?? 'N/A'}}</p>
                          
                        </div>
        
                        <div class="d-2 col-3">
                          <h6>Mobile No.</h6>
                          {{$auction->user->mobile_number ?? 'N/A'}}
                        </div>
        
                        <div class="d-2 col-3">
                          <h6>Email Address</h6>
                          {{$auction->user->email ?? ''}}
                        </div>
        
                        <div class="d-2 col-3">
                          <h6>Auction Address</h6>
                          <address>{{$auction->address ?? 'N/A'}}<br>{{$auction->city ?? 'N/A'}} {{$auction->state ?? 'N/A'}}<br>{{$auction->country ?? 'N/A'}}</address>
                          
                          @isset($auction->latest_offer)
                          @if($auction->latest_offer == '1')
                          <p class="badge rounded-pill bg-warning text-dark mt-2 d-block w-50 f-14 r">Latest Offer</p>
                          
                          @endif
                          @endisset
        
                          @if($auction->status == 0)    
                          <span class="badge badge-danger rounded-pill">Cancelled</span>
                          @elseif($auction->status == 2 && $auction->bid_end > $current)
                          <span class="badge badge-primary rounded-pill">Active</span>
                          @elseif($auction->status == 2 && $auction->bid_end < $current)
                          <span class="badge badge-primary rounded-pill">Expired</span>
                          @elseif($auction->status == 3)
                          <span class="badge badge-success rounded-pill">Sold</span>
                          @elseif($auction->status == 5)
                          <span class="badge badge-secondary rounded-pill">Closed</span>
                          @endif
                        </div>
        
                        @if($auction->status == '1')
                        <div class="d-2 col-3">
                          
                          
                            <h6>Auction Request</h6>
                            
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#acceptmodal" onclick="accept_req({{$auction->id}})">Accept</button>
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectmodal" onclick="reject_req({{$auction->id}})">Reject</button>
                          
                          
                        </div>
                        @endif
                        
        
                        
        
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card-body">
                <ul class="nav nav-tabs border-tab nav-primary mb-3" id="info-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="info-home-tab" data-bs-toggle="tab" href="#info-home" role="tab"
                      aria-controls="info-home" aria-selected="true">Bids</a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" id="profile-info-tab" data-bs-toggle="tab" href="#info-profile" role="tab"
                      aria-controls="info-profile" aria-selected="false">Gallery</a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" id="product-info-tab" data-bs-toggle="tab" href="#info-product" role="tab"
                      aria-controls="info-product" aria-selected="false">Detail</a>
                  </li>

                  @if($winner != '')
                   <li class="nav-item">
                    <a class="nav-link" id="winner-info-tab" data-bs-toggle="tab" href="#info-winner" role="tab"
                      aria-controls="info-winner" aria-selected="false">Winner</a>
                  </li> 
                  @endif

                  <!-- <li class="nav-item ms-auto">
                    <a href="auction-product-details.html" class="btn btn-primary" type="button">Auction Product
                      Details</a>
                  </li> -->
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
                                <table class="display dataTable" id="basic-1">
                                  <thead>
                                    <tr>
                                      <th>Dealer Name</th>
                                      <th>Email</th>
                                      <th>Bid Type</th>
                                      <th>Bid Price (in $)</th>
                                      <th>Bid Date</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @if(count($bids) > 0)
                                    @forelse($bids as $bid)

                                    <tr style="{{($bid->status == '2')? 'color:Black;' : ''}}">
                                      <td style="{{($bid->status == '2')? 'background-color:rgba(36, 105, 92, 0.5);' : ''}}">{{$bid->user->first_name}} {{$bid->user->last_name}}</td>
                                      <td style="{{($bid->status == '2')? 'background-color:rgba(36, 105, 92, 0.5);' : ''}}">{{$bid->user->email}}</td>
                                      <td align="center" style="{{($bid->status == '2')? 'background-color:rgba(36, 105, 92, 0.5);' : ''}}">
                                                @if($bid->type == 'bid')    
                                                <span class="badge badge-secondary rounded-pill">Bid</span>
                                                @elseif($bid->type == 'direct_buy')    
                                                <span class="badge badge-success rounded-pill">Direct Buy</span>
                                                @elseif($bid->type == 'pre_bid')    
                                                <span class="badge badge-primary rounded-pill">Pre Bid</span>
                                                @endif
                                        </td>
                                      <td style="{{($bid->status == '2')? 'background-color:rgba(36, 105, 92, 0.5);' : ''}}">{{number_format($bid->bid_amount,2) ?? 'N/A'}}</td>
                                      <td style="{{($bid->status == '2')? 'background-color:rgba(36, 105, 92, 0.5);' : ''}}">{{$bid->created_at->isoFormat('MMM Do YYYY')}}</td>
                                      

                                      <td style="{{($bid->status == '2')? 'background-color:rgba(36, 105, 92, 0.5);' : ''}}" align="center"><a href="{{url('dealer_detail/'.$bid->user->id)}}" class="btn btn-primary">Detail</a></td>
                                    </tr>
                                    @empty
                                    <tr>
                                      <td>No bids available for this auction</td>
                                    </tr>
                                    @endforelse
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

                  <div class="tab-pane fade" id="info-profile" role="tabpanel" aria-labelledby="profile-info-tab">
                    <!------- Auction Product Images ------->
                    <h5 class="ms-4 mb-0">Auction Product Images</h5>

                    <div class="gallery my-gallery card-body row" itemscope="">
                      
                      @forelse($auction->media->where('type','image') as $media)
                      
                                
                        <figure class="col-xl-3 col-md-4 xl-33" itemprop="associatedMedia" itemscope=""><a
                            href="{{'http://168.235.81.206:60000'.$media->media_url}}" itemprop="contentUrl" data-size="1600x950"><img
                              class="img-thumbnail" src="{{'http://168.235.81.206:60000'.$media->media_url}}" itemprop="thumbnail"
                              alt="Image description"></a>
                          <!-- <figcaption itemprop="caption description">Image caption 3</figcaption> -->
                        </figure>
                        
                        
                        
                        @empty
                        <figure class="col-xl-3 col-md-4 xl-33" itemprop="associatedMedia" itemscope=""><a
                            href="{{asset('image/no_image.jpg')}}" itemprop="contentUrl" data-size="1600x950"><img
                              class="img-thumbnail" src="{{asset('image/no_image.jpg')}}" itemprop="thumbnail"
                              alt="Image description"></a>
                          <!-- <figcaption itemprop="caption description">Image caption 3</figcaption> -->
                        </figure>
                        
                        @endforelse
                      
                    </div>

                    <!------- Auction Product Video ------->
                    <h5 class="ms-4 mb-0">Auction Product Videos</h5>

                    <div class="gallery my-gallery card-body row" itemscope="">
                    @isset($auction->media)
                    @forelse($auction->media->where('type','video') as $media)
                    
                                
                    <figure class="col-xl-3 col-md-4 xl-33" itemprop="associatedMedia" itemscope=""><a
                        href="{{'http://168.235.81.206:60000'.$media->media_url}}" itemprop="contentUrl" data-size="1600x950"><img
                          class="img-thumbnail" src="{{'http://168.235.81.206:60000'.$media->media_url}}" itemprop="thumbnail"
                          alt="Video description"></a>
                      <!-- <figcaption itemprop="caption description">Image caption 3</figcaption> -->
                    </figure>
                    
                    
                    
                    @empty
                    <figure class="col-xl-3 col-md-4 xl-33" itemprop="associatedMedia" itemscope=""><a
                        href="{{'./assets/images/novideo.jpg'}}" itemprop="contentUrl" data-size="1600x950"><img
                          class="img-thumbnail" src="{{asset('image/novideo.jpg')}}" itemprop="thumbnail"
                          alt="Video description"></a>
                      <!-- <figcaption itemprop="caption description">Image caption 3</figcaption> -->
                    </figure>
                    
                    @endforelse
                    @endisset
                     
                    </div>
                  </div>

                  <div class="tab-pane fade" id="info-product" role="tabpanel" aria-labelledby="product-info-tab">
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
                                      <th>Address</th>
                                      <td>
                                      <address>{{$auction->address ?? 'N/A'}}<br>{{$auction->city ?? 'N/A'}} {{$auction->state ?? 'N/A'}}<br>{{$auction->country ?? 'N/A'}}</address>
                                    </tr>
                                    <tr>
                                      <th>Longitude</th>
                                      <td>{{$auction->lng ?? 'N/A'}}
                                    </tr>
                                    <tr>
                                      <th>Latitude</th>
                                      <td>{{$auction->lat ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>

                                      <th>Make</th>
                                      <td>{{$auction->category_translation->name ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                      <th>Model</th>
                                      <td>{{$auction->models->name ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                      <th>Year of Purchase</th>
                                      <td>{{$auction->year ?? 'N/A'}}</td>
                                    </tr>  
                                    <tr>
                                      <th>Engine Power</th>
                                      <td>{{$auction->engine ?? 'N/A'}}</td>
                                    </tr>  
                                    <tr>
                                      <th>Mileage</th>
                                      <td>{{$auction->mileage ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                      <th>VIN</th>
                                      <td>{{$auction->vin ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                      <th>Color</th>
                                      <td>{{$auction->colors->name ?? 'N/A'}}</td>
                                    </tr>

                                    <tr>
                                      <th>Fuel Type</th>
                                      <td>{{$auction->fuels->name ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                      <th>Used Type</th>
                                      <td>{{$auction->uses->name ?? 'N/A'}}</td>
                                    </tr> 
                                    
                                    <tr>
                                      <th>Bid Start Price</th>
                                      <td>$ {{number_format($auction->bid_price,2) ?? 'N/A'}}</td> 
                                    </tr>  
                                    <tr>  
                                      <th>Bid End Price</th>
                                      <td>$ {{number_format($auction->bid_closed_price,2) ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                      <th>Bid Closed Price</th>
                                      <td>$ {{number_format($auction->sale_price,2) ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                      <th>Bid Start Date</th>
                                      <td>{{Carbon::parse($auction->bid_start)->isoFormat('MMM Do YYYY')}}</td>
                                    </tr>  
                                    <tr>  
                                      <th>Bid End Date</th>
                                      <td>{{Carbon::parse($auction->bid_end)->isoFormat('MMM Do YYYY')}}</td>
                                    </tr>
                                    <tr>
                                      <th>Damage Type</th>
                                      <td>{{$auction->damages->name ?? 'N/A'}}</td>
                                    </tr> 
                                    <tr>
                                      <th>Secondary Damage Type</th>
                                      <td>{{$auction->sec_damages->name ?? 'N/A'}}</td>
                                    </tr> 
                                    <tr>
                                      <th>Driverline Type</th>
                                      <td>{{$auction->drivelines->name ?? 'N/A'}}</td>
                                    </tr> 
                                    <tr>
                                      <th>Body Type</th>
                                      <td>{{$auction->bodies->name ?? 'N/A'}}</td>
                                    </tr> 
                                    <tr>
                                      <th>Transmission</th>
                                      <td>{{$auction->transmissions->name ?? 'N/A'}}</td>
                                    </tr> 
                                    <tr>
                                      <th>Catalytic Convertor</th>
                                      <td>{{$auction->catalytics->name ?? 'N/A'}}</td>
                                    </tr> 
                                    <tr>
                                      <th>About</th>
                                      <td>{{$auction->details ?? 'N/A'}}</td>
                                    </tr> 
                                    @if($auction->status == '0')
                                    <tr>
                                      <th>Cancel Reason</th>
                                      <td> {{$auction->cancel_reason ?? 'N/A'}}</td>
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

                  <div class="tab-pane fade" id="info-winner" role="tabpanel" aria-labelledby="winner-info-tab">
                    <!-- Container-fluid starts-->
                    <div class="container-fluid p-0">
                      <div class="row">
                        <!-- Default ordering (sorting) Starts-->
                        <div class="col-sm-12">
                          <div class="card border-0">
                            <div class="card-body p-1">
                            <div class="table-responsive">
                                <table class="display dataTable" id="table-5">
                                  
                                  <tbody>
                                    <tr>
                                      <th>Name</th>
                                      <td>{{$winner->user->first_name ?? ''}} {{$winner->user->last_name ?? ''}}</td>
                                    </tr>
                                    <tr>
                                      <th>Email</th>
                                      <td>{{$winner->user->email ?? ''}}</td>
                                    </tr>
                                    <tr>
                                      <th>Mobile Number</th>
                                      <td>{{$winner->user->mobile_number ?? ''}}</td>
                                    </tr>
                                    <tr>
                                      <th>Address</th>
                                      <td><address>{{$winner->user->address ?? ''}} {{$winner->user->street ?? ''}}<br>{{$winner->user->city ?? ''}} {{$winner->user->state ?? ''}}<br>{{$winner->user->country ?? ''}}</address></td>
                                    </tr>
                                    @isset($auction->bid_price)
                                    <tr>
                                      <th>Bid Price (From - To)</th>
                                      <td>$ {{number_format($auction->bid_price,2) ?? 'N/A'}} To $ {{number_format($auction->bid_closed_price,2) ?? 'N/A'}}</td>
                                    </tr>
                                    @endisset

                                    @isset($winner->commission->bid_amount)
                                    <tr>
                                      <th>Win Price</th>
                                      <td>$ {{number_format($winner->commission->bid_amount,2) ?? 'N/A'}}</td>
                                    </tr>
                                    @endisset

                                    @isset($winner->commission->commission_amount)
                                    <tr>
                                      <th>Earning</th>
                                      <td>$ {{number_format($winner->commission->commission_amount,2) ?? 'N/A'}}</td>
                                    </tr>
                                    @endisset

                                    

                                  </tobdy>  
                                    
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


<!---- Request accept Modal ---->
<div class="modal fade" id="acceptmodal" tabindex="-1" role="dialog" aria-labelledby="acceptmodal"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Do you want to accept request?</h5>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body mt-3">
        <div class="mb-3">
            <form action="{{url('accept_auc_req')}}" method="post" id="accept_auc_req">
                @csrf
                  <input type="hidden" name="acc_req_id" id="acc_req_id">
                  <div class="modal-btn mt-4 text-center">
                    <button class="btn btn-danger me-3" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" >Accept</button>
              
                  </div>
              </form>

        </div>
      </div>

    </div>
  </div>
</div>

  <!---- Request reject Modal ---->
  <div class="modal fade" id="rejectmodal" tabindex="-1" role="dialog" aria-labelledby="rejectmodal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Do you want to reject auction request?</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body mt-3">
          <div class="mb-3">
              <form action="{{url('reject_auc_req')}}" method="post" id="reject_auc_req">
                  @csrf
                  <input type="hidden" name="rej_req_id" id="rej_req_id">
                    <label class="form-label" for="req_reason">Reject Reason</label> 
                    <textarea class="form-control" type="text" name="req_reason" id="req_reason" placeholder="Enter Reject Reason........" required></textarea>
                    <span id="req_reason_error"></span>
                    <div class="modal-btn mt-4 text-center">
                      <button class="btn btn-danger me-3" type="button" data-bs-dismiss="modal">Cancel</button>
                      <button class="btn btn-primary" type="button" onclick="request_rej()">Submit</button>
                
                    </div>
               </form>

          </div>
        </div>

      </div>
    </div>
  </div>

<x-footer></x-footer>