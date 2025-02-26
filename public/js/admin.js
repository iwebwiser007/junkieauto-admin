var base = "http://localhost/junkie_auto/";
var image_path="http://localhost/junkie_auto/storage/images/";
 var img = "http://localhost/junkie_auto/";


 //login page


function login(){
  
    if($('#email').val().trim() === ''){
        iziToast.warning({
            message: "Please enter email address",
            position: "topCenter"
        });
        return ;
    }else if($('#password').val().trim() === ''){
        iziToast.warning({
            message: "Please enter password",
            position: "topCenter"
        });
        return ;
    }else if($('#email').val().trim() !== '' && $('#password').val().trim() !== ''){
        var value = $("#email").val();
        // console.log(value);
        var result = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

        if (!result.test(value)) {
            iziToast.warning({
                message: "Please enter valid email format",
                position: "topCenter"
            });
            return ;
        } else {
            $("#login").submit();
            
        }
    }
}

function email_valid($id){
  var value = $($id).val();
        // console.log(value);
        var result = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

        if (!result.test(value)) {
            iziToast.warning({
                message: "Please enter valid email format",
                position: "topCenter"
            });
            return ;
        } 
}

//general page
 function add_filter(){
    if($('#tab_name').val() == ''){
        iziToast.warning({
            message: "Please enter tab name",
            position: "topCenter"
        });
        return ;
    } else{
      $('#add_tab_name').submit();
    }
}

function edit_filter(){
    if($('#edit_tab_name').val() == ''){
        iziToast.warning({
            message: "Please enter tab name",
            position: "topCenter"
        });
        return ;
    } else{
      $('#edit_tab_name_form').submit();
    }
}


function row_valid(){
    $('#tab_error').html(' ');
    $('#type_error').html(' ');
    
    if($('#tabs').val() == ''){
      
      iziToast.warning({
        message: "Please select a filter type",
        position: "topCenter"
    });
    return ;
    }else if($('#type').val().trim() == '' ){
      
      iziToast.warning({
        message: "Please enter a filter subtype",
        position: "topCenter"
    });
    return ;
    }else{
      
      $('#fi_type').submit();
    }

}

function edit_active(element){
  
  if(element.name == 'hide')
  {
      $(element).attr('name','show');
      $('.edit').show();
  }
  else
  {
      $(element).attr('name','hide');
      $('.edit').hide();
  }
  
}

function delete_active(){
  $('.delete').show();
}

function edit_label($id, $label_name){
  
  $('#edit_label_input').val($id);
  $('#edit_tab_name').val($label_name);
}

function edit_translation($id, $trans_name){
  $('#edit_trans_input').val($id);
  $('#translation_name').val($trans_name);
}

function edit_translation_name(){
  if($('#translation_name').val().trim() == ''){
    iziToast.warning({
      message: "Please enter sub category name",
      position: "topCenter",
    });
    return ;
    
  }else{
    $('#edit_translation_name').submit();    
  }
  
}


//general page end

//banner page

function add_banner(){
  
    if($('#banner_title').val() == ''){
        iziToast.warning({
            message: "Please enter banner title",
            position: "topCenter"
        });
        return ;
    }else if($('#banner_desc').val() == ''){
      
        iziToast.warning({
            message: "Please enter banner description",
            position: "topCenter"
        });
        return ;
    }else if($('#banner_img').val() == ''){ 
        iziToast.warning({
          message: "Please select banner image",
          position: "topCenter"
        });
        
        return ;
        
      }else{
        iziToast.success({
            message: "Please Wait",
            position: 'topCenter'
        });
        $("#exampleModalCenter").modal("hide");
        $('#add_banner_form').submit();  
      } 
    


}

function edit_banners(){
  
  if($('#banner_title').val() == ''){
      iziToast.warning({
          message: "Please enter banner title",
          position: "topCenter"
      });
      return ;
  }else if($('#banner_desc').val() == ''){
    
      iziToast.warning({
          message: "Please enter banner description",
          position: "topCenter"
      });
      return ;
  }else if($('#banner_img').val() == ''){
    if($('#imgreg').attr('src') == ''){
      iziToast.warning({
        message: "Please select banner image",
        position: "topCenter"
      });
      
      return ;
    }    
    

  }else {
      iziToast.success({
          message: "Banner added successfully",
          position: 'topCenter'
      });
      $("#exampleModalCenter").modal("hide");
      $('#add_banner_form').submit();
  }
  


}

function save_image(type, id)
{ 
    // console.log(type);
    
    var selection = document.getElementById(id);
    
    
    var result = null;
    
    if(type == 'pdf')
    {
         result=check_pdf_ext(selection.files[0].name);
    }
    else if(type == 'image')
    {
         result=check_img_ext(selection.files[0].name);
    }
    else if(type == 'video')
    {
        
        // var vid = document.createElement('video');
        // var fileURL = URL.createObjectURL(selection.files[0]);
        // vid.src = fileURL;
        
        //   vid.ondurationchange = function() {
        //      this.duration;
        //     console.log(dur);
        //   };
      
      
          result=check_video_ext(selection.files[0].name);
    }
    else
    {
        result=null;
    }
    
    
    if(result == false)
    {
        if(type == 'pdf')
        {
            iziToast.warning({
               message: "Only Accept Pdf , Document , Text file ",
               position: "topCenter"
             });
        }
        else
        {
           iziToast.warning({
               message: "Only Accept "+ type,
               position: "topCenter"
             }); 
        }
        
        
    }
    else if(type == 'image' && ( (selection.files[0].size / 1024 / 1024) >= 1))
    {
        iziToast.warning({
           message: "Please upload the image not be greater than 1 mb",
           position: "topCenter"
         });
         
        return;
        
    }
    else if(result == true)
    {
        return ;
        
    }
    
}

function check_img_ext(src)
{
    var extension = src.substr(src.lastIndexOf(".") + 1);

    var fileExtension =['jpeg', 'jpg', 'png', 'gif', 'bmp'];
    var ext= fileExtension.includes(extension);
    
    return ext;
    
}

function delete_banner($id){
    $('#banner_id').val($id);
}

function del_banner(){
  $('#delete_banner_form').submit();  
}

function banner_click($id){
    // if($('input').prop('disabled',true)){
    //     $('input').prop('disabled', false);
    //     $('button').prop('disabled', false);
    // } else{
    //     $('input').prop('disabled', true);
    //     $('button').prop('disabled', true);
    // }
    // $('#collapseicon'+$id).click();
    $('#title'+$id).removeAttr("disabled");
    $('#desc'+$id).removeAttr("disabled");
    $('#img'+$id).removeAttr("disabled");
    $('#edit_submit'+$id).removeAttr("disabled");
}

function edit_banner($id){
    
    if($('#title'+$id).val() == ''){
        iziToast.warning({
            message: "Please fill the banner title.",
            position: "topCenter"
        });
    }
    if($('#desc'+$id).val() == ''){
        iziToast.warning({
            message: "Please fill the banner description.",
            position: "topCenter"
        });
    }
    if($('#img'+$id).val() == ''){
        iziToast.warning({
            message: "Please fill the banner image.",
            position: "topCenter"
        });
    }
    if($('#img'+$id).val() !='' && $('#title'+$id).val() != '' && $('#desc'+$id).val() != ''){
        iziToast.success({
            message: "Banner edited successfully",
            position: 'topCenter'
        });
        $('#edit_banner_form').submit();
    }
    
}

function view_banner(id, status){
    $('#view_banner_id').val(id);
    if(status == '0'){
        $('#ban_status').html('Unblock');
        $('#bann_status').html('Unblock');
        $('#banner_status').val('1');
    } else{
        $('#bann_status').html('Block');
        $('#ban_status').html('Block');
        $('#banner_status').val('0');
    }
}

function show_banner(){
    $('#show_banner_form').submit();
}

//banner page end

//auction page
function latest_offer($id){
    $('#tab_id').val($id);
}

//make page
function add_make(){
    if($('#make_name').val().trim() == ''){
        iziToast.warning({
            message: "Please enter name",
            position: "topCenter"
        });
        return ;
    }
    else{
        $("#exampleModalCenter").modal("hide");
        $('#add_make_name').submit();
    }
}

function accept_req($id){
    $('#acc_req_id').val($id);
}

function reject_req($id){
    $('#rej_req_id').val($id);
}

function request_rej(){
  if($('#req_reason').val() == ''){
    $('#req_reason_error').html('Please fill the reason');
  }else{
    $('#reject_auc_req').submit();
  }
}

function accept_docs($id){
    $('#acc_docs_id').val($id);
}

function reject_docs($id){
    $('#rej_docs_id').val($id);
}

function docs_rej(){
  if($('#docs_reason').val() == ''){
    $('#docs_reason_error').html('Please fill the reason');
  }else{
    $('#reject_seller_docs').submit();
  }
}

//image validation
function fileValidation(id) {
  
    var fileInput = document.getElementById(id);
    //var fileInput = value;
    var filePath = fileInput.value;
        
    // Allowing file type
    var allowedExtensions = 
            /(\.jpg|\.jpeg|\.png|\.gif)$/i;
    
    if (!allowedExtensions.exec(filePath)) {
        
        fileInput.value = '';
        
        iziToast.warning({
            message: "Only accepts image",
            position: "topCenter"
        });
        $('#imgreg').attr('src','http://localhost/junkie_auto/public/image/no_image.jpg');
        
        return ;

    } 
    else 
    { 
        // Image preview
        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById(
                    'imagePreview').innerHTML = '<img src="' + e.target.result
                    + '"' + 'name="imgreg' +'"' + 'id="imgreg' +'"' +  'style="max-width:400px;max-height:100px;margin-bottom:10px;"/>';
                    document.getElementById('imgreg').value = filePath;
                    
            };
            
            
            reader.readAsDataURL(fileInput.files[0]);
            
        }
    }
}

function edit_profile(){
  
  if($('#first_name').val().trim() == ''){
    iziToast.warning({
      message: 'Please enter first name.',
      position: 'topCenter'
    });
    return ;
  }else if($('#first_name').val().trim().length > 50){
    iziToast.warning({
      message: "first name is too long.",
      position: "topCenter"
    });
    return ;
  }else if($('#last_name').val().trim() == ''){
    iziToast.warning({
      message: 'Please enter last name.',
      position: 'topCenter'
    });
    return ;
  }else if($('#last_name').val().trim().length > 50){
    iziToast.warning({
      message: "last name is too long.",
      position: "topCenter"
    });
    return ;
  }else if($('#last_name').val().trim() ==''){
    iziToast.warning({
      message: "Please fill address.",
      position: "topCenter"
    });
    return ;
  }else if($('#address').val().trim().length > 200){
    iziToast.warning({
      message: "Address is too long.",
      position: "topCenter"
    });
    return ;
  }else if($('#email').val().trim() == ''){
    iziToast.warning({
      message: "Please enter your email address.",
      position: "topCenter"
    });
    return ;
  }else if($('#mobile').val().trim()==''){
    iziToast.warning({
      message: "Please enter admin mobile number.",
      position: "topCenter"
    });
    return ;
  }else if($('#mobile').val().trim().length > 12){
    iziToast.warning({
      message: "Mobile number is too long.",
      position: "topCenter"
    });
    return ;
  }else if($('#street').val().trim().length > 200){
    iziToast.warning({
      message: "Street is too long.",
      position: "topCenter"
    });
    return ;
  }else if($('#street').val().trim()==''){
    iziToast.warning({
      message: "Please enter street.",
      position: "topCenter"
    });
    return ;
  }else if($('#city').val().trim()==''){
    iziToast.warning({
      message: "Please enter your city name",
      position: "topCenter"
    });
    return ;
  }else if($('#city').val().trim().length > 50){
    iziToast.warning({
      message: "City name is too long.",
      position: "topCenter"
    });
    return ;
  }else if($('#state').val().trim()==''){
    iziToast.warning({
      message: "Please enter your state",
      position: "topCenter"
    });
    return ;
  }else if($('#state').val().trim().length > 50){
    iziToast.warning({
      message: "State name is too long.",
      position: "topCenter"
    });
    return ;
  }else if($('#country').val().trim()==''){
    iziToast.warning({
      message: "Please enter your country",
      position: "topCenter"
    });
    return ;
  }else if($('#country').val().trim().length > 50){
    iziToast.warning({
      message: "Country name is too long.",
      position: "topCenter"
    });
    return ;
  }else if($('#imgreg').attr('src') =='http://localhost/junkie_auto/public/image/no_image.jpg' ){ 
        
    iziToast.warning({
      message: "Please select profile image",
      position: "topCenter"
    });
    
    return ;  
  }
  
     
  $('#edit_profile_form').submit();
  
}

function add_commission(){
  if($('#commission').val().trim() == ''){
    iziToast.warning({
      message: "Please enter commission",
      position: "topCenter",
    });
    return ;
  }else if($('#commission').val().trim() > 100){
    iziToast.warning({
      message: "Commission should not more than 100%",
      position: "topCenter",
    });
    return ;
  }else {
      $('#add_commission').submit();
  }
}

function add_bid_difference(){
  if($('#commission').val().trim() == ''){
    iziToast.warning({
      message: "Please enter commission",
      position: "topCenter",
    });
    return ;
  }else if($('#commission').val().trim() <= 0){
    iziToast.warning({
      message: "Bid difference should be greater than zero",
      position: "topCenter",
    });
    return ;
  }else {
      $('#add_commission').submit();
  }
}

function edit_password(){
  if($('#password').val().trim() == ''){
    iziToast.warning({
      message: 'Please enter your password.',
      position: 'topCenter'
    });
    return ;
  }else if($('#repass').val().trim() == ''){
    iziToast.warning({
      message: 'Please re-enter your password.',
      position: 'topCenter'
    });
    return ;
  }else if($('#password').val().trim() != $('#repass').val().trim()){
    iziToast.warning({
      message: 'Password does not match.',
      position: 'topCenter'
    });
    return ;
  }else {
    $('#edit_password_form').submit();    
  }
  
}

//image validation
function banner_image(id) {
  var fileInput = document.getElementById(id);
  //var fileInput = value;
  var filePath = fileInput.value;
      
  // Allowing file type
  var allowedExtensions = 
          /(\.jpg|\.jpeg|\.png|\.gif)$/i;
  
  if (!allowedExtensions.exec(filePath)) {
      
      fileInput.value = '';
      
      iziToast.warning({
          message: "Only accepts image",
          position: "topCenter"
      });
      $('#imgreg').attr('src','');
      $('#imgreg').val('');
      $('#img1').val('');
      
      return ;

  } 
  else 
  { 
      // Image preview
      if (fileInput.files && fileInput.files[0]) {
          var reader = new FileReader();
          reader.onload = function(e) {
              $('#imgreg').attr('src',e.target.result);
                  document.getElementById('imgreg').value = filePath;
                  $('#imgslct').val(filePath);
          };
          
          
          reader.readAsDataURL(fileInput.files[0]);
          
      }
  }
}

function find_bid(){
    if($('#date1').val() != '' && $('#date2').val() == ''){
        
            iziToast.warning({
                message: 'Please select To',
                position: 'topCenter',
            });
            return ;
        
    }else if($('#date2').val() != '' && $('#date1').val() == ''){
        
            iziToast.warning({
                message: 'Please select From',
                position: 'topCenter',
            });
            return ;
        
    }else if($('#date1').val() > $('#date2').val() ){
        iziToast.warning({
            message: "From date shouldn't greater than To date",
            position: 'topCenter',
        });
        return ;
    } else{
        $('#all_bids_auction').submit();
    }
}
