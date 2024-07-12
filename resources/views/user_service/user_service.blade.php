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
    <section class="breadcumb-section" style="margin-top: 55px">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="breadcumb-style1">
              <div class="breadcumb-list">
    
             
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
        
  
  
      <!-- Service Details -->
      <section class="pt10 pb90 pb30-md">
        <div class="container-fluid">
          <div class="row wrap">

            <div class="col-md-11 m-auto">

                <div class="row">
                     <div class="col-lg-4">
         

           
        
              
                        <div class="column">
                       
                     
                          <div class="blog-sidebar ms-lg-auto" style="max-width: 100%">
                        
                                <div class="freelancer-style1 service-single mb-0">
                                    <div class="wrapper d-flex align-items-center justify-content-center">
                                            <div class="thumb position-relative mb25">
                                                    @if($user->profile_pic)
                            
                                                    <img class=" rounded-circle wa-xs" src="{{ asset($user->profile_pic) }}" alt="Profile Picture"
                                                    style="height: 145px; width: 145px;">
                                                    @else
                                                    <img class=" rounded-circle wa-xs" src="/avatar.jpg" alt="user.png" style="height: 55px; width: 55px;"> 
                                                        
                                                    @endif
                                                    <img class="rounded-circle mx-auto" src="images/team/fl-1.png" alt=""> 
                                                {{-- <span class="online"></span> --}}
                                            </div>          
                                    </div>
                                    <div class="wrapper d-flex align-items-center justify-content-center">
                                        <div class="">
                                            <h5 class="title mb-1 text-center" style="font-size: 30px; font-weight:600;">{{$user->name}}</h5>
                                            <p class="mb-0 text-center" style="font-weight: 600">{{$user->username}}</p> 
                                            <p class="mb-0 text-center" style="font-weight: 500;font-size: 16px;">{{$user->display_name}}</p> 
                                        <div class="review">
                                            {{-- <p class="text-center"><i class="fas fa-star fz10 review-color pr10"></i><span class="dark-color">4.9</span> (595 reviews)</p> --}}
                                        </div>
                                        </div>        
                                    </div>

                                

                                    <hr class="opacity-100">
                                    <div class="details">
                                        <div class="fl-meta d-flex align-items-center justify-content-between">
                                        <a class="meta fw500 text-start">
                                            <i class="fa-solid fa-earth-asia"></i>
                                            Country<br>
                                            <span class="fz14 fw400"> </span></a>

                                            @if($user->country == 'Select Country')
                                           Not identify

                                             @elseif($user->country)  
                                             <a class="meta fw500 text-start"> {{ \App\Models\Country::find($user->country)->name }}</a>
                                            @endif
                                    
                                    

                                    
                                        </div>

                                        <div class="fl-meta d-flex align-items-center justify-content-between mt-3">
                                        <a class="meta fw500 text-start">
                                            <i class="fa-solid fa-city"></i>
                                            City<br>
                                            <span class="fz14 fw400"> </span></a>

                                            @if($user->city == 'Select City')
                                           Not identify

                                             @elseif($user->city)  
                                             <a class="meta fw500 text-start"> {{ \App\Models\City::find($user->city)->name }}</a>
                                            @endif
                                    
                                    

                                    
                                        </div>


                                        <div class="fl-meta d-flex align-items-center justify-content-between" style="margin-top: 18px">
                                        <a class="meta fw500 text-start">
                                            <i class="fa-solid fa-user"></i>
                                            Member since<br>
                                            <span class="fz14 fw400"> </span></a>
                                    
                                            <a class="meta fw500 text-start">{{ \Carbon\Carbon::parse($user->created_at)->format('F j, Y') }}</a>


                                    
                                        </div>
                                        <div class="fl-meta d-flex align-items-center justify-content-between" style="margin-top: 18px">
                                        <a class="meta fw500 text-start">
                                            <i class="fa-solid fa-street-view"></i>
                                            
                                            Gender<br>
                                            <span class="fz14 fw400"> </span></a>
                                    
                                        <a class="meta fw500 text-start"> {{$user->gender}}</a>

                                    
                                        </div>
                                    </div>
                                    <div class="d-grid mt30">
                                        @if($user->id != auth()->user()->id)
                                        <a href="{{ route('open.conversation',$user->username)}}" class="ud-btn btn-thm-border">Contact Me<i class="fal fa-arrow-right-long"></i></a>
                                        @endif
                  
                                       
                                    </div>
                                </div>
                            
                          </div>

                          <div class="blog-sidebar ms-lg-auto" style="max-width: 100%;margin-top:30px;">
                                <div class="freelancer-style1 service-single mb-0">
                                    
                                    <p style="font-weight: 600">About us</p>
                                    
                                    <p> {{$user->introduce_yourself}}</p>

                                    <div style="border-top: 1px solid rgba(0, 0, 0, 0.11);margin-top:30px;">
                                        <p style="font-weight: 600;margin-top:30px;">Languages</p>

                                                        
                                                @php
                                                $languages = App\Models\LanguageList::where('user_id', $user->id)->get();
                                            @endphp
                                            
                                            @forelse($languages as $language)
                                                <div class="language_list d-flex mt-2">
                                                    <div class="d-flex"> 
                                                        <h5 class=" mt-2">{{ $language->languages }}</h5>
                                                        <span class="tag ms-3">{{ $language->languages_level }}</span>
                                                    </div>
                                                </div>
                                            @empty
                                                <p>No languages available.</p>
                                            @endforelse
                                    
                                    </div>

                                    <div style="border-top: 1px solid rgba(0, 0, 0, 0.11);margin-top:30px;">
                                        <p style="font-weight: 600;margin-top:30px;">Education</p>
                                            @php
                                            $educations = App\Models\Education::where('user_id',$user->id)->get();
                                            @endphp                    
                                            @foreach($educations as $education) 

                                                <div class="mt-2">
                                                    <span class="tag">{{ $education->start_year }} - {{ $education->end_year }}</span>
                                                    <h5 class="mt15">{{ $education->degree }}</h5>
                                                    <h6 class="text-thm">{{ $education->university_name }}</h6>
                                                    {{-- <p>{{ $education->description }}</p> --}}
                                                </div>
                                            @endforeach
                                    </div>
                                    <div style="border-top: 1px solid rgba(0, 0, 0, 0.11);margin-top:30px;">
                                        <p style="font-weight: 600;margin-top:30px;">Work & Experience</p>
                                            @php
                                            $experiences = App\Models\Experience::where('user_id',$user->id)->get();
                                            @endphp                    
                                            @foreach($experiences as $experience) 

                                                <div class="mt-2">
                                                    <span class="tag">{{ $experience->start_year }} - {{ $experience->end_year }}</span>
                                                    <h5 class="mt15">{{ $experience->position }}</h5>
                                                    <h6 class="text-thm">{{ $experience->company_name }}</h6>
                                                    <p>{{ $experience->description }}</p>
                                                    {{-- <p>{{ $education->description }}</p> --}}
                                                </div>
                                            @endforeach
                                    </div>
                                    <div style="border-top: 1px solid rgba(0, 0, 0, 0.11);margin-top:30px;">
                                        <p style="font-weight: 600;margin-top:30px;">Awards</p>
                                            @php
                                            $awards = App\Models\Award::where('user_id',$user->id)->get();
                                            @endphp                    
                                            @foreach($awards as $award) 

                                                <div class="mt-2">
                                                    <span class="tag">{{ $award->start_year }} - {{ $award->end_year }}</span>
                                                    <h5 class="mt15">{{ $award->award }}</h5>
                                                    <h6 class="text-thm">{{ $award->institute }}</h6>
                                                    {{-- <p>{{ $award->description }}</p> --}}
                                                    {{-- <p>{{ $education->description }}</p> --}}
                                                </div>
                                            @endforeach
                                    </div>

                               </div>
                          </div>
                        </div>
                      </div>
          
                      <div class="col-md-8">

                    <p class="mb-0 " style="font-weight: 600;font-size:22px">{{$user->username}} services</p>
                          <div class="row mt-3">
                         
                            @foreach ($services as $key => $service)
                            <div class="col-md-4">
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
                                                    href="{{ route('service.details', $service->id) }}">
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

@endsection
@section('footer_script')


@endsection