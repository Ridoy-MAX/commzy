@extends('layouts.index')
@section('content')
    <!-- Home Banner Style V1 -->
   


    <!-- talent by category -->
    <section class="pb-0  mt-5">
        <div class="container">
            <div class="row align-items-center wow fadeInUp" data-wow-delay="300ms">
                <div class="col-lg-9">
                    <div class="main-title2">
                        <h2 class="title">All categories</h2>
                        <p class="paragraph">Find your best service by category</p>
                    </div>
                </div>
                <div class="col-lg-3">
                    {{-- <div class="text-start text-lg-end mb-4">
                        <a class="ud-btn btn-light-thm bdrs90" href="#">All Category<i
                                class="fal fa-arrow-right-long"></i></a>
                    </div> --}}
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 wow fadeInUp" data-wow-delay="300ms">
                    <div class="row" >
                        @foreach ($categories as $key => $categorys)
                     
                                <div class="item col-md-3">
                                    <a href="{{ route('category.service', ['category' => $categorys->id]) }}">
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
                                    </a>
                                </div>
                     
                        @endforeach
                    </div>
                </div>
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
