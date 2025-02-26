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
                          <h5>All Active Auctions</h5>
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
                                            <!-- <th>Status</th> -->
                                            <th>Action</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($auction as $auc)
                                        <tr>
                                            <td>{{$auc->user->first_name}} {{$auc->user->last_name}}</td>
                                            <td>{{$auc->model}}</td>
                                            <td>{{$auc->year}}</td>
                                            <td>{{$auc->bid_price}}</td>
                                            <td>{{$auc->bid_closed_price}}</td>
                                            

                                            <td align='center'>
                                                <a href="{{url('auction_detail/'.$auc->id)}}" class="btn btn-primary">Detail</a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" align="center">No auction available</td>
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