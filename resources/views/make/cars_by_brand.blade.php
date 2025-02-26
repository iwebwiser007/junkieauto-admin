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
                          <h5>{{$brand->name}} Cars: {{$headname}}</h5>
                          <div class="action-buttons">
                              <!-- Add New Tab -->
                            <form action="{{url('cars_make/'.$brand->id)}}" method="post" id='auction_type'>
                              @csrf
                              <select class="form-select" id="auc_type" name="auc_type" onchange="select(this.value)" >
                                <option class="d-none" label="Select Auction"></option>
                                <option value="All Auction" >All Auction</option>
                                <option value="Active Auction" >Active Auction</option>
                                <option value="Sold Auction" >Sold Auction</option>
                                <option value="Cancelled Auction" >Cancelled Auction</option>
                                <option value="Closed Auction" >Closed Auction</option>
                              </select>
                            </form>
                        
                          </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table  id="basic-3">
                                    <thead>
                                        <tr>
                                            <th>Dealer name</th>
                                            <th>Model</th> 
                                            <th>Year</th>
                                            <th>Starting bid(in $)</th>
                                            <th>Closing bid(in $)</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($all as $auc)
                                        <tr>
                                            <td>{{$auc->user->first_name}} {{$auc->user->last_name}}</td>
                                            <td>{{$auc->models->name}}</td> 
                                            <td align='center'>{{$auc->year}}</td>
                                            <td align='center'>{{$auc->bid_price}}</td>
                                            <td align='center'>{{$auc->bid_closed_price}}</td>
                                            <td> 
                                            @if($auc->status == 0)    
                                            <span class="badge badge-danger rounded-pill">Cancelled</span>
                                            @elseif($auc->status == 1)
                                            <span class="badge badge-warning rounded-pill">Request</span>
                                            @elseif($auc->status == 2)
                                            <span class="badge badge-primary rounded-pill">Active</span>
                                            @elseif($auc->status == 3)
                                            <span class="badge badge-success rounded-pill">Sold</span>
                                            @else
                                            <span class="badge badge-secondary rounded-pill">Closed</span>
                                            @endif
                                            </td>

                                            <td  align='center'>
                                                <a href="{{url('auction_detail/'.$auc->id)}}" class="btn btn-primary">Detail</a>
                                                <!-- @if($auc->status == '2' && $auc->latest_offer == '0')
                                                <button class="btn btn-pill btn-secondary px-3 me-2" type="button" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModalCenter" onclick="latest_offer({{$auc->id}})">Latest Offer</button>
                                                 <a href="#{{url('latest_offer/'.$auc->id)}}" class="btn btn-secondary">Latest Offer</a>
                                                @endif -->
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan='7' align='center'>No auction available</td>
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

  

<x-footer></x-footer>

<script>
  function select(id){
        $('#auction_type').submit();
    }
</script>
