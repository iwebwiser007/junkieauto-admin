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
                    <h5>Seller Details</h5>
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
                                    
                                    <h4 class="mb-1">{{$seller->first_name ?? ''}} {{$seller->last_name ?? ''}}</h4>
                                    
                                    <h6>({{$seller->country ?? ''}})</h6>
                                    @isset($seller->email)
                                    <i class="fas fa-at"></i>
                                        {{$seller->email ?? ''}}<br>
                                    @endisset

                                    @isset($seller->mobile_number)
                                    <i class="fas fa-phone-square-alt"></i>
                                        {{$seller->mobile_number ?? ''}}<br>
                                    @endisset

                                    @isset($seller->address)
                                    <i class="fas fa-map-marked-alt"></i> Address
                                    <address>{{$seller->address ?? ''}} {{$seller->street ?? ''}} <br>{{$seller->city ?? ''}} {{$seller->state ?? ''}}<br>{{$country ?? ''}}</address><br>
                                    @endif
                                    @if($seller->type == 'individual')
                                        <span class="badge badge-info">Individual</span>
                                    @elseif($seller->type == 'business')
                                        <span class="badge badge-dark">Business</span>
                                    @endif

                                    @if($seller->status == '1')
                                        <span class="badge badge-success">Active</span>
                                    @elseif($seller->status == '2')
                                        <span class="badge badge-danger">Rejected</span>
                                    @endif
                                    <!-- <p class="badge rounded-pill bg-warning text-dark mt-2 d-block w-50 f-14 r">PayPal
                                    </p> -->

                                    @if($seller->status == '0')
                                    <h6>Seller Request</h6>
                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#acceptmodal" onclick="accept_req({{$seller->id}})">Accept</button>
                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectmodal" onclick="reject_req({{$seller->id}})">Reject</button>
                                    @endif
                                    
                                    
                                  </div>

                                  <div class="follow mt-3">
                                    <ul class="follow-list">
                                      <li>
                                        <div class="follow-num counter text-center">{{ count($auction->where('status','2')) }}</div><span>Active Auction</span>
                                      </li>

                                      <li>
                                        <div class="follow-num counter text-center">{{ count($auction->where('status','3')) }}</div><span>Sold Auction</span>
                                      </li>

                                      <li>
                                        <div class="follow-num counter text-center">{{ count($auction->where('status','0')) }}</div><span>Cancelled
                                          Auction</span>
                                      </li>

                                      <li>
                                        <div class="follow-num counter text-center">{{ count($auction->where('status','1')) }}</div><span>Request Auction</span>
                                      </li>
                                    </ul>
                                  </div>
                                  
                                </div>
                                
                              </div>
                              
                            </div>
                          </div>
                          
                        </div>

                        <div class="col-sm-12 col-xl-12 xl-100">
                          {{-- <h5>Customer Bids </h5> --}}

                          <ul class="nav nav-tabs border-tab nav-primary mb-3" id="info-tab" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link active" id="info-home-tab" data-bs-toggle="tab" href="#info-home"
                                role="tab" aria-controls="info-home" aria-selected="true">{{$headname}}</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="info-gallery-tab" data-bs-toggle="tab" href="#info-gallery"
                                role="tab" aria-controls="info-gallery" aria-selected="true">Gallery</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="info-detail-tab" data-bs-toggle="tab" href="#info-detail"
                                role="tab" aria-controls="info-detail" aria-selected="true">Detail</a>
                            </li>
                            

                           
                          </ul>

                          <div class="tab-content" id="info-tabContent">
                            <div class="tab-pane fade show active" id="info-home" role="tabpanel"
                              aria-labelledby="info-home-tab">
                              <!-- Container-fluid starts-->
                              <div class="container-fluid p-0">
                                <div class="row">
                                  <div class="action-buttons w-25">
                                      <!-- Add New Tab -->
                                    <form action="{{url('seller_detail/'.$seller->id)}}" method="post" id='auction_type'>
                                      @csrf
                                      <select class="form-select" id="auc_type" name="auc_type" onchange="select(this.value)" >
                                        <option class="d-none" label="Select Auction"></option>
                                        <option value="All Auction" {{($headname == 'All Auction')? 'selected' : ''}} >All Auction</option>
                                        <option value="Active Auction" {{($headname == 'Active Auction')? 'selected' : ''}} >Active Auction</option>
                                        <option value="Sold Auction" {{($headname == 'Sold Auction')? 'selected' : ''}} >Sold Auction</option>
                                        <option value="Rejected Auction" {{($headname == 'Rejected Auction')? 'selected' : ''}} >Rejected Auction</option>
                                        <option value="Expired Auction" {{($headname == 'Expired Auction')? 'selected' : ''}} >Expired Auction</option>
                                        <option value="Requested Auction" {{($headname == 'Requested Auction')? 'selected' : ''}} >Requested Auction</option>
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
                                                <th>Make</th>
                                                <th>Model</th>
                                                <th>Year</th>
                                                <th>Bid Price(in $)</th>
                                                <th>Date (Start - End)</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              @forelse($auction as $auc)
                                              <tr>
                                                <td>{{$auc->makes->name ?? ''}}</td>
                                                <td>{{$auc->models->name ?? ''}}</td>
                                                <td>{{$auc->year}}</td>
                                                <td>{{$auc->bid_price ?? ''}} - {{$auc->bid_closed_price ?? ''}}</td>
                                                <td>{{Carbon::parse($auc->bid_start)->isoFormat('MMM Do YYYY')}} To {{Carbon::parse($auc->bid_end)->isoFormat('MMM Do YYYY')}}</td>
                                                <td> 
                                                  @if($auc->status == 0)    
                                                  <span class="badge badge-danger rounded-pill">Cancel</span>
                                                  @elseif($auc->status == 1)
                                                  <span class="badge badge-warning rounded-pill">Request</span>
                                                  @elseif($auc->status == 2)
                                                  <span class="badge badge-primary rounded-pill">Active</span>
                                                  @elseif($auc->status == 3)
                                                  <span class="badge badge-success rounded-pill">Sold</span>
                                                  @elseif($auc->status == 6)
                                                  <span class="badge badge-success rounded-pill">Expired</span>
                                                  @else
                                                  <span class="badge badge-secondary rounded-pill">Closed</span>
                                                  @endif
                                                  </td>
                                                <td align='center'><a href="{{url('auction_detail/'.$auc->id)}}" class="btn btn-primary">Detail</a></td>
                                              </tr>
                                              @empty
                                              <tr>
                                                <td colspan='7' align="center">No auction available</td>
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

                            <!-- Gallery -->
                            <div class="tab-pane fade" id="info-gallery" role="tabpanel"
                              aria-labelledby="info-gallery-tab">
                              <!------- Auction Product Images ------->
                              <h5 class="ms-4 mb-0">Seller Document's Images</h5>

                              <div class="gallery my-gallery card-body row" itemscope="">
                                
                                @forelse($media[0]->files as $medias)
                                
                                
                                
                                <figure class="col-xl-3 col-md-4 xl-33" itemprop="associatedMedia" itemscope=""><a
                                    href="{{'http://168.235.81.206:60000'.$medias->document_url}}" itemprop="contentUrl" data-size="1600x950"><img
                                      class="img-thumbnail" src="{{'http://168.235.81.206:60000'.$medias->document_url}}" itemprop="thumbnail"
                                      alt="Image description"></a>
                                    @if($medias->status == '2')  
                                    <figcaption itemprop="caption description">{{$medias->cancel_resonse ?? ''}}</figcaption>
                                    @endif
                                    @if($medias->status == '0')
                                    
                                    <h6>Document Request</h6>
                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#acceptdocsmodal" onclick="accept_docs({{$medias->id}})">Accept</button>
                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectdocsmodal" onclick="reject_docs({{$medias->id}})">Reject</button>
                                    @endif
                                </figure>
                                
                                
                               
                                @empty
                                <figure class="col-xl-3 col-md-4 xl-33" itemprop="associatedMedia" itemscope=""><a
                                    href="{{asset('image/no_image.jpg')}}" itemprop="contentUrl" data-size="1600x950"><img
                                      class="img-thumbnail" src="{{asset('image/no_image.jpg')}}" itemprop="thumbnail"
                                      alt="Image description"></a>
                                    
                                </figure>
                                @endforelse

                                
                              </div>
                            </div>

                            <!-- seller detail -->
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
                                                <td>{{$seller->first_name}} {{$seller->last_name}}</td>
                                              </tr>

                                            <tr>

                                                <th>Email</th>
                                                <td>{{$seller->email ?? 'N/A'}}</td>
                                              </tr>
                                              <tr>
                                                <th>Mobile Number</th>
                                                <td>{{$seller->mobile_number ?? 'N/A'}}</td>
                                              </tr>
                                              <tr>
                                                <th>Address</th>
                                                <td>
                                                <address>{{$seller->address ?? 'N/A'}}<br>{{$seller->city ?? 'N/A'}} {{$seller->state ?? 'N/A'}}<br>{{$seller->country ?? 'N/A'}}</address>
                                              </tr>
                                              
                                              
                                              <tr>
                                                <th>Document Type</th>
                                                <td>{{str_replace('_',' ',$seller->document_type) ?? 'N/A'}}</td>
                                              </tr>  
                                              <tr>
                                                <th>Issue Date</th>
                                                <td>{{Carbon::parse($seller->issue_date)->isoFormat('MMM Do YYYY')}}</td>
                                              </tr>  
                                              <tr>
                                                <th>Expire Date</th>
                                                <td>{{Carbon::parse($seller->expire_date)->isoFormat('MMM Do YYYY')}}</td>
                                              </tr>
                                              <tr>
                                                <th>ID Number</th>
                                                <td>{{$seller->id_number ?? 'N/A'}}</td>
                                              </tr>
                                              <tr>
                                                <th>Type</th>
                                                <td>{{$seller->type ?? 'N/A'}}</td>
                                              </tr>

                                              
                                              @if($seller->status == '2')
                                              <tr>
                                                <th>Cancel Reason</th>
                                                <td> {{$seller->cancel_reason ?? 'N/A'}}</td>
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


      <!------- All Modals Starts ------->

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
              <form action="{{url('accept_seller_req')}}" method="post" id="accept_auc_req">
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
          <h5 class="modal-title">Do you want to reject seller request?</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body mt-3">
          <div class="mb-3">
              <form action="{{url('reject_seller_req')}}" method="post" id="reject_auc_req">
                  @csrf
                  <input type="hidden" name="rej_req_id" id="rej_req_id">
                    <label class="form-label" for="req_reason">Reject Reason</label> 
                    <textarea class="form-control" type="text" name="req_reason" id="req_reason" placeholder="Enter Reject Reason........" required></textarea>
                    <span id="req_reason_error" style="color:red;"></span>
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
  
  <!---- Request document accept Modal ---->
  <div class="modal fade" id="acceptdocsmodal" tabindex="-1" role="dialog" aria-labelledby="acceptdocsmodal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Do you want to accept seller documents?</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body mt-3">
          <div class="mb-3">
              <form action="{{url('accept_seller_docs')}}" method="post" id="accept_seller_docs">
                  @csrf
                    <input type="hidden" name="acc_docs_id" id="acc_docs_id">
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

  <!---- Request document reject Modal ---->
  <div class="modal fade" id="rejectdocsmodal" tabindex="-1" role="dialog" aria-labelledby="rejectdocsmodal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Do you want to reject seller documents?</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body mt-3">
          <div class="mb-3">
              <form action="{{url('reject_seller_docs')}}" method="post" id="reject_seller_docs">
                  @csrf
                  <input type="hidden" name="rej_docs_id" id="rej_docs_id">
                    <label class="form-label" for="req_reason">Reject Reason</label> 
                    <textarea class="form-control" type="text" name="docs_reason" id="docs_reason" placeholder="Enter Reject Reason........" required></textarea>
                    <span id="docs_reason_error" style="color:red;"></span>
                    <div class="modal-btn mt-4 text-center">
                      <button class="btn btn-danger me-3" type="button" data-bs-dismiss="modal">Cancel</button>
                      <button class="btn btn-primary" type="button" onclick="docs_rej()">Submit</button>
                
                    </div>
               </form>

          </div>
        </div>

      </div>
    </div>
  </div>

<x-footer></x-footer>


<script>
  function select(id){
        $('#auction_type').submit();
    }
</script>
