<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="zxx">
<!--<![endif]-->

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
  <meta name="keywords" content="">
  <meta name="description" content="">
  <title>{{ App\Setting::firstOrFail()->name }}</title>

  <!-- favicon -->
 
  <link rel="shortcut icon" href="{{ asset('assets/front/images/setting/'.App\LogoSetting::first()->favicon) }}" type="image/x-icon">

  <!--Google Font-->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
  <!--Bootstrap Stylesheet-->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/css/bootstrap.min.css') }}">
  <!--Owl Carousel Stylesheet-->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/css/plugins/owl.theme.default.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/css/plugins/owl.carousel.min.css') }}">
  <!--Slick Slider Stylesheet-->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/css/plugins/slick-theme.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/css/plugins/slick.css') }}">
  <!--Font Awesome Stylesheet-->
  <link rel="stylesheet" href="{{ asset('assets/front/css/all.min.css') }}">
  <!--Animate Stylesheet-->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/css/plugins/animate.css') }}">
  <!--Main Stylesheet-->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/css/style.css') }}">
  <!-- Responsive Css -->
  <link rel="stylesheet" href="{{ asset('assets/front/css/responsive.css') }}">
</head>

<body class="body-class index">
  <!--Start Preloader-->
  <div class="site-preloader">
    <div class="spinner">
      <div class="double-bounce1"></div>
      <div class="double-bounce2"></div>
    </div>
  </div>
  <!--End Preloader-->

  <!-- web site Header(main-menu,topbar) area start  -->
  <header id="header" class="bg1">
    <div class="container">
      <div class="row">
        <div class="col-lg-2 col-xl-3 d-flex align-self-center logo_area1">
          <div class="logo">
            <a href="{{ route('front.index') }}">
              <img class="img-fluid" src="{{ asset('assets/front/images/setting/'.App\LogoSetting::first()->logo) }}" alt="">
            </a>
          </div>
        </div>
        <div class="col-lg-12 col-xl-9">
          <div id="topbar_area"></div>
          <!-- logo 2 hide on xl device-->
          <div class="logoarea2">
            <a href="{{ route('front.index') }}">
              <img src="{{ asset('assets/front/images/setting/'.App\LogoSetting::first()->logo) }}" alt="">
            </a>
          </div>
          <!-- logo 2 -->
          <div class="main_mamu">
            <nav class="navbar navbar-expand-lg navbar-light p-0">
              <a href="{{ route('front.index') }}" class="logo3">
                <img src="{{ asset('assets/front/images/setting/'.App\LogoSetting::first()->logo) }}" alt="">
              </a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
               aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item  @if(\Route::current()->getName() == 'front.index') active @endif">
                    <a class="nav-link" href="{{ route('front.index') }}">Home</a>
                  </li>
                  <li class="nav-item @if(\Route::current()->getName() == 'front.about') active @endif">
                    <a class="nav-link" href="{{ route('front.about') }}">about us</a>
                  </li>
                  <li class="nav-item @if(\Route::current()->getName() == 'front.add_hyip') active @endif">
                    <a class="nav-link" href="{{ route('front.add_hyip') }}">Add hyip</a>
                  </li>
                  <li class="nav-item @if(\Route::current()->getName() == 'front.add_banner') active @endif">
                    <a class="nav-link" href="{{ route('front.add_banner') }}">Add banner</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                     aria-haspopup="true" aria-expanded="false">
                      pages
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="{{ route('front.index') }}">Home</a>
                      <a class="dropdown-item" href="{{ route('front.about') }}">About Us</a>
                      <a class="dropdown-item" href="{{ route('front.add_hyip') }}">Add Hyip</a>
                      <a class="dropdown-item" href="{{ route('front.add_banner') }}">Add Banner</a>
                    </div>
                  </li>
                </ul>
                <a href="#" data-toggle="modal" data-target="#AddModal" data-toggle="tooltip" title="Sign Up" class="mr_btn_solid mr-2" > Sign Up</a>

                <a href="{{route('user.login_form')}}" class="mr_btn_solid"><i class="fa fa-user"></i> Sign In</a>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- web site Header(main-menu,topbar) area start  -->

  <!-- Home Page Main Content Area End -->
  @yield('contents')

  <!-- Footer Area Start -->
  <footer id="footer" style="background: url({{  asset('assets/front/images/setting/'.App\FooterSetting::first()->footer_image) }});">
    <div class="container">
      <div class="row d-flex justify-content-end">
        <div class="col-md-6 col-xl-4">
          <div class="item d-flex">
            <div class="left">
              <i class="fas fa-phone"></i>
            </div>
            <div class="right">
              <p>Call Anytime</p>
              <h4>{{ App\FooterSetting::first()->contact_number }}</h4>
            </div>
          </div>
          <!-- <div class="item d-flex">
            <div class="left">
              <i class="fas fa-check-square"></i>
            </div>
            <div class="right">
              
            </div>
          </div> -->
        </div>
        <div class="col-md-6 col-xl-4">
          <div class="item d-flex">
            <div class="left">
              <i class="fas fa-envelope-open"></i>
            </div>
            <div class="right">
              <p>Get In Touch</p>
              <h4>{{ App\FooterSetting::first()->contact_mail }}</h4>
            </div>
          </div>
          <div class="item d-flex">
            <!-- <div class="left">
              <i class="fas fa-clock"></i>
            </div>
            <div class="right">
              <p>Get In Touch</p>
              <h4>8:00AM - 12:000PM</h4>
            </div> -->
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- Footer Area End -->


  <div id="AddModal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-body">

                  <form method="post" action= "{{ route('user.submit_register_form') }}" enctype="multipart/form-data">
                    
                    @csrf
                    
                    <div class="form-row">
                        <div class="col-md-6 mb-6">
                            <label for="validationServer01">First name</label>
                            <input type="text" name="firstname" class="form-control form-control-lg"  placeholder="First Name">

                        </div>
                        <div class="col-md-6 mb-6">
                            <label for="validationServer02">Last name</label>
                            <input type="text" name="lastname" class="form-control form-control-lg"  placeholder="Last Name" >
                        </div>
                    </div>
                    <br>
                    <div class="form-row mb-4">
                        <div class="col-md-4">
                            <label for="validationServer01">Email</label>
                            <input type="text" name="email" class="form-control form-control-lg"  placeholder="Email">
                        </div>

                        <div class="col-md-4">
                            <label for="validationServerUsername">Username</label>
                            
                            <input type="text" name="username" class="form-control is-invalid form-control-lg" placeholder="Username">
                        </div>

                        <div class="col-md-4">
                            <label for="validationServerUsername">Password</label>
                            
                            <input type="password" name="password" class="form-control is-invalid form-control-lg" placeholder="Username">
                        </div>
                    </div>
                    <br>
                    <div class="form-row">
                        <div class="col-md-6 mb-6">
                            <label for="validationServer02">Picture</label>
                            <input type="file" name="profile_pic" class="form-control form-control-lg" accept="image/*">
                        </div>
                        <div class="col-md-6 mb-6">
                            <label for="validationServer01">Phone</label>
                            <input type="tel" name="phone" class="form-control form-control-lg"  placeholder="Phone Number">

                        </div>
                    </div>
                    <br>
                    <div class="form-row">
                        <div class="col-md-4 mb-6">
                            <label for="validationServer02">Address</label>
                            <input type="text" name="address" class="form-control form-control-lg"  placeholder="Address">

                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="validationServer03">City</label>
                            <input type="text" name="city" class="form-control form-control-lg" placeholder="City">

                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="validationServer05">Country</label>
                            <input type="text" name="country" class="form-control form-control-lg" placeholder="Country Name">
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-lg btn-block btn-primary">Sign Up</button>
                        </div>
                    </div>
                </form>
                  
              </div>
          </div>
      </div>
  </div>




  <!--Start ClickToTop-->
  <div class="totop">
    <a href="#header"><i class="fa fa-arrow-up"></i></a>
  </div>


  <!--End ClickToTop-->
  <!--End Body Wrap-->
  <!--jQuery JS-->
  <script src="{{ asset('assets/front/js/jquery-1.12.4.min.js') }}"></script>
  <!--Bootstrap JS-->
  <script src="{{ asset('assets/front/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/front/js/popper.min.js') }}"></script>
  <!--Owl Carousel JS-->
  <script src="{{ asset('assets/front/js/plugins/owl.carousel.min.js') }}"></script>
  <!--Venobox JS-->
  <script src="{{ asset('assets/front/js/plugins/venobox.min.js') }}"></script>
  <!--Slick Slider JS-->
  <script src="{{ asset('assets/front/js/plugins/slick.min.js') }}"></script>
  
  <!--Main-->
  <script src="{{ asset('assets/front/js/custom.js') }}"></script>

</body>

</html>