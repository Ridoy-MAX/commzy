@extends('layouts.index')
@section('content')

<section class="our-login">

      <div class="container">
        <div class="row">
          <div class="col-lg-8 m-auto wow fadeInUp" data-wow-delay="300ms">
            <div class="main-title text-center">
              <h2 class="title">
                Congratulations!
                 your all imformation has been submit please wait for your account approval..
                
              </h2>
              <p>
                Your first impression matters! Create a profile that will stand out from the crowd on COMMZY.ART.
              </p>
             </p>
            </div>

            <div class="iconbox-style1 contact-style d-flex align-items-start mb30 p-3">
                <div class="icon flex-shrink-0"><span class="flaticon-calendar"></span></div>
                <div class="details">
                  <h5 class="title">Learn what makes a successful profile</h5>
                  <p class="mb-0 text">Trust and safety is a big deal in our community. Please verify your email and phone number so that we can keep your account secured.</p>
                </div>
            </div>

         

            <a class="ud-btn btn-thm" type="submit" href="{{ route('welcome')}}">Finish <i class="fal fa-arrow-right-long"></i></a>

          </div>
        </div>

     
       
      </div>
</section>




@endsection
@section('footer_script')

@endsection