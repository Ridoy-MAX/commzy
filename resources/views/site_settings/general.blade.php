@extends('layouts.dashboard')
@section('content')

<div class="dashboard__content hover-bgc-color">
            <div class="row pb40">
                <div class="col-lg-12">
                @include('components.main_component.dashboard_navigation')
                  
                </div>
            </div>
        <div class="row align-items-center justify-content-between ">

            @if(session('delete'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('delete') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="col-lg-12">
            <div class="dashboard_title_area card p-5">
                <h2>General Setting</h2>
         

                <form class="mt-2" method="POST" action="{{ route('general.update') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb20">
                        <label class="heading-color ff-heading fw500 mb10">Site Title</label>
                        <input type="text" class="form-control" placeholder="" name="site_title" required value="{!! $generalSetting->site_title ?? '' !!}">
                        @error('site_title')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb20">
                        <label class="heading-color ff-heading fw500 mb10">Meta Title</label>
                        <input type="text" class="form-control" placeholder="" name="meta_title" required value="{!! $generalSetting->meta_title ?? '' !!}">
                        @error('meta_title')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb20">
                        <label class="heading-color ff-heading fw500 mb10">Meta Description</label>
                        <input type="text" class="form-control" placeholder="" name="meta_description" required value="{!! $generalSetting->meta_description ?? '' !!}">
                        @error('meta_description')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb20">
                        <label class="heading-color ff-heading fw500 mb10">Site Logo</label>
                        <input type="file" class="form-control" name="site_logo" >
                        @error('site_logo')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                        
                        @php
                        $generalSetting = App\Models\General::first();
                       @endphp   
                      
                            
                        @if($generalSetting)
                        <div class="trust_image">
                            <img src="{{ asset($generalSetting->site_logo) }}" alt="general" style="width: 160px; height: 60px; margin-right:10px;margin-top:10px;">
                            {{-- <a href="{{ route('site_logo.destroy', $generalSetting->id) }}" class="delete">
                                <i class="fa-solid fa-xmark"></i> --}}
                            </a>
                        </div>
                        @else
                        <p>No site logo found.</p>
                        @endif
                    </div>
                    <div class="mb20">
                        <label class="heading-color ff-heading fw500 mb10">Fav icon</label>
                        <input type="file" class="form-control" name="fav_icon" >
                        @error('fav_icon')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                     
                        @if($generalSetting)
                            <div class="trust_image">
                                <img src=" {{ asset($generalSetting->fav_icon) }} " alt="general "
                                style="width: 100px; height: 100px; margin-right:10px;margin-top:10px;">
                            
                            </div>
                         @else
                            <p>No site logo found.</p>
                         @endif   
                    </div>

                    <div class="text-start">
                        <button class="ud-btn btn-thm" type="submit">Save<i class="fal fa-arrow-right-long"></i></button>
                    </div>
                </form>
            </div>
            <div class="dashboard_title_area card p-5">
                
                @if(session('commission'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('commission') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <h2> 	Commission and Pending Clearance Setting</h2>
                {{-- <p class="text">Lorem ipsum dolor sit amet, consectetur.</p> --}}

                <form class="mt-2" method="POST" action="{{ route('commission.update') }}">
                    @csrf

                    <div class="col-md-4">

                        <div class="mb20">
                            <label class="heading-color ff-heading fw500 mb10">Set Commission as Percentage %</label>
                            <input type="number" class="form-control" placeholder="" name="commission" required value="{!! $commissionSetting->commission ?? '' !!}">
                        </div>
                        <div class="mb20">
                            <label class="heading-color ff-heading fw500 mb10">Set Pending Clearance day</label>
                            <select class="form-select p-3" name="pending_clearance">
                                <option value="">Select Pending Clearance day</option>
                                @for ($i = 1; $i <= 90; $i++)
                                    <option value="{{ $i }}" {{ $commissionSetting->pending_clearance == $i ? 'selected' : '' }}>
                                        {{ $i }} day{{ $i > 1 ? 's' : '' }}
                                    </option>
                                @endfor
                            </select>

       
                        </div>
                    </div>
                
                
                    <div class="text-start">
                        <button class="ud-btn btn-thm" type="submit">Save <i class="fal fa-arrow-right-long"></i></button>
                    </div>
                </form>
                
            </div>

            </div>


        </div>
</div>





@endsection
@section('footer_script')


@endsection













          