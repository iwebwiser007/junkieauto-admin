<x-header></x-header>
<x-nav></x-nav>
<?php use Carbon\Carbon; ?>


  <div class="page-body">
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12 col-xl-12 xl-100">
                <div class="card">
                  <div class="card-header pb-0">
                    <h5>Dealer Details</h5>
                  </div>
                  <div class="card-body">
                    <div class="user-profile">
                      <div class="row align-items-center">
                        <!-- user profile header start-->
                        <div class="col-sm-12">
                          <div class="card profile-header p-0 flex-row justify-content-between row">
                            <div class="col-12">
                              <div class="userpro-box w-100">
                                <div
                                  class="user-designation text-start user-designation text-start d-flex justify-content-between">
                                  <div class="title">
                                    <h4 class="mb-1">{{$dealer->first_name ?? ''}} {{$dealer->last_name ?? ''}}</h4>
                                    <h6>({{$dealer->country ?? ''}})</h6>
                                    @isset($dealer->email)
                                    <p class="mb-2 d-inline-block"><i
                                        class="fas fa-at"></i>
                                        {{$dealer->email ?? ''}}</p>
                                    @endisset

                                    @isset($dealer->mobile_number)
                                    <p class="mb-2 d-block"><i
                                        class="fas fa-phone-square-alt"></i>
                                        {{$dealer->mobile_number ?? ''}}</p>
                                    @endisset

                                    
                                    <p class="mb-0 mt-2"><i class="fas fa-map-marked-alt"></i> Address
                                      <address>{{$dealer->address ?? ''}} {{$dealer->street ?? ''}}<br>{{$dealer->city ?? ''}} {{$dealer->state ?? ''}},<br>{{$country ?? ''}}</address>
                                    </p>
                                    <!-- <p class="badge rounded-pill bg-warning text-dark mt-2 d-block w-50 f-14 r">PayPal
                                    </p> -->
                                  </div>

                                  <div class="follow mt-3">
                                    <ul class="follow-list">
                                      <li>
                                        <div class="follow-num counter text-center">{{count($deals)}}</div><span>Total Deals</span>
                                      </li>

                                      <li>
                                        <div class="follow-num counter text-center">{{count($all_bids)}}</div><span>Total Bids</span>
                                      </li>

                                      
                                    </ul>
                                  </div>

                                  
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="col-sm-12 col-xl-12 xl-100">
                          

                          <ul class="nav nav-tabs border-tab nav-primary mb-3" id="info-tab" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link active" id="info-home-tab" data-bs-toggle="tab" href="#info-home"
                                role="tab" aria-controls="info-home" aria-selected="true">All Deals</a>
                            </li>

                            <li class="nav-item">
                              <a class="nav-link" id="info-bids-tab" data-bs-toggle="tab" href="#info-bids"
                                role="tab" aria-controls="info-bids" aria-selected="true">All Bids</a>
                            </li>

                            <li class="nav-item">
                              <a class="nav-link" id="info-detail-tab" data-bs-toggle="tab" href="#info-detail"
                                role="tab" aria-controls="info-detail" aria-selected="true">Detail</a>
                            </li>

                            <li class="nav-item">
                              <a class="nav-link" id="info-gallery-tab" data-bs-toggle="tab" href="#info-gallery"
                                role="tab" aria-controls="info-gallery" aria-selected="true">Gallery</a>
                            </li>

                            
                          </ul>

                          <div class="tab-content" id="info-tabContent">
                            <div class="tab-pane fade show active" id="info-home" role="tabpanel"
                              aria-labelledby="info-home-tab">
                              <!-- Container-fluid starts-->
                              <div class="container-fluid p-0">
                                <div class="row">
                                  <!-- Default ordering (sorting) Starts-->
                                  <div class="col-sm-12">
                                    <div class="card border-0">
                                      <div class="card-body p-1">
                                        <div class="table-responsive">
                                          <table class="display dataTable" id="table-1">
                                            <thead>
                                              <tr>
                                                <th>User Name</th>
                                                <th>Model</th>
                                                <th>Year</th>
                                                <th>Price</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($deals as $del)
                                              <tr>
                                                <td>{{$del->auction->user->first_name ?? ''}} {{$del->auction->user->last_name ?? ''}}</td>
                                                <td>{{$del->auction->models->name ?? ''}}</td>
                                                <td>{{$del->auction->year ?? ''}}
                                                <td>{{$del->bid_amount}}</td>
                                                <td>{{$del->created_at->isoFormat('MMM Do YYYY')}}</td>
                                                <td align='center'>
                                                    <a href="{{url('auction_detail/'.$del->auction_id)}}" class="btn btn-primary">Detail</a>
                                                </td>
                                                
                                              </tr>
                                              @empty
                                              <tr>
                                                  <td colspan='6' align='center'>No deals available</td>
                                              </tr>
                                              @endforelse


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

                            <div class="tab-pane fade" id="info-bids" role="tabpanel" aria-labelledby="info-bids-tab">
                              <!-- Container-fluid starts-->
                              <div class="container-fluid p-0">
                                <div class="row">
                                    <div class="action-buttons">
                                        <!-- Add New Tab -->
                                      <form action="{{url('dealer_detail/'.$dealer->id)}}" method="post" id='bid_type'>
                                        @csrf
                                        <select class="form-select" id="bids_type" name="bids_type" onchange="select(this.value)" >
                                          <option class="d-none" label="Select Bids Type"></option>
                                          <option value="All Bids" {{($headname == 'All Bids')? 'selected' : ''}} >All Bids</option>
                                          <option value="Active Bids" {{($headname == 'Active Bids')? 'selected' : ''}}>Actvie Bids</option>
                                          <option value="Lost Bids" {{($headname == 'Lost Bids')? 'selected' : ''}}>Lost Bids</option>
                                          <option value="Win Bids" {{($headname == 'Win Bids')? 'selected' : ''}}>Won Bids</option>
                                          
                                        </select>
                                      </form>

                                              
                                    </div>
                                    <!-- Default ordering (sorting) Starts-->
                                    <div class="col-sm-12">
                                      <div class="card border-0">
                                        <div class="card-body p-1">
                                          <div class="table-responsive">
                                            <table class="display dataTable" id="basic-1">
                                              <thead>
                                                
                                                <tr>
                                                  <th>Seller Name</th>
                                                  <th>Models</th>
                                                  <th>Year</th>
                                                  <th>Bid Type</th>
                                                  <th>Bid Price</th>
                                                  <th>Bid Date</th>
                                                  <th>Action</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                @forelse($all_bids as $bid)
                                                
                                                <tr >
                                                
                                                    <td >{{$bid->auction[0]->user->first_name ?? ''}} {{$bid->auction[0]->user->last_name ?? ''}}
                                                        
                                                  </td>
                                                    <td >{{$bid->auction[0]->models->name ?? ''}}</td>
                                                    <td >{{$bid->auction[0]->year ?? ''}}</td>
                                                    <td >
                                                        @if($bid->status == '1')
                                                            <span class="badge badge-warning rounded-pill">Active Bid</span>
                                                        @elseif($bid->status == '2')  
                                                            <span class="badge badge-success rounded-pill">Won Bid</span>  
                                                        @elseif($bid->status == '0')
                                                            <span class="badge badge-danger rounded-pill">Lost Bid</span>
                                                        @endif
                                                    </td>
                                                    <td >{{$bid->bid_amount ?? ''}}</td>
                                                    <td >{{$bid->created_at->isoFormat('MMM Do YYYY') ?? ''}}</td>
                                                    <td  align='center'><a href="{{url('auction_detail/'.$bid->auction_id)}}" class="btn btn-primary">Detail</a></td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colsapn='7' align='center'>No Bid available</td>
                                                </tr>
                                                @endforelse
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

                            <!-- dealer detail -->
                          <div class="tab-pane fade" id="info-detail" role="tabpanel" aria-labelledby="detail-info-tab">
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
                                                <th>Name</th>
                                                <td>{{$dealer->first_name}} {{$dealer->last_name}}</td>
                                              </tr>

                                            <tr>

                                                <th>Email</th>
                                                <td>{{$dealer->email ?? 'N/A'}}</td>
                                              </tr>
                                              <tr>
                                                <th>Mobile Number</th>
                                                <td>{{$dealer->mobile_number ?? 'N/A'}}</td>
                                              </tr>
                                              <tr>
                                                <th>Address</th>
                                                <td>
                                                <address>{{$dealer->address ?? 'N/A'}}<br>{{$dealer->city ?? 'N/A'}} {{$dealer->state ?? 'N/A'}}<br>{{$dealer->country ?? 'N/A'}}</address>
                                              </tr>
                                              
                                              
                                              <tr>
                                                <th>Document Type</th>
                                                <td>{{str_replace('_',' ',$dealer->document_type) ?? 'N/A'}}</td>
                                              </tr>  
                                              <tr>
                                                <th>Issue Date</th>
                                                <td>{{Carbon::parse($dealer->issue_date)->isoFormat('MMM Do YYYY')}}</td>
                                              </tr>  
                                              <tr>
                                                <th>Expire Date</th>
                                                <td>{{Carbon::parse($dealer->expire_date)->isoFormat('MMM Do YYYY')}}</td>
                                              </tr>
                                              <tr>
                                                <th>ID Number</th>
                                                <td>{{$dealer->id_number ?? 'N/A'}}</td>
                                              </tr>
                                              <tr>
                                                <th>Type</th>
                                                <td>{{$dealer->type ?? 'N/A'}}</td>
                                              </tr>

                                              
                                              @if($dealer->status == '2')
                                              <tr>
                                                <th>Cancel Reason</th>
                                                <td> {{$dealer->cancel_reason ?? 'N/A'}}</td>
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

                          <!-- Gallery -->
                        <div class="tab-pane fade" id="info-gallery" role="tabpanel"
                          aria-labelledby="info-gallery-tab">
                          <!------- Auction Product Images ------->
                          <h5 class="ms-4 mb-0">Dealer Document's Images</h5>

                          <div class="gallery my-gallery card-body row" itemscope="">
                            
                            @forelse($media[0]->files as $medias)
                            
                            <figure class="col-xl-3 col-md-4 xl-33" itemprop="associatedMedia" itemscope=""><a
                                href="{{'http://168.235.81.206:60000'.$medias->document_url}}" itemprop="contentUrl" data-size="1600x950"><img
                                  class="img-thumbnail" src="{{'http://168.235.81.206:60000'.$medias->document_url}}" itemprop="thumbnail"
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
                        </div>

                        </div>

                        

                            
                          </div>

                          
                        <!-- user profile header end-->
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
        $('#bid_type').submit();
    }
</script>
