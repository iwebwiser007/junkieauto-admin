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
                          <h5>Seller Documents</h5>
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
    @forelse($document_req as $req)
        @if($req->user && $req->user->email && $req->user->mobile_number)
            <tr>
                <td>{{ $req->user->first_name ?? 'N/A' }} {{ $req->user->last_name ?? 'N/A' }}</td>
                <td>{{ $req->user->email }}</td>
                <td>{{ $req->user->mobile_number }}</td>
                <td>
                    @if($req->user->type == 'individual')
                        <span class="badge badge-info">Individual</span>
                    @elseif($req->user->type == 'business')
                        <span class="badge badge-dark">Business</span>
                    @endif
                </td>
                <td>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#acceptdocsmodal" onclick="accept_docs({{ $req->id }})">Accept</button>
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectdocsmodal" onclick="reject_docs({{ $req->id }})">Reject</button>
                    <a href="{{ url('seller_detail/' . $req->user->id) }}" class="btn btn-primary">Detail</a>
                </td>
            </tr>
        @endif
    @empty
        <tr>
            <td colspan='5' align="center">No seller document available for approval</td>
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

  <!---- Request document accept Modal ---->
  <div class="modal fade" id="acceptdocsmodal" tabindex="-1" role="dialog" aria-labelledby="acceptdocsmodal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Do you want to accept seller documents?</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body mt-3">
          <div class="mb-3">
              <form action="{{url('accept_seller_docs')}}" method="post" id="accept_seller_docs">
                  @csrf
                    <input type="hidden" name="acc_docs_id" id="acc_docs_id">
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

  <!---- Request document reject Modal ---->
  <div class="modal fade" id="rejectdocsmodal" tabindex="-1" role="dialog" aria-labelledby="rejectdocsmodal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Do you want to reject seller documents?</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body mt-3">
          <div class="mb-3">
              <form action="{{url('reject_seller_docs')}}" method="post" id="reject_seller_docs">
                  @csrf
                  <input type="hidden" name="rej_docs_id" id="rej_docs_id">
                    <label class="form-label" for="req_reason">Reject Reason</label> 
                    <textarea class="form-control" type="text" name="docs_reason" id="docs_reason" placeholder="Enter Reject Reason........" required></textarea>
                    <span id="docs_reason_error" style="color:red;"></span>
                    <div class="modal-btn mt-4 text-center">
                      <button class="btn btn-danger me-3" type="button" data-bs-dismiss="modal">Cancel</button>
                      <button class="btn btn-primary" type="button" onclick="docs_rej()">Submit</button>
                
                    </div>
               </form>

          </div>
        </div>

      </div>
    </div>
  </div>

<x-footer></x-footer>