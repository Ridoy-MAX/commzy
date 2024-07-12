@extends('layouts.index')
@section('content')
 <!-- Home Banner Style V1 -->
    


 

    



 <section>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <div class="order_complete_message text-center">
            <div class="icon bgc-thm4"><span class="fa fa-check "></span></div>
       
          
            @if(session('success'))
        
            <h2 class="title">  {{ session('success') }} </h2>
            
            @endif
            <p class="text">Thank you. Your order has been place.</p>

          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-8 offset-xl-2">
          <div class="shop_order_box mt60">
            <div class="order_list_raw">
              <ul class="d-md-flex align-items-center justify-content-md-between p-0 mb-0">
                <li class="mb20-sm">
                  <p class="text mb5">Order Number</p>
                  <h6 class="mb-0">{{$checkout->id}}</h6>
                </li>
                <li class="mb20-sm">
                  <p class="text mb5">Date</p>
                  <h6 class="mb-0">{{$checkout->created_at}}</h6>
                </li>
                <li class="mb20-sm">
                  <p class="text mb5">Total</p>
                  <h6 class="mb-0">${{$checkout->service_price+$checkout->shipping_price}}</h6>
                </li>
                <li>
                  <p class="text mb5">Payment Method</p>
                  <h6 class="mb-0">Direct Bank Transfer</h6>
                </li>
              </ul>
            </div>
            <div class="order_details default-box-shadow1">
              <h4 class="title mb25">Order details</h4>
              <div class="od_content">
                <ul class="p-0 mb-0">
                  <li class="bdrb1 mb20"><h6>Service <span class="float-end">Subtotal</span></h6></li>
                  <li class="mb20"><p class="body-color">{{$checkout->service_name}} <span class="float-end">${{$checkout->service_price}}</span></p></li>
            
        
                  <li class=" bdrb1 mb15"><h6>Shipping <span class="float-end">${{$checkout->shipping_price }}</span></h6></li>
                  <li><h6>Total <span class="float-end">${{$checkout->service_price+$checkout->shipping_price}}</span></h6></li>
                </ul>
              </div>
            </div>
          </div>            
        </div>

        <div class="col-md-3 m-auto mt-3">
          <a href="{{ route('order')}}" class="m-auto">
            <button type="submit" class="ud-btn btn-thm">Check your order list<i class="fal fa-arrow-right-long"></i></button>
        </a>
        </div>

    
      </div>
    </div>
  </section>








@endsection
@section('footer_script')

@endsection