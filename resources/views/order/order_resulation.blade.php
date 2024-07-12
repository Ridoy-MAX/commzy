
@extends('layouts.dashboard')
@section('content')
<style>
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
                <p class="text mb5">Order Date</p>
                <h6 class="mb-0"> {{ $order->created_at->format('M d y') }}</h6>
              </li>
              <li class="mb20-sm">
                <p class="text mb5">Total Cost</p>
                <h6 class="mb-0">${{$order->rel_to_checkout->service_price+$order->rel_to_checkout->shipping_price}}</h6>
              </li>
              <li>
                <p class="text mb5">Status</p>
                <h6 class="mb-0 pending-style style2">{{$order->status}}</h6>
              </li>
            </ul>
          </div>
          <div class="order_details default-box-shadow1">
            <h4 class="title mb25">Resolution center</h4>
            <p>Welcome! here you can resolve issue regarding your order.</p>
            <div class="bdrb1 "></div>
                <div class="od_content" style="margin-top: 40px">

                  @if($order->status == 'in process' && $order->client_id == auth()->id())
                      <a href="#" class="ud-btn ms-3" 
                      data-bs-toggle="modal" data-bs-target="#exampleModal"
                      style=" font-size: 16px;    border: 2px solid rgb(53, 53, 53);background:#fcf9f0ce;">   
                          Ask the seller to cancel the order.
                          <i class="fa-solid fa-arrow-right ms-2"></i>
                    </a>

                    @else

                    <a href="#" class="ud-btn ms-3" 
                    data-bs-toggle="modal" data-bs-target="#exampleModal"
                    style=" font-size: 16px;    border: 2px solid rgb(53, 53, 53);background:#fcf9f0ce;">   
                        Ask the buyer to cancel the order.
                        <i class="fa-solid fa-arrow-right ms-2"></i>
                  </a>


                    <a href="{{ route('order.extend.time',$order->id)}}" class="ud-btn"  
                      style=" font-size: 16px;    border: 2px solid rgb(53, 53, 53);background:#fcf9f0ce;">
                          Extend the delivery time <i class="fa-solid fa-arrow-right ms-2"></i>
                         </a>
               
                  @endif

               



              
                    

                   
                </div>

      
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
             
                <div class="review-meta d-flex align-items-center">
                  <i class="fas fa-star fz10 review-color me-2"></i>
                  <p class="mb-0 body-color fz14"><span class="dark-color me-2">4.82</span>94 reviews</p>
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

         
          </div>
     
    </div>
  </div>


  <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-lg">
    <form action="{{ route('cancel.request') }}" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Submit cancel request</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">What kind of issu are you having with this order?</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" style="height: 300px" name="reason" required></textarea>
            
            <input type="hidden" value="{{$order->client_id}}" name="client_id">
            <input type="hidden" value="{{$order->seller_id}}" name="seller_id">
            <input type="hidden" value="{{$order->id}}" name="order_id">

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="ud-btn" data-bs-dismiss="modal"  
              style=" font-size: 16px;    border: 2px solid rgb(53, 53, 53);background:#fcf9f0ce;">Close</button>
          <button type="submit"  class="ud-btn"     
          style=" font-size: 16px;    border: 2px solid rgb(53, 53, 53);background:#fcf9f0ce;">Submit</button>
        </div>
      </div>
  </form>
  </div>
</div>
  @endsection

@section('footer_script')

<script>
    
(function () {
    // Get the delivery time from the order's related proposal (assuming it's in days)
    const deliveryTimeInDays = {{ $order->rel_to_proposal->delivery_time }};
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
                document.getElementById("headline").innerText = "It's time!";
                document.getElementById("countdown").style.display = "none";
                document.getElementById("content").style.display = "block";
                clearInterval(x);
            }
        }, 1000); // Update every 1 second (1000 milliseconds)
})();


</script>

@endsection