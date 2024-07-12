@extends('layouts.index')
@section('content')
 <!-- Home Banner Style V1 -->





      <!-- Popular Artist -->
      <section class=" pb100">
        <div class="container">
          <div class="row align-items-center wow fadeInUp">

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="col-xl-3">
              <div class="main-title mb30-lg">
                <h2 class="title">Favourite artist</h2>
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
                    @foreach($existingFavorites  as $key => $favorite)


                      <div class="col-sm-3 col-xl-3">
                        <a href="">
                        <div class="listing-style1 bdrs16">
                            <div class="list-thumb">
                                <div class="listing-thumbIn-slider position-relative navi_pagi_bottom_center slider-1-grid owl-carousel owl-theme">

                                  {{-- @if($service->rel_to_service) --}}
                                  @foreach($favorite->rel_to_service->rel_to_gallery as $gallery)
                                  <div class="item">
                                    <img class="w-100" src="{{ asset('service/gallery/' . $gallery->image) }}" alt="iamge" style="height: 250px;">

                                    <form action="{{ route('favourite.delete', ['id' => $favorite->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="listing-fav fz12" type="submit" style="border: none"> <i class="fa-solid fa-heart"></i> </button>
                                    </form>


                                  </div>
                                  @endforeach
                                  {{-- @endif --}}



                                </div>
                              </div>
                          <div class="list-content">
                            <p class="list-text body-color fz14 mb-1">{{$favorite->rel_to_service->category->name }} </p>
                            <h5 class="list-title" style="height: 60px">
                              
                         
                              <a
                              href="{{ route('service.details', $favorite->rel_to_service->slug) }}">
                              {{ implode(' ', array_slice(str_word_count($favorite->rel_to_service->service_title, 2), 0, 10)) }}</a>


                            </h5>

                            @php
                            $totalReviews = $favorite->rel_to_service->rel_to_review->count();
                            $sumRatings = 0;
                            foreach ($favorite->rel_to_service->rel_to_review as $review) {
                                $sumRatings += $review->rating;
                            }
                            $averageRating = $totalReviews > 0 ? number_format($sumRatings / $totalReviews, 2) : 0;
                            @endphp

                            <div class="review-meta d-flex align-items-center">
                              <i class="fas fa-star fz10 review-color me-2"></i>
                              <p class="mb-0 body-color fz14"><span class="dark-color me-2">  {{ $averageRating }} </span>{{$favorite->rel_to_service->rel_to_review->count()}} reviews</p>
                            </div>
                            <hr class="my-2">
                            <div class="list-meta d-flex justify-content-between align-items-center mt15">

                              <a class="d-flex" href="#">
                                <span class="position-relative mr10">
                                    @if($favorite->rel_to_user->profile_pic)

                                    <img class=" rounded-circle wa-xs" src="{{ asset($favorite->rel_to_user->profile_pic) }}" alt="Profile Picture" style="height: 35px; width: 35px;">
                                    @else
                                    <img class=" rounded-circle wa-xs" src="/avatar.jpg" alt="user.png" style="height: 55px; width: 55px;">

                                    @endif

                                  {{-- <img class="rounded-circle wa" src="images/team/fl-s-1.png" alt="Freelancer Photo"> --}}
                                  <span class="online-badges"></span>
                                </span>
                                <span class="fz14">{{$favorite->rel_to_user->name}}</span>
                              </a>

                              <div class="budget">
                                <p class="mb-0 body-color"><span class="fz17 fw500 dark-color ms-1"
                                    style="color: #E34A6F;">$983</span></p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </a>
                      </div>

                     @endforeach




                      <div class="col-lg-12">
                        <div class="text-center mt30">
                          <a class="ud-btn btn-light-thm bdrs60" href="{{ route('category.service') }}">All Services<i
                              class="fal fa-arrow-right-long"></i></a>
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









@endsection
@section('footer_script')

@endsection
