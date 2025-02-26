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
                        <h5>All Cars : {{$headname->name}}</h5>
                        
                      </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table  id="basic-3">
                                    <thead>
                                        <tr>
                                            <th>User Name</th>
                                            <th>Model</th>
                                            <th>Year</th>
                                            <th>Starting bid(in $)</th>
                                            <th>Closing bid(in $)</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                      
                                        @forelse($auction as $auc)
                                        <tr>
                                            <td>{{$auc->user->first_name}} {{$auc->user->last_name}}</td>
                                            <td>{{$auc->models->name}}</td>
                                            <td>{{$auc->year}}</td>
                                            <td align="center">{{$auc->bid_price}}</td>
                                            <td align="center">{{$auc->bid_closed_price}}</td>
                                            <td> 
                                            @if($auc->status == 0)    
                                            <span class="badge badge-danger rounded-pill">Cancelled</span>
                                            
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
                                                
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan='7' align="center">No car available</td>
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
