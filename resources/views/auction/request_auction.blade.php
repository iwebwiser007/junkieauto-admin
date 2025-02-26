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
                          <h5>Auction Requests</h5>
                          <div class="action-buttons">
                              <!-- Add New Tab -->
                            <form action="{{url('request_auction')}}" method="post" id='request_type'>
                              @csrf
                              <select class="form-select" id="auc_type" name="auc_type" onchange="select(this.value)" >
                                <option class="d-none" label="Select Auction"></option>
                                <option value="All" {{($headname == 'All')? 'selected' : ''}}>All</option>
                                <!--<option value="New" {{($headname == 'New')? 'selected' : ''}}>New</option>-->
                                <!--<option value="Used" {{($headname == 'Used')? 'selected' : ''}} >Used</option>-->
                                <!--<option value="Junk" {{($headname == 'Junk')? 'selected' : ''}} >Junk</option>-->
                                @forelse($used_type as $used)
                                <option value="{{$used->id}}" {{($headname == $used->id)? 'selected' : ''}}>{{$used->name}}</option>
                                @empty
                                @endforelse
                                
                              </select>
                            </form>

                              
                          </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table  id="basic-3">
                                    <thead>
                                        <tr>
                                            <th>Seller Name</th>
                                            <th>Model</th>
                                            <th>Year</th>
                                            <th>Starting bid(in $)</th>
                                            <th>Closing bid(in $)</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($auction_req as $auc)
                                        <tr>
                                            <td>{{$auc->user->first_name ?? ''}} {{$auc->user->last_name ?? ''}}</td>
                                            <td>{{$auc->models->name ?? ''}}</td>
                                            <td>{{$auc->year ?? ''}}</td>
                                            <td>{{$auc->bid_price ?? ''}}</td>
                                            <td>{{$auc->bid_closed_price ?? ''}}</td>
                                            <td>
                                                @if($auc->uses->name == 'Used')
                                                 <span class="badge badge-secondary rounded-pill">Used</span>
                                                @elseif($auc->uses->name == 'New')
                                                 <span class="badge badge-primary rounded-pill">New</span>
                                                @elseif($auc->uses->name == 'Junk')
                                                 <span class="badge badge-danger rounded-pill">Junk</span>
                                                @else
                                                <span class="badge badge-success rounded-pill">{{$auc->uses->name}}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#acceptmodal" onclick="accept_req({{$auc->id}})">Accept</button>
                                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectmodal" onclick="reject_req({{$auc->id}})">Reject</button>
                                                <a href="{{url('auction_detail/'.$auc->id)}}" class="btn btn-primary">Detail</button>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan = '7' align='center'>No auction request available</td>
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
              <form action="{{url('accept_auc_req')}}" method="post" id="accept_auc_req">
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
          <h5 class="modal-title">Do you want to reject auction request?</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body mt-3">
          <div class="mb-3">
              <form action="{{url('reject_auc_req')}}" method="post" id="reject_auc_req">
                  @csrf
                  <input type="hidden" name="rej_req_id" id="rej_req_id">
                    <label class="form-label" for="req_reason">Reject Reason</label> 
                    <textarea class="form-control" type="text" name="req_reason" id="req_reason" placeholder="Enter Reject Reason........" required></textarea>
                    <span id="req_reason_error"></span>
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

<x-footer></x-footer>

<script>
    function accept_req($id){
        $('#acc_req_id').val($id);
    }

    function reject_req($id){
        $('#rej_req_id').val($id);
    }

    function request_rej(){
      if($('#req_reason').val() == ''){
        $('#req_reason_error').html('Please fill the reason');
      }else{
        $('#reject_auc_req').submit();
      }
    }
</script>

<script>
  function select(id){
        $('#request_type').submit();
    }
</script>
