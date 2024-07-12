@extends('layouts.auth')
@section('content')
    <section class="our-login">
        {{-- <div class="alert alert-primary" role="alert">
            A simple primary alert—check it out!
          </div> --}}
  
        <div class="container">
            <x-auth-session-status class="mb-4 alert alert-primary" :status="session('status')" />
            <div class="row">
                <div class="col-lg-6 m-auto wow fadeInUp" data-wow-delay="300ms">
                    <div class="main-title text-center">
                        <h2 class="title">Log In</h2>
                        <p class="paragraph">Sign up with {{ env('APP_NAME') }} for your next art work.</p>
                    </div>
                </div>
            </div>
            <div class="row wow fadeInRight" data-wow-delay="300ms">
                <div class="col-xl-6 mx-auto">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="log-reg-form search-modal form-style1 bgc-white p50 p30-sm default-box-shadow1 bdrs12">
                            <div class="mb30">
                                <h4>We're glad to see you again!</h4>
                                <p class="text">Don't have an account? <a href="{{ route('register') }}" class="text-thm">Sign Up</a></p>
                            </div>
                            <div class="mb20">
                                <label class="form-label fw600 dark-color">Email Address</label>
                                <input id="email" type="email" name="email" :value="old('email')" required
                                    autofocus autocomplete="username" class="form-control" placeholder="example@email.com">
                                <x-input-error  :messages="$errors->get('email')" class="mt-2 alert alert-danger" />
                            </div>
                            <div class="mb15">
                                <label class="form-label fw600 dark-color">Password</label>
                                <input id="password" type="password" name="password" required
                                    autocomplete="current-password" class="form-control" placeholder="*******">
                            </div>
                            <div class="checkbox-style1 d-block d-sm-flex align-items-center justify-content-between mb20">
                                <label class="custom_checkbox fz14 ff-heading">Remember me
                                    <input id="remember_me" type="checkbox" checked="checked" name="remember">
                                    <span class="checkmark"></span>
                                </label>

                                @if (Route::has('password.request'))
                                    <a class="fz14 ff-heading" href="{{ route('password.request') }}">Lost your password?</a>
                                @endif


                            </div>
                            <div class="d-grid mb20">

                                <button class="ud-btn btn-thm" type="submit">Log In <i class="fal fa-arrow-right-long"></i></button>


                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection
@section('footer_script')
@endsection
