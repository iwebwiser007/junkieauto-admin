<x-header></x-header>
<x-nav></x-nav>


    <div class="page-body">
        @if($errors->any())
            @foreach($errors->all() as $err)
                <li><span style="color:red">{{$err}}</span></li>
            @endforeach
        @endif
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <!-- Default ordering (sorting) Starts-->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                          <h5>Bid Difference</h5>
                          <div class="action-buttons">
                                <!-- Add New Tab -->
                                <button class="btn btn-pill btn-primary px-3 me-2" type="button" data-bs-toggle="modal"
                                data-bs-target="#exampleModalCenter">Add Difference<i class="fas fa-plus-circle ms-2"></i></button>

                                
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table  id="table-3">
                                    <thead>
                                        <tr>
                                            <th>Difference Value (in $)</th>
                                            <th>Status</th>
                                            <th>Valid From</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($commission as $comm)
                                        <tr>
                                            <td>{{$comm->commission}}</td>
                                            <td>
                                                @if($comm->status =='0')
                                                <span class='badge badge-danger'>Deactive</span>
                                                @else
                                                <span class='badge badge-primary'>Active</span>
                                                @endif
                                            </td>
                                            <td>{{$comm->created_at->isoFormat('MMM Do YYYY')}}</td>
                                        </tr>    
                                        @empty
                                        <tr>
                                            <td colspan='3' align='center'>No data available</td>
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

    <!---- Add Commission Modal ---->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add New Bid Difference</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body mt-3">
          <div class="mb-3">
              <form action="{{url('add_bid_commission')}}" method="post" id="add_commission">
                  @csrf
                    <label class="form-label" for="commission">Add Bid Difference</label> 
                    <input class="form-control" type="number" name="commission" id="commission" placeholder="Enter Bid Difference amount........" required>
                    
                    <div class="modal-btn mt-4 text-center">
                      <button class="btn btn-danger me-3" type="button" data-bs-dismiss="modal">Cancel</button>
                      <button class="btn btn-primary" type="button" onclick="add_bid_difference()">Save</button>
                
                    </div>
               </form>

          </div>
        </div>

      </div>
    </div>
  </div>

<x-footer></x-footer>