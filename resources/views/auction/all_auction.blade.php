<x-header></x-header>
<x-nav></x-nav>


    <div class="page-body">
      
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <!-- Default ordering (sorting) Starts-->
                <div class="col-sm-12">
                    <div class="card">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h5>{{$headname}}</h5>
                        <div class="action-buttons">
                              <!-- Add New Tab -->
                            <form action="{{url('all_auction')}}" method="post" id='auction_type'>
                              @csrf
                              <select class="form-select" id="auc_type" name="auc_type" onchange="select(this.value)" >
                                <option class="d-none" label="Select Auction"></option>
                                <option value="All Auction" {{($headname == 'All Auction')? 'selected' : ''}}>All Auction</option>
                                <option value="Active Auction" {{($headname == 'Active Auction')? 'selected' : ''}}>Active Auction</option>
                                <option value="Expired Auction" {{($headname == 'Expired Auction')? 'selected' : ''}} >Expired Auction</option>
                                <option value="Sold Auction" {{($headname == 'Sold Auction')? 'selected' : ''}} >Sold Auction</option>
                                <option value="Rejected Auction" {{($headname == 'Rejected Auction')? 'selected' : ''}} >Cancelled Auction</option>
                                <option value="Closed Auction" {{($headname == 'Closed Auction')? 'selected' : ''}} >Closed Auction</option>
                                <option value="Latest Offer" {{($headname == 'Latest Offer')? 'selected' : ''}} >Latest Offer</option>
                                <option value="Top Auction" {{($headname == 'Top Auction')? 'selected' : ''}} >Top Auction</option>
                              </select>
                            </form>

                              <!------ Edit Button ------>
                              
                              <!-- <button class="btn btn-pill btn-primary me-2" type="button" onclick="edit_active()"><i class="far fa-edit"></i></button> -->

                              
                              <!-- <button class="btn btn-pill btn-danger me-2" type="button" onclick="delete_active()"><i class="fas fa-trash-alt"></i></button> -->
                          </div>
                      </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class='display'  id="basic-3">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Model</th>
                                            <th>Year</th>
                                            <th>Bid Price (From - To)(in $)</th>
                                            <th>No. of Bids</th>
                                            <!-- <th>Latest Offer</th> -->
                                            <th>Status</th>
                                            <th>Action</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php $current = now()->format('Y-m-d'); ?>
                                        @forelse($auction as $auc)
                                        <tr class="position-relative">
                                            <td>{{$auc->user->first_name}} {{$auc->user->last_name}}</td>
                                            <td>{{$auc->models->name}}</td>
                                            <td>{{$auc->year}}</td>
                                            <td align='center'>{{$auc->bid_price}} To {{$auc->bid_closed_price}}</td>
                                            <td align='center'>{{count($auc->bids)}}</td>
                                            <td align='center' class="position-relative latest-offer-tr"> 
                                                @if($auc->status == 0)    
                                                <span class="badge badge-danger rounded-pill">Cancelled</span>
                                                @elseif($auc->status == 1)
                                                <span class="badge badge-warning rounded-pill">Pending</span>
                                                @elseif($auc->status == 2 )
                                                <span class="badge badge-primary rounded-pill">Active</span>
                                                    @if($auc->latest_offer == '1')
                                                    <div class="hover-message">
                                                        <div class="dl">
                                                          <div class="discount alizarin">latest-offer</div>
                                                        </div>
                                                  </div>
                                                  @endif
                                                {{--@elseif($auc->status == 2 && $auc->bid_end < $current)--}}
                                                @elseif($auc->status == '6')
                                                <span class="badge badge-primary rounded-pill">Expired</span>
                                                @elseif($auc->status == 3)
                                                <span class="badge badge-success rounded-pill">Sold</span>
                                                @else
                                                <span class="badge badge-secondary rounded-pill">Closed</span>
                                                @endif

                                                
                                            </td>

                                            <td align='center'>
                                                <a href="{{url('auction_detail/'.$auc->id)}}" class="btn btn-primary">Detail</a>
                                                @if($auc->status == '2' && $auc->latest_offer == '0')
                                                <button class="btn btn-pill btn-secondary px-3 me-2" type="button" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModalCenter" onclick="latest_offer({{$auc->id}})">Latest Offer</button>
                                                <!-- <a href="#{{url('latest_offer/'.$auc->id)}}" class="btn btn-secondary">Latest Offer</a> -->
                                                @endif
                                            </td>
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

    <!---- General Page Add New Tab Modal ---->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add into Latest Offer</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body mt-3">
          <div class="mb-3">
              <form action="{{url('latest_offer')}}" method="post" id="add_tab_name">
                  @csrf
                    <label class="form-label" for="tab_name">Do you really want to add this auction into latest offer?</label> 
                    <input class="form-control" type="hidden" name="tab_id" id="tab_id" >
                    
                    <div class="modal-btn mt-4 text-center">
                      <button class="btn btn-danger me-3" type="button" data-bs-dismiss="modal">Cancel</button>
                      <button class="btn btn-primary" type="submit" >Submit</button>
                
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
