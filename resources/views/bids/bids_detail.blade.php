<x-header></x-header>
<x-nav></x-nav>


  <div class="page-body">
          <!-- Container-fluid starts-->
          <div class="container-fluid">
          <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header row justify-content-between mx-0">
                <div class="d-1 col-3">
                  <h6>User Name</h6>
                  <p>{{$owner->user->first_name}} {{$owner->user->last_name}}</p>
                  
                </div>

                <div class="d-2 col-3">
                  <h6>Mobile No.</h6>
                  <a href="tel:{{$owner->user->mobile_number}}">{{$owner->user->mobile_number}}</a>
                </div>

                <div class="d-2 col-3">
                  <h6>Email Address</h6>
                  <a href="mailto:{{$owner->user->email}}">{{$owner->user->email}}</a>
                </div>

                <div class="d-2 col-3">
                  <h6>User Address</h6>
                  <address>{{$owner->user->address ?? ''}} {{$owner->user->street ?? ''}},<br>{{$owner->user->city ?? ''}}, {{$owner->user->state ?? ''}},<br>{{$owner->user->country ?? ''}}</address>
                </div>

                <div class="d-2 col-3">
                  <h6>Brand</h6>
                  <p>{{$owner->makes->name ?? ''}}</p>
                </div>

                <div class="d-2 col-3">
                  <h6>Model</h6>
                  <p>{{$owner->models->name ?? ''}}</p>
                </div>

                <div class="d-2 col-3">
                  <h6>Used Type</h6>
                  <p>{{ $owner->uses->name ?? '' }}</p>
                </div>

                <div class="d-2 col-3">
                  <h6>Status</h6>
                  <p>{{$owner->statuses->name ?? ''}}</p>
                </div>

              </div>

              <div class="card-body">
                <ul class="nav nav-tabs border-tab nav-primary mb-3" id="info-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="info-home-tab" data-bs-toggle="tab" href="#info-home" role="tab"
                      aria-controls="info-home" aria-selected="true">All Bids</a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" id="profile-info-tab" data-bs-toggle="tab" href="#info-profile" role="tab"
                      aria-controls="info-profile" aria-selected="false">Bids</a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" id="product-info-tab" data-bs-toggle="tab" href="#info-product" role="tab"
                      aria-controls="info-product" aria-selected="false">Pre-Bids</a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" id="make-info-tab" data-bs-toggle="tab" href="#info-make" role="tab"
                      aria-controls="info-make" aria-selected="false">Make Offer</a>
                  </li>
                  
                  @if($winner != '')
                   <li class="nav-item">
                    <a class="nav-link" id="winner-info-tab" data-bs-toggle="tab" href="#info-winner" role="tab"
                      aria-controls="info-winner" aria-selected="false">Winner</a>
                  </li> 
                  @endif

                 
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
                                      <th>Name</th>
                                      <th>Email</th>
                                      <th>Bid Type</th>
                                      <th>Bid Price</th>
                                      <th>Bid Date</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @forelse($all_bids as $bid)
                                    <tr style="{{($bid->status == '2')? 'color:Black;' : ''}}">
                                        <td style="{{($bid->status == '2')? 'background-color:rgba(36, 105, 92, 0.5);' : ''}}">{{$bid->user->first_name ?? ''}} {{$bid->user->last_name ?? ''}}</td>
                                        <td style="{{($bid->status == '2')? 'background-color:rgba(36, 105, 92, 0.5);' : ''}}">{{$bid->user->email ?? ''}}</td>
                                        <td style="{{($bid->status == '2')? 'background-color:rgba(36, 105, 92, 0.5);' : ''}}">
                                            @if($bid->type == 'bid')
                                                <span class="badge badge-warning rounded-pill">Bid</span>
                                            @elseif($bid->type == 'direct_buy')  
                                                <span class="badge badge-success rounded-pill">Direct Buy</span>  
                                            @elseif($bid->type == 'pre_bid')
                                                <span class="badge badge-secondary rounded-pill">Pre Bid</span>
                                            @endif
                                        </td>
                                        <td style="{{($bid->status == '2')? 'background-color:rgba(36, 105, 92, 0.5);' : ''}}">{{$bid->bid_amount ?? ''}}</td>
                                        <td style="{{($bid->status == '2')? 'background-color:rgba(36, 105, 92, 0.5);' : ''}}" >{{$bid->created_at->isoFormat('MMM Do YYYY') ?? ''}}</td>
                                        <td style="{{($bid->status == '2')? 'background-color:rgba(36, 105, 92, 0.5);' : ''}}" align='center'><a href="{{url('dealer_detail/'.$bid->user_id)}}" class="btn btn-primary">Detail</a></td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colsapn='6' align='center'>No Bid available</td>
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

                  <div class="tab-pane fade" id="info-profile" role="tabpanel" aria-labelledby="profile-info-tab">
                    <!-- Container-fluid starts-->
                    <div class="container-fluid p-0">
                      <div class="row">
                        <!-- Default ordering (sorting) Starts-->
                        <div class="col-sm-12">
                          <div class="card border-0">
                            <div class="card-body p-1">
                            <div class="table-responsive">
                                <table class="display dataTable" id="table-2">
                                  <thead>
                                    <tr>
                                      <th>Name</th>
                                      <th>Email</th>
                                      
                                      <th>Bid Price</th>
                                      <th>Bid Date</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @forelse($bids as $bid)
                                    <tr>
                                        <td>{{$bid->user->first_name ?? ''}} {{$bid->user->last_name ?? ''}}</td>
                                        <td>{{$bid->user->email ?? ''}}</td>
                                        
                                        <td >{{$bid->bid_amount ?? ''}}</td>
                                        <td >{{$bid->created_at->isoFormat('MMM Do YYYY') ?? ''}}</td>
                                        <td><a href="{{url('dealer_detail/'.$bid->user_id)}}" class="btn btn-primary">Detail</a></td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colsapn='5' align='center'>No Bid available</td>
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

                  <div class="tab-pane fade" id="info-product" role="tabpanel" aria-labelledby="product-info-tab">
                    <!-- Container-fluid starts-->
                    <div class="container-fluid p-0">
                      <div class="row">
                        <!-- Default ordering (sorting) Starts-->
                        <div class="col-sm-12">
                          <div class="card border-0">
                            <div class="card-body p-1">
                            <div class="table-responsive">
                                <table class="display dataTable" id="table-3">
                                  <thead>
                                    <tr>
                                      <th>Name</th>
                                      <th>Email</th>
                                      
                                      <th>Bid Price</th>
                                      <th>Bid Date</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @forelse($prebids as $bid)
                                    <tr>
                                        <td>{{$bid->user->first_name ?? ''}} {{$bid->user->last_name ?? ''}}</td>
                                        <td>{{$bid->user->email ?? ''}}</td>
                                        
                                        <td >{{$bid->bid_amount ?? ''}}</td>
                                        <td >{{$bid->created_at->isoFormat('MMM Do YYYY') ?? ''}}</td>
                                        <td><a href="{{url('dealer_detail/'.$bid->user_id)}}" class="btn btn-primary">Detail</a></td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colsapn='5' align='center'>No Bid available</td>
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

                  <div class="tab-pane fade" id="info-make" role="tabpanel" aria-labelledby="make-info-tab">
                    <!-- Container-fluid starts-->
                    <div class="container-fluid p-0">
                      <div class="row">
                        <!-- Default ordering (sorting) Starts-->
                        <div class="col-sm-12">
                          <div class="card border-0">
                            <div class="card-body p-1">
                            <div class="table-responsive">
                                <table class="display dataTable" id="table-4">
                                  <thead>
                                    <tr>
                                      <th>Name</th>
                                      <th>Email</th>
                                      
                                      <th>Bid Price</th>
                                      <th>Bid Date</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @forelse($directbids as $bid)
                                    <tr>
                                        <td>{{$bid->user->first_name ?? ''}} {{$bid->user->last_name ?? ''}}</td>
                                        <td>{{$bid->user->email ?? ''}}</td>
                                        
                                        <td >{{$bid->bid_amount ?? ''}}</td>
                                        <td >{{$bid->created_at->isoFormat('MMM Do YYYY') ?? ''}}</td>
                                        <td><a href="{{url('dealer_detail/'.$bid->user_id)}}" class="btn btn-primary">Detail</a></td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colsapn='5' align='center'>No Bid available</td>
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
                                      <td>Name</td>
                                      <td>{{$winner->user->first_name ?? ''}} {{$winner->user->last_name ?? ''}}</td>
                                    </tr>
                                    <tr>
                                      <td>Email</td>
                                      <td>{{$winner->user->email ?? ''}}</td>
                                    </tr>
                                    <tr>
                                      <td>Mobile Number</td>
                                      <td>{{$winner->user->mobile_number ?? ''}}</td>
                                    </tr>
                                    <tr>
                                      <td>Address</td>
                                      <td><address>{{$winner->user->address ?? ''}} {{$winner->user->street ?? ''}}<br>{{$winner->user->city ?? ''}} {{$winner->user->state ?? ''}}<br>{{$winner->user->country ?? ''}}</address></td>
                                    </tr>
                                    

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

<x-footer></x-footer>