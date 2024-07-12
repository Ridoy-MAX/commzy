@extends('layouts.dashboard')
@section('content')


        <div class="dashboard__content hover-bgc-color" >
               <div class="row pb40">
                    <div class="col-lg-12">
                    @include('components.main_component.dashboard_navigation')
                    </div>
                </div>

               <div class="row">
                   <div class="col-lg-9">
                          
                    </div>
                
               </div>

               <div class="row">
                <div class="col-xl-12">
               
                  @if(session('success'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                      {{ session('success') }}
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  @endif
           

                  <div class="ps-widget bgc-white bdrs12 p30 mb30 overflow-hidden position-relative">
                    <div class="col-md-12">
                      <a href="#" class="add-more-btn text-thm pb-5" data-bs-toggle="modal" data-bs-target="#addmodal"><i class="icon far fa-plus mr10">
                       </i>Add Frequently Asked Questions</a>

                                                 
                        
                                                 
                   </div>
                    <div class="accordion-style1 faq-page mb-4 mb-lg-5 mt30">
                      <div class="accordion" id="accordionExample">
                        @foreach($faq as $key => $faqs)
                          <div class="accordion-item  d-flex row">
                          
                            <div class="one col-md-11">
                              <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{ $key + 1 }}" aria-expanded="true" aria-controls="collapseOne">{{ $faqs->question }}?</button>
                              </h2>
                              <div id="collapseOne{{ $key + 1 }}" class="accordion-collapse collapse " aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">{{ $faqs->answer }}</div>
                              </div>
                            </div>

                            <div class="two col-md-1 d-flex align-items-center">
                              <div class="del-edit">
                                <div class="d-flex">
        
                            
                                    
                                    <!-- edit education -->
                                  <a href="#" type="button" class="icon me-2" data-bs-toggle="modal" data-bs-target="#exampleModal9">
                                    <span class="flaticon-pencil"></span>
                                </a>
                                  <!-- edit modal -->
                                  <div class="modal fade" id="exampleModal9" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Education qualification edit</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="ps-widget bgc-white bdrs4 p30  overflow-hidden position-relative">
                                                    
                                                        <div class="col-xl">
                                                          <form class="form-style1" method="post" action="{{ route('update.faq',['id' => $faqs->id])}}">
                                                            @csrf
                                                              <div class="row">
        
                                                                <div class="mb20">
                                                                  <label class="heading-color ff-heading fw500 mb10">Question</label>
                                                                  <input type="text" name="question" class="form-control" placeholder="" value="{{ $faqs->question }}" required="">
                                                              </div>
                                                              <div class="mb20">
                                                                  <label class="heading-color ff-heading fw500 mb10">Answer</label>
                                                                  <textarea name="answer" class="form-control" placeholder="" required="">{{ $faqs->answer }}</textarea>
                                                              </div>
                                                              
                                                            
                                                              
                                                                    <div class="col-md-12">
                                                                        <div class="text-start">
                                                                            <button class="ud-btn btn-thm" type="submit">Save<i class="fal fa-arrow-right-long"></i>
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
                                    <a href="#" class="icon" data-bs-toggle="modal" data-bs-target="#deleteModal9">
                                        <span class="flaticon-delete"></span>
                                    </a>
        
                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal9" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this  record?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="ud-btn" data-bs-dismiss="modal">Cancel</button>
                                                      <form method="post" action="{{ route('faq.softDelete', ['id' => $faqs->id]) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                     
                                                          <button class="ud-btn btn-thm" type="submit">Delete<i class="fal fa-arrow-right-long"></i>
                                                          </button>
                                                      
                                                      </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
        
                                  
                                </div>
                              </div>
                            </div>
                          
                          </div>
                        @endforeach
                    
                      </div>
                    </div>

                    <div class="col-md-12">
                        <div class="text-start">
                          <a class="ud-btn btn-thm" href="{{ route('service.galleries', ['serviceInformationId' => $serviceInformationId]) }}">Next<i class="fal fa-arrow-right-long"></i></a>
                        </div>
                      </div>
                  </div>
               

                
                </div>
              </div>
            

             
                
               
        </div>
         
        
       

        
         <!-- Modal for Viewing User Details -->


<!-- faq.blade.php -->
<!-- Modal -->
<div class="modal fade" id="addmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Add Frequently Asked Questions</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div class="ps-widget bgc-white bdrs4 p30  overflow-hidden position-relative">
                  <div class="col-xl">
                      <form class="form-style1" method="post" action="{{ route('save.faq', ['serviceInformationId' => $serviceInformationId]) }}">
                          @csrf
                          <div class="row">
                              <div class="mb20">
                                  <label class="heading-color ff-heading fw500 mb10">Question</label>
                                  <input type="text" name="question" class="form-control" placeholder="" value="" required="">
                              </div>
                              <div class="mb20">
                                  <label class="heading-color ff-heading fw500 mb10">Answer</label>
                                  <textarea name="answer" class="form-control" placeholder="" required=""></textarea>
                              </div>
                              <div class="col-md-12">
                                  <div class="text-start">
                                      <button class="ud-btn btn-thm" type="submit">Save<i class="fal fa-arrow-right-long"></i></button>
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






@endsection
@section('footer_script')


@endsection