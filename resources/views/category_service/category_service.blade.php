@extends('layouts.index')
@section('content')
 <!-- Home Banner Style V1 -->

 
 <div class="body_content">
    <section class="categories_list_section ">
      <div class="container">
        <div class="row">
      
          <div class="col-lg-12">
            <div class="listings_category_nav_list_menu" style="margin-top: 70px">
              <ul class="mb0 d-flex ps-0">
                <li><a href="{{ route('category.service') }}">All Categories</a></li>

                @foreach($categories as $key => $category)
                <li>
                    <a href="{{ route('category.service', ['category' => $category->id]) }}"
                        class="{{ request()->get('category') == $category->id ? 'active' : '' }}">
                        {{ $category->name }}
                    </a>
                </li>
            @endforeach
            

              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Breadcumb Sections -->
    <section class="breadcumb-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="breadcumb-style1">
              <div class="breadcumb-list">
                <a href="#">Home</a>
                <a href="#">Services</a>
                {{-- <a href="#">Portrait Artist</a> --}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Breadcumb Sections -->
    <section class="breadcumb-section pt-0">
      <div class="cta-service-single cta-banner mx-auto maxw1700 pt120 pt60-sm pb120 pb60-sm bdrs16 position-relative overflow-hidden d-flex align-items-center mx20-lg px30-lg">
        <img class="left-top-img " src="{{ asset('images/vector-img/left-top.png')}}" alt="">
        <img class="right-bottom-img wow " src="{{ asset('images/vector-img/right-bottom.png')}}" alt="">
        <img class="service-v1-vector bounce-y d-none d-xl-block" src="{{ asset('images/vector-img/vector-service-v1.png')}}" alt="">
        <div class="container">
          <div class="row wow ">
            <div class="col-xl-7">
              <div class="position-relative">
                <h2>Design & Creative</h2>
                <p>Give your visitor a smooth online experience with a solid UX design</p>
               
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Listings All Lists -->
    <section class="pt30 pb90">
      <div class="container">
        <div class="row align-items-center mb20">
          <div class="col-md-10 pe-0">
            <div class="text-center text-sm-start">
              <div class="dropdown-lists">


            <form action="{{ route('category.service') }}" method="GET">

                <ul class="p-0 mb-0 text-center text-sm-start">
             
                  <li class="list-inline-item position-relative  d-xl-inline-block" style="width: 150px">
                    <div class="col">
                      <select  class="form-select p-2" aria-label="Default select example" name="delivery_time">
                  
                        <option  > Delivery time</option>

              
                         <option value="1 days"   {{ old('delivery_time') == '1 days' ? 'selected' : '' }}   selected >24 hour</option>
                         <option value="2 days"   {{ old('delivery_time') == '2 days' ? 'selected' : '' }}  >2 days</option>
                         <option value="3 days"   {{ old('delivery_time') == '3 days' ? 'selected' : '' }}  >3 days</option>
                         <option value="4 days"   {{ old('delivery_time') == '4 days' ? 'selected' : '' }}  >4 days</option>
                         <option value="5 days"   {{ old('delivery_time') == '5 days' ? 'selected' : '' }}  >5 days</option>
                         <option value="6 days"   {{ old('delivery_time') == '6 days' ? 'selected' : '' }}  >6 days</option>
                         <option value="7 days"   {{ old('delivery_time') == '7 days' ? 'selected' : '' }}  >7 days</option>
                       
                     </select>

                
                  
                  <!-- Repeat the same approach for other select dropdowns -->
                  
                    </div>
                  </li>

                  <li class=" position-relative  d-xl-inline-block mt-3">
                    <button class="open-btn mb10 dropdown-toggle" type="button" data-bs-toggle="dropdown">Budget <i class="fa fa-angle-down ms-2"></i></button>
                    <div class="dropdown-menu dd3">
                      <div class="widget-wrapper pb25 mb0 pr20">
                     
                        <div class="range-slider-style1">
                          <div class="range-wrapper">
                              <div class="slider-range mb20"></div>
                              <div class="text-center">
                                  <input type="number" class="amount" placeholder="$" name="minprice" value="{{ old('minprice', 0) }}" style="width: 70px">
                                  <span class="fa-sharp fa-solid fa-minus mx-1 dark-color"></span>
                                  <input type="number" class="amount2" placeholder="$" name="price" value="{{ old('price', 0) }}" style="width: 70px">
                              </div>
                          </div>
                      </div>
                      


                      </div>
              
                    </div>

                    {{-- <input class="form-control " type="number" name="price"  placeholder="amount $" > --}}
                  </li>
              
                  <li class="list-inline-item position-relative  d-xl-inline-block mt-3">
              
                    <div class="col">
                        
                      <select class="form-select p-2" name="country">
                        @php
                        $countries = App\Models\Country::all();
                    
                        $selectedCountryId = isset($_GET['country']) ? $_GET['country'] : null;
                     
                        @endphp   
                        <option value="0">Select Country</option>
                        
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}" @if($country->id == $selectedCountryId) selected @endif>{{ $country->name }}</option>
                        @endforeach
                    </select>
                    
                    
                    
                    

                      
                     </div>

               
                  </li>

                  <li class="list-inline-item position-relative  d-xl-inline-block mt-3">
              
                    <div class="col">
                        
                              <select class="form-select p-2" aria-label="Default select example"  name="languages">
                                   @php
                                   $languages = App\Models\Language::all();     
                                   $selectedlanguagesId = isset($_GET['languages']) ? $_GET['languages'] : null;
                                   @endphp  
                             
                                  <option value="" >Select Language</option>

                                  @foreach($languages as $languages)
                                        <option value="{{ $languages->value }}"  @if($languages->value == $selectedlanguagesId) selected @endif >{{ $languages->value }}</option>
                                  @endforeach       
                              </select>
                     </div>

                   
                  </li>
                  
                  <button class="done-btn ud-btn btn-thm drop_btn3" style="padding: 5px 35px;">
                    Filter<i class="fal fa-arrow-right-long"></i>
                  </button>
              
                </ul>
            </form>

              </div>
            </div>
          </div>
          {{-- <div class="col-md-2">
            <div class="page_control_shorting mb10 d-flex align-items-center justify-content-center justify-content-sm-end">
              <div class="pcs_dropdown dark-color pr10 pr0-xs"><span>Sort by</span>
                <select class="selectpicker show-tick">
                  <option>Best Seller</option>
                  <option>Recommended</option>
                  <option>New Arrivals</option>
                </select>
              </div>
            </div>
          </div> --}}
        </div>
        <div class="row">
       
       
          @foreach($services as $key => $service)

          <div class="col-md-3">
            <a > 
            <div class="listing-style1 default-box-shadow1 bdrs16">
              <div class="list-thumb">
                <div class="listing-thumbIn-slider position-relative navi_pagi_bottom_center slider-1-grid owl-carousel owl-theme">
             
                  {{-- @if($service->rel_to_service) --}}
                  @foreach($service->rel_to_gallery as $gallery)
                  <div class="item">
                    <img class="w-100" src="{{ asset('service/gallery/' . $gallery->image) }}" alt="iamge" style="height: 250px;">

                    <form action="{{ route('favourite.save')}}" method="post">
                      @csrf
                      <input type="hidden" value="{{$service->id}}" name="service_information_id">
                      <button  class="listing-fav fz12" type="submit" style="border: none"> <span class="far fa-heart"></span> </button>
                    </form>
                  
                  </div>
                  @endforeach
                  {{-- @endif --}}
               

             
                </div>
              </div>

              <div class="list-content">
             

            

                <p class="list-text body-color fz14 mb-1">{{$service->category->name }}</p>

                <h5 class="list-title"  style="height: 60px">
                  <a href="{{ route('service.details', $service->slug)}}">   {{ implode(' ', array_slice(str_word_count($service->service_title, 2), 0, 10)) }}</a>
                </h5>

                
                {{-- <div class="review-meta d-flex align-items-center">
                  <i class="fas fa-star fz10 review-color me-2"></i>
                  <p class="mb-0 body-color fz14"><span class="dark-color me-2">4.82</span>94 reviews</p>
                </div> --}}

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
                <div class="list-meta d-flex justify-content-between align-items-center mt15">
                  <a class="d-flex" href="#">
                    <span class="position-relative mr10">

                      @if($service->rel_to_user->profile_pic)

                      <img class=" rounded-circle wa-xs" src="{{ asset($service->rel_to_user->profile_pic) }}" alt="Profile Picture" style="height: 35px; width: 35px;">
                      @else
                      <img class=" rounded-circle wa-xs" src="/avatar.jpg" alt="user.png" style="height: 55px; width: 55px;"> 
                        
                      @endif

                      {{-- <img class="rounded-circle wa" src="images/team/fl-s-1.png" alt="artist Photo"> --}}


                      <span class="online-badges"></span>
                    </span>
                    <span class="fz14 mt-1">{{$service->rel_to_user->name}}</span>
                  </a>

            

                  <div class="budget">
                    <p class="mb-0 body-color"><span class="fz17 fw500 dark-color ms-1"
                        style="color: #E34A6F;">${{$service->price}}</span></p>
                  </div>
                </div>
              </div>
            </div>
            </a>
          </div>
          @endforeach

          
       
       
      
      
        </div>
        <div class="row">
          <div class="mbp_pagination mt30 text-center">
          
          
          </div>
        </div>
      </div>
    </section>

    <!-- Our Footer --> 
 
    <a class="scrollToHome" href="#"><i class="fas fa-angle-up"></i></a>
  </div>

@endsection
@section('footer_script')
<script>
    $(document).ready(function(){
        $('#country').select2();
    });
    $(document).ready(function(){
        $('#city').select2();
    });


    $(document).ready(function(){
        $('#language').select2();
    });

    
    $(document).ready(function(){
        $('#language_level').select2();
    });

    // $('#city').html(data);
    // $('.selectpicker').selectpicker('refresh');

</script>

  
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection