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
                            <form action="{{url('all_dealer')}}" method="post" id='dealer_type_form'>
                              @csrf
                              <select class="form-select" id="dealer_type" name="dealer_type" onchange="select(this.value)" >
                                <option class="d-none" label="Select Dealer"></option>
                                <option value="All Dealer" {{ ($headname == 'All Dealer')? 'selected' : ''}} >All Dealer</option>
                                <option value="Top Dealer" {{ ($headname == 'Top Dealer')? 'selected' : ''}}>Top Dealer</option>
                                <!-- <option value="Rejected Dealer" >Rejected Dealer</option> -->
                                
                              </select>
                            </form>

                              <!------ Edit Button ------>
                              
                              <!-- <button class="btn btn-pill btn-primary me-2" type="button" onclick="edit_active()"><i class="far fa-edit"></i></button> -->

                              
                              <!-- <button class="btn btn-pill btn-danger me-2" type="button" onclick="delete_active()"><i class="fas fa-trash-alt"></i></button> -->
                          </div>
                        </div>
                    
                        <div class="card-body">
                            <div class="table-responsive">
                                <table  id="basic-1">
                                    <thead>
                                        <tr>
                                            <th>Dealer Name</th>
                                            <th>Email</th>
                                            <th>Mobile no.</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
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
        $('#dealer_type_form').submit();
    }
</script>
