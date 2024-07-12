@extends('layouts.dashboard')
@section('content')


<div class="dashboard__content hover-bgc-color">
          <div class="row pb40">
            <div class="col-lg-12">
              @include('components.main_component.dashboard_navigation')
            </div>
            <div class="col-lg-12">
              <div class="dashboard_title_area">
                <h2>Dashboard </h2>
                <p class="text"></p>
              </div>
            </div>
          </div>
          <div class="row">
          
            <div class="col-sm-6 col-xxl-3">
              <div class="d-flex align-items-center justify-content-between statistics_funfact">
                <div class="details">
                  <div class="fz15">Completed Services</div>
                  <div class="title">{{$completedeservice}} </div>
                  {{-- <div class="text fz14"><span class="text-thm">80+</span> New Completed</div> --}}
                </div>
                <div class="icon text-center"><i class="flaticon-success"></i></div>
              </div>
            </div>
            <div class="col-sm-6 col-xxl-3">
              <div class="d-flex align-items-center justify-content-between statistics_funfact">
                <div class="details">
                  <div class="fz15">in Queue Services</div>
                  <div class="title">{{$processeservice}}</div>
                  {{-- <div class="text fz14"><span class="text-thm">35+</span> New Queue</div> --}}
                </div>
                <div class="icon text-center"><i class="flaticon-review"></i></div>
              </div>
            </div>
            <div class="col-sm-6 col-xxl-3">
              <div class="d-flex align-items-center justify-content-between statistics_funfact">
                <div class="details">
                  <div class="fz15">Total Review</div>
                  <div class="title">{{$totalReviews}} </div>
                  {{-- <div class="text fz14"><span class="text-thm">290+</span> New Review</div> --}}
                </div>
                <div class="icon text-center"><i class="flaticon-review-1"></i></div>
              </div>
            </div>
            <div class="col-sm-6 col-xxl-3">
              <div class="d-flex align-items-center justify-content-between statistics_funfact">
                <div class="details">
                  <div class="fz15">Total cancel order</div>
                  <div class="title">{{$cancelservice}}</div>
                  {{-- <div class="text fz14"><span class="text-thm">10</span> New Offered</div> --}}
                </div>
                <div class="icon text-center"><i class="flaticon-contract"></i></div>
              </div>
            </div>
          </div>
         
          <div class="row">

            <div class="cta-banner3 bgc-light-yellow mx-auto maxw1600 pt120 pt60-lg pb90 pb60-lg position-relative overflow-hidden">
              <div class="container">
                <div class="row">
                  <div class="col-xl-5 wow fadeInRight" data-wow-delay="300ms" style="visibility: visible; animation-delay: 300ms; animation-name: fadeInRight;">
                    <div class="mb30">
                      <div class="main-title">
                        <h2 class="title">Steps to become a top seller on Commzy.art</h2>
                      </div>
                    </div>
                    <div class="why-chose-list">
                      <div class="list-one d-flex align-items-start mb30">
                        <span class="list-icon flex-shrink-0 flaticon-badge"></span>
                        <div class="list-content flex-grow-1 ml20">
                          <h4 class="mb-1">Proof of quality</h4>
                          <p class="text mb-0 fz15">Hone your skills and expand your knowledge with online courses. You’ll be able to offer more services and gain more exposure with every course completed.</p>
                        </div>
                      </div>
                      <div class="list-one d-flex align-items-start mb30">
                        <span class="list-icon flex-shrink-0 flaticon-money"></span>
                        <div class="list-content flex-grow-1 ml20">
                          <h4 class="mb-1">Get noticed</h4>
                          <p class="text mb-0 fz15">Tap into the power of social media by sharing your services, and get expert help to grow your impact.</p>
                        </div>
                      </div>
                      <div class="list-one d-flex align-items-start mb30">
                        <span class="list-icon flex-shrink-0 flaticon-security"></span>
                        <div class="list-content flex-grow-1 ml20">
                          <h4 class="mb-1">Become a successful seller!</h4>
                          <p class="text mb-0 fz15">
                            To become a successful seller, focus on understanding customer needs, provide excellent service, maintain product quality, and build a strong online presence. Utilize social media, optimize product listings, and offer competitive prices. Prioritize customer satisfaction, gather feedback, and adapt to market trends. Continuous learning, persistence, and ethical practices are key. </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <img class="cta-banner3-img wow fadeInLeft" src="images/about/about-5.jpg" alt="" data-wow-delay="300ms" style="visibility: visible; animation-delay: 300ms; animation-name: fadeInLeft;">
            </div>
            
          </div>
        </div>



@endsection
@section('footer_script')

@endsection