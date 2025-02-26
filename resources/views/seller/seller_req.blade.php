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
                          <h5>Seller Requests</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table  id="basic-1">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile no.</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($seller_req as $req)
                                        <tr>
                                            <td>{{$req->first_name}} {{$req->last_name}}</td>
                                            <td>{{$req->email}}</td>
                                            <td>{{$req->mobile_number}}</td>
                                            <td>
                                                @if($req->type == 'individual')
                                                    <span class="badge badge-info">Individual</span>
                                                @elseif($req->type == 'business')
                                                    <span class="badge badge-dark">Business</span>
                                                @endif
                                             </td>
                                            <td>
                                               
                                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#acceptmodal" onclick="accept_req({{$req->id}})">Accept</button>
                                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectmodal" onclick="reject_req({{$req->id}})">Reject</button>
                                                <a href="{{url('seller_detail/'.$req->id)}}" class="btn btn-primary">Detail</a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan='5' align="center">No seller request available</td>
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
                    <span id="req_reason_error"></span>
                    <div class="modal-btn mt-4 text-center">
                      <button class="btn btn-secondary me-3" type="button" data-bs-dismiss="modal">Cancle</button>
                      <button class="btn btn-primary" type="button" onclick="request_rej()">Submit</button>
                
                    </div>
               </form>

          </div>
        </div>

      </div>
    </div>
  </div>

<x-footer></x-footer>