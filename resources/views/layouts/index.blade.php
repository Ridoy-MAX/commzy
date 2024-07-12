<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
@php $general  = \App\Models\General::first(); @endphp
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
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
<link rel="stylesheet" href="{{asset('/css/ud-custom-spacing.css')}}  ">
<link rel="stylesheet" href="{{asset('/css/jquery-ui.min.css')}}  ">
<link rel="stylesheet" href="{{asset('/css/style.css')}}  ">
<!-- Responsive stylesheet -->
<link rel="stylesheet" href="{{asset('/css/responsive.css')}}  ">
<!-- Title -->
<title>{{$general->site_title}}</title>

<!-- Apple Touch Icon -->
<link href="{{asset('/ images/apple-touch-icon-60x60.png')}} " sizes="60x60" rel="apple-touch-icon">
<link href="{{asset('/images/apple-touch-icon-72x72.png')}}  " sizes="72x72" rel="apple-touch-icon">
<link href="{{asset('/images/apple-touch-icon-114x114.png')}}  " sizes="114x114" rel="apple-touch-icon">
<link href="{{asset('/images/apple-touch-icon-180x180.png')}}  " sizes="180x180" rel="apple-touch-icon">

<!-- Favicon -->
<link href="{{ asset($general->fav_icon)  }}  " sizes="128x128" rel="shortcut icon" type="image/x-icon" />
<link href="{{ asset($general->fav_icon) }}  " sizes="128x128" rel="shortcut icon" />
</head>

<body>
  <div class="wrapper ovh">
    <div class="preloader"></div>

    <!-- Main Header Nav -->
    <header class="header-nav nav-homepage-style stricky main-menu border-0" style="background: #3B3355">
     
      <!-- Ace Responsive Menu -->
      <nav class="posr">
        <div class="container posr">
          <div class="row align-items-center justify-content-between">
            <div class="col-auto px-0 px-xl-3">
              <div class="d-flex align-items-center justify-content-between">
                <div class="logos">
                  <a class="header-logo logo1" href="{{ route('welcome')}}">
                    <img src="{{ asset($general->site_logo) }}" alt="Header Logo" style="width: 150px;">
                  </a>
                  <a class="header-logo logo2" href="{{ route('welcome')}}">
                    <img src="{{ asset($general->site_logo) }}" alt="Header Logo" style="width: 150px;">
                    </a>
                </div>
                <div class="home1_style at-home2">

                </div>
                <!-- Responsive Menu Structure-->

              </div>
            </div>
            <div class="col-auto pe-0 pe-xl-3">
              <div class="d-flex align-items-center">
                <a class="login-info" data-bs-toggle="modal" href="#exampleModalToggle" role="button"><span
                    class="flaticon-loupe"></span></a>


            @if (Route::has('login'))
                @auth
                    <a class="login-info me-2" href="{{ route('favourite')}} ">
                    <i class="fa-regular fa-heart  ms-5" style="font-size: 20px;"></i>
                    {{-- <span class=" text-bg-primary" style="background-color: #ffffff;
                
                        width: 5px !important;
                        height: 5px;
                        color: black;
                        font-size: 9px;
                        padding: 2px 3px;
                        border-radius: 50px;
                        position: relative;
                        left: -8px;
                        top: -12px;">
                        2</span> --}}
                    </a>
                    {{-- <a class="login-info" href="/page-cart.html"><i class="fa-solid fa-cart-shopping" style="font-size: 20px;"></i> --}}
                    <!-- <span class=" text-bg-primary" 
                    style="background-color: #ffffff; color: black; font-size: 11px; padding: 1px; border-radius: 50px; position: relative; left: -8px; top: -6px;">
                    3</span> -->
                    </a>
                    @if(auth()->check())
                        @php
                            $accountApproval = \App\Models\AccountApproval::where('user_id', auth()->id())->where('approval', 'approved')->first();
                        @endphp
                    
                        @if($accountApproval)

                        @else
                            <a class="login-info mx15-xl mx30" href="{{ route('seller') }}">
                                <span class="d-none d-xl-inline-block">Become a</span> Seller
                            </a>
                        @endif

                    @endif
                
                
                
                    <a class="login-info mx15-xl mx30" href="{{ url('/dashboard') }}">
                      @if(Auth::user()->profile_pic)
                      <img class=" rounded-circle wa-xs" src="{{ asset(Auth::user()->profile_pic) }}" alt="Profile Picture" style="height: 40px; width: 40px; position: relative; top: 0px;">
                      @else
                      <img class=" rounded-circle wa-xs" src="/avatar.jpg" alt="user.png" style="height: 40px; width: 40px; position: relative; top: 0px;"> 
                        
                      @endif
                   
                    </a>
                    @else
                    <a class="login-info mx15-xl mx30" href="{{ route('seller') }}">
                        <span class="d-none d-xl-inline-block">Become a</span> Seller
                    </a>
                    <a class="login-info mr15-xl mr30 ms-3" href="{{ route('login') }}">Sign in</a>
                        
                        @if (Route::has('register'))
                        <a class="ud-btn btn-white add-joining bdrs50 text-thm2" href="{{ route('register') }}">Join</a>

                        @endif
                @endauth
            @endif
              </div>
            </div>
          </div>
        </div>
      </nav>
    </header>
    <!-- Search Modal -->
    <div class="search-modal">
      <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
        tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalToggleLabel"></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                  class="fal fa-xmark"></i></button>
            </div>
            <div class="modal-body">
              <form action="{{ route('category.service') }}" method="GET">
                <div class="popup-search-field search_area">
                    <input type="text" class="form-control border-0" placeholder="What service are you looking for today?" name="search">
                    <label><span class="far fa-magnifying-glass"></span></label>
                    <button class="ud-btn btn-thm" type="submit">Search</button>
                </div>
            </form>
            
             
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="hiddenbar-body-ovelay"></div>

    <!-- Mobile Nav  -->
    <div id="page" class="mobilie_header_nav stylehome1">
      <div class="mobile-menu">
        <div class="header bdrb1">
          <div class="menu_and_widgets">
            <div class="mobile_menu_bar d-flex justify-content-between align-items-center">
              <a class="mobile_logo" href="{{ route('welcome')}}"><img src="{{ asset($general->site_logo) }}" alt="Header Logo"
                      style="width: 100px;"></a>
              <div class="right-side text-end">




                @if (Route::has('login'))
                @auth
                    <a class="login-info me-2" href="{{ route('favourite')}} ">
                    <i class="fa-regular fa-heart  ms-5" style="font-size: 20px;"></i>
                    {{-- <span class=" text-bg-primary" style="background-color: #ffffff;
                
                        width: 5px !important;
                        height: 5px;
                        color: black;
                        font-size: 9px;
                        padding: 2px 3px;
                        border-radius: 50px;
                        position: relative;
                        left: -8px;
                        top: -12px;">
                        2</span> --}}
                    </a>
                    {{-- <a class="login-info" href="/page-cart.html"><i class="fa-solid fa-cart-shopping" style="font-size: 20px;"></i> --}}
                    <!-- <span class=" text-bg-primary" 
                    style="background-color: #ffffff; color: black; font-size: 11px; padding: 1px; border-radius: 50px; position: relative; left: -8px; top: -6px;">
                    3</span> -->
                    </a>
                    @if(auth()->check())
                        @php
                            $accountApproval = \App\Models\AccountApproval::where('user_id', auth()->id())->where('approval', 'approved')->first();
                        @endphp
                    
                        @if($accountApproval)

                        @else
                            <a class="login-info mx15-xl mx30" href="{{ route('seller') }}">
                                <span class="d-none d-xl-inline-block">Become a</span> Seller
                            </a>
                        @endif

                    @endif
                
                
                
                    <a class="login-info mx15-xl mx30" href="{{ url('/dashboard') }}">
                      @if(Auth::user()->profile_pic)
                      <img class=" rounded-circle wa-xs" src="{{ asset(Auth::user()->profile_pic) }}" alt="Profile Picture" style="height: 40px; width: 40px; position: relative; top: 0px;">
                      @else
                      <img class=" rounded-circle wa-xs" src="/avatar.jpg" alt="user.png" style="height: 40px; width: 40px; position: relative; top: 0px;"> 
                        
                      @endif
                   
                    </a>
                    @else
                    <a class="login-info mx15-xl mx30" href="{{ route('seller') }}">
                        <span class="d-none d-xl-inline-block"></span> Become a Seller
                    </a>
                    <a class="login-info mr15-xl mr30 ms-3" href="{{ route('login') }}">Sign in</a>
                        
                        {{-- @if (Route::has('register'))
                        <a class="ud-btn btn-white add-joining bdrs50 text-thm2" href="{{ route('register') }}">Join</a>

                        @endif --}}
                @endauth
            @endif


                {{-- <a class="" href="page-login.html">join</a> --}}
                {{-- <a class="menubar ml30" href="#menu"><img src="images/mobile-dark-nav-icon.svg" alt=""></a> --}}
              </div>
            </div>
          </div>
          <div class="posr">
            <div class="mobile_menu_close_btn"><span class="far fa-times"></span></div>
          </div>
        </div>
      </div>
      <!-- /.mobile-menu -->
      <nav id="menu" class="">
        <ul>


          <li><span>Become a Seller</span>
        
          </li>
          <li><span>Blog</span>
            <ul>
              <li><a href="page-blog-v1.html">List V1</a></li>
              <li><a href="page-blog-v2.html">List V2</a></li>
              <li><a href="page-blog-v3.html">List V3</a></li>
              <li><a href="page-blog-single.html">Single</a></li>
            </ul>
          </li>
          <!-- Only for Mobile View -->
        </ul>
      </nav>
    </div>

    <div class="body_content">
    @yield('content')
   

   


    <!-- Our Footer --> 
    <section class="footer-style1 pt25 pb-0">
      <div class="container">
        <div class="row bb-white-light pb10 mb60">
          <div class="col-md-7">
            <div class="d-block text-center text-md-start justify-content-center justify-content-md-start d-md-flex align-items-center mb-3 mb-md-0">
              <a class="fz17 fw500 text-white mr15-md mr30" href="{{ route('terms')}} ">Terms of Service</a>
              <a class="fz17 fw500 text-white mr15-md mr30" href="{{ route('privacy')}}">Privacy Policy</a>
              <a class="fz17 fw500 text-white" href="{{ route('refund')}}">Refund Policy</a>
            </div>
          </div>
          @php

          $footer  = \App\Models\Footer::first();
          $categories = \App\Models\Category::latest()->take(6)->get();

          @endphp
          <div class="col-md-5">
            <div class="social-widget text-center text-md-end">
              <div class="social-style1">
                <a class="text-white me-2 fw500 fz17" href="#">Follow us</a>
                <a href="{{$footer->facebook}}"><i class="fab fa-facebook-f list-inline-item"></i></a>
                <a href="{{$footer->twitter}}"><i class="fab fa-twitter list-inline-item"></i></a>
                <a href="{{$footer->instagram}}"><i class="fab fa-instagram list-inline-item"></i></a>
                <a href="{{$footer->linkedin}}"><i class="fab fa-linkedin-in list-inline-item"></i></a>
              </div>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-sm-6 col-lg-3">
            <div class="link-style1 mb-4 mb-sm-5">
              <h5 class="text-white mb15">About</h5>
              <div class="link-list">
                <a href="{{ route('privacy')}}">Privacy Policy</a>
                <a href="{{ route('terms')}}">Terms of Service</a>
                <a href="{{ route('refund')}}">Refund Policy</a>
          
                <a href="{{ route('about')}}">About of  commzy.art</a>

              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="link-style1 mb-4 mb-sm-5">
              <h5 class="text-white mb15">Categories</h5>
              <ul class="ps-0">
                @foreach ($categories as $key => $categorys)
                <li><a href="{{ route('category.service', ['category' => $categorys->id]) }}"> {{ $categorys->name }}</a></li>
      
                @endforeach
         
              
              </ul>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="link-style1 mb-4 mb-sm-5">
              <h5 class="text-white mb15">Support</h5>
              <ul class="ps-0">
                <li><a href="#">Help & Support</a></li>
                <li><a href="#">Trust & Safety</a></li>
                <li><a href="#">Selling on commzy</a></li>
                <li><a href="#">Buying on commzy</a></li>
              </ul>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="footer-widget">
              <div class="footer-widget mb-4 mb-sm-5">
                <div class="mailchimp-widget">
                  <h5 class="title text-white mb20">News letter</h5>
                  @if(session('success'))
                  <div class="alert alert-success">
                      {{ session('success') }}
                  </div>
              @endif
                  <div class="mailchimp-style1">
                 

<!-- Your existing HTML content for displaying the newsletter list goes here -->

                    <form action="{{ route('newsletter.store')}}" method="POST">
                      @csrf
                      <input type="email" class="form-control" name="email" placeholder="Your email address">
                      <button type="submit">Send</button>
                    </form>
           
                  </div>
                </div>
              </div>

            


            </div>
          </div>
        </div>
      </div>
      <div class="container white-bdrt1 py-4">
        <div class="row align-items-center">
          <div class="col-md-6">
            <div class="text-center text-lg-start">
              <p class="copyright-text mb-2 mb-md-0 text-white-light ff-heading">© commzy.art 2023 CreativeLayers. All rights reserved.</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="footer_bottom_right_btns text-center text-lg-end">
              
            </div>
          </div>
        </div>
      </div>
    </section>

      <a class="scrollToHome at-home2" href="#" style="background-color: #322c44fc;"><i class="fas fa-angle-up"></i></a>
    </div>
  </div>






<style>
  @media (max-width: 575px){
    .login-info {
        font-size: 12px;
        margin-right: 0px !important;
    }

  }

</style>



  <!-- Wrapper End -->
  <script src="{{asset('/js/jquery-3.6.4.min.js')}}  "></script>
<script src="{{asset('/js/jquery-migrate-3.0.0.min.js')}}  "></script>
<script src="{{asset('/js/popper.min.js')}} "></script>
<script src="{{asset('/js/bootstrap.min.js')}} "></script>
<script src="{{asset('/js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('/js/jquery.mmenu.all.js')}}"></script>
<script src="{{asset('/js/ace-responsive-menu.js')}}"></script>
<script src="{{asset('/js/jquery-scrolltofixed-min.js')}}"></script>
<script src="{{asset('/js/wow.min.js')}}"></script>
<script src="{{asset('/js/owl.js')}}"></script>
<script src="{{asset('/js/jquery.counterup.js')}}"></script>
<script src="{{asset('/js/pricing-table.js')}}"></script>
<!-- Custom script for all pages -->
<script src="{{asset('/js/script.js')}}"></script>
@yield('footer_script')
</body>


</html>