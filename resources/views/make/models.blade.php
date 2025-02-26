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
                          <h5>{{$brand->name}} Models</h5>
                          <div class="action-buttons">

                                <a href="{{url('cars_make/'.$brand->caregory_id)}}" class="btn btn-primary">All Cars</a>
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
                                            <th>Model</th>
                                            <th>Total Cars</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($models as $mk)
                                        <tr>
                                            <td>{{$mk->name}}</td>
                                            <td>{{$mk->cars_model_count}}</td>
                                            <td  align='center'>
                                                <a href="{{url('all_cars/'.$mk->caregory_id)}}" class="btn btn-primary">All Cars</a>
                                                <button class="btn btn-primary" type="button" onclick="view_model({{$mk->caregory_id}}, {{$mk->make_models->status}})" data-bs-toggle="modal"
                                                    data-bs-target="#showmodel" aria-expanded="false" aria-controls="collapse11" title="{{($mk->make_models->status == 0)? 'Block' : 'Unblock'}}">
                                                    
                                                    <i class="far fa-eye{{($mk->make_models->status == '0')? '-slash' : ''}}"></i></button>
                                            </td>
                                        </tr>    
                                        @empty
                                        <tr>
                                            <td colspan='3' align='center'>No models available for this maker</td>
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

    <!---- General Page Add New Model Modal ---->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add New Model</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body mt-3">
          <div class="mb-3">
              <form action="{{url('add_model')}}" method="post" id="add_make_name">
                  @csrf
                    <input type="hidden" name="brand_id" id="brand_id" value="{{$brand->caregory_id}}">
                    <label class="form-label" for="make_name">Add Model</label> 
                    <input class="form-control" type="text" name="make_name" id="make_name" placeholder="Enter Model Name........" required>
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

  <!-- Show hide Model -->
  <div class="modal fade" id="showmodel" tabindex="-1" role="dialog" aria-labelledby="deletemodel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><span id="ban_status"><span>Model</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body mt-3">
          <div class="mb-3">
            
              <form action="{{url('show_model/'.$brand->id)}}" method="post" id="show_model_form">
                  @csrf
                    <label class="form-label" for="view_model_id">Do you really want to <span id="model_statuses">{{}}</span> this model?</label> 
                    <input class="form-control" type="hidden" name="view_model_id" id="view_model_id" >
                    <input type="hidden" name="model_status" id="model_status">
                    
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
    function view_model($id,$status){
        
        $('#view_model_id').val($id);
        $('#model_status').val($status);
        if($status == '0')
        {
            $status = 'unblock';
        }
        else{
            $status = 'block';
        }
        $('#model_statuses').html($status);
    }

    
</script>