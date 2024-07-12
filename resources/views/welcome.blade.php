@extends('layouts.index')
@section('content')
    <!-- Home Banner Style V1 -->
    <section class="hero-home2 pb100-xs">
        <div class="container">
            <div class="row mb60 mb0-xl">
                <div class="col-xl-7">
                    <div class="pr30 pr0-lg mb30-md position-relative">
                        <h1 class="animate-up-1 mb25 text-white">{{ $banner->banner_title }} <br class="d-none d-xl-block">
                        </h1>
                        <p class="text-white animate-up-2">{{ $banner->banner_description }} </p>
                        <div
                            class="advance-search-tab bgc-white p10 bdrs4-sm bdrs60 banner-btn position-relative zi1 animate-up-3 mt30">
                            <form class="form-search position-relative" action="{{ route('category.service') }}" method="GET">
                            <div class="row">
    
                                    <div class="col-md-9 col-lg-10 col-xl-9">
                         
                                        <div class="advance-search-field mb10-sm">
                                
                                                <div class="box-search">
                                                    <span class="icon far fa-magnifying-glass"></span>
                                                    <input class="form-control" type="text" name="search"
                                                        placeholder="What are you looking for?">
                                                    <div class="search-suggestions">
                                                        <h6 class="fz14 ml30 mt25 mb-3">Popular Search</h6>
                                                        <div class="box-suggestions">
                                                            <ul class="px-0 m-0 pb-4">


                                                                @foreach ($category as $key => $category)
                                                                    <a href="services?category={{ $category->id }}">
                                                                        <li>
                                                                            <div class="info-product">
                                                                                <div class="item_title">{{ $category->name }}
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    </a>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                
                                        </div>

                          
                                    </div>
                         

                                <div class="col-md-3 col-lg-2 col-xl-3">
                                    <div class="text-center text-xl-start">
                                        <a href="#">
                                            <button class="ud-btn btn-thm w-100 bdrs60" type="submit">Search</button>
                                        </a>

                                    </div>
                                </div>
                            </div>

                        </form>
                        </div>
                        <div class="row mt20 animate-up-4">
                            <div class="col-xl-9">
                                <div class="row justify-content-between">
                                    <div class="col-6 col-sm-3 funfact_one at-home2-hero">
                                        <div class="details">
                                            <ul class="ps-0 mb-0 d-flex">
                                                <li>
                                                    <div class="timer">34</div>
                                                </li>
                                                {{-- <li><span>M</span></li> --}}
                                            </ul>
                                            <p class="text-white mb-0">Total artist</p>
                                        </div>
                                    </div>
                                    <div class="col-6 col-sm-3 funfact_one at-home2-hero">
                                        <div class="details">
                                            <ul class="ps-0 mb-0 d-flex">
                                                <li>
                                                    <div class="timer">33</div>
                                                </li>
                                                {{-- <li><span>M</span></li> --}}
                                            </ul>
                                            <p class="text-white mb-0">Positive Review</p>
                                        </div>
                                    </div>
                                    <div class="col-6 col-sm-3 funfact_one at-home2-hero">
                                        <div class="details">
                                            <ul class="ps-0 mb-0 d-flex">
                                                <li>
                                                    <div class="timer">90</div>
                                                </li>
                                                {{-- <li><span>M</span></li> --}}
                                            </ul>
                                            <p class="text-white mb-0">Order recieved</p>
                                        </div>
                                    </div>
                                    <div class="col-6 col-sm-3 funfact_one at-home2-hero pe-0">
                                        <div class="details">
                                            <ul class="ps-0 mb-0 d-flex">
                                                <li>
                                                    <div class="timer">26</div>
                                                </li>
                                                {{-- <li><span>M</span></li> --}}
                                            </ul>
                                            <p class="text-white mb-0">Projects Completed</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 d-none d-xl-block position-relative">
                    <div class="img_box">
                        <img src="{{ asset($banner->image_one) }}" alt="" class="home_banner_img_one">
                        <img src="{{ asset($banner->image_two) }}" alt="" class="home_banner_img_two">
                    </div>

                    <div class="home2-hero-content position-relative">
                        <div
                            class="iconbox-small1 d-none d-xl-flex wow fadeInRight default-box-shadow4 bounce-x animate-up-1">
                            <span class="icon flaticon-review"></span>
                            <div class="details pl20">
                                <h6 class="mb-1">{{ $banner->iconbox_one_title }}</h6>
                                <p class="text fz13 mb-0">{{ $banner->iconbox_one_detail }}</p>
                            </div>
                        </div>
                        <div
                            class="iconbox-small2 d-none d-xl-flex wow fadeInLeft default-box-shadow4 bounce-y animate-up-2">
                            <span class="icon flaticon-review"></span>
                            <div class="details pl20">
                                <h6 class="mb-1">{{ $banner->iconbox_two_title }}</h6>
                                <p class="text fz13 mb-0">{{ $banner->iconbox_two_detail }}</p>
                            </div>
                        </div>

                        <img src="images/about/happy-client.png" alt=""
                            class="bounce-x bdrs16 img-1 default-box-shadow4">
                        <!-- <div class="iconbox-small2 d-none d-xl-flex wow fadeInLeft bounce-x bdrs16 img-1 default-box-shadow4 animate-up-1" style="width: 300px;">
                    <span class="icon flaticon-review"></span>
                    <div class="details pl20">
                      <h6 class="mb-1">Perfect artist</h6>
                      <p class="text fz13 mb-0">Lorem Ipsum Dolar Amet</p>
                    </div>
                  </div> -->
                        <!-- <img src="images/about/happy-client.png" alt="" class="bounce-x bdrs16 img-1 default-box-shadow4"> -->
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- talent by category -->
    <section class="pb-0  mt-5">
        <div class="container">
            <div class="row align-items-center wow fadeInUp" data-wow-delay="300ms">
                <div class="col-lg-9">
                    <div class="main-title2">
                        <h2 class="title">Browse talent by category</h2>
                        <p class="paragraph">Find your best service by category</p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="text-start text-lg-end mb-4">
                        <a class="ud-btn btn-light-thm bdrs90" href="{{ route('all.category')}} ">All Category<i
                                class="fal fa-arrow-right-long"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 wow fadeInUp" data-wow-delay="300ms">
                    <div class="dots_none slider-dib-sm slider-5-grid vam_nav_style owl-theme owl-carousel">
                        @foreach ($categories as $key => $categorys)
                            <a href="services?category={{ $categorys->id }}">
                                <div class="item">
                                    <div class="feature-style1 mb30 bdrs16">
                                        <div class="feature-img bdrs16 overflow-hidden"><img class="w-100"
                                                src="{{ asset($categorys->image) }} " alt=""
                                                style="height: 250px"></div>
                                        <div class="feature-content">
                                            <div class="top-area">

                                                {{-- <h6 class="title mb-1">1.853 services</h6> --}}
                                                <h5 class="text"> {{ $categorys->name }} <br class="d-none d-lg-block">
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Artist -->
    <section class=" pb100">
        <div class="container">
            <div class="row align-items-center wow fadeInUp">
                <div class="col-xl-3">
                    <div class="main-title mb30-lg">
                        <h2 class="title">Popular artist</h2>
                        <p class="paragraph">Most viewed and all-time top-selling services</p>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="navpill-style2">
                        <div class="tab-content ha" id="pills-tabContent">
                            <div class="tab-pane fade fz15 text show active" id="pills-home" role="tabpanel"
                                aria-labelledby="pills-home-tab">
                                <div class="row">


                                    @foreach ($services as $key => $service)
                                        <div class="col-md-3">
                                            <a>
                                                <div class="listing-style1 default-box-shadow1 bdrs16">
                                                    <div class="list-thumb">
                                                        <div
                                                            class="listing-thumbIn-slider position-relative navi_pagi_bottom_center slider-1-grid owl-carousel owl-theme">
                                                            @foreach ($service->rel_to_gallery as $gallery)
                                                                <div class="item">
                                                                    <img class="w-100"
                                                                        src="{{ asset('service/gallery/' . $gallery->image) }}"
                                                                        alt="iamge" style="height: 250px;">

                                                                    <form action="{{ route('favourite.save') }}"
                                                                        method="post">
                                                                        @csrf
                                                                        <input type="hidden" value="{{ $service->id }}"
                                                                            name="service_information_id">
                                                                        <button class="listing-fav fz12" type="submit"
                                                                            style="border: none" data-bs-toggle="tooltip"
                                                                            data-bs-placement="top"
                                                                            data-bs-custom-class="custom-tooltip"
                                                                            data-bs-title="Add your favourite list"> <span
                                                                                class="far fa-heart"></span> </button>
                                                                    </form>

                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>

                                                    <div class="list-content">




                                                        <p class="list-text body-color fz14 mb-1">
                                                            {{ $service->category->name }}</p>
                                                        <h5 class="list-title" style="height: 60px">
                                                            <a
                                                                href="{{ route('service.details', $service->slug) }}">
                                                                {{ implode(' ', array_slice(str_word_count($service->service_title, 2), 0, 10)) }}</a>
                                                        </h5>


                                                        @php
                                                        $totalReviews = $service->rel_to_review->count();
                                                        $sumRatings = 0;
                                                        foreach ($service->rel_to_review as $review) {
                                                            $sumRatings += $review->rating;
                                                        }
                                                        $averageRating = $totalReviews > 0 ? number_format($sumRatings / $totalReviews, 2) : 0;
                                                        @endphp


                                                        <div class="review-meta d-flex align-items-center">
                                                            <i class="fas fa-star fz10 review-color me-2"></i>
                                                            <p class="mb-0 body-color fz14"><span
                                                            class="dark-color me-2">  {{ $averageRating }}</span>{{$service->rel_to_review->count()}} reviews</p>
                                                        </div>



                                                        <hr class="my-2">
                                                        <div
                                                            class="list-meta d-flex justify-content-between align-items-center mt15">
                                                            <a class="d-flex">
                                                                <span class="position-relative mr10">
                                                                    @if ($service->rel_to_user->profile_pic)
                                                                        <img class=" rounded-circle wa-xs"
                                                                            src="{{ asset($service->rel_to_user->profile_pic) }}"
                                                                            alt="Profile Picture"
                                                                            style="height: 35px; width: 35px;">
                                                                    @else
                                                                        <img class=" rounded-circle wa-xs"
                                                                            src="/avatar.jpg" alt="user.png"
                                                                            style="height: 55px; width: 55px;">
                                                                    @endif
                                                                    <span class="online-badges"></span>
                                                                </span>
                                                                <span
                                                                    class="fz14 mt-1">{{ $service->rel_to_user->name }}</span>
                                                            </a>



                                                            <div class="budget">
                                                                <p class="mb-0 body-color"><span
                                                                        class="fz17 fw500 dark-color ms-1"
                                                                        style="color: #E34A6F;">${{ $service->price }}</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach




                                    <div class="col-lg-12">
                                        <div class="text-center mt30">
                                            <a class="ud-btn btn-light-thm bdrs60" href="{{ route('category.service') }}">All Services<i class="fal fa-arrow-right-long"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Our Partners -->
    <section class="our-partners">
        <div class="container">
            <div class="row wow fadeInUp">
                <div class="col-lg-12">
                    <div class="main-title text-center">
                        <h6 style="font-size: 30px;">Trusted by the world’s best</h6>
                    </div>
                </div>
            </div>
            <div class="row wow fadeInUp">

                @foreach ($trust as $key => $trust)
                    <div class="col-6 col-md-4 col-xl-2">
                        <div class="partner_item text-center mb30-lg">
                            <img class="wa m-auto" src="{{ asset('trust/' . $trust->image_one) }}" alt="1.png" />
                        </div>
                    </div>
                @endforeach

                {{-- <div class="col-6 col-md-4 col-xl-2">
            <div class="partner_item text-center mb30-lg"><img class="wa m-auto" src="images/partners/2.png" alt="2.png"></div>
          </div>
          <div class="col-6 col-md-4 col-xl-2">
            <div class="partner_item text-center mb30-lg"><img class="wa m-auto" src="images/partners/3.png" alt="3.png"></div>
          </div>
          <div class="col-6 col-md-4 col-xl-2">
            <div class="partner_item text-center mb30-lg"><img class="wa m-auto" src="images/partners/4.png" alt="4.png"></div>
          </div>
          <div class="col-6 col-md-4 col-xl-2">
            <div class="partner_item text-center mb30-lg"><img class="wa m-auto" src="images/partners/5.png" alt="5.png"></div>
          </div>
          <div class="col-6 col-md-4 col-xl-2">
            <div class="partner_item text-center mb30-lg"><img class="wa m-auto" src="images/partners/6.png" alt="6.png"></div>
          </div> --}}

            </div>
        </div>
    </section>




    <!-- Learn With Freeio -->
    <section class="bgc-thm3">
        <div class="container">
            <div class="row align-items-md-center">
                <div class="col-md-6 col-lg-8 mb30-md wow fadeInUp" data-wow-delay="100ms">
                    <div class="main-title">
                        <h2 class="title">{{ $awardwinner->title }}</h2>
                        <p class="paragraph">{{ $awardwinner->description }}</p>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-lg-4">
                            <div class="funfact_one">
                                <div class="details">
                                    <ul class="ps-0 d-flex mb-0">
                                        <li>
                                            <div class="timer"> {{ $awardwinner->professionals_number_one }} </div>
                                        </li>
                                        <li>
                                            <div>.</div>
                                        </li>
                                        <li>
                                            <div class="timer">{{ $awardwinner->professionals_number_two }}</div>
                                        </li>
                                        <li><span>/</span></li>
                                        <li>
                                            <div class="timer">{{ $awardwinner->devided_number }}</div>
                                        </li>
                                    </ul>
                                    <p class="text mb-0">Clients rate professionals on Freeio</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="funfact_one">
                                <div class="details">
                                    <ul class="ps-0 d-flex mb-0">
                                        <li>
                                            <div class="timer">{{ $awardwinner->satisfied_percentage }}</div>
                                        </li>
                                        <li><span>%</span></li>
                                    </ul>
                                    <p class="text mb-0">{{ $awardwinner->satisfied_details }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="funfact_one">
                                <div class="details">
                                    <h2>Award winner</h2>
                                    <p class="text mb-0">Home ownership</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-4">
                    <div class="testimonial-slider2 mb15 navi_pagi_bottom_center slider-1-grid owl-carousel owl-theme wow fadeInUp"
                        data-wow-delay="300ms">
                        <div class="item">
                            <div class="testimonial-style1 default-box-shadow1 position-relative bdrs16 mb35">
                                <div class="testimonial-content">
                                    <h4 class="title text-thm">Great Work</h4>
                                    <span class="icon fas fa-quote-left"></span>
                                    <h4 class="t_content">“I found the course material to be highly engaging, and the
                                        instructors to
                                        be helpful and communicative.”</h4>
                                </div>
                                <div class="thumb d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img class="wa" src="images/testimonials/testimonial-1.png" alt="">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0">Courtney Henry</h6>
                                        <p class="fz14 mb-0">Artist</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimonial-style1 default-box-shadow1 position-relative bdrs16 mb35">
                                <div class="testimonial-content">
                                    <h4 class="title text-thm">Great Work</h4>
                                    <span class="icon fas fa-quote-left"></span>
                                    <h4 class="t_content">“I found the course material to be highly engaging, and the
                                        instructors to
                                        be helpful and communicative.”</h4>
                                </div>
                                <div class="thumb d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img class="wa" src="images/testimonials/testimonial-2.png" alt="">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0">Courtney Henry</h6>
                                        <p class="fz14 mb-0">Artist</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimonial-style1 default-box-shadow1 position-relative bdrs16 mb35">
                                <div class="testimonial-content">
                                    <h4 class="title text-thm">Great Work</h4>
                                    <span class="icon fas fa-quote-left"></span>
                                    <h4 class="t_content">“I found the course material to be highly engaging, and the
                                        instructors to
                                        be helpful and communicative.”</h4>
                                </div>
                                <div class="thumb d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img class="wa" src="images/testimonials/testimonial-3.png" alt="">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0">Courtney Henry</h6>
                                        <p class="fz14 mb-0">Artist</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimonial-style1 default-box-shadow1 position-relative bdrs16 mb35">
                                <div class="testimonial-content">
                                    <h4 class="title text-thm">Great Work</h4>
                                    <span class="icon fas fa-quote-left"></span>
                                    <h4 class="t_content">“I found the course material to be highly engaging, and the
                                        instructors to
                                        be helpful and communicative.”</h4>
                                </div>
                                <div class="thumb d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img class="wa" src="images/testimonials/testimonial-3.png" alt="">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0">Courtney Henry</h6>
                                        <p class="fz14 mb-0">Artist</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('footer_script')
@endsection
