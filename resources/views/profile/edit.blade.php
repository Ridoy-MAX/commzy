@extends('layouts.dashboard')
@section('content')


      <div class="dashboard__content hover-bgc-color">
                <div class="row pb40">
                    <div class="col-lg-12">
                    @include('components.main_component.dashboard_navigation')
                    </div>
                    <div class="col-lg-9">
                    <div class="dashboard_title_area">
                        <h2>My Profile</h2>
                        <p class="text">Lorem ipsum dolor sit amet, consectetur.</p>
                    </div>
                    </div>
                </div>
                @include('profile.partials.update-profile-information-form')
                @include('profile.partials.user-education')
                @include('profile.partials.user-experience')
                @include('profile.partials.user-award')
              
                @include('profile.partials.update-password-form')
                @include('profile.partials.delete-user-form')
        </div>








@endsection
@section('footer_script')
@endsection






