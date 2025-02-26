<x-header></x-header>
<x-nav></x-nav>

  <div class="page-body">
        <!-- Container-fluid starts-->
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-12 col-xl-12 xl-100">
              <div class="card">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h5>Edit Profile</h5>
                </div>

                <div class="card-body">
                <ul class="nav nav-tabs border-tab nav-primary general-tab" id="info-tab" role="tablist">
                    
                    <li class="nav-item position-relative">
                      
                      <a class="nav-link text-start active" id="detail-info-tab" data-bs-toggle="tab" href="#info_detail"
                        role="tab" aria-controls="info_detail" aria-selected="true">Edit Details</a>
                    </li>

                    <li class="nav-item position-relative">
                      
                      <a class="nav-link text-start" id="pass-info-tab" data-bs-toggle="tab" href="#info_pass"
                        role="tab" aria-controls="info_pass" aria-selected="true">Password</a>
                    </li>
                    
                  </ul>

                  <div class="tab-content" id="info-tabContent">
                    
                    <div class="tab-pane fade show active" id="info_detail" role="tabpanel"
                      aria-labelledby="detail-info-tab">
                      <!-- Container-fluid starts-->
                      <div class="container-fluid">
                        <div class="row">
                          <!------- Default ordering (sorting) Starts ------->
                          <div class="col-sm-12">
                            <div class="card">
                              
                              <div class="card-body p-2">
                                <form action="{{url('edit_profile')}}" method="post" id="edit_profile_form" enctype="multipart/form-data">
                                    @csrf
                                    <label class="form-label">First Name</label>
                                    <input class="form-control" name="first_name" id="first_name" value="{{user()->first_name}}">
                                    <label class="form-label">Last Name</label>
                                    <input class="form-control" name='last_name' id="last_name" value="{{user()->last_name}}">
                                    <label class="form-label">Email</label>
                                    <input class="form-control" type="email" name='email' id='email' onchange="email_valid(this.id)" value="{{user()->email}}">
                                    <label class="form-label">Mobile Number</label>
                                    <input class="form-control" type="text" name='mobile' id='mobile' value="{{user()->mobile_number}}">
                                    <label class="form-label">Address</label>
                                    <input class="form-control" type="text" name='address' id='address' value="{{user()->address}}">
                                    <label class="form-label">Street</label>
                                    <input class="form-control" type="text" name='street' id='street' value="{{user()->street}}">
                                    <label class="form-label">City</label>
                                    <input class="form-control" type="text" name='city' id='city' value="{{user()->city}}">
                                    <label class="form-label">State</label>
                                    <input class="form-control" type="text" name='state' id='state' value="{{user()->state}}">
                                    <label class="form-label">Country</label>
                                    <input class="form-control" type="text" name='country' id='country' value="{{user()->country}}">
                                    <!-- <label class="form-label">Image</label>
                                    <input class="form-control" type="text" name='img' id='img' value="{{user()->profile_url}}"> -->
                                    
                                    
                                    <label class="form-label">Select Profile Image</label>
                                    <input class="form-control" type='file' name='img' id='img' onchange="fileValidation(this.id)">
                                    <!--<input type="hidden" name="imgslct" id="imgslct"> -->
                                     <div id=imagePreview>
                                        
                                        <img src ="{{user()->profile_url}}" id='imgreg' name='imgreg' style="max-width:400px;max-height:100px;margin-bottom:10px;"/>
                                    </div>
                                    <!-- <div style='width:300px;height:100px;'>
                                    <label class="form-label">Previously uploaded image</label>
                                      <img src ="{{user()->profile_url}}" id='imgreg' name='imgreg' style="max-width:400px;max-height:100px;margin-bottom:10px;"/>
                                    </div> -->
                                    <div class="modal-btn mt-4">
                                      
                                      <button class="btn btn-primary" type="button" onclick="edit_profile()">Save</button>
                                    </div>
                                </form>
                              </div>
                            </div>
                          </div>
                          <!-- Default ordering (sorting) Ends-->
                        </div>
                      </div>
                      <!-- Container-fluid Ends-->
                    </div>
                    

                    <!-- password change -->
                    <div class="tab-pane fade" id="info_pass" role="tabpanel"
                      aria-labelledby="pass-info-tab">
                      <!-- Container-fluid starts-->
                      <div class="container-fluid">
                        <div class="row">
                          <!------- Default ordering (sorting) Starts ------->
                          <div class="col-sm-12">
                            <div class="card">
                              
                              <div class="card-body p-2">
                                <form action="{{url('edit_password')}}" method="post" id="edit_password_form">
                                    @csrf
                                    <label class="form-label">Password</label>
                                    <input class="form-control" type="password" name='password' id='password'>
                                    <label class="form-label">ReEnter Password</label>
                                    <input class="form-control" type="password" name='repass' id='repass'>
                                    
                                    <div class="modal-btn mt-4">
                                      
                                      <button class="btn btn-primary" type="button" onclick="edit_password()">Save</button>
                                    </div>
                                </form>
                              </div>
                            </div>
                          </div>
                          <!-- Default ordering (sorting) Ends-->
                        </div>
                      </div>
                      <!-- Container-fluid Ends-->
                    </div>


                  </div>

                 

                  
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Container-fluid Ends-->
      </div>

      

<x-footer></x-footer>


