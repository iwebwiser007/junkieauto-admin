<x-header></x-header>
<x-nav></x-nav>

  <!-- Page Sidebar Ends-->
  <div class="page-body">
        <div class="container-fluid">
          <div class="page-header">
            <div class="row">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                  <h5>Add Banner</h5>

                  <div class="action-buttons">
                    <!-- Add New Tab -->
                     <!-- <button class="btn btn-pill btn-primary px-3 me-2" type="button" data-bs-toggle="modal"
                      data-bs-target="#exampleModalCenter">Add<i class="fas fa-plus-circle ms-2"></i></button> -->
                    <a href="{{url('add_banner')}}" class="btn btn-pill btn-primary px-3 me-2">Add Banner</a>
                  </div>
              </div>
            </div>
          </div>
        </div>


        <!----------- Container-fluid starts -------------->
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
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
                  <!------- Accordion Container ------->
                  <div class="default-according style-1 banner-accordion" id="accordionoc">
                    @forelse($banner as $ban)
                    <div class="card" >
                      <div class="card-header bg-primary position-relative">
                        <h5 class="mb-0">
                          <button class="btn btn-link text-white" data-bs-toggle="collapse"
                            data-bs-target="#collapseicon{{$ban->id}}" aria-expanded="true" aria-controls="collapse11">{{$ban->title}}
                            <!-- #<span>{{$loop->index + 1}}</span>--></button>

                          <div class="banner-acco-btn position-absolute">
                            <!------- Edit Button ------->
                            <a href="{{url('edit_banner/'.$ban->id)}}" class="btn btn-primary banner-edit"> <i
                                class="far fa-edit"></i></a>
                            <!-- <button class="btn btn-primary banner-edit" type="button" onclick="banner_click({{$ban->id}})"><i
                                class="far fa-edit"></i></button> -->

                                <!------- view Button ------->
                            <button class="btn btn-primary banner-del" type="button" onclick="view_banner({{$ban->id}}, {{$ban->status}})" data-bs-toggle="modal"
                            data-bs-target="#showbanner" aria-expanded="false" aria-controls="collapse11" title="{{($ban->status == 0)? 'Block' : 'Unblock'}}">
                            
                            <i class="far fa-eye{{($ban->status == '0')? '-slash' : ''}}"></i></button>

                            <!------- delete Button ------->
                            <!-- <button class="btn btn-secondary banner-del" type="button" onclick="delete_banner({{$ban->id}})" data-bs-toggle="modal"
                            data-bs-target="#deletebanner" aria-expanded="false" aria-controls="collapse11"><i
                                class="far fa-trash-alt"></i></button> -->

                            
                          </div>
                        </h5>
                      </div>

                      <div class="collapse {{ ($loop->index == '0')? 'show' : ''}}" id="collapseicon{{$ban->id}}" aria-labelledby="collapseicon"
                        data-bs-parent="#accordionoc">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-lg-12">
                              <!-- <form class="theme-form" action="{{url('edit_banner')}}" method="post" enctype="multipart/form-data" id="edit_banner_form">
                                @csrf
                                <input type="hidden" name="bannerid{{$ban->id}}" id="bannerid{{$ban->id}}" value="{{$ban->id}}"> -->
                                <div class="mb-3">
                                  <label class="col-form-label pt-0" for="title{{$ban->id}}">Banner Title</label>
                                  <input class="form-control" id="title{{$ban->id}}" name="title{{$ban->id}}" type="text" aria-describedby="emailHelp"
                                    placeholder="Add Banner Title" value="{{$ban->title}}" disabled>
                                </div>

                                <div class="mb-3">
                                  <label class="col-form-label pt-0" for="desc{{$ban->id}}">Banner Description</label>
                                  <textarea class="form-control" id="desc{{$ban->id}}" name="desc{{$ban->id}}" rows="3"
                                    placeholder="Add Banner Description" disabled>{{strip_tags($ban->description)}}</textarea>
                                </div>

                                <div class="mb-3 add-banner-img position-relative">
                                  <!-- <label class="col-form-label position-initial" for="img{{$ban->id}}">Add Banner Image</label>
                                  <input class="form-control d-none" id="img{{$ban->id}}" name="img{{$ban->id}}" type="file" onchange="save_image('image','img'+{{$ban->id}})" value="{{$ban->image_path}}" disabled > -->

                                  <div class="banner-img-container mt-5">
                                    <img src="{{$ban->image_path ?? './assets/img/banner/1.jpg'}}" class="default-img" alt="Banner Image">
                                  </div>
                                </div>

                                <!-- <div class="mb-3 row justify-content-end mt-4">
                                  <div class="col-2 text-end">
                                    <button class="btn btn-primary w-75 text-center" type="button" id="edit_submit{{$ban->id}}" onclick="edit_banner({{$ban->id}})" disabled>Submit</button>
                                  </div>
                                </div> -->
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    @empty
                    <div>No Banner Available</div>
                    @endforelse
                    
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>



        <!----------- Container-fluid Ends ---------------->
      </div>

     

  <!-- Show hide Banner -->
  <div class="modal fade" id="showbanner" tabindex="-1" role="dialog" aria-labelledby="deletebanner"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><span id="ban_status"><span> Banner</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body mt-3">
          <div class="mb-3">
            
              <form action="{{url('show_banner')}}" method="post" id="show_banner_form">
                  @csrf
                    <label class="form-label" for="banner_id">Do you really want to <span id="bann_status"></span> this banner?</label> 
                    <input class="form-control" type="hidden" name="view_banner_id" id="view_banner_id" >
                    <input type="hidden" name="banner_status" id="banner_status">
                    <span id="tab_name_error"></span>
                    <div class="modal-btn mt-4 text-center">
                      <button class="btn btn-danger me-3" type="button" data-bs-dismiss="modal">Cancel</button>
                      <button class="btn btn-primary" type="button" onclick="show_banner()">Submit</button>
                
                    </div>
               </form>

          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- Delete Banner -->
  <div class="modal fade" id="deletebanner" tabindex="-1" role="dialog" aria-labelledby="deletebanner"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Delete Banner</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body mt-3">
          <div class="mb-3">
            
              <form action="{{url('delete_banner')}}" method="post" id="delete_banner_form">
                  @csrf
                    <label class="form-label" for="banner_id">Do you really want to delete this banner?</label> 
                    <input class="form-control" type="hidden" name="banner_id" id="banner_id" >
                    <span id="tab_name_error"></span>
                    <div class="modal-btn mt-4 text-center">
                      <button class="btn btn-danger me-3" type="button" data-bs-dismiss="modal">Cancel</button>
                      <button class="btn btn-primary" type="button" onclick="del_banner()">Delete</button>
                
                    </div>
               </form>

          </div>
        </div>

      </div>
    </div>
  </div>


<x-footer></x-footer>

<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });
</script>