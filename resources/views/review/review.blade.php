@extends('layouts.dashboard')
@section('content')


        <div class="dashboard__content hover-bgc-color">
                <div class="row pb40">
                    <div class="col-lg-12">
                    @include('components.main_component.dashboard_navigation')
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-9">
                        <div class="dashboard_title_area">
                        <h2>Reviews</h2>
                        <p class="text">Your all services review</p>
                        </div>
                    </div>

                 
                </div>

                <div class="row">
                    <div class="col-xl-12">
                      <div class="ps-widget bgc-white bdrs4 p30 mb30 overflow-hidden position-relative">
                        <div class="packages_table table-responsive">
                          <div class="navtab-style1">
                            <nav>
                              <div class="nav nav-tabs mb20" id="nav-tab2" role="tablist">
                                <button class="nav-link active fw500 ps-0" id="nav-item1-tab" data-bs-toggle="tab" data-bs-target="#nav-item1" type="button" role="tab" aria-controls="nav-item1" aria-selected="true">Services reviews</button>
                     
                              </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                              <div class="tab-pane fade show active" id="nav-item1" role="tabpanel" aria-labelledby="nav-item1-tab">
                                
                                @foreach($reviews as $review)
                                     
                                <div class="col-md-12">
                                    <div class="bdrb1 pb20">
                                      <div class="mbp_first position-relative d-sm-flex align-items-center justify-content-start mb30-sm mt30">
                                        @php
                                        $client = \App\Models\User::find($review->client_id);
                                        @endphp

                                        @if($client->profile_pic)

                                        <img class=" rounded-circle wa-xs" src="{{ asset($client->profile_pic) }}" alt="Profile Picture" 
                                        style="height: 45px; width: 45px;">
                                        @else
                                        <img class=" rounded-circle wa-xs" src="/avatar.jpg" alt="user.png" style="height: 55px; width: 55px;"> 
                                        
                                        @endif


                                        <div class="ml20 ml0-xs mt20-xs">
                                          <div class="del-edit"><span class="flaticon-flag"></span></div>
                                          <h6 class="mt-0 mb-1">  {{$client->name}}</h6>

                                          <div class="d-flex align-items-center">
                                
                                                
                                                @if( $review->rating == '1')
                                                <div class="d-flex ">
                                                <i class="fas fa-star review-color"></i>
                                                </div>
                                                @endif
                                                @if( $review->rating == '2')
                                                <div class="d-flex ">
                                                <i class="fas fa-star review-color"></i>
                                                <i class="fas fa-star review-color"></i>
                                                </div>
                                                @endif
                                                @if( $review->rating == '3')
                                                <div class="d-flex ">
                                                <i class="fas fa-star review-color"></i>
                                                <i class="fas fa-star review-color"></i>
                                                <i class="fas fa-star review-color"></i>
                                                </div>
                                                @endif
                                                @if( $review->rating == '4')
                                                <div class="d-flex ">
                                                <i class="fas fa-star review-color"></i>
                                                <i class="fas fa-star review-color"></i>
                                                <i class="fas fa-star review-color"></i>
                                                <i class="fas fa-star review-color"></i>
                                                </div>
                                                @endif
                                                @if( $review->rating == '5')
                                                <div class="d-flex ">
                                                <i class="fas fa-star review-color"></i>
                                                <i class="fas fa-star review-color"></i>
                                                <i class="fas fa-star review-color"></i>
                                                <i class="fas fa-star review-color"></i>
                                                <i class="fas fa-star review-color"></i>
                                                </div>
                                                @endif
                                                                    
                                            
                                       
                                            <div class="ms-3">
                                                <span class="fz14 text">Published 
                                                   {{ \Carbon\Carbon::parse($review->created_at)->diffForHumans(null, true, false, 2) }}
                                           ago</span></div>
                                          </div>
                                        </div>
                                      </div>
                                      <p class="text mt20 mb20">{{$review->comment}} </p>
                                      
                                        @php
                                          $service = \App\Models\ServiceInformation::find($review->service_information_id);
                                      @endphp
                  
                                      <a href="{{ route('service.details', $service->slug)}}" class="ud-btn bgc-thm4 text-thm">View service</a>
                                    </div>
                                </div>

                                {{-- Display review details, e.g., $review->comment, $review->rating, etc. --}}
                                @endforeach
                       


                                <div class="mbp_pagination text-center mt30">
                                    <ul class="page_navigation">
                                        @for ($i = 1; $i <= $reviews->lastPage(); $i++)
                                            <li class="page-item {{ ($reviews->currentPage() == $i) ? 'active' : '' }}">
                                                <a class="page-link" href="{{ $reviews->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endfor
                                    </ul>
                                    <p class="mt10 mb-0 pagination_page_count text-center">
                                        {{ $reviews->firstItem() }} – {{ $reviews->lastItem() }} of {{ $reviews->total() }} records
                                    </p>
                                </div>
                               
                              </div>
                          
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            

           
        </div>
         
        
       

        
         <!-- Modal for Viewing User Details -->


   





 
         

@endsection
@section('footer_script')


@endsection