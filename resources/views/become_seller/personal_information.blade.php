@extends('layouts.index')
@section('content')

<section class="our-login">

    <div class="container">
        <div class="row">
          <div class="col-lg-10 m-auto wow fadeInUp" data-wow-delay="300ms">
            <div class="main-title text-center">
              <h2 class="title">Fill up your personal information</h2>
              <p class="paragraph">Tell us a bit about yourself. This information will appear on your public profile, so that potential buyers can get to know you better.</p>
            </div>
          </div>
        </div>
        <div class="row bgc-thm4 p-5" >
          
                <div class="col-md-10 m-auto mt-5">
                    <h5 class="list-title">Profile Details</h5>
                    @if(session('profile_pic'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('profile_pic') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                        <div class="profile-box d-sm-flex align-items-center mb30">
                        <div class="profile-img mb20-sm">

                        @if(Auth::user()->profile_pic)
                        <img class=" rounded-circle wa-xs" src="{{ asset(Auth::user()->profile_pic) }}" alt="Profile Picture" style="height: 55px; width: 55px; position: relative; top: -10px;">
                        @else
                        <img class=" rounded-circle wa-xs" src="/avatar.jpg" alt="user.png" style="height: 55px; width: 55px; position: relative; top: -10px;"> 
                            
                        @endif

                        
                        </div>
                        <div class="profile-content ml20 ml0-xs">
                            <div class="d-flex align-items-center my-3">
                            <a href="{{ route('photo.delete', Auth::user()->id) }}" class="tag-delt text-thm2"><span class="flaticon-delete text-thm2"></span></a>
                            <a href="" class="upload-btn ml10" data-bs-toggle="modal" data-bs-target="#exampleModal">Upload Images</a>
                            </div>
                            <p class="text mb-0">Max file size is 1MB, Minimum dimension: 330x300 And Suitable files are .jpg & .png</p>
                        </div>
                        </div>
                </div>



                <div class="col-md-10 mx-auto">
                    <form class="form-style1" method="post" action="{{ route('seller.profile.update', Auth::user()->id) }}">
                        @csrf
                    
                        <div class="row">
                        <div class="col-sm-6">
                            <div class="mb20">
                            <label class="heading-color ff-heading fw500 mb10">Name</label>
                            <input type="text" class="form-control"  id="name" name="name" value="{{Auth::user()->name}}" required autofocus autocomplete="name">
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb20">
                            <label class="heading-color ff-heading fw500 mb10" >Email Address</label>
                            <input id="email" name="email" type="email"     class="form-control" value="{{Auth::user()->email}}" disabled>
                            <x-input-error class="mt-2" :messages="$errors->get('email')" role="alert" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb20">
                            <label class="heading-color ff-heading fw500 mb10">Username</label>
                            <input type="text" class="form-control"  id="name" name="username" value="{{Auth::user()->username}}" required 
                         >
                            <x-input-error class="mt-2 alert alert-danger" :messages="$errors->get('username')" role="alert" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb20">
                            <label class="heading-color ff-heading fw500 mb10">Display Name</label>
                            <input type="text" class="form-control"  name="display_name"  value="{{Auth::user()->display_name}}" required  >
                        
                            </div>
                        </div>
                     
                        <!-- <div class="col-sm-6">
                            <div class="mb20">
                            <label class="heading-color ff-heading fw500 mb10" >Hourly Rate</label>
                            <input id="email" name="email" type="text"   required  class="form-control" >
                        
                            </div>
                        </div> -->
                    
                    
                        <div class="col-sm-12">
                            <div class="mb20">
                            <div class="form-style1">
                                <label class="heading-color ff-heading fw500 mb10">Gender</label>
                                <div class="bootselect-multiselect">
                                <select class="form-select p-3" name="gender" required>
                                <option class="p-2" selected>{{Auth::user()->gender}} </option>
                                    <option>Male</option>
                                    <option>Female</option>
                                    <option>Other</option>
                                </select>
                                </div>
                            </div>
                            </div>
                        </div>
                    
                        <div class="col-sm-6">
                        <label class="heading-color ff-heading fw500 mb10">Country</label>
                                <select class="form-select p-3" aria-label="Default select example" id="country"  name="country" required>
                                    @php
                                    $countries = App\Models\Country::all();
                                    @endphp   

                                    <option selected >Select Country</option>
                                    @foreach($countries as $country)
                                    <option value="{{ $country->id }}" {{ $user->country == $country->id ? 'selected' : '' }}>
                                        {{ $country->name }}
                                    </option>
                                    @endforeach

                               
                                        
                                </select>

                        
                        </div>
                        <div class="col-sm-6">
                            <div class="mb20">
                            <div class="form-style1">
                                <label class="heading-color ff-heading fw500 mb10">City</label>
                                <select  class="form-select p-3" aria-label="Default select example" id="city" name="city" required>
                                    <option selected >Select City</option>
  
                                    
                             
                                   
                                  </select>
                            </div>
                            </div>
                        </div>
                         
                        <div class="col-md-12">
                            <div class="mb10">
                            <label class="heading-color ff-heading fw500 mb10">Introduce Yourself</label>
                            <textarea cols="30" rows="6" placeholder="Description" name="introduce_yourself" required>
                        
                                {{Auth::user()->introduce_yourself}}
                            </textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="text-start mb-3 d-flex">
                            <button class="ud-btn btn-thm" href="" type="submit" >Next<i class="fal fa-arrow-right-long"></i></button>

                            {{-- <a class="ud-btn btn-thm ms-3" href="{{ route('extra.information')}}" >Next<i class="fal fa-arrow-right-long"></i></a> --}}
                            </div>
                        </div>
                        <div class="col-md-12">
                            
                       

                       
                        
                        </div>


                   
                        <div class="col-md-12">
                            <div class="text-start">
                  
                            </div>
                        </div>
                        </div>




                    
                    </form>

                </div>
        </div>
      </div>
</section>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                <form method="post" action="{{ route('photo.upload') }}" enctype="multipart/form-data">

                    @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Images</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                            <input  name="profile_pic" type="file"   required  class="form-control" >
                            </div>
                            
                            <div class="modal-footer">
                                <button type="button" class="ud-btn" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="ud-btn btn-thm">Save changes</button>
                            </div>
                        </div>
                    </form>
                 
                </div>
    </div>






    <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
         
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Languages add</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="form-style1" method="post" action="{{ route('language.insert') }}">
                            @csrf
                                <div class="col-md-12">
                                    <div class="mb20">
                                        <label class="heading-color ff-heading fw500 mb10 w-100">Languages </label>
                                        <select class="form-select p-3" aria-label="Default select example"  name="languages">
                                           <option selected >Select language</option>
                                            @php
                                            $languages = App\Models\Language::all();
                                    
                                            @endphp   

                                            @foreach($languages as $language)
                                                <option value="{{ $language->value }}" >
                                            
                                                    {{ $language->value }}
                                                </option>
                                            @endforeach 
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb20">
                                        <label class="heading-color ff-heading fw500 mb10  w-100 col-md-12">Languages Level</label>
                            
                                        <select class="form-select col-md-12"  name="languages_level" id="languages_level">
                                            <option class="p-2" > select level</option>
                                            <option>Fluent</option>
                                            <option>Native</option>
                                            <option>Conversational</option>
                                          
                                        </select>
                                    </div>
                                </div>

                        

                                <button type="button" class="ud-btn" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="ud-btn btn-thm">Save changes</button>
                             </form>
                        </div>
                       
            
            </div>
        </div>
    </div>

@endsection
@section('footer_script')
<script>
    // $(document).ready(function(){
    //     $('#country').select2();
    // });
    // $(document).ready(function(){
    //     $('#city').select2();
    // });


    $(document).ready(function(){
        $('#language').select2();
    });

    
    $(document).ready(function(){
        $('#language_level').select2();
    });

    // $('#city').html(data);
    // $('.selectpicker').selectpicker('refresh');

</script>

<script type="text/javascript">

$('#country').change(function(){
   var country_id = $(this).val();

   $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
      });

    $.ajax({
      type:'POST',
      url:'/getId',
      data:{'country_id': country_id},
      success:function(data){
        // alert(data);
        $('#city').html(data);
      }
    });

});

</script>
@endsection