
@if($errors->has('start_year'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <span class="text-danger">{{ $errors->first('start_year') }}</span>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

 @endif

 
@if($errors->has('end_year'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <span class="text-danger">{{ $errors->first('end_year') }}</span>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

 @endif
@if(session('status'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('status') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

          <div class="ps-widget bgc-white bdrs4 p30 mb30 overflow-hidden position-relative">
                <div class="bdrb1 pb15 mb25">
                  <h5 class="list-title">Profile Details</h5>
                </div>
            <div class="col-xl-7">

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
                        <a href="" class="upload-btn ml10" data-bs-toggle="modal" data-bs-target="#uploadimage">Upload Images</a>
                      </div>
                      <p class="text mb-0">Max file size is 1MB, Minimum dimension: 330x300 And Suitable files are .jpg & .png</p>
                    </div>
                  </div>
            </div>



                <!-- Button trigger modal -->
         

                <!-- Modal -->
                <div class="modal fade" id="uploadimage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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


                <div class="col-lg-7">
                <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                    @csrf
                </form>

                  <form class="form-style1" method="post" action="{{ route('profile.update', Auth::user()->id) }}">
                        @csrf
                     
                        <div class="row">
                        <div class="col-sm-6">
                            <div class="mb20">
                            <label class="heading-color ff-heading fw500 mb10">Name</label>
                            <input type="text" class="form-control"  id="name" name="name" value="{{$user->name}}" required autofocus autocomplete="name">
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb20">
                            <label class="heading-color ff-heading fw500 mb10">Username</label>
                            <input type="text" class="form-control"  id="name" name="username" value="{{$user->username}}" required autofocus autocomplete="username">
                            <x-input-error class="mt-2" :messages="$errors->get('username')" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb20">
                            <label class="heading-color ff-heading fw500 mb10">Display name</label>
                            <input type="text" class="form-control"   name="display_name" value="{{$user->display_name}}" required autofocus >
                            {{-- <x-input-error class="mt-2" :messages="$errors->get('username')" /> --}}
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb20">
                            <label class="heading-color ff-heading fw500 mb10" >Email Address</label>
                            <input id="email" name="email" type="email"  value="{{$user->email}}" required  class="form-control" disabled>
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>
                        </div>
                        <!-- <div class="col-sm-6">
                            <div class="mb20">
                            <label class="heading-color ff-heading fw500 mb10" >Hourly Rate</label>
                            <input id="email" name="email" type="text"   required  class="form-control" >
                        
                            </div>
                        </div> -->
                     
                     
                        <div class="col-sm-6">
                            <div class="mb20">
                            <div class="form-style1">
                                <label class="heading-color ff-heading fw500 mb10">Gender</label>
                                <div class="bootselect-multiselect">
                                <select class="selectpicker" name="gender">
                                <option class="p-2" selected>  {{$user->gender}}</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                    <option>Other</option>
                                </select>
                                </div>
                            </div>
                            </div>
                        </div>


                        @if(session('country'))
                        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                            {{ session('country') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <a href="#" class="add-more-btn text-thm pb-3" data-bs-toggle="modal" data-bs-target="#Modalcountry"><i class="icon far fa-plus mr10">
                        </i>Add Country & City</a>
                      
                        <div class="col-sm-6">
                           <label class="heading-color ff-heading fw500 mb10">Country</label>
                           @if($user->country == 'Select Country')
                           <input   value=" Not identify"   class="form-control" disabled>
               

                             @elseif($user->country)  
                             

                             <input  value="{{ \App\Models\Country::find($user->country)->name }}"   class="form-control" disabled>
                     
                            @endif

                         
                        </div>
                        <div class="col-sm-6">
                           <label class="heading-color ff-heading fw500 mb10">City</label>
                           @if($user->city == 'Select City')
                           <input   value=" Not identify"   class="form-control" disabled>
               

                             @elseif($user->city)  

                             <input  value="{{ \App\Models\City::find($user->city)->name }}"   class="form-control" disabled>
                     
                            @endif

                         
                        </div>

                 

                        <div class="col-md-12 mt-4">
                           <a href="#" class="add-more-btn text-thm pb-5 pt-3 mt-5" data-bs-toggle="modal" data-bs-target="#Modal"><i class="icon far fa-plus mr10">
                            </i>Add Languages</a>

                           @if(session('languages'))
                            <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                                {{ session('languages') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                          

                           @if(session('language_delete'))
                            <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                {{ session('language_delete') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif

                            @php
                            $languages = App\Models\LanguageList::where('user_id', Auth::id())->get();
                            @endphp 
                            
                            @foreach($languages as $language)     
                            <div class="language_list d-flex p-2">
                                <div> 
                                    <h5 class="mt15 ms-2">  {{ $language->languages }}</h5>
                                    <span class="tag"> {{ $language->languages_level }}</span>
                                </div>
                                <div class="mt-5">
                                    <a href="#" class="icon mt-5 ms-5 " data-bs-toggle="modal" data-bs-target="#deletelanguage{{ $language->id }}">
                                        <span class="flaticon-delete mt-5 "></span>
                                    </a>
                                </div>

                                  <!-- Delete Modal -->
                                    <div class="modal fade" id="deletelanguage{{ $language->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this language record?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="ud-btn" data-bs-dismiss="modal">Cancel</button>
                                                    <form method="post" action="">
                                                      
                                                        <a class="ud-btn btn-thm" href="{{ route('language.delete',$language->id)}}">Delete<i
                                                                class="fal fa-arrow-right-long"></i>
                                                           </a>
                                                    
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                            </div>
                            @endforeach
                          
                        </div>


                     
                        <div class="col-md-12">
                            <div class="mb10">
                            <label class="heading-color ff-heading fw500 mb10">Introduce Yourself</label>

                            <textarea 
                            class="form-control"
                            placeholder="Description" name="introduce_yourself" style="height: 300px">{{$user->introduce_yourself}}</textarea>


                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="text-start">
                            <button class="ud-btn btn-thm" >Save<i class="fal fa-arrow-right-long"></i></button>
                            </div>
                        </div>
                        </div>




                                 
                         @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                            <div>
                                <p class="text-sm mt-2 text-gray-800">
                                    {{ __('Your email address is unverified.') }}

                                    <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        {{ __('Click here to re-send the verification email.') }}
                                    </button>
                                </p>

                                @if (session('status') === 'verification-link-sent')
                                    <p class="mt-2 font-medium text-sm text-green-600">
                                        {{ __('A new verification link has been sent to your email address.') }}
                                    </p>
                                @endif
                            </div>
                            
                            @endif
                 </form>

                            @if (session('status') === 'profile-updated')
                            {{-- <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600"
                                >{{ __('Saved.') }}
                            </p> --}}
                            @endif

     
                </div>
            </div>




            <div class="modal fade" id="Modalcountry" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                 
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Country & City add</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="form-style1" method="post" action="{{ route('country.city') }}">
                                
                                        @csrf
                                        <div class="col-sm-12">
                                            <label class="heading-color ff-heading fw500 mb10">Country</label>
                                                <select class="form-select p-3" aria-label="Default select example" id="country"  name="country">
                                                        @php
                                                        $countries = App\Models\Country::all();
                                                        @endphp   
                                                        <option selected >Select Country</option>
                
                                                        @foreach($countries as $country)
                                                        <option value="{{ $country->id }}" >
                                                            {{ $country->name }}
                                                        </option>
                                                        {{-- <option value="{{ $country->id }}" {{ $user->country == $country->id ? 'selected' : '' }}>
                                                            {{ $country->name }}
                                                        </option> --}}
                                                        @endforeach
                                                        
                                                </select>
                
                                        
                                        </div>
                
                                        <div class="col-sm-12 mt-3">
                                            <div class="mb20">
                                            <div class="form-style1">
                                                <label class="heading-color ff-heading fw500 mb10">City</label>
                                                <select  class="form-select p-3" aria-label="Default select example" id="city" name="city">
                                                <option selected >Select City</option>
                
                                                
                                            
                                                
                                                </select>
                                            
                                            </div>
                                            </div>
                                        </div>
                                

                                        <button type="button" class="ud-btn" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="ud-btn btn-thm">Save changes</button>
                                    </form>
                                </div>
                               
                    
                    </div>
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

$('#country').change(function() {
    var country_id = $(this).val();
    var selectedCityId = $('#city').val(); // Capture the selected city ID

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $.ajax({
        type: 'POST',
        url: '/getId',
        data: {
            'country_id': country_id,
            'selectedCityId': selectedCityId // Send the selected city ID
        },
        success: function(data) {
            console.log(data); // Log the response to the console
            $('#city').html(data);
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText); // Log any AJAX errors
        }
    });
});


</script>
@endsection

