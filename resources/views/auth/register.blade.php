@extends('layouts.auth')
@section('content')
    <section class="our-register">
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <div class="container">
            <div class="row">
                <div class="col-lg-6 m-auto wow fadeInUp" data-wow-delay="300ms">
                    <div class="main-title text-center">
                        <h2 class="title">Register</h2>
                        <p class="paragraph">Sign up with {{ env('APP_NAME') }} for your next art work.</p>
                    </div>
                </div>
            </div>
            <div class="row wow fadeInRight" data-wow-delay="300ms">
                <div class="col-xl-6 mx-auto">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="log-reg-form search-modal form-style1 bgc-white p50 p30-sm default-box-shadow1 bdrs12">
                            <div class="mb30">
                                <h4>Let's create your account!</h4>
                                <p class="text">Already have an account <a href="{{ route('login') }}"
                                        class="text-thm">Log in!</a></p>
                            </div>
                            <div class="mb20">
                                <label class="form-label fw600 dark-color">Name </label>
                                <input id="name" type="text" name="name" :value="old('name')" required
                                    autofocus autocomplete="name" class="form-control"
                                    placeholder="Enter your full name ....">
                                <x-input-error :messages="$errors->get('name')" class="mt-2 alert alert-danger" />
                            </div>

                            <div class="mb20">
                                <label class="form-label fw600 dark-color">Email Address</label>
                                <input id="email" type="email" name="email" :value="old('email')" required
                                    autofocus autocomplete="username" class="form-control" placeholder="example@email.com">
                                <x-input-error  :messages="$errors->get('email')" class="mt-2 alert alert-danger" />
                            </div>
                            <div class="mb15">
                                <label class="form-label fw600 dark-color">Password</label>
                                <input id="password" type="password" name="password" required autocomplete="new-password"
                                    class="form-control" placeholder="*******">
                                <x-input-error :messages="$errors->get('password')" class="mt-2 alert alert-danger" />
                            </div>
                            <div class="mb15">
                                <label class="form-label fw600 dark-color">Confirm Password</label>
                                <input id="password_confirmation" type="password" name="password_confirmation" required
                                    autocomplete="new-password" class="form-control" placeholder="*******">
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 alert alert-danger" />
                            </div>
                            <div class="d-grid mb20">
                                <button class="ud-btn btn-thm" type="submit">Create Account <i class="fal fa-arrow-right-long"></i></button>
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
