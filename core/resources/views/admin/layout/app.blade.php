
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <title>Hyip Listing Admin Panel</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/main.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/toastr.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap-toggle.min.css') }}">

    <style type="text/css">
      
      .btn{
        padding: .65rem .75rem;
      }

    </style>

    <script src="{{ asset('assets/admin/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{ asset('assets/admin/js/nicEdit.js') }}"></script>
  </head>
  <body class="app sidebar-mini rtl">
    <!-- Navbar-->
    <header class="app-header">
      <a class="app-header__logo" href="{{ route('admin.home') }}">Admin Panel</a>
      <!-- Sidebar toggle button-->
      <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu">
          <i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="{{ route('admin.show_password_form') }}"><i class="fa fa-cog fa-lg"></i> Password </a></li>
            <li><a class="dropdown-item" href="{{ route('admin.show_profile_form') }}"><i class="fa fa-user fa-lg"></i> Profile</a></li>
            <li><a class="dropdown-item" href="{{ route('admin.logout') }}"><i class="fa fa-sign-out fa-lg"></i>Logout</a></li>
          </ul>
        </li>
      </ul>
    </header>

    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user">
        <img class="app-sidebar__user-avatar" src="{{ asset('assets/admin/images/'.Auth::guard('admin')->user()->profile_pic) }}" alt="User Image">
        <div>
          <p class="app-sidebar__user-name">{{ Auth::guard('admin')->user()->username }}</p>
        </div>
      </div>
      <ul class="app-menu">
        <li>
          <a class="app-menu__item  @if(Request::is('admin/home')) active @endif" href="{{ route('admin.home') }}">
              <i class="app-menu__icon fa fa-dashboard"></i>
              <span class="app-menu__label">Dashboard</span>
          </a>
        </li>

        <li class="treeview">
          <a class="app-menu__item  @if(Request::is('admin/settings/*')) active @endif" href="#" data-toggle="treeview">
            <i class="app-menu__icon fa fa-cog"></i>
            <span class="app-menu__label">Settings</span>
            <i class="treeview-indicator fa fa-angle-right"></i>
          </a>
          <ul class="treeview-menu">
            <li>
              <a class="treeview-item  @if(Route::currentRouteName()== 'admin.show_settings_general') active @endif" href="{{ route('admin.show_settings_general') }}" rel="noopener">
                <i class="icon fa fa-circle-o"></i> 
                <span class="app-menu__label">General Settings</span>
              </a>
            </li>
            <li>
              <a class="treeview-item  @if(Route::currentRouteName()== 'admin.show_settings_sms') active @endif" href="{{ route('admin.show_settings_sms')  }}">
                <i class="icon fa fa-circle-o"></i> 
                <span class="app-menu__label">SMS Settings</span>
              </a>
            </li>
            <li>
              <a class="treeview-item  @if(Route::currentRouteName()== 'admin.show_settings_mail') active @endif" href="{{ route('admin.show_settings_mail') }}">
                <i class="icon fa fa-circle-o"></i> 
                <span class="app-menu__label">Mail Settings</span>
              </a>
            </li>
            <li>
              <a class="treeview-item  @if(Route::currentRouteName()== 'admin.show_settings_logo') active @endif" href="{{ route('admin.show_settings_logo') }}">
                <i class="icon fa fa-circle-o"></i> 
                <span class="app-menu__label">Logo & Favicon</span>
              </a>
            </li>
            <li>
              <a class="treeview-item  @if(Route::currentRouteName()== 'admin.show_settings_index') active @endif" href="{{ route('admin.show_settings_index') }}">
                <i class="icon fa fa-circle-o"></i> 
                <span class="app-menu__label">Index Page Settings</span>
              </a>
            </li>
            <li>
              <a class="treeview-item  @if(Route::currentRouteName()== 'admin.show_settings_footer') active @endif" href="{{ route('admin.show_settings_footer') }}">
                <i class="icon fa fa-circle-o"></i> 
                <span class="app-menu__label">Footer Page Settings</span>
              </a>
            </li>
            <li>
              <a class="treeview-item  @if(Route::currentRouteName()== 'admin.show_settings_details') active @endif" href="{{ route('admin.show_settings_details') }}">
                <i class="icon fa fa-circle-o"></i> 
                <span class="app-menu__label">Details Page Settings</span>
              </a>
            </li>
            <li>
              <a class="treeview-item  @if(Route::currentRouteName()== 'admin.show_settings_about') active @endif" href="{{ route('admin.show_settings_about') }}">
                <i class="icon fa fa-circle-o"></i> 
                <span class="app-menu__label">About Page Settings</span>
              </a>
            </li>
            <li>
              <a class="treeview-item  @if(Route::currentRouteName()== 'admin.show_settings_hyip') active @endif" href="{{ route('admin.show_settings_hyip') }}">
                <i class="icon fa fa-circle-o"></i> 
                <span class="app-menu__label">Hyip Page Settings</span>
              </a>
            </li>
            <li>
              <a class="treeview-item  @if(Route::currentRouteName()== 'admin.show_settings_banner') active @endif" href="{{ route('admin.show_settings_banner') }}">
                <i class="icon fa fa-circle-o"></i> 
                <span class="app-menu__label">Banner Page Settings</span>
              </a>
            </li>
          </ul>
        </li>

        <li>
          <a class="treeview-item  @if(Route::currentRouteName()== 'admin.view_categories') active @endif" href="{{ route('admin.view_categories')  }}">
            <i class="icon fa fa-list-alt"></i> 
            <span class="app-menu__label">Category</span>
          </a>
        </li>

        
        <li>
          <a class="treeview-item @if(Route::currentRouteName()== 'admin.view_withdrawal_types') active @endif" href="{{ route('admin.view_withdrawal_types')  }}">
            <i class="icon fa fa-money"></i> 
            <span class="app-menu__label">Withdraw Type</span>
          </a>
        </li>

        <li>
          <a class="treeview-item @if(Route::currentRouteName()== 'admin.view_features') active @endif" href="{{ route('admin.view_features')  }}">
            <i class="icon fa fa-briefcase"></i> 
            <span class="app-menu__label">Feature</span>
          </a>
        </li>

        <li>
          <a class="treeview-item @if(Route::currentRouteName()== 'admin.view_payments_mediums') active @endif" href="{{ route('admin.view_payments_mediums')  }}">
            <i class="icon fa fa-medium"></i> 
            <span class="app-menu__label">Payment Medium</span>
          </a>
        </li>

        <li>
          <a class="treeview-item @if(Route::currentRouteName()== 'admin.view_all_status') active @endif" href="{{ route('admin.view_all_status')  }}">
            <i class="icon fa fa-arrows"></i> 
            <span class="app-menu__label">Status</span>
          </a>
        </li>

        <li class="treeview">
          <a class="app-menu__item  @if(Request::is('admin/company/*')) active @endif" href="#" data-toggle="treeview">
            <i class="app-menu__icon fa fa-bank"></i>
            <span class="app-menu__label">Hyips</span>
            <i class="treeview-indicator fa fa-angle-right"></i>
          </a>
          <ul class="treeview-menu">
            <li>
              <a class="treeview-item  @if(Route::currentRouteName()== 'admin.create_company_form') active @endif" href="{{ route('admin.create_company_form') }}" rel="noopener">
                <i class="icon fa fa-circle-o"></i> Create Hyip
              </a>
            </li>
            <li>
              <a class="treeview-item  @if(Route::currentRouteName()== 'admin.view_companies_published') active @endif" href="{{ route('admin.view_companies_published')  }}">
                <i class="icon fa fa-circle-o"></i> Published Hyips
              </a>
            </li>
            <li>
              <a class="treeview-item  @if(Route::currentRouteName()== 'admin.view_companies_unpublished') active @endif" href="{{ route('admin.view_companies_unpublished')  }}">
                <i class="icon fa fa-circle-o"></i> Unpublished Hyips
              </a>
            </li>
          </ul>
        </li>

        <li class="treeview">
          <a class="app-menu__item  @if(Request::is('admin/vote/*')) active @endif" href="#" data-toggle="treeview">
            <i class="app-menu__icon fa fa-star"></i>
            <span class="app-menu__label">Vote</span>
            <i class="treeview-indicator fa fa-angle-right"></i>
          </a>
          <ul class="treeview-menu">
            <li>
              <a class="treeview-item @if(Route::currentRouteName()== 'admin.create_vote_form') active @endif" href="{{ route('admin.create_vote_form') }}" rel="noopener">
                <i class="icon fa fa-circle-o"></i> Create Vote
              </a>
            </li>
            <li>
              <a class="treeview-item @if(Route::currentRouteName()== 'admin.view_votes') active @endif" href="{{ route('admin.view_votes')  }}">
                <i class="icon fa fa-circle-o"></i> View Votes
              </a>
            </li>
          </ul>
        </li>

        <li class="treeview">
          <a class="app-menu__item  @if(Request::is('admin/ad-package/*')) active @endif" href="#" data-toggle="treeview">
            <i class="app-menu__icon fa fa-cube"></i>
            <span class="app-menu__label">Ad Package</span>
            <i class="treeview-indicator fa fa-angle-right"></i>
          </a>
          <ul class="treeview-menu">
            
            <li>
              <a class="treeview-item @if(Route::currentRouteName()== 'admin.view_all_ad_packages') active @endif" href="{{ route('admin.view_all_ad_packages')  }}">
                <i class="icon fa fa-circle-o"></i> All Ad Package
              </a>
            </li>
            <li>
              <a class="treeview-item @if(Route::currentRouteName()== 'admin.view_published_ad_packages') active @endif" href="{{ route('admin.view_published_ad_packages')  }}">
                <i class="icon fa fa-circle-o"></i> Published Ad Package
              </a>
            </li>
            <li>
              <a class="treeview-item @if(Route::currentRouteName()== 'admin.view_unpublished_ad_packages') active @endif" href="{{ route('admin.view_unpublished_ad_packages')  }}">
                <i class="icon fa fa-circle-o"></i> Unpublished Ad Package
              </a>
            </li>
          </ul>
        </li>

        <li class="treeview">
          <a class="app-menu__item  @if(Request::is('admin/advertisement/*') || Request::is('admin/ad-size/*')) active @endif" href="#" data-toggle="treeview">
            <i class="app-menu__icon fa fa-cube"></i>
            <span class="app-menu__label">Advertisement</span>
            <i class="treeview-indicator fa fa-angle-right"></i>
          </a>
          <ul class="treeview-menu">
            <li>
              <a class="treeview-item @if(Route::currentRouteName()== 'admin.view_all_ad_sizes') active @endif" href="{{ route('admin.view_all_ad_sizes')  }}">
                <i class="icon fa fa-circle-o"></i> Ad Size
              </a>
            </li>
            <li>
              <a class="treeview-item @if(Route::currentRouteName()== 'admin.create_advertisement_form') active @endif" href="{{ route('admin.create_advertisement_form') }}" rel="noopener">
                <i class="icon fa fa-circle-o"></i> Create Advertisement
              </a>
            </li>
            <li>
              <a class="treeview-item @if(Route::currentRouteName()== 'admin.view_published_advertisements') active @endif" href="{{ route('admin.view_published_advertisements')  }}">
                <i class="icon fa fa-circle-o"></i> Published Ad
              </a>
            </li>
            <li>
              <a class="treeview-item @if(Route::currentRouteName()== 'admin.view_unpublished_advertisements') active @endif" href="{{ route('admin.view_unpublished_advertisements')  }}">
                <i class="icon fa fa-circle-o"></i> Unpublished Ad
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
    
    <script src="{{ asset('assets/admin/js/popper.min.js')}}"></script>
    <script src="{{ asset('assets/admin/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('assets/admin/js/toastr.min.js')}}"></script>
    <script src="{{ asset('assets/admin/js/main.js')}}"></script>
    <script src="{{ asset('assets/admin/js/bootstrap-toggle.min.js') }}"></script>

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

  </body>
</html>