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
            <div class="col-sm-12 col-xl-12 xl-100">
              <div class="card">
              <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                  <h5>Filter</h5>

                  <div class="action-buttons">
                    <!-- Add New Tab -->
                    <button class="btn btn-danger btn-pill" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalCenter-1">
                                  Add <i class="fas fa-plus-circle ms-2"></i>
                                </button>

                    <!------ Edit Button ------>
                    
                    <button class="btn btn-pill btn-primary me-2" type="button" name="hide" onclick="edit_active(this)">Edit  <i class="far fa-edit"></i></button>


                    
                     <!-- <button class="btn btn-pill btn-danger me-2" type="button" onclick="delete_active()"><i class="fas fa-trash-alt"></i></button> -->
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
                  <ul class="nav nav-tabs border-tab nav-primary general-tab" id="info-tab" role="tablist">
                    @forelse($filter_lable as $fi_lb)
                    @if($fi_lb->filter_id != '13' && $fi_lb->filter_id != '2' )
                    <li class="nav-item position-relative">
                      
                      <div class="edit" style="display:none;">
                        
                        <button type="button" class="position-absolute translate-middle badge rounded-pill bg-danger border-0 p-1"  
                            data-bs-toggle="modal" data-bs-target="#exampleModalCenter-2" onclick="edit_label( '{{$fi_lb->filter_id}}', '{{$fi_lb->label_name}}' )">
                          <i class="far fa-edit"></i>
                        </button>
                      </div>

                      <a class="nav-link text-start {{ ($loop->index == '0')? 'active' : ''}}" id="{{str_replace(' ','_',$fi_lb->label_name)}}-info-tab" data-bs-toggle="tab" href="#info_{{str_replace(' ','_',$fi_lb->label_name)}}"
                        role="tab" aria-controls="info_{{str_replace(' ','_',$fi_lb->label_name)}}" aria-selected="{{ ($loop->index == '0')? 'true' : 'false' }}">{{$fi_lb->label_name}}</a>
                    </li>
                    @endif
                    @empty
                    @endforelse

                  </ul>

                  <div class="tab-content" id="info-tabContent">
                    @forelse($filter_lable as $fi_lb)
                    @if($fi_lb->filter_id != '13' && $fi_lb->filter_id != '2')
                    <div class="tab-pane fade {{ ($loop->index == '0')? 'show active' : ''}}" id="info_{{str_replace(' ','_',$fi_lb->label_name)}}" role="tabpanel"
                      aria-labelledby="{{str_replace(' ','_',$fi_lb->label_name)}}-info-tab">
                      <!-- Container-fluid starts-->
                      <div class="container-fluid">
                        <div class="row">
                          <!------- Default ordering (sorting) Starts ------->
                          <div class="col-sm-12">
                            <div class="card">
                              <div class="card-body p-2">
                                <div class="table-responsive">
                                  <table class="display dataTable" id="table-{{$loop->index+1}}">
                                    <thead>
                                       <tr>
                                        <th>Name</th>
                                        <th>Total Cars</th>
                                        <th>Action</th>
                                        
                                      </tr>
                                      
                                    </thead>
                                    <tbody>
                                    @forelse($filter_translations->where('filter_id',$fi_lb->filter_id) as $fi_tr)
                                      <tr>
                                        <td id="{{$fi_tr->name}}">{{$fi_tr->name}}</td>
                                        <td>{{count($auctions->where($fi_tr->list->type,$fi_tr->id))}}</td>
                                        <td align='center'><button type="button" class="btn btn-primary"  
                                              data-bs-toggle="modal" data-bs-target="#exampleModalCenter-edit" onclick="edit_translation( '{{$fi_tr->id}}', '{{$fi_tr->name}}' )">
                                              Edit <i class="far fa-edit"></i></button>
                                            <a href="{{url('translation_cars/'.$fi_tr->id.'/'.$fi_lb->filter_id)}}" class="btn btn-danger {{(count($auctions->where($fi_tr->list->type,$fi_tr->id)) == '0')? 'd-none' : '' }} "  >All Cars <i class="fas fa-car-side"></i></a>
                                            <!--<button class="btn btn-primary" type="button" onclick="view_trans( '{{$fi_tr->list->type}}' , {{$fi_tr->id}}, {{$fi_tr->status}})" data-bs-toggle="modal"-->
                                            <!--  data-bs-target="#showmake" aria-expanded="false" aria-controls="collapse11" title="{{($fi_tr->status == 0)? 'Unblock' : 'Block'}}">-->
                                            <!--  <i class="far fa-eye{{($fi_tr->status == '0')? '-slash' : ''}}"></i></button>-->
                                        </td>
                                      </tr>
                                      @empty
                                      <tr>
                                        <td colspan = "3" align="center">No Data available </td>
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
                    @endif
                    @empty
                    @endforelse
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Container-fluid Ends-->
      </div>

      <!------- All Modals Starts ------->

  <!---- General Page Add New Tab Modal ---->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add New Tab</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body mt-3">
          <div class="mb-3">
              <form action="{{url('add_filter')}}" method="post" id="add_tab_name">
                  @csrf
                    <label class="form-label" for="tab_name">Add General Tab</label> 
                    <input class="form-control" id="exampleFormControlInput1" type="text" name="tab_name" id="tab_name" placeholder="Enter Tab Name........" required>
                    <span id="tab_name_error"></span>
                    <div class="modal-btn mt-4 text-center">
                      <button class="btn btn-danger me-3" type="button" data-bs-dismiss="modal">Cancel</button>
                      <button class="btn btn-primary" type="button" onclick="add_filter()">Save</button>
                
                    </div>
               </form>

          </div>
        </div>

      </div>
    </div>
  </div>

  <!---- General Page Edit New Tab Modal ---->
  <div class="modal fade" id="exampleModalCenter-2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter-2"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Tab</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body mt-3">
          <div class="mb-3">
              <form action="{{url('edit_filter')}}" method="post" id="edit_tab_name_form">
                  @csrf
                    <input type="hidden" name="edit_label_input" id="edit_label_input" value="">
                    <label class="form-label" for="edit_tab_name">Edit General Tab</label> 
                    <input class="form-control" type="text" name="edit_tab_name" id="edit_tab_name" required>
                    <span id="tab_name_error"></span>
                    <div class="modal-btn mt-4 text-center">
                      <button class="btn btn-danger me-3" type="button" data-bs-dismiss="modal">Cancel</button>
                      <button class="btn btn-primary" type="button" onclick="edit_filter()">Save</button>
                
                    </div>
               </form>

          </div>
        </div>

      </div>
    </div>
  </div>

  <!---- General Page Add New Tab Modal ---->
  <div class="modal fade" id="exampleModalCenter-1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body mt-3">
          <div class="mb-3">
            <form action="{{url('add_type')}}" method="post" id="fi_type">
              @csrf
              <!------- Select Box One ------->
               <label class="form-label" for="tab">Select General Tab</label>
              <select class="form-select digits my-4" name="tab" id="tab">
                <option class="d-none" label="Select General Tab........"></option>
                @forelse($filter_lable as $fi_lb)
                @if($fi_lb->filter_id != '13')
                <option value="{{$fi_lb->filter_id}}">{{ucwords(str_replace('_',' ',$fi_lb->label_name))}}</option>
                @endif
                @empty
                @endforelse
                
              </select>
              
              <!-- Input box -->
              <label class="form-label" for='type'>Type</label>
              <input type="text" class="form-control digits my-4" name="type" id="type" value="">
              

             
              <div class="modal-btn mt-5 text-center">
                <button class="btn btn-danger me-3" type="button" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" type="button" onclick="row_valid()">Add</button>
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>


  <!---- filter translation edit ---->
  
  <div class="modal fade" id="exampleModalCenter-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter-edit"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Filter Sub-cat</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body mt-3">
          <div class="mb-3">
              <form action="{{url('edit_translation')}}" method="post" id="edit_translation_name">
                  @csrf
                    <input type="hidden" name="edit_trans_input" id="edit_trans_input" value="">
                    <label class="form-label" for="translation_name">Edit Sub-category Name</label> 
                    <input class="form-control"  type="text" name="translation_name" id="translation_name" placeholder="Enter Sub-category Name........" required>
                    
                    <div class="modal-btn mt-4 text-center">
                      <button class="btn btn-danger me-3" type="button" data-bs-dismiss="modal">Cancel</button>
                      <button class="btn btn-primary" type="button" onclick="edit_translation_name()">Save</button>
                
                    </div>
               </form>

          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Show hide Translation -->
  <div class="modal fade" id="showmake" tabindex="-1" role="dialog" aria-labelledby="deletemake"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><span id="ban_status"><span>Sub-category</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body mt-3">
          <div class="mb-3">
            
              <form action="{{url('show_translation')}}" method="post" id="show_translation">
                  @csrf
                    <label class="form-label" for="view_trans_id">Do you really want to <span id="trans_statuses"></span> this sub category?</label> 
                    <input class="form-control" type="hidden" name="view_trans_id" id="view_trans_id" >
                    <input type="hidden" name="list_type" id="list_type">
                    <input type="hidden" name="trans_status" id="trans_status">
                    
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
  



  <!------- All Modals End ------->


<x-footer></x-footer>


<script>
    function view_trans($list_type,$id,$status){
        $('#list_type').val($list_type);
        $('#view_trans_id').val($id);
        $('#trans_status').val($status);
        
        if($status == '0')
        {
            $status = 'unblock';
        }
        else{
            $status = 'block';
            
        }
        $('#trans_statuses').html($status);
    }
   
</script>

