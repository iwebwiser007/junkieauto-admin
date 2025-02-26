<x-header></x-header>
<x-nav></x-nav>


    <div class="page-body">
      
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <!-- Default ordering (sorting) Starts-->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                          <h5>Current Bids</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table  id="basic-3">
                                    <thead>
                                        <tr>
                                            <th>User Name</th>
                                            <th>Model</th>
                                            <th>Bid Price(in $)</th>
                                            <th>Auction Date(From - To)</th>
                                            <!-- <th>Bid Win Amount (in $)</th> -->
                                            <th>Total Bids</th>
                                            <!-- <th>Status</th> -->
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($auction as $auc)
                                        <tr>
                                            <td>{{$auc->user->first_name}} {{$auc->user->last_name}}</td>
                                            <td align="center">{{$auc->models->name ?? ''}}</td>
                                            <td align="center">{{$auc->bid_price}} - {{$auc->bid_closed_price}}</td>
                                            <td align="center">{{$auc->bid_start}} To {{$auc->bid_end}}</td>
                                            <!-- <td>{{(count($auc->bids->where('status','2')) > 0)? $auc->bids->where('status','2') : ''}}</td> -->
                                            <td align="center">{{count($auc->bids)}}</td>
                                            <!-- <td align="center"> <span class="badge badge-warning rounded-pill">Active</span> </td> -->
                                            <td>
                                                @if(count($auc->bids) > '0')
                                                <a href="{{url('bids_detail/'.$auc->id)}}" class="btn btn-primary">Detail</a>
                                                @else
                                                <a class="btn btn-primary">Detail</a>
                                                @endif
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan='6' align='center'>No active auction available</td>
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