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
                        <h5>{{$headname}}</h5>
                        <div class="action-buttons">
                              <!-- Add New Tab -->
                            <form action="{{url('all_seller')}}" method="post" id='seller_type_form'>
                              @csrf
                              <select class="form-select" id="seller_type" name="seller_type" onchange="select(this.value)" >
                                <option class="d-none" label="Select Seller"></option>
                                <option value="All Seller" {{ ($headname == 'All Seller')? 'selected' : ''}} >All Seller</option>
                                <option value="Active Seller" {{ ($headname == 'Active Seller')? 'selected' : ''}} >Active Seller</option>
                                <option value="Rejected Seller" {{ ($headname == 'Rejected Seller')? 'selected' : ''}} >Rejected Seller</option>
                                <option value="Top Seller" {{ ($headname == 'Top Seller')? 'selected' : ''}} >Top Seller</option>
                                <option value="All Dealer" {{ ($headname == 'All Dealer')? 'selected' : ''}} >All Dealer</option>
                                <option value="Top Dealer" {{ ($headname == 'Top Dealer')? 'selected' : ''}} >Top Dealer</option>
                              </select>
                            </form>
                        
                        </div>
                      </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table  id="basic-1">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile no.</th>
                                            <!-- <th> Seller Type</th> -->
                                            @if($headname != 'Top Seller' && $headname != 'Top Dealer' && $headname != 'All Dealer')
                                            <th>User Type</th>
                                            @endif
                                            @if($headname == 'All Seller')
                                            <th>Status</th>
                                            @endif
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($headname != 'Top Seller' && $headname != 'Top Dealer' && $headname != 'All Dealer')
                                        
                                        @forelse($seller as $sel)
                                        <tr>
                                            <td>{{$sel->first_name }}</td>
                                            <td>{{$sel->email}}</td>
                                            <td>{{$sel->mobile_number}}</td>
                                            <!-- <td>
                                                @if($sel->type == 'individual')
                                                    <span class="badge badge-info">Individual</span>
                                                @elseif($sel->type == 'business')
                                                    <span class="badge badge-dark">Business</span>
                                                @endif
                                            </td> -->
                                            
                                            <td>
                                                @if(count($sel->dealer)>0)
                                                Seller/Dealer
                                                @else
                                                Seller
                                                @endif
                                            </td>

                                            @if($headname == 'All Seller')
                                            <td>
                                                @if($sel->status == '1')
                                                    <span class='badge badge-primary'>Active</span>
                                                @elseif($sel->status == '2')
                                                    <span class='badge badge-danger'>Rejected</span>
                                                @endif
                                            </td>
                                            @endif
                                           
                                            <td align='center'>
                                                @if($sel->status == '2')
                                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#acceptmodal" onclick="accept_req({{$sel->id}})">Accept</button>
                                                @endif
                                                <a href="{{url('seller_detail/'.$sel->id)}}" class="btn btn-primary">Detail</a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan='6' align='center'>No seller available</td>
                                        </tr>
                                        @endforelse
                                        @elseif($headname == 'Top Seller')
                                        @forelse($seller as $sel)
                                            <tr>
                                                <td>{{$sel->user->first_name ?? '' }}</td>
                                                <td>{{$sel->user->email ?? ''}}</td>
                                                <td>{{$sel->user->mobile_number ?? ''}}</td>
                                                <!--<td>-->
                                                <!--    @if($sel->user->type == 'individual')-->
                                                <!--        <span class="badge badge-info">Individual</span>-->
                                                <!--    @elseif($sel->user->type == 'business')-->
                                                <!--        <span class="badge badge-dark">Business</span>-->
                                                <!--    @endif-->
                                                <!--</td>-->
                
                                                <td align='center'>
                                                    <a href="{{url('seller_detail/'.$sel->user_id)}}" class="btn btn-primary">Detail</a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan='4' align='center'>No seller available</td>
                                            </tr>
                                        @endforelse
                                        @elseif($headname == 'All Dealer' || $headname == 'Top Dealer')
                                        @forelse($dealer->unique('user_id') as $del)
                                        <tr>
                                            <td>{{$del->user->first_name ?? '' }} {{$del->user->last_name ?? '' }}</td>
                                            <td>{{$del->user->email ?? ''}}</td>
                                            <td>{{$del->user->mobile_number ?? ''}}</td>
                                           
                                            <td align='center'>
                                                <a href="{{url('dealer_detail/'.$del->user_id)}}" class="btn btn-primary">Detail</a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan='4' align='center'>No dealer available</td>
                                        </tr>
                                        @endforelse
                                        @endif
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
                      <button class="btn btn-secondary me-3" type="button" data-bs-dismiss="modal">Cancel</button>
                      <button class="btn btn-primary" type="submit" >Accept</button>
                
                    </div>
               </form>

          </div>
        </div>

      </div>
    </div>
  </div>


<x-footer></x-footer>

<script>
  function select(id){
        $('#seller_type_form').submit();
    }
</script>


