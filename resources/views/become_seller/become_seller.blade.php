@extends('layouts.index')
@section('content')

<section class="our-login">

      <div class="container">
        <div class="row">
          <div class="col-lg-8 m-auto wow fadeInUp" data-wow-delay="300ms">
            <div class="main-title text-center">
              <h2 class="title">
              
                Ready to start selling on COMMZY.ART?
              </h2>
              <p>
                Your first impression matters! Create a profile that will stand out from the crowd on COMMZY.ART.
              </p>
             </p>
            </div>

            <div class="iconbox-style1 contact-style d-flex align-items-start mb30 p-3 bgc-thm4">
                <div class="icon flex-shrink-0"><span class="flaticon-calendar"></span></div>
                <div class="details">
                  <h5 class="title">Learn what makes a successful profile</h5>
                  <p class="mb-0 text">Discover the do’s and don’ts to ensure you’re always on the right track.</p>
                </div>
            </div>

            <div class="iconbox-style1 contact-style d-flex align-items-start mb30 p-3 bgc-thm4">
                <div class="icon flex-shrink-0"><span class="flaticon-goal"></span></div>
                <div class="details">
                  <h5 class="title">Create your seller profile</h5>
                  <p class="mb-0 text">Add your profile picture, description, and professional information.</p>
                </div>
            </div>

            <div class="iconbox-style1 contact-style d-flex align-items-start mb30 p-3 bgc-thm4">
                <div class="icon flex-shrink-0"><span class="flaticon-tracking"></span></div>
                <div class="details">
                  <h5 class="title">Publish your serivce</h5>
                  <p class="mb-0 text">Create a Gig of the service you’re offering and start selling instantly.</p>
                </div>
            </div>

            <a class="ud-btn btn-thm" type="submit" href="{{ route('seller.information')}}">Continue <i class="fal fa-arrow-right-long"></i></a>

          </div>
        </div>

     
       
      </div>
</section>




@endsection
@section('footer_script')

@endsection