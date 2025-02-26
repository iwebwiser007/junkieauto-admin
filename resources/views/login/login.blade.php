<!DOCTYPE html>
<html lang="en">

<head>
  <!------- META TAGS START ------->
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--<meta name="description"-->
  <!--  content="viho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">-->
  <!--<meta name="keywords"-->
  <!--  content="admin template, viho admin template, dashboard template, flat admin template, responsive admin template, web app">-->
  <meta name="author" content="pixelstrap">
  <!------- META TAGS END ------->

  <!------- PROJECT TITLE ------->
  <title>Junkie Auto</title>

  <!------- ALL CSS LINKS STARTS ------->

  <!---- Website title icon ---->
  <link rel="icon" href="{{asset('image/favicon.png')}}" type="image/x-icon">


  <!---- Google fonts ---->
  <link rel="preconnect" href="https://fonts.gstatic.com/">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
    rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap"
    rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
    rel="stylesheet">

  <!-- Bootstrap v5.0.0-beta1 -->
  <!--<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}">-->
    <link rel="stylesheet" type="text/css" href="{{ url('/public/css/bootstrap.css')}}">


  <!---- Project stylesheet ---->
  <link rel="stylesheet" type="text/css" href="{{ url('/public/css/style.css') }}">


  <!---- Responsive css ---->
  <link rel="stylesheet" type="text/css" href="{{ url('/public/css/responsive.css')}}">

  <!---- Font Awesome 4.7.0 ---->
  <link rel="stylesheet" type="text/css" href="{{ url('/public/css/fontawesome.css')}}">

  <!-- iziToast css  -->
  <link rel="stylesheet" href="{{asset('bundels/izitoast/css/iziToast.min.css')}}">

  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/font-awesome-5-css@5.4.1/css/all.min.css">


  <!------- ALL CSS LINKS END ------->
</head>

<!------- Body Starts ------->

<body>
  <!------- Loader Starts ------->
  <div class="loader-wrapper">
      <div class="theme-loader">
        <div class="loader-p"></div>
      </div>
    </div>
    @if (Session::has('msg'))
    <?php $msg=Session::get('msg');
        
    ?>
    <div class="alert alert-warning alert-dismissible my-2 w-25 text-white bg-danger mx-auto fade show" role="alert">
      {{$msg}}
      
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     
    </div>
    @endif
    
  
    <!------- Loader End ------->

  <!------- Main Container Starts ------->
  <div class="main-container">
    @if($errors->any())
        @foreach($errors->all() as $err)
            <li><span style="color:red">{{$err}}</span></li>
        @endforeach
    @endif
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-5"><img class="bg-img-cover bg-center" src="{{ url('/public/image/login/login-img.png')}}" alt="looginpage">
        </div>
        <div class="col-xl-7 p-0">
          
          <div class="login-card">
            
            <form class="theme-form login-form" action="{{url('login_data')}}" method="post" id="login">
                @csrf
              <h4>Login</h4>
              <div class="form-group">
                <label>Choose Language</label>
                <div class="input-group"><span class="input-group-text"><i class="fas fa-globe-asia"></i></span>
                <select class="form-control" name="language" id="language">
                  @forelse($language as $lang)
                  <option value="{{$lang->short_name}}">{{ ucfirst($lang->name) }}</option>
                 @empty
                 @endforelse 
                </select>
                  
                </div>
              </div>
              <div class="form-group">
                <label>Email Address</label>
                <div class="input-group"><span class="input-group-text"><i class="far fa-envelope"></i></span>
                  <input class="form-control" type="email" name="email" id="email" required="" placeholder="Test@gmail.com" >
                  {{-- <div class="invalid-tooltip">Please enter proper email.</div> --}}
                </div>
              </div>
              <div class="form-group">
                <label>Password</label>
                <div class="input-group"><span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
                  <input class="form-control" type="password" name="password" id="password" required=""
                    placeholder="*********">
                  {{-- <div class="invalid-tooltip">Please Enter Password.</div> --}}
                 
                </div>
              </div>

               <div class="form-group">
                <div class="checkbox">
                  <input type="checkbox" name="login_check" id="login_check">
                  <label for="login_check" class="text-muted">Remember Password</label>
              </div>
             
              <div class="form-group">
                
                <button class="btn btn-primary btn-block w-100 mt-4" type="button" onclick="login()" >Sign in</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!------- Main Container End ------->

  <!------- ALL JAVASCRIPT AND JS LINKS STARTS  ------->

  <!---- Form validation script starts ---->
  <script>
    (function () {
      'use strict';
      window.addEventListener('load', function () {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function (form) {
          form.addEventListener('submit', function (event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
  </script>
  <!---- Form validation script End ---->

  <!---- Jquery v3.5.1  ---->
  <script src="{{ url('/public/js/jquery/jquery-3.5.1.min.js')}}"></script>

  <!---- Bootstrap js ---->
  <script src=" {{ url('/public/js/bootstrap/popper.min.js')}} "></script>
  <script src="{{ url('/public/js/bootstrap/bootstrap.min.js')}} "></script>



  <!---- Sidebar jquery ---->
  <script src="{{ url('/public/js/sidebar-menu.js')}}"></script>
  <script src="{{ url('/public/js/config.js')}}"></script>

  <!---- Theme js ---->
  <script src="{{ url('/public/js/script.js')}}"></script>

    <script src="{{ url('/public/js/fontawsome.js')}}"></script>
    <script src="{{ url('/public/js/admin.js')}}"></script>

    <script type="text/javascript">
       $msg=$('#msg').val();
       if($msg!='')
       {
          iziToast.error({
            message: $msg,
            position: "topCenter"

        });
       }
     </script>
<script src="{{asset('bundels/izitoast/js/iziToast.min.js')}}"></script>
 <script src="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/all.min.css"></script>


  <!------- ALL JAVASCRIPT AND JS LINKS STARTS  ------->
</body>
<!------- Body End ------->

</html>
