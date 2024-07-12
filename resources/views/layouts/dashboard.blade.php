<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">


<meta name="CreativeLayers" content="ATFN">
<!-- css file -->
<link rel="stylesheet" href="{{asset('/css/bootstrap.min.css')}} ">
<link rel="stylesheet" href="{{asset('/css/ace-responsive-menu.css')}}  ">
<link rel="stylesheet" href="{{asset('/css/menu.css')}}  ">
<link rel="stylesheet" href="{{asset('/css/fontawesome.css')}}  ">
<link rel="stylesheet" href="{{asset('/css/flaticon.css')}}  ">
<link rel="stylesheet" href="{{asset('/css/bootstrap-select.min.css')}}  ">
<link rel="stylesheet" href="{{asset('/css/ud-custom-spacing.css')}}  ">
<link rel="stylesheet" href="{{asset('/css/animate.css')}}  ">
<link rel="stylesheet" href="{{asset('/css/slider.css')}}  ">
<link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}  ">
<link rel="stylesheet" href="{{asset('css/dashbord_navitaion.css')}}  ">

<link rel="stylesheet" href="{{asset('/css/ud-custom-spacing.css')}}  ">
<link rel="stylesheet" href="{{asset('/css/jquery-ui.min.css')}}  ">
<link rel="stylesheet" href="{{asset('/css/style.css')}}  ">
<!-- Responsive stylesheet -->
<link rel="stylesheet" href="{{asset('/css/responsive.css')}}  ">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<!-- Title -->
@php $general  = \App\Models\General::first(); @endphp
<title>{{$general->site_title}}</title>
<!-- Favicon -->
<link href="{{ asset($general->fav_icon) }}  " sizes="128x128" rel="shortcut icon" type="image/x-icon" />
<link href="{{ asset($general->fav_icon)}}  " sizes="128x128" rel="shortcut icon" />
<!-- Apple Touch Icon -->
<link href="{{asset('/ images/apple-touch-icon-60x60.png')}} " sizes="60x60" rel="apple-touch-icon">
<link href="{{asset('/images/apple-touch-icon-72x72.png')}}  " sizes="72x72" rel="apple-touch-icon">
<link href="{{asset('/images/apple-touch-icon-114x114.png')}}  " sizes="114x114" rel="apple-touch-icon">
<link href="{{asset('/images/apple-touch-icon-180x180.png')}}  " sizes="180x180" rel="apple-touch-icon">

</head>
<body>
<div class="wrapper">
  <div class="preloader"></div>

  <!-- Main Header Nav -->
  <header class="header-nav nav-innerpage-style menu-home4 dashboard_header main-menu">
    <!-- Ace Responsive Menu -->
    <nav class="posr">
      <div class="container-fluid pr30 pr15-xs pl30 posr menu_bdrt1">
        <div class="row align-items-center justify-content-between">
          <div class="col-6 col-lg-auto">
            <div class="text-center text-lg-start d-flex align-items-center">
              <div class="dashboard_header_logo position-relative me-2 me-xl-5">
             

                <a href="{{ route('welcome') }}" class="logo">
                  <img src="{{ asset($general->site_logo) }}" alt="Header Logo" style="width: 150px;">

              </div>
              <div class="fz20 ml90">
                <a href="#" class="dashboard_sidebar_toggle_icon vam"><img src="images/dashboard-navicon.svg" alt=""></a>
              </div>
              <a class="login-info d-block d-xl-none ml40 vam" data-bs-toggle="modal" href="#exampleModalToggle" role="button"><span class="flaticon-loupe"></span></a>
              <div class="ml40 d-none d-xl-block">
                {{-- <div class="search_area dashboard-style">
                  <input type="text" class="form-control border-0" placeholder="What service are you looking for today?">
                  <label><span class="flaticon-loupe"></span></label>
                </div> --}}
              </div>
            </div>
          </div>
          <div class="col-6 col-lg-auto">
            <div class="text-center text-lg-end header_right_widgets">

              <ul class="dashboard_dd_menu_list d-flex align-items-center justify-content-center justify-content-sm-end mb-0 p-0">

                @include('layouts.notification')


                <li class="d-none d-sm-block">
                  <a class="text-center mr5 text-thm2 dropdown-toggle fz20" type="button" data-bs-toggle="dropdown" href="#"><span class="flaticon-mail"></span></a>
                  <div class="dropdown-menu">
                    <div class="dboard_notific_dd px30 pt20 pb15">
                      <div class="notif_list d-flex align-items-start bdrb1 pb25 mb10">
                        <img class="img-2" src="images/testimonials/testi-1.png" alt="">
                        <div class="details ml15">
                          {{-- <p class="dark-color fw500 mb-2">Ali Tufan</p>
                          <p class="text mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing.</p>
                          <p class="mb-0 text-thm">4 hours ago</p> --}}
                        </div>
                      </div>

                      <div class="d-grid">
                        <a href="page-dashboard-message.html" class="ud-btn btn-thm w-100">View All Messages<i class="fal fa-arrow-right-long"></i></a>
                      </div>
                    </div>
                  </div>
                </li>
              
                <li class="user_setting">
                  <div class="dropdown">
                    <a class="btn" href="#" data-bs-toggle="dropdown">
                    @if(Auth::user()->profile_pic)
                    <img class=" rounded-circle wa-xs" src="{{ asset(Auth::user()->profile_pic) }}" alt="Profile Picture" style="height: 55px; width: 55px; position: relative; top: 0px;">
                    @else
                    <img class=" rounded-circle wa-xs" src="/avatar.jpg" alt="user.png" style="height: 55px; width: 55px; position: relative; top: 0px;">

                    @endif
                    </a>
                    <div class="dropdown-menu">
                      <div class="user_setting_content">


                        <p class="fz15 fw400 ff-heading mt30 pl30">Account</p>
                        <a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="flaticon-photo mr10"></i>My Profile</a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <a class="dropdown-item" href="{{route('logout') }}"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                                <i class="flaticon-logout mr10"></i>
                                  Logout
                            </a>
                        </form>

                      </div>
                    </div>
                  </div>
                </li>
              </ul>


            </div>
          </div>
        </div>
      </div>
    </nav>
  </header>

  <!-- Mobile Nav  -->
  <div id="page" class="mobilie_header_nav stylehome1">
    <div class="mobile-menu">
      <div class="header bdrb1">
        <div class="menu_and_widgets">
          <div class="mobile_menu_bar d-flex justify-content-between align-items-center">
            <a class="mobile_logo" href="{{ route('welcome')}}"><img src="{{ asset($general->site_logo) }}" alt="Header Logo"
              style="width: 100px;"></a>
            <div class="right-side text-end">


              <div class="text-center text-lg-end header_right_widgets">

                <ul class="dashboard_dd_menu_list d-flex align-items-center justify-content-center justify-content-sm-end mb-0 p-0">
  
                  @include('layouts.notification')
  
  
                  <li class=" d-sm-block">
                    <a class="text-center mr5 text-thm2 dropdown-toggle fz20" type="button" data-bs-toggle="dropdown" href="#"><span class="flaticon-mail"></span></a>
                    <div class="dropdown-menu">
                      <div class="dboard_notific_dd px30 pt20 pb15">
                        <div class="notif_list d-flex align-items-start bdrb1 pb25 mb10">
                          <img class="img-2" src="images/testimonials/testi-1.png" alt="">
                          <div class="details ml15">
                            <p class="dark-color fw500 mb-2">Ali Tufan</p>
                            <p class="text mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing.</p>
                            <p class="mb-0 text-thm">4 hours ago</p>
                          </div>
                        </div>
                        <div class="notif_list d-flex align-items-start mb25">
                          <img class="img-2" src="images/testimonials/testi-2.png" alt="">
                          <div class="details ml15">
                            <p class="dark-color fw500 mb-2">Ali Tufan</p>
                            <p class="text mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing.</p>
                            <p class="mb-0 text-thm">4 hours ago</p>
                          </div>
                        </div>
                        <div class="d-grid">
                          <a href="page-dashboard-message.html" class="ud-btn btn-thm w-100">View All Messages<i class="fal fa-arrow-right-long"></i></a>
                        </div>
                      </div>
                    </div>
                  </li>
                
                  <li class="user_setting">
                    <div class="dropdown">
                      <a class="btn" href="#" data-bs-toggle="dropdown">
                      @if(Auth::user()->profile_pic)
                      <img class=" rounded-circle wa-xs" src="{{ asset(Auth::user()->profile_pic) }}" alt="Profile Picture" style="height: 55px; width: 55px; position: relative; top: 0px;">
                      @else
                      <img class=" rounded-circle wa-xs" src="/avatar.jpg" alt="user.png" style="height: 55px; width: 55px; position: relative; top: 0px;">
  
                      @endif
                      </a>
                      <div class="dropdown-menu">
                        <div class="user_setting_content">
  
  
                          <p class="fz15 fw400 ff-heading mt30 pl30">Account</p>
                          <a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="flaticon-photo mr10"></i>My Profile</a>
  
                          <form method="POST" action="{{ route('logout') }}">
                              @csrf
  
                              <a class="dropdown-item" href="{{route('logout') }}"
                                      onclick="event.preventDefault();
                                                  this.closest('form').submit();">
                                                  <i class="flaticon-logout mr10"></i>
                                    Logout
                              </a>
                          </form>
  
                        </div>
                      </div>
                    </div>
                  </li>
                </ul>
  
  
              </div>


              {{-- <a class="" href="page-login.html">join</a>
              <a class="menubar ml30" href="#menu"><img src="images/mobile-dark-nav-icon.svg" alt=""></a> --}}









            </div>
          </div>
        </div>
        <div class="posr"><div class="mobile_menu_close_btn"><span class="far fa-times"></span></div></div>
      </div>
    </div>
    <!-- /.mobile-menu -->
    <nav id="menu" class="">
      <ul>
        <li>
            <span>Home</span>

        </li>

        <p class="fz15 fw400 ff-heading pl30 mt30">Account</p>
          <div class="sidebar_list_item ">
            <a href="page-dashboard-profile.html" class="items-center"><i class="flaticon-photo mr15"></i>My Profile</a>
          </div>
          <div class="sidebar_list_item ">
            <a href="page-login.html" class="items-center"><i class="flaticon-logout mr15"></i>Logout</a>
          </div>

        <!-- Only for Mobile View -->
      </ul>
    </nav>
  </div>

  <div class="dashboard_content_wrapper">
    <div class="dashboard dashboard_wrapper pr30 pr0-xl">
      <div class="dashboard__sidebar d-none d-lg-block">
        <div class="dashboard_sidebar_list">
          <p class="fz15 fw400 ff-heading pl30">Start</p>
          <div class="sidebar_list_item">
            <a href="{{ route('dashboard') }}" class="items-center {{ request()->routeIs('dashboard') ? '-is-active ' : '' }}"><i class="flaticon-home mr15"></i>Dashboard</a>
          </div>
          <div class="sidebar_list_item">
            <a href="{{ route('proposal')}}" class="items-center {{ request()->routeIs('proposal') ? '-is-active ' : '' }}"><i class="flaticon-document mr15"></i>My Proposals</a>
          </div>
          <div class="sidebar_list_item">
            <a href="{{ route('order')}}" class="items-center {{ request()->routeIs('order') ? '-is-active ' : '' }}">
              <i class="fa-solid fa-bars-staggered me-3"></i>My Orders</a>
          </div>

        
          <div class="sidebar_list_item ">
            <a href="{{ route('message.inbox') }}" class="items-center"><i class="flaticon-chat mr15"></i>Message</a>
          </div>
          <div class="sidebar_list_item ">
            <a href="{{ route('reviews') }}" class="items-center {{ request()->routeIs('reviews') ? '-is-active ' : '' }}"><i class="flaticon-review-1 mr15"></i>Reviews</a>
          </div>
          <div class="sidebar_list_item">
            <a href="{{ route('invoice')}} " class="items-center {{ request()->routeIs('invoice') ? '-is-active ' : '' }}"><i class="flaticon-receipt mr15"></i>Invoice</a>
          </div>
          
          @canAny(['seller'])
          <div class="sidebar_list_item">
            <a href="{{ route('earning')}} " class="items-center {{ request()->routeIs('earning') ? '-is-active ' : '' }}"><i class="flaticon-web mr15"></i>Earnings</a>

        
          </div>
          @endcan

     
          @canAny(['manage-service'])


          <div class="sidebar_list_item ">
            <a href="{{ route('service.view')}}" class="items-center {{ request()->routeIs('service') ? '-is-active ' : '' }}">
              <i class="flaticon-presentation mr15"></i>Manage Services</a>
          </div>
          <div class="sidebar_list_item ">
            <a href="{{ route('service.create')}}" class="items-center {{ request()->routeIs('service.create') ? '-is-active ' : '' }}">
              <i class="fa-brands fa-creative-commons-share me-3"></i>Create Services</a>
          </div>
          @endcan

          <div class="sidebar_list_item">
            <a href="{{ route('support') }}" class="items-center {{ request()->routeIs('support') ? '-is-active ' : '' }}">
              <i class="fa-solid fa-headset me-3"></i>Support</a>
          </div>

          @canAny(['role-permission'])
          <p class="fz15 fw400 ff-heading pl30 mt30">Role & Permission </p>
          <div class="sidebar_list_item">
            <a href="{{ route('role') }}" class="items-center {{ request()->routeIs('role') ? '-is-active ' : '' }}"><i class="fa-solid fa-capsules me-3"></i>Role</a>
          </div>

          <div class="sidebar_list_item">
            <a href="{{ route('assign.role') }}" class="items-center {{ request()->routeIs('assign.role') ? '-is-active ' : '' }}"> <i class="fa-brands fa-gg-circle me-3"></i> Assign Role</a>
          </div>
          @endcan

          @canAny(['create-users', 'edit-users', 'delete-users'])
            <p class="fz15 fw400 ff-heading pl30 mt30">Users </p>
            @can('create-users')
            <div class="sidebar_list_item">
              <a href="{{ route('userlist') }}" class="items-center {{ request()->routeIs('userlist') ? '-is-active ' : '' }}"><i class="fa-solid fa-user-group me-3"></i>Users List</a>
            </div>
            @endcan
            @can('block-users')
            <div class="sidebar_list_item">
              <a href="{{ route('blocklist') }}" class="items-center {{ request()->routeIs('blocklist') ? '-is-active ' : '' }}"> <i class="fa-solid fa-ban me-3"></i>  Block List</a>
            </div>
            @endcan
          @endcan

          @canAny(['account-approval'])
          <p class="fz15 fw400 ff-heading pl30 mt30">Account approval</p>
          <div class="sidebar_list_item">
            <a href="{{ route('account.approval') }}" class="items-center {{ request()->routeIs('account.approval') ? '-is-active ' : '' }}">
              <i class="fa-solid fa-list me-3"></i>  Account approval List</a>
          </div>
          @endcan
          @canAny(['account-approval'])
          <p class="fz15 fw400 ff-heading pl30 mt30">Withdraw request </p>
          <div class="sidebar_list_item">
            <a href="{{ route('earning.request') }}" class="items-center {{ request()->routeIs('earning.request') ? '-is-active ' : '' }}">
              <i class="fa-solid fa-code-pull-request me-3"></i> Withdraw request List</a>
          </div>
          @endcan


          @canAny(['category-list'])
          <p class="fz15 fw400 ff-heading pl30 mt30">Category </p>
          <div class="sidebar_list_item">
            <a href="{{ route('category') }}" class="items-center {{ request()->routeIs('category') ? '-is-active ' : '' }}">
              <i class="fa-solid fa-list me-3"></i>  Category  List</a>
          </div>
          @endcan


          @canAny(['site-settings'])
            <p class="fz15 fw400 ff-heading pl30 mt30">Site setting</p>
            <div class="sidebar_list_item">
              <a href="{{ route('setting.privacy')}} " class="items-center {{ request()->routeIs('setting.privacy') ? '-is-active ' : '' }}"><i class="fa-solid fa-lock me-3"></i>Privacy policy</a>
            </div>
            <div class="sidebar_list_item">
              <a href="{{ route('setting.term')}} " class="items-center {{ request()->routeIs('setting.term') ? '-is-active ' : '' }}"><i class="fa-solid fa-server me-3"></i>Terms of Service</a>
            </div>
            <div class="sidebar_list_item">
              <a href="{{ route('setting.refund')}}" class="items-center {{ request()->routeIs('setting.refund') ? '-is-active ' : '' }}"><i class="fa-solid fa-rotate-left me-3"></i>Refund Policy</a>
            </div>
            <div class="sidebar_list_item">
              <a href="{{ route('setting.about')}}" class="items-center {{ request()->routeIs('setting.about') ? '-is-active ' : '' }}"><i class="fa-solid fa-circle-info me-3"></i>About Us</a>
            </div>
            <div class="sidebar_list_item">
              <a href="{{ route('setting.banner')}}" class="items-center {{ request()->routeIs('setting.banner') ? '-is-active ' : '' }}"><i class="fa-solid fa-vault me-3"></i>Banner Setting</a>
            </div>
            <div class="sidebar_list_item">
              <a href="{{ route('setting.general')}}" class="items-center {{ request()->routeIs('setting.general') ? '-is-active ' : '' }}"><i class="fa-solid fa-plus-minus me-3"></i>General Settings</a>
            </div>
            <div class="sidebar_list_item">
              <a href="{{ route('newsletter')}}" class="items-center {{ request()->routeIs('newsletter') ? '-is-active ' : '' }}">
                <i class="fa-solid fa-newspaper me-3"></i>News Letter</a>
            </div>
          @endcan
        </div>
      </div>
      <div class="dashboard__main pl0-md">
      @yield('content')
        <footer class="dashboard_footer pt30 pb30">
          <div class="container">
            <div class="row align-items-center justify-content-center justify-content-md-between">
              <div class="col-auto">
                <div class="copyright-widget">
                  <p class="mb-md-0">©  2023 COMMZY.ART All rights reserved.</p>
                </div>
              </div>
              <div class="col-auto">
                <div class="footer_bottom_right_btns at-home8 text-center text-lg-end">
                  {{-- <ul class="p-0 m-0">
                    <li class="list-inline-item bg-white">
                      <select class="selectpicker show-tick">
                        <option>US$ USD</option>
                      </select>
                    </li>
                    <li class="list-inline-item bg-white">
                      <select class="selectpicker show-tick">
                        <option>English</option>
                      </select>
                    </li>
                  </ul> --}}
                </div>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
  </div>
  <a class="scrollToHome" href="#"><i class="fas fa-angle-up"></i></a>
</div>
  <!-- Wrapper End -->

{{-- <script src="{{asset('/js/jquery-3.6.4.min.js')}}  "></script> --}}
<!-- DataTables CSS -->
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"> --}}

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JavaScript -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script src="{{asset('/js/jquery-migrate-3.0.0.min.js')}}  "></script>
<script src="{{asset('/js/popper.min.js')}} "></script>
<script src="{{asset('/js/bootstrap.min.js')}} "></script>
<script src="{{asset('/js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('/js/jquery.mmenu.all.js')}}"></script>
<script src="{{asset('/js/ace-responsive-menu.js')}}"></script>
<script src="{{asset('/js/jquery-scrolltofixed-min.js')}}"></script>
<script src="{{asset('/js/chart.min.js')}}"></script>
<script src="{{asset('/js/chart-custome.js')}}"></script>
<script src="{{asset('/js/wow.min.js')}}"></script>
<script src="{{asset('/js/owl.js')}}"></script>
<script src="{{asset('/js/jquery.counterup.js')}}"></script>
<script src="{{asset('/js/pricing-table.js')}}"></script>
<script src="{{asset('/js/dashboard-script.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<!-- Custom script for all pages -->
<script src="{{asset('/js/script.js')}}"></script>
@yield('footer_script')
</body>
</html>
