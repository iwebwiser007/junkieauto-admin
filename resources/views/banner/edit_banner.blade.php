<x-header></x-header>
<x-nav></x-nav>

  <!-- Page Sidebar Ends-->
  <div class="page-body">
        @if($errors->any())
            @foreach($errors->all() as $err)
                <li><span style="color:red">{{$err}}</span></li>
            @endforeach
        @endif
        <div class="container-fluid">
          <div class="page-header">
            <div class="row">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                  <h5>Edit Banner</h5>

              </div>
            </div>
          </div>
        </div>


        <!----------- Container-fluid starts -------------->
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <!------- Accordion Container ------->
                  <div class="default-according style-1 banner-accordion" id="accordionoc">
                    
                    <div class="card" >
                      <div class="card-header bg-primary position-relative">
                        <h5 class="mb-0">Edit Banner</h5>
                      </div>

                      <div class="card-body">
                          <div class="row">
                            <div class="col-lg-12">
                              <form class="theme-form" action="{{url('edit_banner')}}" method="post" enctype="multipart/form-data" id="add_banner_form">
                                @csrf
                                <input type="hidden" name="banner" id="bannerid" value="{{$ban->id}}">
                                <div class="mb-3">
                                  <label class="col-form-label pt-0" for="banner_title">Banner Title</label>
                                  <input class="form-control" id="banner_title" name="banner_title" type="text" aria-describedby="emailHelp"
                                    placeholder="Add Banner Title" value="{{$ban->title}}" >
                                </div>

                                <div class="mb-3">
                                  <label class="col-form-label pt-0" for="banner_desc">Banner Description</label>
                                  <textarea class="ckeditor form-control" id="banner_desc" name="banner_desc" rows="3"
                                    placeholder="Add Banner Description" >{{strip_tags($ban->description)}}</textarea>
                                </div>

                                <div class="mb-3 add-banner-img position-relative">
                                  <label class="col-form-label position-initial" for="banner_img">Add Banner Image</label>
                                  <input class="form-control d-none" id="banner_img" name="banner_img" type="file" onchange="banner_image(this.id)" value="{{$ban->image_path}}" >

                                  <div class="banner-img-container mt-5">
                                    <!-- <input type="hidden" id="img1" name="img1" class="default-img" alt="Banner Image" value="{{$ban->image_path}}" > -->
                                    <img src="{{$ban->image_path ?? asset('image/no_image.jpg') }}" id="imgreg" name="imgreg" class="default-img" alt="Banner Image">
                                    
                                  </div>
                                </div>

                                <div class="mb-3 row justify-content-end mt-4">
                                  <div class="col-2 text-end">
                                    <button class="btn btn-primary text-center" type="button" onclick="edit_banners()">Submit</button>
                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                    </div>
                   
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>



        <!----------- Container-fluid Ends ---------------->
      </div>

     

 
<x-footer></x-footer>

<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });
</script>