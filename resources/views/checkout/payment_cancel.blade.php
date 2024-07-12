@extends('layouts.index')
@section('content')
 <!-- Home Banner Style V1 -->
    


 

    



 <section>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <div class="order_complete_message text-center">
            <div class="icon bgc-thm4">
                <i class="fa-solid fa-xmark"></i>
            </div>
       
          
            @if(session('success'))
        
            <h2 class="title">  {{ session('success') }} </h2>
            
            @endif
            <p class="text">Your  transaction has been canceled .</p>

          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-8 offset-xl-2">
          <div class="shop_order_box mt60">
            <div class="order_list_raw">
              <ul class="d-md-flex align-items-center justify-content-center p-0 mb-0">
                {{-- <p> You have canceled the transaction.</p> --}}
                <a href="{{ route('dashboard')}}" class="m-auto ud-btn btn-thm">
                Dashboard<i class="fal fa-arrow-right-long"></i>
                </a>
              </ul>
            </div>
         
          </div>            
        </div>

        <div class="col-md-3 m-auto mt-3">
         
        </div>

    
      </div>
    </div>
  </section>








@endsection
@section('footer_script')

@endsection