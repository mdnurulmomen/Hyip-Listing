
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="Vali is a responsive and free user theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali user">
    <meta property="og:title" content="Vali - Free Bootstrap 4 user theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-user">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-user/hero-social.png">
    <meta property="og:description" content="Vali is a responsive and free user theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <title>Hyip Listing User Panel</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/user/css/main.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/user/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/user/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/user/css/toastr.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/user/css/bootstrap-toggle.min.css') }}">

    <style type="text/css">
      .btn{
        padding: .65rem .75rem;
      }
    </style>

    <script src="{{ asset('assets/user/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{ asset('assets/user/js/nicEdit.js') }}"></script>
  </head>
  <body class="app sidebar-mini rtl">
    <!-- Navbar-->
    <header class="app-header">
      <a class="app-header__logo" href="{{ route('user.home') }}">user Panel</a>
      <!-- Sidebar toggle button-->
      <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu">
          <i class="fa fa-user fa-lg"></i></a>
          
            <ul class="dropdown-menu settings-menu dropdown-menu-right">
              <li><a class="dropdown-item" href="{{ route('user.show_password_form') }}"><i class="fa fa-cog fa-lg"></i> Password </a></li>
              <li><a class="dropdown-item" href="{{ route('user.show_profile_form') }}"><i class="fa fa-user fa-lg"></i> Profile</a></li>
              <li><a class="dropdown-item" href="{{ route('user.logout') }}"><i class="fa fa-sign-out fa-lg"></i>Logout</a></li>
            </ul>

        </li>
      </ul>
    </header>

    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user">
        <img class="app-sidebar__user-avatar" src="{{ asset('assets/user/images/'.Auth::guard()->user()->profile_pic) }}" alt="User Image">
        <div>
          <p class="app-sidebar__user-name">{{ Auth::guard()->user()->username }}</p>
        </div>
      </div>
      <ul class="app-menu">

        <li>
          <a class="app-menu__item  @if(Request::is('user/home')) active @endif" href="{{ route('user.home') }}">
              <i class="app-menu__icon fa fa-dashboard"></i>
              <span class="app-menu__label">Dashboard</span>
          </a>
        </li>

        <li class="treeview">
          <a class="app-menu__item  @if(Request::is('user/advertisement/*') || Request::is('user/ad-size/*')) active @endif" href="{{route('user.view_advertisements')}}">
            <i class="app-menu__icon fa fa-cube"></i>
            <span class="app-menu__label">My Advertisement</span>
          </a>
        </li>

        <li class="treeview">
          <a class="app-menu__item  @if(Request::is('user/payment/*')) active @endif" href="#" data-toggle="treeview">
            <i class="app-menu__icon fa fa-bank"></i>
            <span class="app-menu__label">Payments</span>
            <i class="treeview-indicator fa fa-angle-right"></i>
          </a>
          <ul class="treeview-menu">
            <li>
              <a class="treeview-item  @if(Route::currentRouteName()== 'user.create_payment') active @endif" href="{{ route('user.create_payment') }}" rel="noopener">
                <i class="icon fa fa-circle-o"></i> Make Payment
              </a>
            </li>
            <li>
              <a class="treeview-item  @if(Route::currentRouteName()== 'user.view_payments') active @endif" href="{{ route('user.view_payments')  }}">
                <i class="icon fa fa-circle-o"></i> Payments History
              </a>
            </li>
          </ul>
        </li>

      </ul>
    </aside>


    <main class="app-content">
      
      @yield('contents')
      
    </main>

    <!-- Essential javascripts for application to work-->
    
    <script src="{{ asset('assets/user/js/popper.min.js')}}"></script>
    <script src="{{ asset('assets/user/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('assets/user/js/toastr.min.js')}}"></script>
    <script src="{{ asset('assets/user/js/main.js')}}"></script>
    <script src="{{ asset('assets/user/js/bootstrap-toggle.min.js') }}"></script>

    <script>
      (function ($) {
           $(document).ready(function () {
               $('[data-toggle="tooltip"]').tooltip();
               @if(session()->has('success'))
               toastr.success("{{ session('success') }}", "Success")
               @endif
               @if($errors->any())
               @foreach($errors->all() as $error)
               toastr.error("{{ $error }}", "Whopps")
               @endforeach
               @endif
           });
       })(jQuery);
  </script>

  @yield('script')

  </body>
</html>