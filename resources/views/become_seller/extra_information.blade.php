@extends('layouts.index')
@section('content')

<section >

    <div class="container">
        <div class="row">
          <div class="col-lg-8 m-auto wow fadeInUp" data-wow-delay="300ms">
            <div class="main-title text-center">
              <h2 class="title">Professional Info</h2>

              <p class="paragraph">This is your time to shine. Let potential buyers know what you do best and how you gained your skills, certifications and experience.</p>
            </div>
          </div>
        </div>

        <div class="row">
            <div class="col-md-9 bgc-thm4 m-auto p-5">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

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

                <div class="bdrb1 pb15 mb30 d-sm-flex justify-content-between">
                 

                    <h5 class="list-title"> Languages</h5>
                    <a href="#" class="add-more-btn text-thm pb-1" data-bs-toggle="modal" data-bs-target="#Modal">
                        <i class="icon far fa-plus mr10">
                        </i>Add Languages
                    </a>
                </div>

                
                    @php
                    $languages = App\Models\LanguageList::where('user_id', Auth::id())->get();
                    @endphp 
                    @foreach($languages as $language)     
                    <div class="language_list d-flex mb-4">
                        <div> 
                            <h5 class="mt15 ms-2">  {{ $language->languages }}</h5>
                            <span class="tag"> {{ $language->languages_level }}</span>
                        </div>
                        <div class="">
                            <a href="#" class="icon  ms-5 p-2 " data-bs-toggle="modal" data-bs-target="#deletelanguage{{ $language->id }}"
                                style="background: white">
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
                {{-- education --}}
                <div class="bdrb1 pb15 mb30 d-sm-flex justify-content-between">
                 

                    <h5 class="list-title">Education</h5>
                    <a href="#" class="add-more-btn text-thm" data-bs-toggle="modal" href=''
                              data-bs-target="#educationModal"><i class="icon far fa-plus mr10"></i>Add Education</a>
                </div>
        
                 <div class="position-relative">
                    @php
                    $educations = App\Models\Education::where('user_id', Auth::id())->get();
                   @endphp    
                       @foreach($educations as $education)   
                        <div class="educational-quality">
                            <div class="m-circle text-thm">M</div>
                                
                            <div class="wrapper mb40 position-relative">
                                <div class="del-edit">
                                  <div class="d-flex">
          
                               
                                      
                                      <!-- edit education -->
                                    <a href="#" type="button" class="icon me-2" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $education->id }}"  >
                                      <span class="flaticon-pencil"></span>
                                   </a>
                                    <!-- edit modal -->
                                    <div class="modal fade" id="exampleModal{{ $education->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog modal-dialog-centered modal-lg">
                                              <div class="modal-content">
                                                  <div class="modal-header">
                                                      <h1 class="modal-title fs-5" id="exampleModalLabel">Education qualification edit</h1>
                                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                  </div>
                                                  <div class="modal-body">
                                                      <div class="ps-widget bgc-white bdrs4 p30  overflow-hidden position-relative">
                                                      
                                                          <div class="col-xl">
                                                              <form class="form-style1" method="post" action="{{ route('education.update', $education->id) }}" >
                                                              @csrf
                                                                  <div class="row">
          
                                                                  <div class="mb20">
                                                                      <label class="heading-color ff-heading fw500 mb10">Degree</label>
                                                                      <input type="text" name="degree" class="form-control" placeholder="e.g., Bachelor of Science" value="{{ $education->degree }}" required>
                                                                  </div>
                                                                  <div class="mb20">
                                                                      <label class="heading-color ff-heading fw500 mb10">University Name</label>
                                                                      <input type="text" name="university_name" class="form-control" placeholder="e.g., University of XYZ" value="{{ $education->university_name }}" required>
                                                                  </div>
                                                                  <div class="mb20">
                                                                      <label class="heading-color ff-heading fw500 mb10">Description</label>
                                                                      <textarea name="description" class="form-control" placeholder="Description" required>
                                                                      {{ $education->description }}
                                                                      </textarea>
                                                                  </div>
                                                                  <div class="mb20">
                                                                      <label class="heading-color ff-heading fw500 mb10">Start Year</label>
                                                                      <input type="number" name="start_year" class="form-control" placeholder="e.g., 2010" 
                                                                      value="{{ $education->start_year }}"  required>
                                                                  </div>
                                                                  <div class="mb20">
                                                                      <label class="heading-color ff-heading fw500 mb10">End Year</label>
                                                                      <input type="number" name="end_year" class="form-control" placeholder="e.g., 2014" 
                                                                      value="{{ $education->end_year }}"
                                                                      required>
                                                                  </div>
                                                                      <div class="col-md-12">
                                                                          <div class="text-start">
                                                                              <button class="ud-btn btn-thm" type="submit" >Save<i
                                                                                      class="fal fa-arrow-right-long"></i>
                                                                                  </button>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                              </form>
                                                          </div>
                                                      </div>
                                                  </div>
                                              
                                              </div>
                                          </div>
                                    </div>
          
                                      <!-- Delete Button (Using Bootstrap Modal for Confirmation) -->
                                      <a href="#" class="icon" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $education->id }}">
                                          <span class="flaticon-delete"></span>
                                      </a>
          
                                      <!-- Delete Modal -->
                                      <div class="modal fade" id="deleteModal{{ $education->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                          <div class="modal-dialog modal-dialog-centered">
                                              <div class="modal-content">
                                                  <div class="modal-header">
                                                      <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                  </div>
                                                  <div class="modal-body">
                                                      Are you sure you want to delete this education record?
                                                  </div>
                                                  <div class="modal-footer">
                                                      <button type="button" class="ud-btn" data-bs-dismiss="modal">Cancel</button>
                                                      <form method="post" action="{{ route('education.destroy', $education->id) }}">
                                                          @csrf
                                                          @method('DELETE')
                                                          <button class="ud-btn btn-thm" type="submit" >Delete<i
                                                                  class="fal fa-arrow-right-long"></i>
                                                              </button>
                                                       
                                                      </form>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
          
                                    
                                  </div>
                                </div>
                                <span class="tag">{{ $education->start_year }} - {{ $education->end_year }}</span>
                                <h5 class="mt15">{{ $education->degree }}</h5>
                                <h6 class="text-thm">{{ $education->university_name }}</h6>
                                <p>{{ $education->description }}</p>
                              </div>
        
        
                        </div>
                        @endforeach
                 </div>


                 {{-- experience --}}
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

                 <div class="">
                    <div class="bdrb1 pb15 mb30 d-sm-flex justify-content-between">
                      <h5 class="list-title">Work & Experience</h5>
                      <a href="#" class="add-more-btn text-thm" data-bs-toggle="modal" href=''
                                data-bs-target="#experienceModal"><i class="icon far fa-plus mr10"></i>Add Experience</a>
                    </div>
    
                    @if(session('experience'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('experience') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
    
                    <div class="position-relative">
                      <div class="educational-quality">
                             @php
                             $experiences = App\Models\Experience::where('user_id', Auth::id())->get();
                            @endphp   
    
                        @foreach($experiences as $experience)     
                        <div class="m-circle text-thm">M</div>
                        <div class="wrapper mb40 position-relative">
                          <div class="del-edit">
                            <div class="d-flex">
    
                                  <!-- edit education -->
                                  <a href="#" type="button" class="icon me-2" data-bs-toggle="modal" data-bs-target="#edit{{ $experience->id }}"  >
                                  <span class="flaticon-pencil"></span>
                             </a>
                              <!-- edit modal -->
                              <div class="modal fade" id="edit{{ $experience->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Experience  edit</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="ps-widget bgc-white bdrs4 p30  overflow-hidden position-relative">
                                                
                                                    <div class="col-xl">
                                                        <form class="form-style1" method="post" action="{{ route('experience.update', $experience->id) }}" >
                                                        @csrf
                                                            <div class="row">
    
                                                            <div class="mb20">
                                                                <label class="heading-color ff-heading fw500 mb10">Position</label>
                                                                <input type="text" name="position" class="form-control" placeholder="e.g., Bachelor of Science" value="{{ $experience->position }}" required>
                                                            </div>
                                                            <div class="mb20">
                                                                <label class="heading-color ff-heading fw500 mb10">Company Name</label>
                                                                <input type="text" name="company_name" class="form-control" placeholder="e.g., University of XYZ" value="{{ $experience->company_name }}" required>
                                                            </div>
                                                            <div class="mb20">
                                                                <label class="heading-color ff-heading fw500 mb10">Description</label>
                                                                <textarea name="description" class="form-control" placeholder="Description" required>
                                                                {{ $experience->description }}
                                                                </textarea>
                                                            </div>
                                                            <div class="mb20">
                                                                <label class="heading-color ff-heading fw500 mb10">Start Year</label>
                                                                <input type="number" name="start_year" class="form-control" placeholder="e.g., 2010" 
                                                                value="{{ $experience->start_year }}"  required>
                                                            </div>
                                                            <div class="mb20">
                                                                <label class="heading-color ff-heading fw500 mb10">End Year</label>
                                                                <input type="number" name="end_year" class="form-control" placeholder="e.g., 2014" 
                                                                value="{{ $experience->end_year }}"
                                                                required>
                                                            </div>
                                                                <div class="col-md-12">
                                                                    <div class="text-start">
                                                                        <button class="ud-btn btn-thm" type="submit" >Save<i
                                                                                class="fal fa-arrow-right-long"></i>
                                                                            </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                        </div>
                                    </div>
                              </div>
    
                                <!-- Delete Button (Using Bootstrap Modal for Confirmation) -->
                                <a href="#" class="icon" data-bs-toggle="modal" data-bs-target="#delete{{ $experience->id }}">
                                    <span class="flaticon-delete"></span>
                                </a>
    
                                <!-- Delete Modal -->
                                <div class="modal fade" id="delete{{ $experience->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete this experience record?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="ud-btn" data-bs-dismiss="modal">Cancel</button>
                                                <form method="post" action="{{ route('experience.destroy', $experience->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="ud-btn btn-thm" type="submit" >Delete<i
                                                            class="fal fa-arrow-right-long"></i>
                                                        </button>
                                                 
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
    
    
                            </div>
                          </div>
                          <span class="tag">{{ $experience->start_year }} - {{ $experience->end_year }}</span>
                          <h5 class="mt15">{{ $experience->position }}</h5>
                          <h6 class="text-thm">{{ $experience->company_name }}</h6>
                          <p>{{ $experience->description }}</p>
                        </div>
                       
                        @endforeach
                      </div>
                     
                    </div>
                </div>
    

                  
                    <!-- add  -->
                    <div class="modal fade" id="experienceModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Experience</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="ps-widget bgc-white bdrs4 p30  overflow-hidden position-relative">
                                    
                                        <div class="col-xl">
                                            <form class="form-style1" method="post" action="{{ route('experience.store') }}" >
                                            @csrf
                                                <div class="row">
    
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw500 mb10">Position Title</label>
                                                    <input type="text" name="position" class="form-control" placeholder="" required>
                                                </div>
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw500 mb10">Company Name</label>
                                                    <input type="text" name="company_name" class="form-control" placeholder="" required>
                                                </div>
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw500 mb10">Description</label>
                                                    <textarea name="description" class="form-control" placeholder="Description" required></textarea>
                                                </div>
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw500 mb10">Start Year</label>
                                                    <input type="number" name="start_year" class="form-control" placeholder="" required>
                                                </div>
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw500 mb10">End Year</label>
                                                    <input type="number" name="end_year" class="form-control" placeholder="" required>
                                                </div>
                                                    <div class="col-md-12">
                                                        <div class="text-start">
                                                            <button class="ud-btn btn-thm" type="submit" >Save<i
                                                                    class="fal fa-arrow-right-long"></i>
                                                                </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            
                            </div>
                        </div>
                    </div>
    
                  {{-- award --}}
                  <div class="">
                    <div class="bdrb1 pb15 mb30 d-sm-flex justify-content-between">
                      <h5 class="list-title">Awards</h5>
                      <a href="#" class="add-more-btn text-thm" data-bs-toggle="modal" href=''
                                data-bs-target="#awardModal"><i class="icon far fa-plus mr10"></i>Add Award</a>
                    </div>
    
                    @if(session('Awards'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('Awards') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
    
                    <div class="position-relative">
                      <div class="educational-quality">
                        @php
                             $awards = App\Models\Award::where('user_id', Auth::id())->get();
                            @endphp    
                        @foreach($awards as $award)     
                        <div class="m-circle text-thm">M</div>
                        <div class="wrapper mb40 position-relative">
                          <div class="del-edit">
                            <div class="d-flex">
    
                                  <!-- edit education -->
                              <a href="#" type="button" class="icon me-2" data-bs-toggle="modal" data-bs-target="#awardedit{{ $award->id }}"  >
                                <span class="flaticon-pencil"></span>
                             </a>
                              <!-- edit modal -->
                              <div class="modal fade" id="awardedit{{ $award->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Award  edit</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="ps-widget bgc-white bdrs4 p30  overflow-hidden position-relative">
                                                
                                                    <div class="col-xl">
                                                        <form class="form-style1" method="post" action="{{ route('award.update', $award->id) }}" >
                                                        @csrf
                                                            <div class="row">
    
                                                            <div class="mb20">
                                                                <label class="heading-color ff-heading fw500 mb10">Award Title</label>
                                                                <input type="text" name="award" class="form-control" placeholder="e.g., Bachelor of Science" value="{{ $award->award }}" required>
                                                            </div>
                                                            <div class="mb20">
                                                                <label class="heading-color ff-heading fw500 mb10">Institute Name</label>
                                                                <input type="text" name="institute" class="form-control" placeholder="e.g., University of XYZ" value="{{ $award->institute }}" required>
                                                            </div>
                                                            <div class="mb20">
                                                                <label class="heading-color ff-heading fw500 mb10">Description</label>
                                                                <textarea name="description" class="form-control" placeholder="Description" required>
                                                                {{ $award->description }}
                                                                </textarea>
                                                            </div>
                                                            <div class="mb20">
                                                                <label class="heading-color ff-heading fw500 mb10">Start Year</label>
                                                                <input type="number" name="start_year" class="form-control" placeholder="e.g., 2010" 
                                                                value="{{ $award->start_year }}"  required>
                                                            </div>
                                                            <div class="mb20">
                                                                <label class="heading-color ff-heading fw500 mb10">End Year</label>
                                                                <input type="number" name="end_year" class="form-control" placeholder="e.g., 2014" 
                                                                value="{{ $award->end_year }}"
                                                                required>
                                                            </div>
                                                                <div class="col-md-12">
                                                                    <div class="text-start">
                                                                        <button class="ud-btn btn-thm" type="submit" >Save<i
                                                                                class="fal fa-arrow-right-long"></i>
                                                                            </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                        </div>
                                    </div>
                              </div>
    
                                <!-- Delete Button (Using Bootstrap Modal for Confirmation) -->
                                <a href="#" class="icon" data-bs-toggle="modal" data-bs-target="#awarddelete{{ $award->id }}">
                                    <span class="flaticon-delete"></span>
                                </a>
    
                                <!-- Delete Modal -->
                                <div class="modal fade" id="awarddelete{{ $award->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete this experience record?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="ud-btn" data-bs-dismiss="modal">Cancel</button>
                                                <form method="post" action="{{ route('award.destroy', $award->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="ud-btn btn-thm" type="submit" >Delete<i
                                                            class="fal fa-arrow-right-long"></i>
                                                        </button>
                                                 
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
    
    
                            </div>
                          </div>
                          <span class="tag">{{ $award->start_year }} - {{ $award->end_year }}</span>
                          <h5 class="mt15">{{ $award->award }}</h5>
                          <h6 class="text-thm">{{ $award->institute }}</h6>
                          <p>{{ $award->description }}</p>
                        </div>
                       
                        @endforeach
                      </div>
                     
                    </div>
                  </div>
    
    
    
    
    
    
    
    
    
                  
                    <!-- add  -->
                    <div class="modal fade" id="awardModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Experience</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="ps-widget bgc-white bdrs4 p30  overflow-hidden position-relative">
                                    
                                        <div class="col-xl">
                                            <form class="form-style1" method="post" action="{{ route('award.store') }}" >
                                            @csrf
                                                <div class="row">
    
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw500 mb10">Award Title</label>
                                                    <input type="text" name="award" class="form-control" placeholder="e.g., Bachelor of Science" required>
                                                </div>
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw500 mb10">Institute Name</label>
                                                    <input type="text" name="institute" class="form-control" placeholder="e.g., University of XYZ" required>
                                                </div>
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw500 mb10">Description</label>
                                                    <textarea name="description" class="form-control" placeholder="Description" required></textarea>
                                                </div>
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw500 mb10">Start Year</label>
                                                    <input type="number" name="start_year" class="form-control" placeholder="e.g., 2010" required>
                                                </div>
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw500 mb10">End Year</label>
                                                    <input type="number" name="end_year" class="form-control" placeholder="e.g., 2014" required>
                                                </div>
                                                    <div class="col-md-12">
                                                        <div class="text-start">
                                                            <button class="ud-btn btn-thm" type="submit" >Save<i
                                                                    class="fal fa-arrow-right-long"></i>
                                                                </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            
                            </div>
                        </div>
                   </div>
    
    
                   <div class="col-md-12 mt-5">
                        <div class="text-start mt-5">
                        <a class="ud-btn btn-thm mt-5" href="{{ route('seller.information.submit')}}" >Next<i class="fal fa-arrow-right-long"></i></a>
                        </div>
                    </div>
                 
                  </div>

               
        


                 
            
            </div>
        </div>
     


      

      


        
          
        
        </div>
        

</section>



      <!-- add  -->
      <div class="modal fade" id="educationModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Education qualification</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="ps-widget bgc-white bdrs4 p30  overflow-hidden position-relative">
                    
                        <div class="col-xl">
                            <form class="form-style1" method="post" action="{{ route('education.store') }}" >
                            @csrf
                                <div class="row">

                                <div class="mb20">
                                    <label class="heading-color ff-heading fw500 mb10">Degree</label>
                                    <input type="text" name="degree" class="form-control" placeholder="e.g., Bachelor of Science" required>
                                </div>
                                <div class="mb20">
                                    <label class="heading-color ff-heading fw500 mb10">University Name</label>
                                    <input type="text" name="university_name" class="form-control" placeholder="e.g., University of XYZ" required>
                                </div>
                                <div class="mb20">
                                    <label class="heading-color ff-heading fw500 mb10">Description</label>
                                    <textarea name="description" class="form-control" placeholder="Description" required></textarea>
                                </div>
                                <div class="mb20">
                                    <label class="heading-color ff-heading fw500 mb10">Start Year</label>
                                    <input type="number" name="start_year" class="form-control" placeholder="e.g., 2010" required>
                                </div>
                                <div class="mb20">
                                    <label class="heading-color ff-heading fw500 mb10">End Year</label>
                                    <input type="number" name="end_year" class="form-control" placeholder="e.g., 2014" required>
                                </div>
                                    <div class="col-md-12">
                                        <div class="text-start">
                                            <button class="ud-btn btn-thm" type="submit" >Save<i
                                                    class="fal fa-arrow-right-long"></i>
                                                </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
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
@endsection
@section('footer_script')

@endsection