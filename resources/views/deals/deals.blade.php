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
                        <h5>All {{$headname ?? ''}} Deals</h5>
                        <div class="action-buttons">
                              <!-- Add New Tab -->
                            <form action="{{url('deals')}}" method="post" id='deals_type_form'>
                              @csrf
                              <select class="form-select" id="bid_type" name="bid_type" onchange="select(this.value)" >
                                <option class="d-none" label="Select Bid Type"></option>
                                <option value="All" {{ ($headname == 'All')? 'selected' : ''}} >All Deals</option>
                                <option value="Bid" {{ ($headname == 'Bid')? 'selected' : ''}} >Bid</option>
                                <option value="Pre-Bid" {{ ($headname == 'Pre-Bid')? 'selected' : ''}} >Pre-Bid</option>
                                <option value="Direct-Buy" {{ ($headname == 'Direct-Buy')? 'selected' : ''}} >Direct-Buy</option>
                                
                              </select>
                            </form>

                              <!------ Edit Button ------>
                              
                              <!-- <button class="btn btn-pill btn-primary me-2" type="button" onclick="edit_active()"><i class="far fa-edit"></i></button> -->

                              
                              <!-- <button class="btn btn-pill btn-danger me-2" type="button" onclick="delete_active()"><i class="fas fa-trash-alt"></i></button> -->
                          </div>
                      </div>
                        
                        <div class="card-body">
                            <div class="table-responsive">
                                <table  id="basic-3">
                                    <thead>
                                        <tr>
                                            <th>Seller Name</th>
                                            <th>Bid Price (From - To) (in $)</th>
                                            <!-- <th>Bid Date (From - To)</th> -->
                                            <th>Bid Win Price (in $)</th>
                                            <th>Date</th>
                                            <th>Bid Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($auction as $auc)
                                        <tr>
                                            <td>{{$auc->user->first_name}} {{$auc->user->last_name}}</td>
                                            <td align='center'>{{$auc->bidwin->bid_price ?? ''}} - {{$auc->bidwin->bid_closed_price ?? ''}}</td>
                                            <!-- <td align='center'>{{$auc->bidwin->bid_start ?? ''}}<br> To <br>{{$auc->bidwin->bid_end ?? ''}}</td> -->
                                            <td align='center'>{{$auc->bid_amount}}</td>
                                            <td>{{$auc->created_at->isoFormat('MMM Do YYYY')}}</td>
                                            <td> 
                                                @if($auc->type == 'bid')
                                                    <span class="badge badge-warning rounded-pill">Bid</span>
                                                @elseif($auc->type == 'direct_buy')  
                                                    <span class="badge badge-success rounded-pill">Direct-Buy</span>  
                                                @elseif($auc->type == 'pre_bid')
                                                    <span class="badge badge-secondary rounded-pill">Pre-Bid</span>
                                                @endif
                                            </td>

                                            <td>
                                                <a href="{{url('auction_detail/'.$auc->auction_id)}}" class="btn btn-primary">Detail</a>
                                                @if($auc->status == '2' && $auc->latest_offer == '0')
                                                <button class="btn btn-pill btn-secondary px-3 me-2" type="button" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModalCenter" onclick="latest_offer({{$auc->id}})">Latest Offer</button>
                                                <!-- <a href="#{{url('latest_offer/'.$auc->id)}}" class="btn btn-secondary">Latest Offer</a> -->
                                                @endif
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan='6' align="center">No Deals available</td>
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
        $('#deals_type_form').submit();
    }
</script>
