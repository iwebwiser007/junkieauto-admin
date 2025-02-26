<x-header></x-header>
<x-nav></x-nav>
<?php use Carbon\Carbon; ?>

    <div class="page-body">
      
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <!-- Default ordering (sorting) Starts-->
                <div class="col-sm-12">
                    <div class="card">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h5>{{$headname}}</h5>
                        <div class="action-buttons w-75">
                              
                            <form action="{{url('all_bids_auction')}}" method="post" id='all_bids_auction'>
                              @csrf
                              <div class="d-flex justify-content-between align-items-center">
                              <input class="form-control me-2 " type='date' name="date1" id="date1" value="{{$date1 ?? ''}}">
                              <input class="form-control  me-2 " type='date' name="date2" id="date2" value="{{$date2 ?? ''}}">
                              <select class="form-select  me-2" id="bids_type" name="bids_type" >
                                <option class="d-none" label="Select Bid"></option>
                                <option value="All Bids" {{ ($headname == 'All Bids')? 'selected' : ''}} >All Bids</option>
                                <option value="Active Bids" {{ ($headname == 'Active Bids')? 'selected' : ''}} >Active Bids</option>
                                <option value="Rejected Bids" {{ ($headname == 'Rejected Bids')? 'selected' : ''}} >Rejected Bids</option>
                                <option value="Win Bids" {{ ($headname == 'Win Bids')? 'selected' : ''}} >Win Bids</option>
                                
                              </select>
                              <button class="btn btn-success" type="button" onclick="find_bid()">Find</button>
                              </div>
                            </form>

                              
                          </div>
                      </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table  id="basic-3">
                                    <thead>
                                        <tr>
                                            <th>Dealer Name</th>
                                            <th>Seller Name</th>
                                            <th>Model</th>
                                            <th>Bid Price (in $)</th>
                                            <th>Bid Date </th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($bids as $auc)
                                        
                                        
                                            <tr>
                                                <td>{{$auc->user->first_name ?? ''}} {{$auc->user->last_name ?? ''}}</td>
                                                <td>{{$auc->auctions->user->first_name ?? ''}} {{$auc->auctions->user->last_name ?? ''}}</td>
                                                <td align="center">{{$auc->auctions->models->name ?? ''}}</td>
                                                <td align="center">{{$auc->bid_amount ?? ''}}</td>
                                                <td align="center">{{Carbon::parse($auc->bid_start)->isoFormat('MMM Do YYYY')}}</td>
                                                <td align="center">
                                                    @if($auc->status == 0)    
                                                    <span class="badge badge-danger rounded-pill">Rejected</span>
                                                    
                                                    @elseif($auc->status == 1)
                                                    <span class="badge badge-primary rounded-pill">Active</span>
                                                    @elseif($auc->status == 2)
                                                    <span class="badge badge-success rounded-pill">Sold</span>
                                                    
                                                    @endif
                                                 </td>
                                                <td>
                                                    
                                                    <a href="{{url('bids_detail/'.$auc->id)}}" class="btn btn-primary">Detail</a>
                                                    
                                                </td>
                                            </tr>
                                        
                                        @empty
                                        <tr>
                                            <td colspan='7' align='center'>No bid available</td>
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
        $('#all_bids_auction').submit();
    }
</script>
