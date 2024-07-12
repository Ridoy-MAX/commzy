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
                        <h2>Manage Services</h2>
                        <p class="text">Manage your Service list</p>
                        </div>
                    </div>

                 
                </div>
            

             
                
               
                <div class="row">
                  <div class="col-xl-12">
                    <div class="ps-widget bgc-white bdrs4 p30 mb30 overflow-hidden position-relative">
                      @if(session('success'))
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                          {{ session('success') }}
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                      @endif
                      <div class="navtab-style1">
                        <nav>
                          <div class="nav nav-tabs mb30" id="nav-tab2" role="tablist">
                            <button class="nav-link active fw500 ps-0" id="nav-item1-tab" data-bs-toggle="tab" data-bs-target="#nav-item1" type="button" role="tab" aria-controls="nav-item1" aria-selected="true">Active Services</button>
                            <button class="nav-link fw500" id="nav-item2-tab" data-bs-toggle="tab" data-bs-target="#nav-item2" type="button" role="tab" aria-controls="nav-item2" aria-selected="false">Deacvtive Services</button>

                            <button class="nav-link fw500" id="nav-item3-tab" data-bs-toggle="tab" data-bs-target="#nav-item3" type="button" role="tab" aria-controls="nav-item3" aria-selected="false">Incomplete Services</button>
                           
                          </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                          
                          <div class="tab-pane fade show active" id="nav-item1" role="tabpanel" aria-labelledby="nav-item1-tab">
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
                                        <div class="d-flex">
              
                                       
                                            
                                          
                
                                      
                
                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="deleteModal1" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete this education record?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="ud-btn" data-bs-dismiss="modal">Cancel</button>
                                                            <form method="post" action="http://127.0.0.1:8000/user/destroy1">
                                                                <input type="hidden" name="_token" value="PNOdfxpL7LonuoTFnAxLgNp5e5NVkkxlSyze2oKB">                                                <input type="hidden" name="_method" value="DELETE">                                                <button class="ud-btn btn-thm" type="submit">Delete<i class="fal fa-arrow-right-long"></i>
                                                                    </button>
                                                             
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                
                                          
                                        </div>
                                      </div>
                                      @endforeach
                                      {{-- @endif --}}
                                   

                                 
                                    </div>
                                  </div>
                                  <div class="list-content">
                                    <form action="{{ route('service.delete', ['id' => $service->id]) }}" method="POST" class="d-inline">
                                      @csrf
                                      
                                      <button type="submit" class="icon m-3" data-bs-toggle="tooltip" data-bs-placement="top"
                                          data-bs-custom-class="custom-tooltip" data-bs-title="Delete your service!"
                                          style="background: #ffffff; padding: 5px 10px; border-radius: 56px; width: 40px !important; position: absolute; top: -229px; z-index: 9; right: 0;">
                                          <span class="flaticon-delete"></span>
                                      </button>
                                  </form>
                                  

                                  <form action="{{ route('service.block', ['id' => $service->id]) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="icon m-3" data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-custom-class="custom-tooltip" data-bs-title="Deactivate your service!"
                                        style="background: #ffffff; padding: 5px 10px; border-radius: 56px; position: absolute; top: -180px; z-index: 9; right: 0;">
                                        <i class="fa-solid fa-ban"></i>
                                    </button>
                                </form>
                                


                                    <a href="{{ route('information.update',  $service->id)}} " type="button" class="icon m-3" 
                                      data-bs-toggle="tooltip" data-bs-placement="top"
                                      data-bs-custom-class="custom-tooltip"
                                      data-bs-title="Edit your service!"
                                      style="
                                      background: #ffffff;
                                        padding: 5px 10px;
                                        border-radius: 56px;
                                      
                                        position: absolute;
                                        top: -130px;
                                        z-index: 9;
                                        right: 0; "
                                      >
                                      <span class="flaticon-pencil"></span>
                                   </a>

                                    <p class="list-text body-color fz14 mb-1">{{$service->category->name }}</p>
                                    <h5 class="list-title" style="height: 60px">
                                      <a href="{{ route('service.details', $service->slug)}}">{{ implode(' ', array_slice(str_word_count($service->service_title, 2), 0, 10)) }}</a>
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
                                      <a href="#">
                                        <span class="position-relative mr10">
                                          @if(Auth::user()->profile_pic)
                                          <img class="rounded-circle" src="{{ asset(Auth::user()->profile_pic) }}" alt="Profile Picture" style="height: 40px; width: 40px; position: relative; top: 0px;">
                                          @else
                                          <img class=" rounded-circle" src="/avatar.jpg" alt="user.png" style="height: 40px; width: 40px;
                                           position: relative; top: 0px;"> 
                                            
                                          @endif

                                          
                                          <span class="online-badge"></span>
                                        </span>
                                        <span class="fz14">{{Auth::user()->name}}</span>
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
                          
                          </div>

                          <div class="tab-pane fade" id="nav-item2" role="tabpanel" aria-labelledby="nav-item2-tab">
                            <div class="row">
                            
                              @foreach($deactiveservices as $key => $service)
                              <div class="col-md-3">
                                <div class="listing-style1 default-box-shadow1 bdrs16">
                                  <div class="list-thumb">
                                    <div class="listing-thumbIn-slider position-relative navi_pagi_bottom_center slider-1-grid owl-carousel owl-theme">
                                 
                                      {{-- @if($service->rel_to_service) --}}
                                      @foreach($service->rel_to_gallery as $gallery)
                                      <div class="item">
                                        <img class="w-100" src="{{ asset('service/gallery/' . $gallery->image) }}" alt="iamge" style="height: 250px;">
                                        <div class="d-flex">
              
                                         
                                            
                                          
                
                                          
                                            <!-- Delete Button (Using Bootstrap Modal for Confirmation) -->
                                         
                                        
                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="delete{{$service->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete this education record?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="ud-btn" data-bs-dismiss="modal">Cancel</button>
                                                            <a href="{{ route('service.delete',['id' => $service->id])}}" class="ud-btn" data-bs-dismiss="modal">Delte</a>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                       
                
                
                                          
                                        </div>
                                      </div>
                                      @endforeach
                                      {{-- @endif --}}
                                   

                                 
                                    </div>
                                  </div>
                                  <div class="list-content">
                                    <form action="{{ route('service.delete', ['id' => $service->id]) }}" method="POST" class="d-inline">
                                      @csrf
                                      
                                      <button type="submit" class="icon m-3" data-bs-toggle="tooltip" data-bs-placement="top"
                                          data-bs-custom-class="custom-tooltip" data-bs-title="Delete your service!"
                                          style="background: #ffffff; padding: 5px 10px; border-radius: 56px; width: 40px !important; position: absolute; top: -229px; z-index: 9; right: 0;">
                                          <span class="flaticon-delete"></span>
                                      </button>
                                    </form>

                                  <form action="{{ route('service.active', ['id' => $service->id]) }}" method="POST" class="d-inline">
                                    @csrf
                     
                                    <button type="submit" class="icon m-3" data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-custom-class="custom-tooltip" data-bs-title="Active your service!"
                                        style="background: #ffffff; padding: 5px 10px; border-radius: 56px; position: absolute; top: -180px; z-index: 9; right: 0;">
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                  </form>
                                

                                    <a href="{{ route('information.update',  $service->id)}} " type="button" class="icon m-3" 
                                      data-bs-toggle="tooltip" data-bs-placement="top"
                                      data-bs-custom-class="custom-tooltip"
                                      data-bs-title="Edit your service!"

                                      style="
                                        background: #ffffff;
                                        padding: 5px 10px;
                                        border-radius: 56px;
                                        position: absolute;
                                        top: -130px;
                                        z-index: 9;
                                        right: 0; "
                                      >
                                      <span class="flaticon-pencil"></span>
                                   </a>

                                    <p class="list-text body-color fz14 mb-1">{{$service->category->name }}</p>
                                    <h5 class="list-title" style="height: 60px">
                                      <a href="{{ route('service.details', $service->slug)}}"> 
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


                                    {{-- <div class="review-meta d-flex align-items-center">
                                      <i class="fas fa-star fz10 review-color me-2"></i>
                                      <p class="mb-0 body-color fz14"><span class="dark-color me-2">4.82</span>94 reviews</p>
                                    </div> --}}
                                    <hr class="my-2">
                                    <div class="list-meta d-flex justify-content-between align-items-center mt15">
                                      <a href="#">
                                        <span class="position-relative mr10">
                                          @if(Auth::user()->profile_pic)
                                          <img class="rounded-circle" src="{{ asset(Auth::user()->profile_pic) }}" alt="Profile Picture" style="height: 40px; width: 40px; position: relative; top: 0px;">
                                          @else
                                          <img class=" rounded-circle" src="/avatar.jpg" alt="user.png" style="height: 40px; width: 40px;
                                           position: relative; top: 0px;"> 
                                            
                                          @endif

                                          
                                          <span class="online-badge"></span>
                                        </span>
                                        <span class="fz14">{{Auth::user()->name}}</span>
                                      </a>
                                      <div class="budget">
                                        <p class="mb-0 body-color"><span class="fz17 fw500 dark-color ms-1"
                                            style="color: #E34A6F;">${{$service->price}}</span></p>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              @endforeach
                            </div>
                          </div>
                          <div class="tab-pane fade" id="nav-item3" role="tabpanel" aria-labelledby="nav-item3-tab">
                            <div class="row">
                            
                              @foreach($incompleteservices as $key => $service)
                              <div class="col-md-3">
                                <div class="listing-style1 default-box-shadow1 bdrs16">
                                  <div class="list-thumb">
                                    <div class="listing-thumbIn-slider position-relative navi_pagi_bottom_center slider-1-grid owl-carousel owl-theme">
                                 
                                      {{-- @if($service->rel_to_service) --}}
                                      @if($service->rel_to_gallery->isEmpty())
                                      <!-- If there are no gallery images, display default image -->
                                      <div class="item">
                                          <img class="w-100" src="{{ asset('path_to_your_default_image.jpg') }}" alt="Default Image" style="height: 250px;">
                                      </div>

                                      @else
                                          <!-- Loop through gallery images -->
                                          @foreach($service->rel_to_gallery as $gallery)
                                      <div class="item">
                                        <img class="w-100" src="{{ asset('service/gallery/' . $gallery->image) }}" alt="iamge" style="height: 250px;">
                                        <div class="d-flex">

                                            <!-- Delete Button (Using Bootstrap Modal for Confirmation) -->

                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="delete{{$service->slug}}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete this education record?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="ud-btn" data-bs-dismiss="modal">Cancel</button>
                                                            <a href="{{ route('service.delete',['id' => $service->id])}}" class="ud-btn" data-bs-dismiss="modal">Delte</a>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
  
                                        </div>
                                      </div>
                                      @endforeach
                                      @endif

                                
                                      {{-- @endif --}}
                                   

                                 
                                    </div>
                                  </div>
                                  <div class="list-content">
                                  
                                    <form action="{{ route('service.delete', ['id' => $service->id]) }}" method="POST" class="d-inline">
                                      @csrf
                                      
                                      <button type="submit" class="icon m-3" data-bs-toggle="tooltip" data-bs-placement="top"
                                          data-bs-custom-class="custom-tooltip" data-bs-title="Delete your service!"
                                          style="background: #ffffff; padding: 5px 10px; border-radius: 56px; width: 40px !important; position: absolute; top: -229px; z-index: 9; right: 0;">
                                          <span class="flaticon-delete"></span>
                                      </button>
                                  </form>

                                    <a href="{{ route('information.update',  $service->slug)}} " class="icon  m-3"  
                                      data-bs-toggle="tooltip" data-bs-placement="top"
                                      data-bs-custom-class="custom-tooltip"
                                      data-bs-title="Fill  your full information  to active your service!"
                                      style="
                                    background: #ffffff;
                                      padding: 5px 10px;
                                      border-radius: 56px;
                                    
                                      position: absolute;
                                      top: -180px;
                                      z-index: 9;
                                      right: 0; "
                                      >
                                      <i class="fa-solid fa-check"></i>
                                    </a>

                                    {{-- <a href="{{ route('information.update', ['id' => $service->id])}} " type="button" class="icon m-3" 
                                      style="
                                      background: #ffffff;
                                        padding: 5px 10px;
                                        border-radius: 56px;
                                      
                                        position: absolute;
                                        top: -130px;
                                        z-index: 9;
                                        right: 0; "
                                      >
                                      <span class="flaticon-pencil"></span>
                                   </a> --}}

                                    <p class="list-text body-color fz14 mb-1">{{$service->category->name }}</p>
                                    <h5 class="list-title" style="height: 60px">
                                      <a href="{{ route('service.details', $service->slug)}}">{{ implode(' ', array_slice(str_word_count($service->service_title, 2), 0, 10)) }}</a>
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
                                      class="dark-color me-2">  {{ $averageRating }} </span>{{$service->rel_to_review->count()}} reviews</p>
                                  </div>


                                    {{-- <div class="review-meta d-flex align-items-center">
                                      <i class="fas fa-star fz10 review-color me-2"></i>
                                      <p class="mb-0 body-color fz14"><span class="dark-color me-2">4.82</span>94 reviews</p>
                                    </div> --}}
                                    <hr class="my-2">
                                    <div class="list-meta d-flex justify-content-between align-items-center mt15">
                                      <a href="#">
                                        <span class="position-relative mr10">
                                          @if(Auth::user()->profile_pic)
                                          <img class="rounded-circle" src="{{ asset(Auth::user()->profile_pic) }}" alt="Profile Picture" style="height: 40px; width: 40px; position: relative; top: 0px;">
                                          @else
                                          <img class=" rounded-circle" src="/avatar.jpg" alt="user.png" style="height: 40px; width: 40px;
                                           position: relative; top: 0px;"> 
                                            
                                          @endif

                                          
                                          <span class="online-badge"></span>
                                        </span>
                                        <span class="fz14">{{Auth::user()->name}}</span>
                                      </a>
                                      <div class="budget">
                                        <p class="mb-0 body-color"><span class="fz17 fw500 dark-color ms-1"
                                            style="color: #E34A6F;">${{$service->price}}</span></p>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              @endforeach
                            </div>
                          </div>
                        
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
        </div>
         
        
       

        
         <!-- Modal for Viewing User Details -->


   



         <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

         <script>
             $(document).ready(function() {
                 $('#blockServiceBtn').on('click', function(e) {
                     e.preventDefault();
                     var serviceId = $(this).data('service-id');
                     
                     $.ajax({
                         url: '/service/block/' + serviceId,
                         type: 'POST',
                         dataType: 'json',
                         headers: {
                             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                         },
                         success: function(response) {
                             // Handle success response (if needed)
                             console.log(response.message);
                             // Reload the page or update UI as needed
                             location.reload();
                         },
                         error: function(xhr, status, error) {
                             // Handle error response (if needed)
                             console.error(error);
                         }
                     });
                 });
             });
         </script>
         

@endsection
@section('footer_script')


@endsection