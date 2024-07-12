@extends('layouts.index')
@section('content')
 <!-- Home Banner Style V1 -->

 <style>
  #container {
  display: flex;
  width: 300px;
  height: 50px;
  /* margin: 0 auto; */
  
}
#star {
  font-size: 40px;
  flex: 1;
  text-align: center;
  line-height: 50px;
  margin: 0px auto;
  cursor: pointer;
  border-radius: 100%;
  transition: 1s;
}

.inactive{
    color: lightgrey
}

/* @keyframes myAnim {
	0% {
		animation-timing-function: ease-out;
		transform: scale(1);
		transform-origin: center center;
	}

	10% {
		animation-timing-function: ease-in;
		transform: scale(0.91);
	}

	17% {
		animation-timing-function: ease-out;
		transform: scale(0.98);
	}

	33% {
		animation-timing-function: ease-in;
		transform: scale(0.87);
	}

	45% {
		animation-timing-function: ease-out;
		transform: scale(1);
	}
} */

.animated {
animation: myAnim 2s ease 0s infinite normal forwards;  color: gold
}

.active {
    color: gold;
}
 </style>
 <div class="body_content">
    
    <!-- Breadcumb Sections -->
    <section class="breadcumb-section" style="margin-top: 75px">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="breadcumb-style1">
              <div class="breadcumb-list">
                <a href="{{ route('welcome')}}">Home</a>
                <a href="{{ route('category.service')}}">Services</a>
                <a href="#">{{$service->category->name }}</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Breadcumb Sections -->
    <div class="container">
      @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
    </div>
        
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
                  <h2>{{$service->service_title}}</h2>
                  <div class="list-meta mt30">
                    <a class="list-inline-item mb5-sm" href="#">
                      <span class="position-relative mr10">
                        @if($service->rel_to_user->profile_pic)

                        <img class=" rounded-circle wa-xs" src="{{ asset($service->rel_to_user->profile_pic) }}" alt="Profile Picture" style="height: 35px; width: 35px;">
                        @else
                        <img class=" rounded-circle wa-xs" src="/avatar.jpg" alt="user.png" style="height: 55px; width: 55px;"> 
                          
                        @endif

                   
                        <span class="online-badge"></span>
                      </span>
                      <span class="fz14">{{$service->rel_to_user->name}}</span>
                    </a>
                    <p class="mb-0 dark-color fz14 list-inline-item ml25 ml15-sm mb5-sm ml0-xs"><i class="fas fa-star vam fz10 review-color me-2">
                      </i> {{ number_format($averageRating, 2) }} ({{$totalReviews}} reviews) </p>
                    <p class="mb-0 dark-color fz14 list-inline-item ml25 ml15-sm mb5-sm ml0-xs"><i class="flaticon-file-1 vam fz20 me-2"></i>
                      {{ \App\Models\Order::where('service_information_id', $service->id)
                      ->where('status', 'in process')
                      ->count() }} Order{{ \App\Models\Order::where('service_information_id', $service->id)
                      ->where('status', 'in process')
                      ->count() != 1 ? 's' : '' }}

                         in Queue</p>
               
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
  
      <!-- Service Details -->
      <section class="pt10 pb90 pb30-md">
        <div class="container">
          <div class="row wrap">
            <div class="col-lg-8">
              <div class="column">
                <div class="row">
                  <div class="col-sm-6 col-md-4">
                    <div class="iconbox-style1 contact-style d-flex align-items-start mb30">
                      <div class="icon flex-shrink-0"><span class="flaticon-calendar"></span></div>
                      <div class="details">
                        <h5 class="title">Delivery Time</h5>
                        <p class="mb-0 text">{{$service->delivery_time}}</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-4">
                    <div class="iconbox-style1 contact-style d-flex align-items-start mb30">
                      <div class="icon flex-shrink-0"><span class="flaticon-goal"></span></div>
                      <div class="details">
                        <h5 class="title">languages </h5>
                        @php
                        // Assuming $service is the Service model instance passed to the view
                        $languages = App\Models\LanguageList::where('user_id', $service->user_id)->get();
                    @endphp
                    
                    @if($languages->count() > 0)
                           <div class="d-flex">
                            @foreach($languages as $language)
                              <p class="ms-2 mb-0">{{ $language->languages }},</p> 
                           
                             
                            @endforeach
                          </div>
                         
                    @else
                        <p>No languages added.</p>
                    @endif
                        {{-- <p class="mb-0 text">{{$service->rel_to_user->profile_pic}}</p> --}}
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-4">
                    <div class="iconbox-style1 contact-style d-flex align-items-start mb30">
                      <div class="icon flex-shrink-0"><span class="flaticon-tracking"></span></div>
                      <div class="details">
                        <h5 class="title">Location</h5>

                        @if($service->rel_to_user->country == 'Select Country')
                        Not identify

                        @elseif($service->rel_to_user->country)  
                        <span class="fz14 fw400"> {{ \App\Models\Country::find($service->rel_to_user->country)->name }} 
                       @endif
                       
                        {{-- <p class="mb-0 text">   {{ \App\Models\Country::find($service->rel_to_user->country)->name }}    </p> --}}
                      </div>
                    </div>
                  </div>
                </div>
                <div class="service-single-sldier vam_nav_style slider-1-grid owl-carousel owl-theme mb60">
                  @foreach($service->rel_to_gallery as $gallery)
                  <div class="item">
                    <div class="thumb p50 p30-sm">   <img class="w-100" src="{{ asset('service/gallery/' . $gallery->image) }}" alt="" style="height: 500px;"></div>
                  </div>
                  @endforeach
                </div>
                <div class="service-about">
                  <h4>About</h4>
                   <p>  {!! $service->service_detail !!}</p>
                 
                 
                  <div class="d-flex align-items-start mb50">
                    <div class="list1">
                      <h6>Tag</h6>
                      <p class="text mb-0 tag">{{$service->tag}}</p>
                   
                    </div>
                    <div class="list1 ml80">
                      <h6>Skill</h6>
                      <p class="text mb-0 tag">{{$service->skill}}</p>
                    
                    </div>
                   
                  </div>
                  <hr class="opacity-100 mb60">
                
                  <hr class="opacity-100 mb60">
                  <h4>Frequently Asked Questions</h4>
                  <div class="accordion-style1 faq-page mb-4 mb-lg-5 mt30">
                    <div class="accordion" id="accordionExample">
                      @foreach($service->rel_to_faq as $faq)
                      <div class="accordion-item active">
                        <h2 class="accordion-header" id="headingOne">
                          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{$faq->id}}" aria-expanded="flase" aria-controls="collapseOne">{{$faq->question}}?</button>
                        </h2>
                        <div id="collapseOne{{$faq->id}}" class="accordion-collapse collapse " aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                          <div class="accordion-body">{{$faq->answer}}.</div>
                        </div>
                      </div>
                      @endforeach
                   
                    </div>
                  </div>
                  <hr class="opacity-100 mb60">
                 
                  <hr class="opacity-100 mb15">
                  <div class="product_single_content mb50">
                    <div class="mbp_pagination_comments">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="total_review mb30 mt45">
                            <h4>{{$totalReviews}} Reviews</h4>
                          </div>
                          <div class="d-md-flex align-items-center mb30">
                            <div class="total-review-box d-flex align-items-center text-center mb30-sm" >
                              <div class="wrapper mx-auto">
                                <div class="t-review mb15"> {{ number_format($averageRating, 2) }}
                                </div>
                                <h5>Exceptional</h5>
                                <p class="text mb-0">{{$totalReviews}} reviews</p>
                              </div>
                            </div>
                            <div class="wrapper ml60 ml0-sm">
                              <div class="review-list d-flex align-items-center mb10">
                                <div class="list-number">{{$totalReviews}} reviews for this service</div>
                                  
                               
                              </div>
                              
                            </div>
                          </div>
                        </div>

                        @foreach($reviews->take(5) as $key => $review)
                        <div class="col-md-12">
                          <div class="mbp_first position-relative d-flex align-items-center justify-content-start mb30-sm">

                            @php
                            $client = \App\Models\User::find($review->client_id);
                            @endphp

                            @if($client->profile_pic)

                            <img class=" rounded-circle wa-xs" src="{{ asset($client->profile_pic) }}" alt="Profile Picture" 
                            style="height: 45px; width: 45px;">
                            @else
                            <img class=" rounded-circle wa-xs" src="/avatar.jpg" alt="user.png" style="height: 55px; width: 55px;"> 
                              
                            @endif

                            {{-- <img src="{{ asset('images/blog/comments-2.png')}}" class="mr-3" alt="comments-2.png"> --}}
                            <div class="ml20">
                              <h6 class="mt-0 mb-0">   {{$client->name}}</h6>
                              <div><span class="fz14">     {{ \Carbon\Carbon::parse($review->created_at)->diffForHumans(null, true, false, 2) }} </span></div>
                           
                           
                            </div>
                          </div>
                         
                          <p class="text mt20 mb20">
                            {{$review->comment}}
                          </p>

                          @if( $review->rating == '1')
                           <div class="d-flex mb-5">
                            <i class="fas fa-star review-color"></i>
                           </div>
                          @endif
                          @if( $review->rating == '2')
                           <div class="d-flex mb-5">
                            <i class="fas fa-star review-color"></i>
                            <i class="fas fa-star review-color"></i>
                           </div>
                          @endif
                          @if( $review->rating == '3')
                           <div class="d-flex mb-5">
                            <i class="fas fa-star review-color"></i>
                            <i class="fas fa-star review-color"></i>
                            <i class="fas fa-star review-color"></i>
                           </div>
                          @endif
                          @if( $review->rating == '4')
                           <div class="d-flex mb-5">
                            <i class="fas fa-star review-color"></i>
                            <i class="fas fa-star review-color"></i>
                            <i class="fas fa-star review-color"></i>
                            <i class="fas fa-star review-color"></i>
                           </div>
                          @endif
                          @if( $review->rating == '5')
                           <div class="d-flex mb-5">
                            <i class="fas fa-star review-color"></i>
                            <i class="fas fa-star review-color"></i>
                            <i class="fas fa-star review-color"></i>
                            <i class="fas fa-star review-color"></i>
                            <i class="fas fa-star review-color"></i>
                           </div>
                          @endif



                          {{-- <p>Rating: {{ $review->rating }}</p>
                           <div class="d-flex mb-5">
                              <i class="fas fa-star review-color"></i>
                              <i class="far fa-star review-color ms-2"></i>
                              <i class="far fa-star review-color ms-2"></i>
                              <i class="far fa-star review-color ms-2"></i>
                              <i class="far fa-star review-color ms-2"></i>
                            </div> --}}

                        </div>

                        @endforeach
                     
                        @if($service->rel_to_review->count() > 5)
                        <div class="col-md-12">
                            <div class="position-relative bdrb1 pb50">
                                <button class="ud-btn btn-light-thm" id="see-more-btn">See More<i class="fal fa-arrow-right-long"></i></button>
                            </div>
                          </div>
                        @endif

                        <div id="hidden-reviews" style="display: none;">
                          <!-- Display all reviews beyond the first five -->
                          @foreach($reviews->skip(5) as $key => $review)
                          <div class="col-md-12">
                            <div class="mbp_first position-relative d-flex align-items-center justify-content-start mb30-sm">
  
                              @php
                              $client = \App\Models\User::find($review->client_id);
                              @endphp
  
                              @if($client->profile_pic)
  
                              <img class=" rounded-circle wa-xs" src="{{ asset($client->profile_pic) }}" alt="Profile Picture" 
                              style="height: 45px; width: 45px;">
                              @else
                              <img class=" rounded-circle wa-xs" src="/avatar.jpg" alt="user.png" style="height: 55px; width: 55px;"> 
                                
                              @endif
  
                              {{-- <img src="{{ asset('images/blog/comments-2.png')}}" class="mr-3" alt="comments-2.png"> --}}
                              <div class="ml20">
                                <h6 class="mt-0 mb-0">   {{$client->name}}</h6>
                                <div><span class="fz14">       {{ \Carbon\Carbon::parse($review->created_at)->diffForHumans(null, true, false, 2) }} 
                                  </span></div>
                              </div>
                            </div>
                           
                            <p class="text mt20 mb20">
                              {{$review->comment}}
                            </p>
  
                            @if( $review->rating == '1')
                             <div class="d-flex mb-5">
                              <i class="fas fa-star review-color"></i>
                             </div>
                            @endif
                            @if( $review->rating == '2')
                             <div class="d-flex mb-5">
                              <i class="fas fa-star review-color"></i>
                              <i class="fas fa-star review-color"></i>
                             </div>
                            @endif
                            @if( $review->rating == '3')
                             <div class="d-flex mb-5">
                              <i class="fas fa-star review-color"></i>
                              <i class="fas fa-star review-color"></i>
                              <i class="fas fa-star review-color"></i>
                             </div>
                            @endif
                            @if( $review->rating == '4')
                             <div class="d-flex mb-5">
                              <i class="fas fa-star review-color"></i>
                              <i class="fas fa-star review-color"></i>
                              <i class="fas fa-star review-color"></i>
                              <i class="fas fa-star review-color"></i>
                             </div>
                            @endif
                            @if( $review->rating == '5')
                             <div class="d-flex mb-5">
                              <i class="fas fa-star review-color"></i>
                              <i class="fas fa-star review-color"></i>
                              <i class="fas fa-star review-color"></i>
                              <i class="fas fa-star review-color"></i>
                              <i class="fas fa-star review-color"></i>
                             </div>
                            @endif
  
  
  
                            {{-- <p>Rating: {{ $review->rating }}</p>
                             <div class="d-flex mb-5">
                                <i class="fas fa-star review-color"></i>
                                <i class="far fa-star review-color ms-2"></i>
                                <i class="far fa-star review-color ms-2"></i>
                                <i class="far fa-star review-color ms-2"></i>
                                <i class="far fa-star review-color ms-2"></i>
                              </div> --}}
  
                          </div>
                          @endforeach
                        </div>




                      </div>
                    </div>
                  </div>
                  {{-- <div class="bsp_reveiw_wrt">
                    <h6 class="fz17">Add a Review</h6>
                    <p class="text">Your email address will not be published. Required fields are marked *</p>
                    <h6>Your rating of this product</h6>
                  
                    



                    <form class="comments_form mt30 mb30-md" method="POST" action="{{ route('service.review') }}">
                      @csrf

                      <div id="container">
                        <div id="star" class="inactive" data-index=0>★</div>
                        <div id="star" class="inactive" data-index=1>★</div>
                        <div id="star" class="inactive" data-index=2>★</div>
                        <div id="star" class="inactive" data-index=3>★</div>
                        <div id="star" class="inactive" data-index=4>★</div>
                      </div>
                      <input type="hidden" name="rating" value="">

                      <!-- Star rating section (use JavaScript to handle star selection) -->
                      <!-- Comment textarea -->
                      <div class="mb-4">
                          <label class="fw500 fz16 ff-heading dark-color mb-2">Comment</label>
                          <textarea class="pt15" name="comment" rows="6" placeholder="Enter your comment here..."></textarea>
                      </div>
                      <!-- User's name (assuming it's automatically filled based on the authenticated user) -->
                      <div class="row">
                        <div class="col-md-6 mb20">
                          <label class="fw500 ff-heading dark-color mb-2">Name</label>
                          <input type="text" class="form-control" value="{{ Auth::user()->name }}" disabled>
                          <input type="hidden" class="form-control" value="{{$service->id}}" name="service_information_id" >
                      </div>
                      <!-- User's email (assuming it's automatically filled based on the authenticated user) -->
                      <div class="col-md-6 mb20">
                          <label class="fw500 ff-heading dark-color mb-2">Email</label>
                          <input type="email" class="form-control" value="{{ Auth::user()->email }}" disabled>
                      </div>
                      </div>
                    
                      <!-- Checkbox for saving user information -->
                      <div class="checkbox-style1 d-block d-sm-flex align-items-center justify-content-between mb20">
                          <label class="custom_checkbox fz15 ff-heading">
                              Save my name, email, and website in this browser for the next time I comment.
                              <input type="checkbox" name="save_info">
                              <span class="checkmark"></span>
                          </label>
                      </div>
                      <!-- Submit button -->
                      <button type="submit" class="ud-btn btn-thm">Send<i class="fal fa-arrow-right-long"></i></button>
                  </form>
                  
                  </div> --}}
                </div>
              </div>
            </div>
            <div class="col-lg-4">
         

           
        
              
              <div class="column">
                @if(session('proposal'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('proposal') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
  
                @if ($errors->has('delivery_time'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ $errors->first('delivery_time') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="blog-sidebar ms-lg-auto">
                  <div class="price-widget">
                    <div class="navtab-style1">
                   
                      <div class="price-content">
                    
                        <div class="h5 mb-2">{{$service->title}}</div>
                        
                        <hr class="opacity-100 mb20">
                        <ul class="p-0 mb15 d-sm-flex align-items-center">
                          <li class="fz14 fw500 dark-color"><i class="flaticon-sandclock fz20 text-thm2 me-2 vam"></i>{{$service->delivery_time}} Delivery</li>
                      
                        </ul>
                        <div class="list-style1">
                          <ul class="">
                            <li class="mb15"><i class="far fa-check text-thm3 bgc-thm3-light"></i>
                              languages /    @if($languages->count() > 0)
               
                              @foreach($languages as $language)
                              <p class="ms-2 mb-0">{{ $language->languages }},</p> 
                              @endforeach
                       
                      @else
                          <p>No languages added.</p>
                      @endif</li>
                            <li><i class="far fa-check text-thm3 bgc-thm3-light"></i>Source file</li>
                          </ul>
                        </div>
                        <div class="d-grid">
                          @if($service->user_id != auth()->user()->id)
                          <a href="" class="ud-btn btn-thm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                              Continue ${{$service->price}}<i class="fal fa-arrow-right-long"></i>
                          </a>
                          @endif
                      
                        </div>
                      </div>
                    </div>              
                  </div>
                  <div class="freelancer-style1 service-single mb-0">
                    <div class="wrapper d-flex align-items-center">
                      <div class="thumb position-relative mb25">
                        @if($service->rel_to_user->profile_pic)

                        <img class=" rounded-circle wa-xs" src="{{ asset($service->rel_to_user->profile_pic) }}" alt="Profile Picture" style="height: 35px; width: 35px;">
                        @else
                        <img class=" rounded-circle wa-xs" src="/avatar.jpg" alt="user.png" style="height: 55px; width: 55px;"> 
                          
                        @endif
                        {{-- <img class="rounded-circle mx-auto" src="images/team/fl-1.png" alt=""> --}}
                        {{-- <span class="online"></span> --}}
                      </div>

                      <a href="{{ route('user.services',$service->user_id)}} ">
                        <div class="ml20">
                          <h5 class="title mb-1">{{$service->rel_to_user->name}}</h5>
                          <p>{{$service->rel_to_user->username}}</p>
                          {{-- <p class="mb-0">Dog Trainer</p> --}}
                          {{-- <div class="review"><p><i class="fas fa-star fz10 review-color pr10"></i><span class="dark-color">4.9</span> (595 reviews)</p></div> --}}
                        </div>
                      </a>
                    
                    </div>
                    <hr class="opacity-100">
                    <div class="details">
                      <div class="fl-meta d-flex align-items-center justify-content-between">
                        <a class="meta fw500 text-start">Location<br>
                            @if($service->rel_to_user->country == 'Select Country')
                            Not identify

                            @elseif($service->rel_to_user->country)  
                            <span class="fz14 fw400"> {{ \App\Models\Country::find($service->rel_to_user->country)->name }} 
                           @endif
                   

                       


                          </span></a>
                     
                        <a class="meta fw500 text-start">Gender<br><span class="fz14 fw400">{{$service->rel_to_user->gender}}</span></a>
                      </div>
                    </div>
                    <div class="d-grid mt30">
                      @if($service->user_id != auth()->user()->id)
                      <a href="{{ route('open.conversation',$service->rel_to_user->username)}} " class="ud-btn btn-thm-border">
                        Contact Me<i class="fal fa-arrow-right-long"></i></a>
                      @endif

 
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
  
      <!-- Listings -->
    


    <!-- Our Footer --> 
 
    <a class="scrollToHome" href="#"><i class="fas fa-angle-up"></i></a>
  </div>











  <!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Send Proposal</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('proposal.sent')}}" method="POST">
        @csrf
      
        <div class="modal-body">
          <div class="col-sm-12">
            <div class="mb25">
            <h6 class="mb15">Price</h6>
            <input class="form-control" type="number" placeholder="$" name="price" required>
            <input type="hidden" value="{{$service->id }}" name="service_information_id">
            <input type="hidden" value="{{$service->rel_to_user->id}}" name="seller_id">
            </div>
          </div>

          <div class="col-sm-12">
            <div class="mb25">
            <h4 class="mb15" class="mb15">Additional information</h4>
            {{-- <h6>Order Notes (optional)</h6> --}}
            <textarea  class="" rows="7" placeholder="Description" name="description" required></textarea>
            </div>
        </div>
          <div class="col-sm-12">
              <select class="form-select p-2" name="delivery_time">
                <option value="">Select Delivery Time</option>
                @for ($i = 1; $i <= 90; $i++)
                    <option value="{{ $i }}"> {{ $i }} day{{ $i > 1 ? 's' : '' }}</option>
                @endfor
              </select>
          
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="ud-btn " data-bs-dismiss="modal">Close</button>
          <button type="submit" class="ud-btn ">Submit</button>
        </div>

      </form>
    </div>
  </div>
</div>
@endsection
@section('footer_script')
<script>
  // JavaScript to handle "See More" button functionality
  document.getElementById('see-more-btn').addEventListener('click', function() {
      document.getElementById('hidden-reviews').style.display = 'block';
      this.style.display = 'none'; // Hide the "See More" button after clicking
  });
</script>

<script>
  document.querySelectorAll("#star").forEach((star) => {
    star.addEventListener("mouseover", animateStart);
    star.addEventListener("mouseout", animateEnd);
    star.addEventListener("click", set);
});

function animateStart(e) {
    const index = e.target.getAttribute("data-index");
    for (let i = 0; i <= index; i++) {
        e.target.parentNode.children[i].classList.add("animated");
    }
}

function animateEnd(e) {
    const index = e.target.getAttribute("data-index");
    for (let i = 0; i <= index; i++) {
        e.target.parentNode.children[i].classList.remove("animated");
    }
}

function set(e) {
    const index = e.target.getAttribute("data-index");
    for (let i = 0; i <= 4; i++) {
        e.target.parentNode.children[i].classList.remove("active");
    }
    for (let i = 0; i <= index; i++) {
        e.target.parentNode.children[i].classList.add("active");
    }

    // Set the rating value in the hidden input field
    document.querySelector('input[name="rating"]').value = index + 1;
}


</script>



@endsection