@extends('layouts.index')
@section('content')
 <!-- Home Banner Style V1 -->





      <!-- Popular Artist -->
      <section class=" pb100">
        <div class="container">
          <div class="row align-items-center wow fadeInUp">

         

            <div class="col-xl-3">
              <div class="main-title mb30-lg">
                <h2 class="title">
                    Refund Policy</h2>

              </div>
            </div>

          </div>

          <div class="row">
            @foreach($refund as $refund)
            <p class="paragraph"> {!! $refund->description !!}</p>
            @endforeach
          </div>
         
        </div>
      </section>









@endsection
@section('footer_script')

@endsection
