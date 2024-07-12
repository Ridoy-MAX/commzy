@extends('layouts.dashboard')
@section('content')

<div class="dashboard__content hover-bgc-color">
            <div class="row pb40">
                <div class="col-lg-12">
                @include('components.main_component.dashboard_navigation')
                  
                </div>
            </div>
        <div class="row align-items-center justify-content-between ">

            @if(session('banner'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('banner') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="col-lg-12">
                <div class="col-lg-12 m-auto">
                    <div class="dashboard_title_area card p-5 ">
                        <h2>Banner Setting</h2>
            
                        <form className=" mt-2 mb-5" method="POST" action="{{ route('banner.update') }}" enctype="multipart/form-data">
                        @csrf
                            <div class="mb20">
                                <label class="heading-color ff-heading fw500 mb10">Banner Title</label>
                                <input type="text" class="form-control" name="banner_title" value="{!! $bannerSetting->banner_title ?? '' !!}" required>
                                @error('banner_title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb20">
                                <label class="heading-color ff-heading fw500 mb10">Banner Description </label>
                                <input type="text" class="form-control"  name="banner_description" value="{!! $bannerSetting->banner_description ?? '' !!}" required>
                                @error('banner_description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb20">
                                <label class="heading-color ff-heading fw500 mb10">Banner Image one</label>
                                <input type="file" class="form-control"  name="image_one"  >
                                @error('image_one')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="trust_image">
                                    <img src="{{ asset($bannerSetting->image_one ) }}" alt="image_one" style="width: 258px;  margin-right:10px;margin-top:10px;">
 
 
                                </div>
                            </div>
                            <div class="mb20">
                                <label class="heading-color ff-heading fw500 mb10">Banner Image two</label>
                                <input type="file" class="form-control"  name="image_two"  >
                                @error('image_two')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="trust_image">
                                    <img src="{{ asset($bannerSetting->image_two ) }}" alt="image_two" style="width: 258px;  margin-right:10px;margin-top:10px;">
 
 
                                </div>
                            </div>

                            <div class="mb20">
                                <label class="heading-color ff-heading fw500 mb10">Iconbox one title </label>
                                <input type="text" class="form-control"  name="iconbox_one_title" value="{!! $bannerSetting->iconbox_one_title ?? '' !!}" required>
                                @error('iconbox_one_title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb20">
                                <label class="heading-color ff-heading fw500 mb10">Iconbox one details </label>
                                <input type="text" class="form-control"  name="iconbox_one_detail"  value="{!! $bannerSetting->iconbox_one_detail ?? '' !!}" required>
                                @error('iconbox_one_detail')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        
                            <div class="mb20">
                                <label class="heading-color ff-heading fw500 mb10">Iconbox two title </label>
                                <input type="text" class="form-control"  name="iconbox_two_title" value="{!! $bannerSetting->iconbox_two_title ?? '' !!}" required>
                                @error('iconbox_two_title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb20">
                                <label class="heading-color ff-heading fw500 mb10">Iconbox two details </label>
                                <input type="text" class="form-control"  name="iconbox_two_detail" value="{!! $bannerSetting->iconbox_two_detail ?? '' !!}" required>
                                @error('iconbox_two_detail')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        
                        


                            <div class="text-start">
                                <button class="ud-btn btn-thm" type="submit">Save<i class="fal fa-arrow-right-long"></i></button>
                            </div>
                        

                        
                        </form>
                        
                        <!-- <form className=" mt-5" style="margin-top: 100px;">
                            <h4 class="mt-5">Banner Section two</h4>
                            <div class="mb20">
                                <label class="heading-color ff-heading fw500 mb10">Heading Title</label>
                                <input type="text" class="form-control" placeholder="i will">
                            </div>
                            <div class="mb20">
                                <label class="heading-color ff-heading fw500 mb10">Description </label>
                                <input type="text" class="form-control" placeholder="i will">
                            </div>
                            <div class="mb20">
                                <label class="heading-color ff-heading fw500 mb10">Card Image </label>
                                <input type="file" class="form-control" placeholder="i will">
                            </div>
                            <div class="mb20">
                                <label class="heading-color ff-heading fw500 mb10">Card Title </label>
                                <input type="text" class="form-control" placeholder="i will">
                            </div>
                            <div class="mb20">
                                <label class="heading-color ff-heading fw500 mb10">Card Description </label>
                                <input type="text" class="form-control" placeholder="i will">
                            </div>

                        
                        


                            <div class="text-start">
                                <a class="ud-btn btn-thm" >Save<i class="fal fa-arrow-right-long"></i></a>
                            </div>
                        

                        
                        </form> -->
                    
                    </div>       
                </div>

                <div class="dashboard_title_area card p-5  mt-5">
                          @if(session('trust'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('trust') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                         @endif
                        <h2>Trusted by the world’s best</h2>
            
                        <form className=" mt-2 mb-5" method="POST" action="{{ route('trusted.create') }}" enctype="multipart/form-data">
                        @csrf
                           
                            <div class="mb20">
                                <label class="heading-color ff-heading fw500 mb10">Company logo </label>
                                <input type="file" class="form-control"  name="image_one" >
                                @error('image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="text-start">
                                <button class="ud-btn btn-thm" type="submit">Save<i class="fal fa-arrow-right-long"></i></button>
                            </div>
                        

                        
                        </form>

                        <div class="d-flex ">
                        @if(session('delete'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('delete') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                         @endif
                            @foreach ($trusts as $trust)
                               
                               <div class="trust_image m-3">
                                   <img src="{{ asset('trust/' . $trust->image_one) }}" alt="Trust Image" style="width: 100px;  margin-right:10px;margin-top:10px;">

                                  

                                   <a href="{{ route('trusted.destroy', $trust->id)}}" class="delete">   <i class="fa-solid fa-xmark"></i></a>

                                

                               </div>
                              

                            @endforeach
                        </div>
                        
                   
                    
                    </div>

                </div>

                <div class="col-lg-12 m-auto">
                    <div class="dashboard_title_area card p-5 ">
                        <h2>People Love To Learn With Commzy.art</h2>
            
                        <form className=" mt-2 mb-5" method="POST" action="{{ route('award.winner.update') }}" enctype="multipart/form-data">
                         @csrf
                            <div class="mb20">
                                <label class="heading-color ff-heading fw500 mb10"> Title</label>
                                <input type="text" class="form-control" name="title" value="{!! $awardSetting->title ?? '' !!}" required>
                                @error('title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb20">
                                <label class="heading-color ff-heading fw500 mb10"> Description </label>
                                <input type="text" class="form-control"  name="description" value="{!! $awardSetting->description ?? '' !!}" required>
                                @error('description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb20">
                             <label class="heading-color ff-heading fw500 mb10"> Professionals rate  </label>
                                <div class="professionals_rate">
                                    <div class="one">
                                          <input type="number"  name="professionals_number_one" value="{!! $awardSetting->professionals_number_one ?? '' !!}" required>
                                    </div>
                                    <div class="two">
                                        <input type="number"   name="professionals_number_two" value="{!! $awardSetting->professionals_number_two ?? '' !!}" required>
                                    </div>
                                    <div class="three">
                                        <p>/</p>
                                    </div>
                                    <div class="foure">
                                      <input type="number"   name="devided_number" value="{!! $awardSetting->devided_number ?? '' !!}" required>
                                    </div>
                            
                                </div>
                              
                                @error('professionals_number_one')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                @error('professionals_number_two')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                @error('devided_number')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                          
                           
                            <div class="mb20">
                                <label class="heading-color ff-heading fw500 mb10"> Professionals rate details </label>
                                <input type="text" class="form-control"  name="professionals_details" value="{!! $awardSetting->professionals_details ?? '' !!}" required>
                                @error('professionals_details')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb20">
                                <label class="heading-color ff-heading fw500 mb10"> Satisfied percentage  %</label>
                                <input type="number" class="form-control"  name="satisfied_percentage" value="{!! $awardSetting->satisfied_percentage ?? '' !!}" required>
                                @error('satisfied_percentage')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb20">
                                <label class="heading-color ff-heading fw500 mb10"> Satisfied details </label>
                                <input type="text" class="form-control"  name="satisfied_details" value="{!! $awardSetting->satisfied_details ?? '' !!}" required>
                                @error('satisfied_details')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                         
                          

                        
                        
                        
                        


                            <div class="text-start">
                                <button class="ud-btn btn-thm" type="submit">Save<i class="fal fa-arrow-right-long"></i></button>
                            </div>
                        

                        
                        </form>
                        
                   
                    
                    </div>       
                </div>

                <div class="col-lg-12 m-auto">
                    <div class="dashboard_title_area card p-5 ">
                        <h2>Add social link</h2>
            
                        <form className=" mt-2 mb-5" method="POST" action="{{ route('footer.update') }}" enctype="multipart/form-data">
                         @csrf
                            <div class="mb20">
                                <label class="heading-color ff-heading fw500 mb10">Facebook</label>
                                <input type="text" class="form-control" name="facebook" value="{!! $footerSetting->facebook ?? '' !!}" required>
                                @error('facebook')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb20">
                                <label class="heading-color ff-heading fw500 mb10">twitter</label>
                                <input type="text" class="form-control"  name="twitter" value="{!! $footerSetting->twitter ?? '' !!}" required>
                                @error('twitter')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb20">
                                <label class="heading-color ff-heading fw500 mb10">instagram</label>
                                <input type="text" class="form-control"  name="instagram" value="{!! $footerSetting->instagram ?? '' !!}"  required>
                                @error('instagram')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb20">
                                <label class="heading-color ff-heading fw500 mb10">linkedin</label>
                                <input type="text" class="form-control"  name="linkedin" value="{!! $footerSetting->linkedin ?? '' !!}" required>
                                @error('linkedin')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="text-start">
                                <button class="ud-btn btn-thm" type="submit">Save<i class="fal fa-arrow-right-long"></i></button>
                            </div>
                        

                        
                        </form>
                        
                
                    
                    </div>       
                </div>


        </div>
</div>





@endsection
@section('footer_script')


@endsection













          