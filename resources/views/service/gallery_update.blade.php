@extends('layouts.dashboard')
@section('content')


        <div class="dashboard__content hover-bgc-color">
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
                  <div class="ps-widget bgc-white bdrs12 p30 mb30 overflow-hidden position-relative">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                     
                    @error('image')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <div class="text-danger">{{ $message }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                   
                    @enderror

                    <div class="bdrb1 pb15 mb30">
                      <h5 class="list-title">Gallery</h5>
                    </div>
                    <div class="col-xl-9">
                      <div class="d-flex mb30">
                        @foreach ($gallery as $gallery)
                        <div class="gallery-item me-3 bdrs4 overflow-hidden position-relative">
                          <img class="" src="{{ asset('service/gallery/' . $gallery->image) }}" alt="image"  style="width: 200px;height:180px">
                          <div class="del-edit">
                            <div class="d-flex justify-content-center">

                             
                              <a href="{{ route('gallery.delete', $gallery->id) }}" class="icon" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete"><span class="flaticon-delete"></span></a>
                            </div>
                          </div>
                        </div>
                        @endforeach

                      
                        <div class="gallery-item bdrs4 overflow-hidden">
                          <a href="#" data-bs-toggle="modal" data-bs-target="#addmodal"><img class="w-100" src="{{asset('images/gallery/g-1.png')}} " alt=""></a>
                        </div>
                      </div>
                      <p class="text">Max file size is 1MB, Minimum dimension: 330x300 And Suitable files are .jpg & .png</p>
                      <a href="{{ route('service.view')}}" class="ud-btn btn-thm mt-2">Save & Publish<i class="fal fa-arrow-right-long"></i></a>
                    </div>
                  </div>
                </div>
              </div>
            

             
                
               
        </div>
         
        
       

        
         <!-- Modal for Viewing User Details -->


   


<!-- Modal -->
<div class="modal fade" id="addmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Add Gallery </h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div class="ps-widget bgc-white bdrs4 p30  overflow-hidden position-relative">
                  <div class="col-xl">
                      <form class="form-style1" method="post" action="{{ route('update.save.gallery', ['id' => $id]) }}" enctype="multipart/form-data">
                          @csrf
                          <div class="row">
                              <div class="mb20">
                                  <label class="heading-color ff-heading fw500 mb10">Chosse image</label>
                                  <input type="file" name="image" class="form-control" required>
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