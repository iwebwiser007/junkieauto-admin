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
                          
                          <h5>Makes</h5>
                          
                          <div class="action-buttons">
                                <!-- Add New Tab -->
                                <button class="btn btn-pill btn-primary px-3 me-2" type="button" data-bs-toggle="modal"
                                data-bs-target="#exampleModalCenter">Add<i class="fas fa-plus-circle ms-2"></i></button>

                                
                            </div>
                        </div>

                        <!------- Loader Starts ------->
                        <div class="loader-wrapper">
                            <div class="theme-loader">
                              <div class="loader-p"></div>
                            </div>
                          </div>
                          @if (Session::has('msg'))
                        <?php $msg=Session::get('msg');?>
                        @if(str_contains($msg, 'successfully') == '1')
                          <div class="alert alert-warning alert-dismissible my-2 w-50 text-white bg-success mx-auto fade show" role="alert">
                        @else
                          <div class="alert alert-warning alert-dismissible my-2 w-50 text-white bg-danger mx-auto fade show" role="alert">
                        @endif
                          {{$msg}}
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                          <!------- Loader End ------->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="table-3">
                                    <thead>
                                        <tr>
                                            <th>Brand</th>
                                            <th>Models</th>
                                            <th>Total Cars</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @forelse($makes as $mk)
                                        <tr>
                                          @if(count($mk->brands) > 0)
                                            <td>{{$mk->brands[0]->name}}</td>
                                            <td>{{$mk->sub_cat_count}}</td>
                                            <td>{{$mk->cars_count}}</td>
                                            <td align='center'>
                                                <a href="{{url('models/'.$mk->id)}}" class="btn btn-primary">All Models</a>
                                                
                                                  <button class="btn btn-primary" type="button" onclick="view_make({{$mk->id}}, {{$mk->status}})" data-bs-toggle="modal"
                                                    data-bs-target="#showmake" aria-expanded="false" aria-controls="collapse11" title="{{($mk->status == 0)? 'Unblock' : 'Block'}}">
                                                    
                                                    <i class="far fa-eye{{($mk->status == '0')? '-slash' : ''}}"></i></button>
                                            </td>
                                          @endif
                                        </tr>    
                                      @empty
                                        <tr>
                                            <td colspan='4' align='center'>No makers available</td>
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

    <!---- General Page Add New Tab Modal ---->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add New Make</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body mt-3">
          <div class="mb-3">
              <form action="{{url('add_make')}}" method="post" id="add_make_name">
                  @csrf
                    <label class="form-label" for="make_name">Add Make</label> 
                    <input class="form-control" type="text" name="make_name" id="make_name" placeholder="Enter Make Name........" required>
                    <span id="tab_name_error"></span>
                    <div class="modal-btn mt-4 text-center">
                      <button class="btn btn-danger me-3" type="button" data-bs-dismiss="modal">Cancel</button>
                      <button class="btn btn-primary" type="button" onclick="add_make()">Save</button>
                
                    </div>
               </form>

          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- Show hide Make -->
  <div class="modal fade" id="showmake" tabindex="-1" role="dialog" aria-labelledby="deletemake"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><span id="ban_status"><span>Make</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body mt-3">
          <div class="mb-3">
            
              <form action="{{url('show_make')}}" method="post" id="show_make_form">
                  @csrf
                    <label class="form-label" for="view_make_id">Do you really want to <span id="make_statuses">{{}}</span> this make?</label> 
                    <input class="form-control" type="hidden" name="view_make_id" id="view_make_id" >
                    <input type="hidden" name="make_status" id="make_status">
                    
                    <div class="modal-btn mt-4 text-center">
                      <button class="btn btn-danger me-3" type="button" data-bs-dismiss="modal">Cancel</button>
                      <button class="btn btn-primary" type="submit" >Submit</button>
                
                    </div>
               </form>

          </div>
        </div>

      </div>
    </div>
  </div>

<x-footer></x-footer>

<script>
    function view_make($id,$status){
        $('#view_make_id').val($id);
        $('#make_status').val($status);
        if($status == '0')
        {
            $status = 'unblock';
        }
        else{
            $status = 'block';
        }
        $('#make_statuses').html($status);
    }

    

    
</script>