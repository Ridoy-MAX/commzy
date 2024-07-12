
@extends('layouts.dashboard')
@section('content')
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
  transition: 0.3s;
}

.inactive{
    color: lightgrey
}
@media only screen and (max-width: 575px) {
  #countdown{
    width: 100%;
  }
  .time_countdown {
      margin-top: 30px !important;
  }
  .time_countdown ul{
    margin-left:  -26px!important;
    padding-left: 0px !important;
  }
  .time_countdown ul li{
    margin: 10px;
  }
  .time_countdown ul li span {
    font-size: 14px !important;
    font-weight: 600;
    padding: 12px 22px !important;
    box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;
    border-radius: 10px !important;
}

.time_countdown ul li p {
    font-size: 12px !important;
    font-weight: 600;
    margin-top: 5px;
    text-align: center;
}

}



.animated {
animation: myAnim 2s ease 0s infinite normal forwards;  color: gold
}

.active {
    color: gold;
}
    /* general styling */
    .time_countdown{
        margin-top: 100px
    }
.time_countdown ul{
    display: flex;
    justify-content: space-between
}
.time_countdown ul li span{
    font-size: 40px;
    font-weight: 600;
    padding: 40px 40px;
    box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;
    border-radius:10px; 
}
.time_countdown ul li p{
    font-size: 18px;
    font-weight: 600;
    margin-top: 5px;
 text-align: center;

}

@media all and (max-width: 768px) {
  h1 {
    font-size: calc(1.5rem * var(--smaller));
  }

  li {
    font-size: calc(1.125rem * var(--smaller));
  }

  li span {
    font-size: calc(3.375rem * var(--smaller));
  }
}

</style>
<div class="row pb40">
    <div class="col-lg-12">
    @include('components.main_component.dashboard_navigation')
      
    </div>
</div>
<div class="container">
 
    <div class="row">
      <div class="col-md-8 ">
        <div class="shop_order_box mt60">
          <div class="order_list_raw">
            <ul class="d-md-flex align-items-center justify-content-md-between p-0 mb-0">
              <li class="mb20-sm">
                <p class="text mb5">Order Number</p>
                <h6 class="mb-0">#0{{$order->id}}</h6>
              </li>
              <li class="mb20-sm">
                <p class="text mb5">Date</p>
                <h6 class="mb-0"> {{ $order->created_at->format('M d y') }}</h6>
              </li>
              <li class="mb20-sm">
                <p class="text mb5">Total</p>
                <h6 class="mb-0">${{$order->rel_to_proposal->price}}</h6>
              </li>
              <li class="mb20-sm">
                <p class="text mb5">Status</p>
                <h6 class="mb-0 pending-style style2">{{$order->status}}</h6>
              </li>
             
            </ul>
          </div>
          <div class="order_details default-box-shadow1">
            @if(session('DeliverWork'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('DeliverWork') }}
                {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
            </div>
            @endif

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            

           @if($order->client_id == auth()->id() && $order->status == 'pending')
           <a href="{{ route('service.checkout', $order->id) }}"
               class="ud-btn mb-5"  
               style="padding: 10px 18px; font-size: 14px; border: 2px solid #E34A6F; background:#E34A6F; color:aliceblue;"> 
               Make payment to active order
           </a>
           @elseif($order->seller_id == auth()->id() && $order->status == 'pending')
              <h2 class="mb-5">Wait until the client activates your order.</h2>
           @endif
       


            
            @if($order->status == 'pending')
           

            @elseif($order->seller_id == auth()->id() && $order->status == 'in process')
                <a href="service.checkout"
                class="ud-btn mb-5"  
                data-bs-toggle="modal" data-bs-target="#exampleModal"
                style="padding: 10px 18px; font-size: 14px; border: 2px solid black; background:#E34A6F;color:aliceblue;"> 
                Deliver now
              </a>

            @endif


            @if($order && $order->client_id == auth()->id() && $order->status == 'complete')
            <section class="breadcumb-section pt-0">
              <div class=" cta-banner mx-auto maxw1700 pt120 pt60-sm pb120 pb60-sm bdrs16 position-relative overflow-hidden d-flex
               align-items-center mx20-lg px30-lg" style="background: #dbadad31">
                <img class="left-top-img " src="http://127.0.0.1:8000/images/vector-img/left-top.png" alt="">
                <img class="right-bottom-img wow  animated" src="http://127.0.0.1:8000/images/vector-img/right-bottom.png" alt="" style="visibility: visible;">
      
                <div class="container">
                  <div class="row" >
                    <div class="col">
                      <div class="position-relative">
                        <h2>Congratulations!  Your order completed successfully </h2>
                    
                      </div>

                      <a class="d-flex" >
                        <span class="position-relative mr10">
      
                
                            @if($order->rel_to_service->rel_to_user->profile_pic)
      
                            <img class=" rounded-circle wa-xs" src="{{ asset($order->rel_to_service->rel_to_user->profile_pic) }}" alt="Profile Picture" 
                            style="height: 35px; width: 35px;">
                            @else
                            <img class=" rounded-circle wa-xs" src="/avatar.jpg" alt="user.png" style="height: 55px; width: 55px;"> 
                              
                            @endif
      
                    
                          {{-- <img class="rounded-circle wa" src="images/team/fl-s-1.png" alt="artist Photo"> --}}
      
      
                          <span class="online-badges"></span>
                        </span>
                        <span class="fz14 mt-1 d-flex">  <p style="font-weight: 600;color:#c04b68;">{{$order->rel_to_service->rel_to_user->name}}</p> 
                          <p class="ms-2" style="font-weight: 400">Deliver your work. 
                             </p> 
                             <p style="font-weight: 600" class="ms-2"> 
                              {{ \Carbon\Carbon::parse($deliverWork->created_at)->diffForHumans(null, true, false, 2) }} ago.</p></span>
                      </a>


                      <p>{{$deliverWork->comment }} </p>

                 
                      <a href="{{ asset($deliverWork->file) }}" class="pending-style style2" style="background: #E34A6F;color:white;" download>Download Attachment</a>
                
                    </div>
                  </div>
                </div>
              </div>
            </section>

            @php
          $existingReview = \App\Models\Review::where('client_id', $order->client_id)
          ->where('service_information_id', $order->service_information_id)
          ->where('order_id', $order->id)
          ->exists();
            @endphp
        

            @if (!$existingReview)
            
              <form class="comments_form mt30 mb30-md" method="POST" action="{{ route('service.review') }}" style="margin-bottom: 40px">
                @csrf

                <p style="font-size: 25px">
                Public feedback
                </p>

                <p style="font-weight: 500"> Share your experince with the community</p>
                <p style="font-weight: 500;font-size: 21px"> Rating the service</p>
              
                <div id="container " class="d-flex" style="width: 40%">
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
                    <label class="fw500 fz16 ff-heading dark-color mb-2">Whats your experince with the seller?</label>
                    <textarea class="pt15" name="comment" rows="6" placeholder="Enter your comment here..."></textarea>
                </div>
                <!-- User's name (assuming it's automatically filled based on the authenticated user) -->
                <div class="row">
                  <div class="col-md-6 mb20">
                  
                    <input type="hidden" class="form-control" value="{{$order->client_id}}"  name="client_id" >
                    <input type="hidden" class="form-control" value="{{$order->seller_id}}"  name="seller_id" >
                    <input type="hidden" class="form-control" value="{{$order->id}}"  name="order_id" >
                    <input type="hidden" class="form-control" value="{{$order->service_information_id}}" name="service_information_id" >
                </div>
                <!-- User's email (assuming it's automatically filled based on the authenticated user) -->
                <div class="col-md-6 mb20">
            
                    <input type="hidden" class="form-control" value="{{ Auth::user()->email }}" disabled>
                </div>
                </div>
              
            
                <!-- Submit button -->
                <button type="submit" class="ud-btn btn-thm">Submit<i class="fal fa-arrow-right-long"></i></button>
              </form>

            @else
              <p class="alert alert-primary">You have already reviewed this service .</p>
            @endif

            @elseif($order && $order->seller_id == auth()->id() && $order->status == 'complete')
            <section class="breadcumb-section pt-0">
              <div class=" cta-banner mx-auto maxw1700 pt120 pt60-sm pb120 pb60-sm bdrs16 position-relative overflow-hidden d-flex
               align-items-center mx20-lg px30-lg" style="background: #dbadad31">
                <img class="left-top-img " src="http://127.0.0.1:8000/images/vector-img/left-top.png" alt="">
                <img class="right-bottom-img wow  animated" src="http://127.0.0.1:8000/images/vector-img/right-bottom.png" alt="" style="visibility: visible;">
      
                <div class="container">
                  <div class="row" >
                    <div class="col">
                      <div class="position-relative">
                        <h2>Congratulations!  You  complete your  order successfully </h2>
                    
                      </div>

                  

                      <p style="font-weight: 600;color:#E34A6F;">Your summery</p>
                      <p>{{$deliverWork->comment }} </p>
                      <p style="font-weight: 600; color:#E34A6F;">Your Attachment file</p>
                 
                      <a href="{{ asset($deliverWork->file) }}" class="pending-style style2" style="background: #E34A6F;color:white;" download>Download Attachment</a>
                
                    </div>
                  </div>
                </div>
              </div>
            </section>
            @endif
             



            {{-- @if($order->status == 'complete') --}}

            @if($order->status == 'in process' && $deliverWork && $deliverWork->client_id == auth()->id() && $deliverWork->status == 'pending')
            
              <div class="alert alert-primary alert-dismissible fade show">
              
                  <a class="d-flex">
                      <!-- Profile Picture -->
                      <span class="position-relative mr10">
                          @if($order->rel_to_service->rel_to_user->profile_pic)
                          <img class=" rounded-circle wa-xs" src="{{ asset($order->rel_to_service->rel_to_user->profile_pic) }}" alt="Profile Picture" style="height: 35px; width: 35px;">
                          @else
                          <img class=" rounded-circle wa-xs" src="/avatar.jpg" alt="user.png" style="height: 55px; width: 55px;"> 
                          @endif
                          <span class="online-badges"></span>
                      </span>
                      <!-- User Name and Action -->
                      <span class="fz14 mt-1 d-flex">
                          <p style="font-weight: 600">{{$order->rel_to_service->rel_to_user->name}}</p>
                          <p class="ms-2" style="font-weight: 600">Send your delivery</p>
                      </span>
                  </a>
              
                  <p>Are you ready to approve it?</p>
              
                  <!-- Buttons for Approve and Cancel -->
                  <div class="d-flex">
                      <a href="" class="ud-btn mb-5" data-bs-toggle="modal" data-bs-target="#exampleModal" style="padding: 10px 18px; font-size: 14px; border: 2px solid black; background:#fcf9f0ce;">Yes</a>

                      
                      <form method="post" action="{{ route('delivery.cancel.post', $deliverWork->id) }}">
                        @csrf
                        @method('POST') <!-- Use POST method for the form -->
                        <button type="submit" class="ud-btn mb-5 ms-3" style="padding: 10px 18px; font-size: 14px; border: 2px solid black; background:#fcf9f0ce;">
                            No
                        </button>
                    </form>
                    
                  </div>
              
                  <!-- Modal -->
                  <div class="modal fade p-3" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="exampleModalLabel">Approve delivery</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                  Once you approve this delivery, your order will be marked as complete.
                              </div>
                              <div class="d-flex">
                                <form method="post" action="{{ route('order.complete.post', $order->id) }}">
                                  @csrf
                                  @method('POST') <!-- Use POST method for the form -->
                                  <button type="submit" class="ud-btn mb-5 ms-3" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                          style="padding: 10px 18px; font-size: 14px; border: 2px solid black; background:#fcf9f0ce;">
                                      Yes
                                  </button>
                              </form>
                                  <button type="button" class="ud-btn mb-5 ms-3" data-bs-dismiss="modal" style="padding: 10px 18px; font-size: 14px; border: 2px solid black; background:#fcf9f0ce;">Cancel</button>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
            @endif
            
        
            
            



            
        


            
            <h4 class="title mb25" >Order details</h4>
            <div class="od_content" style="margin-top: 50px">
         
          
              <!-- Other properties of DeliverWork -->
              
              <!-- Other properties of DeliverWork -->
             
              @php
              $commission = \App\Models\Commission::latest()->first();
              $commissionPercentage = $commission ? $commission->commission : 0;
              $commissionAmount = $order->rel_to_proposal->price * ($commissionPercentage / 100);
              $servicePriceAfterCommission = $order->rel_to_proposal->price - $commissionAmount;
          @endphp
          
          @if ($commission)
              <ul class="p-0 mb-0">
                  <li class="bdrb1 mb20">
                      <h6>Service <span class=""></span> <span class="float-end">Duration</span></h6>
                  </li>
                  <li class="mb20">
                      <p class="body-color tag">{{$order->rel_to_service->service_title}}</p>
                      <p class="body-color float-end">{{$order->rel_to_proposal->delivery_time}} days</p>
                  </li>
                  <li class="mb15"><h6>Total <span class="float-end">${{$order->rel_to_proposal->price}}</span></h6></li>
                  <li class="bdrb1 mb20">
                      <h6>Commission {{$commission->commission}}% <span class="float-end">-${{ $commissionAmount }}</span></h6>
                  </li>
                  <li >
                      <h6>Service Price After Commission <span class="float-end">${{ $servicePriceAfterCommission }}</span></h6>
                  </li>
              </ul>
          @else
              <p>No commission record found.</p>
          @endif
          

            </div>







            @if($order->status == 'pending')


            @elseif($order->status == 'in process')
            <div class="card p-4" style="background: #e34f4a44">
              <h2 style="margin-top: 0px" class="text-center">  {{ $remainingDays }} days remaining.</h2>
            </div>
          
             
             {{-- <div class="time_countdown">

                <div class="container">
                    <h1 id="headline"></h1>
                    <div id="countdown">
                      <ul class="d-flex">
                        <li class=""><span id="days"></span> <p>Days</p></li>
                        <li><span id="hours"></span> <p>Hours</p></li>
                        <li><span id="minutes"></span> <p>Minutes</p></li>
                        <li><span id="seconds"></span> <p>Seconds</p></li>
                      </ul>
                    </div>
                    <div id="content" class="emoji">
                  
                    </div>
                  </div>

             </div> --}}
          
          
              <div class="od_content " style="margin-top: 100px">
                  <h4 class="title mb25">Checkout details</h4>
                  <div class="row">
                      <div class="col-md-6">
                          <h6>Name</h6>
                          <p class="from-control">{{$order->rel_to_checkout->name}}</p>
                      </div>
                      @if($order->rel_to_checkout->email)
                      <div class="col-md-6">
                          <h6>Email</h6>
                          <p class="from-control">{{$order->rel_to_checkout->email}}</p>
                      </div>
                      @endif
                    
                    
                
                      @if($order->rel_to_checkout->company)
                      <div class="col-md-6">
                          <h6>Company Name</h6>
                          <p class="from-control">{{$order->rel_to_checkout->company}}</p>
                      </div>
                      @endif
                      @if($order->rel_to_checkout->country)
                      <div class="col-md-6">
                          <h6>Country</h6>
                          <p class="from-control">     {{ \App\Models\Country::find($order->rel_to_checkout->country)->name }} </p>
                      </div>
                      @endif
                      @if($order->rel_to_checkout->city)
                      <div class="col-md-6">
                          <h6>City</h6>
                          <p class="from-control"> {{ \App\Models\City::find($order->rel_to_checkout->city)->name }}  </p>
                      </div>
                      @endif
                      @if($order->rel_to_checkout->state)
                      <div class="col-md-6">
                          <h6>State</h6>
                          <p class="from-control">{{$order->rel_to_checkout->state}}</p>
                      </div>
                      @endif
                      @if($order->rel_to_checkout->house)
                      <div class="col-md-6">
                          <h6>House</h6>
                          <p class="from-control">{{$order->rel_to_checkout->house}}</p>
                      </div>
                      @endif
                      @if($order->rel_to_checkout->apartment)
                      <div class="col-md-6">
                          <h6>Apartment</h6>
                          <p class="from-control">{{$order->rel_to_checkout->apartment}}</p>
                      </div>
                      @endif
                      @if($order->rel_to_checkout->phone)
                      <div class="col-md-6">
                          <h6>Phone</h6>
                          <p class="from-control">{{$order->rel_to_checkout->phone}}</p>
                      </div>
                      @endif
                  

                      @if($order->rel_to_checkout->additional)
                      <div class="col-md-12">
                          <h6>Additional</h6>
                          <p class="from-control">{{$order->rel_to_checkout->additional}}</p>
                      </div>
                      @endif
                  </div>
              
                  <ul class="p-0 mb-0">
                    <li class="bdrb1 mb20">
                      
                  
                
                  
                  </ul>
              </div>

            @endif

            @if($order->status == 'in process' && $extenddelivery && $extenddelivery->seller_id == auth()->id() && $extenddelivery->status == 'pending')
              <div class="card p-3 mb-3">
                <div class=" d-flex">
                  <p style="font-weight: 600"> Your request to extend the delivery time .</p> <span class="ms-3">
                    {{ \Carbon\Carbon::parse($extenddelivery->created_at)->diffForHumans(null, true, false, 2) }} ago.
                </span>
                </div>

                <p>Your requested delivery time:{{$extenddelivery->delivery_time}}days </p>

                <p style="font-weight: 600">Your reason for extend the delivery time </p>
                <p>{{$extenddelivery->reason}}</p>

                <form method="post" action="{{ route('extend.delivery.cancel.post', $extenddelivery->id) }}">
                  @csrf
                  @method('POST') <!-- Use POST method for the form -->
                  <button type="submit" class="ud-btn" style="border: 2px solid black; background:#fcf9f0ce;">
                      Cancel request
                  </button>
              </form>
              
              </div>
        
            @endif



            @if($order->status == 'in process' && $cancelorder && $cancelorder->user_id == auth()->id() && $cancelorder->status == 'pending')
              <div class="card p-3 mb-3" style="background: #e34a7036">
                <div class=" d-flex">
                  <p style="font-weight: 600"> Order cancel request has been send.</p> <span class="ms-3">
                    {{ \Carbon\Carbon::parse($cancelorder->created_at)->diffForHumans(null, true, false, 2) }} ago.
                </span>
                </div>

             

                <p style="font-weight: 600"> Reason for order cancel request </p>
                <p>{{$cancelorder->reason}}</p>

          
                <form action="{{ route('order.cancel.reject', $cancelorder->id) }}" method="POST">
                  @csrf
                  @method('PATCH') <!-- Use PATCH method for updating existing records -->
                  <button type="submit" class="ud-btn ms-3" style="border: 2px solid black;background:#fcf9f0ce;">Cancel request</button>
              </div>

              @elseif($order->status == 'in process' && $cancelorder && $cancelorder->status == 'pending')

              <div class="card p-3 mb-3" style="background: #e34a7036">
              
                <div class=" d-flex">
                  <p style="font-weight: 600"> Order cancel request has been receive.</p> <span class="ms-3">
                    {{ \Carbon\Carbon::parse($cancelorder->created_at)->diffForHumans(null, true, false, 2) }} ago.
                </span>
                </div>


             

                <p style="font-weight: 600"> Reason for cancel request </p>
                <p>{{$cancelorder->reason}}</p>

                <div class="d-flex">
                  {{-- <a href="{{ route('order.cancel',$cancelorder->order_id)}}"
                    class="ud-btn "  style="   border: 2px solid black;background:#fcf9f0ce;">Approve request</a> --}}

                    <form action="{{ route('order.cancel', $order->id) }}" method="post">
                      @csrf
                      @method('POST')
                      <button type="submit" class="ud-btn ms-3" style=" border: 2px solid black;background:#fcf9f0ce;">Approve request</button>
                    </form>

                    <form action="{{ route('order.cancel.reject', $cancelorder->id) }}" method="POST">
                      @csrf
                      @method('PATCH') <!-- Use PATCH method for updating existing records -->
                      <button type="submit" class="ud-btn ms-3" style="border: 2px solid black;background:#fcf9f0ce;">Cancel request</button>
                  </form>
                  

                </div>

            
              </div>


        
             @endif

{{-- 
            @if($order->status == 'in process' && $cancelorder && $cancelorder->user_id == auth()->id() && $cancelorder->status == 'pending')
           
        
            @endif --}}






            @if($order->status == 'in process' && $extenddelivery && $extenddelivery->client_id == auth()->id() && $extenddelivery->status == 'pending')
              <div class="card p-3 mb-3">

                <a class="d-flex" >
                  <span class="position-relative mr10">

          
                      @if($order->rel_to_service->rel_to_user->profile_pic)

                      <img class=" rounded-circle wa-xs" src="{{ asset($order->rel_to_service->rel_to_user->profile_pic) }}" alt="Profile Picture" 
                      style="height: 35px; width: 35px;">
                      @else
                      <img class=" rounded-circle wa-xs" src="/avatar.jpg" alt="user.png" style="height: 55px; width: 55px;"> 
                        
                      @endif

              
                    {{-- <img class="rounded-circle wa" src="images/team/fl-s-1.png" alt="artist Photo"> --}}


                    <span class="online-badges"></span>
                  </span>
                  <span class="fz14 mt-1 d-flex"><p style="font-weight: 600">{{$order->rel_to_service->rel_to_user->name}}</p> 
                    <p class="ms-2" style="font-weight: 400">request to extend the delivery time  
                       </p> 
                       <p style="font-weight: 600" class="ms-2"> 
                        {{ \Carbon\Carbon::parse($extenddelivery->created_at)->diffForHumans(null, true, false, 2) }} ago.</p></span>
                </a>



                <p> Requested delivery time:{{$extenddelivery->delivery_time}}days </p>

                <p style="font-weight: 600"> Reason for extend the delivery time </p>
                <p>{{$extenddelivery->reason}}</p>

                <div class="d-flex">

                  <form action="{{ route('extend.delivery.approve',$extenddelivery->id)}}" method="POST">
                    @csrf
                    <input type="hidden" value="{{$extenddelivery->delivery_time}}" name="delivery_time">

                    <input type="hidden" value="{{$order->rel_to_proposal->id}}" name="proposal_id">
                    <input type="hidden" value="{{$order->rel_to_proposal->delivery_time}}" name="proposal_daivery_time">


                    <button type="submit"

                      class="ud-btn "  style="border: 2px solid black;background:#fcf9f0ce;">Approve request
                    </button>
                  </form>
                
                  <form method="post" action="{{ route('extend.delivery.cancel.post', $extenddelivery->id) }}">
                    @csrf
                    @method('POST') <!-- Use POST method for the form -->
                    <button type="submit" class="ud-btn ms-3" style="border: 2px solid black; background:#fcf9f0ce;">
                        Cancel request
                    </button>
                </form>
                </div>

     
              </div>
        
            @endif

            
            @if($order->status == 'in process' && $extenddelivery && $extenddelivery->client_id == auth()->id() && $extenddelivery->status == 'approve')


          
        
            @endif


            @foreach($approvedelivery as $approvedelivery)
                @if($order->status == 'in process' && $approvedelivery && $approvedelivery->seller_id == auth()->id() )

          
                    <div class="card p-3 mb-3">

                      <a class="d-flex" >
                        <span class="position-relative mr10">

                
                      @php
                          $client = \App\Models\User::find($order->client_id);
                      @endphp
                      
                      @if( $client->profile_pic)
                          <img class="rounded-circle wa-xs" src="{{ asset($client->profile_pic) }}" alt="Profile Picture" style="height: 35px; width: 35px;">
                      @else
                          <img class="rounded-circle wa-xs" src="/avatar.jpg" alt="user.png" style="height: 55px; width: 55px;"> 
                      @endif
                      
                          
                      

                    
                          {{-- <img class="rounded-circle wa" src="images/team/fl-s-1.png" alt="artist Photo"> --}}


                          <span class="online-badges"></span>
                        </span>
                        <span class="fz14 mt-1 d-flex"><p style="font-weight: 600">{{$client->name}}</p> 
                          <p class="ms-2" style="font-weight: 400"> Accepted your request to extend the delivery  
                            </p> 
                            <p style="font-weight: 600" class="ms-2"> 
                              {{ \Carbon\Carbon::parse($approvedelivery->created_at)->diffForHumans(null, true, false, 2) }} ago.</p></span>
                        </a>



                      <p>Your requested delivery time:{{$approvedelivery->delivery_time}}days </p>

                      <p style="font-weight: 600">Your reason for extend the delivery time </p>
                      <p>{{$approvedelivery->reason}}</p>
                      <p style="font-weight: 600"> New delivery date </p>
                      <p> {{ $order->created_at->addDays($approvedelivery->new_delivery_time)->format('M d y') }}</p>

          
                    </div>
              
                @elseif($order->status == 'in process' && $approvedelivery && $approvedelivery->client_id == auth()->id() )
                    <div class="card p-3 mb-3">

                      <a class="d-flex" >
                        <span class="position-relative mr10">
      
                
                            @if($order->rel_to_service->rel_to_user->profile_pic)
      
                            <img class=" rounded-circle wa-xs" src="{{ asset($order->rel_to_service->rel_to_user->profile_pic) }}" alt="Profile Picture" 
                            style="height: 35px; width: 35px;">
                            @else
                            <img class=" rounded-circle wa-xs" src="/avatar.jpg" alt="user.png" style="height: 55px; width: 55px;"> 
                              
                            @endif
      
                    
                          {{-- <img class="rounded-circle wa" src="images/team/fl-s-1.png" alt="artist Photo"> --}}
      
      
                          <span class="online-badges"></span>
                        </span>
                        <span class="fz14 mt-1 d-flex"><p style="font-weight: 600">{{$order->rel_to_service->rel_to_user->name}}</p> 
                          <p class="ms-2" style="font-weight: 400">request han been accepted.  
                            </p> 
                            <p style="font-weight: 600" class="ms-2"> 
                              {{ \Carbon\Carbon::parse($approvedelivery->created_at)->diffForHumans(null, true, false, 2) }} ago.</p></span>
                      </a>
      
      
      
                      <p> Requested delivery time:{{$approvedelivery->delivery_time}}days </p>
      
                      <p style="font-weight: 600"> Reason for extend the delivery time </p>
                      <p>{{$approvedelivery->reason}}</p>
                      <p style="font-weight: 600"> New delivery date </p>
                      <p> {{ $order->created_at->addDays($approvedelivery->new_delivery_time)->format('M d y') }}</p>
      
          
                    </div>
                @endif
            @endforeach
 
         

          </div>
        </div>            
      </div>

          <div class="col-md-3  mt60">
            <a> 
            <div class="listing-style1 default-box-shadow1 bdrs16">
              <div class="list-thumb">
                <div class="listing-thumbIn-slider position-relative navi_pagi_bottom_center slider-1-grid owl-carousel owl-theme">
             
                  {{-- @if($service->rel_to_service) --}}
            
                           @foreach($order->rel_to_service->rel_to_gallery as $gallery)
                              <div class="item">
                                <img class="w-100" src="{{ asset('service/gallery/' . $gallery->image) }}" alt="iamge" style="height: 250px;">

                                <form action="{{ route('favourite.save')}}" method="post">
                                  @csrf
                                  <input type="hidden" value="{{$order->rel_to_service->id}}" name="service_information_id">
                                  {{-- <button  class="listing-fav fz12" type="submit" style="border: none"  
                                   data-bs-toggle="tooltip" data-bs-placement="top"
                                  data-bs-custom-class="custom-tooltip"
                                  data-bs-title="Add your favourite list"> <span class="far fa-heart"></span> </button> --}}
                                </form>
                              
                              </div>
                              @endforeach
                  {{-- @endif --}}
               

             
                </div>
              </div>

              <div class="list-content">
             

            

                <p class="list-text body-color fz14 mb-1">{{$order->rel_to_service->category->name}}</p>
                <h5 class="list-title" style="height: 60px">
                    <a href="{{ route('service.details', $order->rel_to_service->slug)}}">{{ implode(' ', array_slice(str_word_count($order->rel_to_service->service_title, 2), 0, 10)) }}</a>
                </h5>
             
                {{-- <div class="review-meta d-flex align-items-center">
                  <i class="fas fa-star fz10 review-color me-2"></i>
                  <p class="mb-0 body-color fz14"><span class="dark-color me-2">4.82</span>94 reviews</p>
                </div> --}}

                @php
                $totalReviews = $order->rel_to_service->rel_to_review->count();
                $sumRatings = 0;
                foreach ($order->rel_to_service->rel_to_review as $review) {
                    $sumRatings += $review->rating;
                }
                $averageRating = $totalReviews > 0 ? number_format($sumRatings / $totalReviews, 2) : 0;
                @endphp


                <div class="review-meta d-flex align-items-center">
                    <i class="fas fa-star fz10 review-color me-2"></i>
                    <p class="mb-0 body-color fz14"><span
                    class="dark-color me-2">  {{ $averageRating }}</span>{{$order->rel_to_service->rel_to_review->count()}} reviews</p>
                </div>

                
                <hr class="my-2">
                <div class="list-meta d-flex justify-content-between align-items-center mt15">
                  <a class="d-flex" >
                    <span class="position-relative mr10">

            
                        @if($order->rel_to_service->rel_to_user->profile_pic)

                        <img class=" rounded-circle wa-xs" src="{{ asset($order->rel_to_service->rel_to_user->profile_pic) }}" alt="Profile Picture" style="height: 35px; width: 35px;">
                        @else
                        <img class=" rounded-circle wa-xs" src="/avatar.jpg" alt="user.png" style="height: 55px; width: 55px;"> 
                          
                        @endif

                 
                      {{-- <img class="rounded-circle wa" src="images/team/fl-s-1.png" alt="artist Photo"> --}}


                      <span class="online-badges"></span>
                    </span>
                    <span class="fz14 mt-1">{{$order->rel_to_service->rel_to_user->name}}</span>
                  </a>

            

                  <div class="budget">
                    <p class="mb-0 body-color"><span class="fz17 fw500 dark-color ms-1"
                        style="color: #E34A6F;">${{$order->rel_to_service->price}}</span></p>
                  </div>
                </div>
              </div>
            </div>
            </a>


            @if($order->status == 'in process')
                <p>To extend delivery time or cancel order visite resulation center</p>
                <a href="{{ route('order.resulation',$order->id)}}"
                  class="ud-btn "          style="padding: 10px 18px; font-size: 12px;    border: 2px solid black;background:#fcf9f0ce;"> 
                  Resolution center
              </a>
           
            @endif

          </div>
     
    </div>
  </div>








  <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-lg">

    <form action="{{ route('deliver.work') }}" method="POST" enctype="multipart/form-data">
      @csrf

    
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Deliver your work</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
          <div class="mb-3">
            <label for="formFile" class="form-label">Attachment your file</label>

            <input class="form-control" type="file" id="formFile" name="file" required>

         
            <p>max 1 gb</p>
          </div>

          <div class="mb-3">
            <label class="form-label">Write something</label>
            <textarea class="form-control" rows="10" name="comment" required style="height: 300px"></textarea> <!-- Change to 'comment' -->
        </div>
    
        <input type="hidden" value="{{$order->id}}" name="order_id">
        <input type="hidden" value="{{$order->seller_id}}" name="seller_id">
        <input type="hidden" value="{{$order->client_id}}" name="client_id">

        </div>

        <div class="modal-footer">
          <button type="button" class="ud-btn" data-bs-dismiss="modal" style="   border: 2px solid black;background:#fcf9f0ce;">Close</button>
          <button type="submit" class="ud-btn "  style="   border: 2px solid black;background:#fcf9f0ce;">Submit</button>
        </div>
      </div>

    </form>
  </div>
</div>
{{-- @php
use Carbon\Carbon;
$remainingDays = Carbon::now()->diffInDays($order->deliverydates);
@endphp --}}


  @endsection
@section('footer_script')

<script>

(function () {
    // Get the delivery time from the order's related proposal (assuming it's in days)
    const deliveryTimeInDays = {{ $remainingDays }};
    const deliveryTimeInMilliseconds = deliveryTimeInDays * 24 * 60 * 60 * 1000;

    const countDown = new Date(Date.now() + deliveryTimeInMilliseconds).getTime(),
        x = setInterval(function () {
            const now = new Date().getTime(),
                distance = countDown - now;

            document.getElementById("days").innerText = Math.floor(distance / (1000 * 60 * 60 * 24));
            document.getElementById("hours").innerText = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            document.getElementById("minutes").innerText = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            document.getElementById("seconds").innerText = Math.floor((distance % (1000 * 60)) / 1000);

            // Do something later when the date is reached
            if (distance < 0) {
                document.getElementById("headline").innerText = "your delivery is running late.";
                document.getElementById("countdown").style.display = "none";
                document.getElementById("content").style.display = "block";
                clearInterval(x);
            }
        }, 1000); // Update every 1 second (1000 milliseconds)
})();


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
    for (let i = 0; i <= 4; i++) {
        if (i > index) {
            e.target.parentNode.children[i].classList.remove("animated");
        }
    }
}

function set(e) {
    const index = e.target.getAttribute("data-index");
    const ratingValue = parseInt(index) + 1;

    for (let i = 0; i <= 4; i++) {
        e.target.parentNode.children[i].classList.remove("active");
    }

    for (let i = 0; i <= index; i++) {
        e.target.parentNode.children[i].classList.add("active");
    }

    // Set the rating value in the hidden input field
    document.querySelector('input[name="rating"]').value = ratingValue;
}




</script>


@endsection