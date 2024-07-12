@extends('layouts.dashboard')
@section('content')

 <style>
.bootstrap-tagsinput {
	margin: 0;
	width: 100%;
	padding: 0.5rem 0.75rem 0;
	font-size: 1rem;
	line-height: 1.25;
	transition: border-color 0.15s ease-in-out;

	&.has-focus {
		background-color: #fff;
		border-color: #5cb3fd;
	}

	.label-info {
		display: inline-block;
		background-color: #636c72;
		padding: 0 0.4em 0.15em;
		border-radius: 0.25rem;
		margin-bottom: 0.4em;
	}

	input {
		margin-bottom: 0.5em;
	}
}

.bootstrap-tagsinput .tag [data-role="remove"]:after {
	content: "\00d7";
}

 </style>
        <div class="dashboard__content hover-bgc-color">
               <div class="row pb40">
                    <div class="col-lg-12">
                    @include('components.main_component.dashboard_navigation')
                    </div>
                </div>

               <div class="row">
                   <div class="col-lg-9">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                            <div class="dashboard_title_area">
                                <h2> Services update</h2>
                            
                            </div>
                    </div>
                    {{-- <div class="col-lg-3">
                        <div class="text-lg-end">
                            <a href="#" class="ud-btn btn-dark">Save & Publish<i class="fal fa-arrow-right-long"></i></a>
                        </div>
                    </div> --}}
               </div>

               <div class="row">
                <div class="col-xl-12">
                  <div class="ps-widget bgc-white bdrs4 p30 mb30 overflow-hidden position-relative">
                    <div class="bdrb1 pb15 mb25">
                      <h5 class="list-title">Basic Information</h5>
                    </div>
                    <div class="col-xl-12">
                      <form class="form-style1" method="post" action="{{ route('service.information.update')}}" >
                        @csrf
                        <div class="row">
                            <input type="hidden" name="service_information_id" value="{{ $serviceInformation->id }}">

                          <div class="col-sm-6">
                            <div class="mb20">
                              <label class="heading-color ff-heading fw500 mb10">Service Title</label>
                              <input type="text" class="form-control" placeholder="" required name="service_title" value="{!!$serviceInformation->service_title!!}">
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="mb20">
                              <label class="heading-color ff-heading fw500 mb10">Price</label>
                              <input type="text" class="form-control" placeholder="$10" required name="price" value="{{$serviceInformation->price}}">
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="mb20">
                              <div class="form-style1">
                                <label class="heading-color ff-heading fw500 mb10">Category</label>
                                <div class="bootselect-multiselect">
                                  <select class="selectpicker" required name="category_id">
                                    <option value="{{ $serviceInformation->category_id }}" selected> {{$serviceInformation->category->name }}</option>
                                    @foreach($category as $key => $user)
                                  

                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                      
                         
                          <div class="col-sm-6">
                            <div class="mb20">
                              <div class="form-style1">
                                <label class="heading-color ff-heading fw500 mb10">Delivery Time Days</label>
                                <div class="bootselect-multiselect" required >
                                  <select class="selectpicker" name="delivery_time">
                                
                                    <option selected> {!! $serviceInformation->delivery_time !!}</option>

                                    <option>1 days</option>
                                    <option>2 days</option>
                                    <option>3 days</option>
                                    <option>4 days</option>
                                    <option>5 days</option>
                                    <option>6 days</option>
                                    <option>7 days</option>
                                    <option>8 days</option>
                                    <option>9 days</option>
                                    <option>10 days</option>
                                    <option>11 days</option>
                                    <option>12 days</option>
                                   
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                         
                          <div class="col-sm-6">
                            <div class="mb20">
                              <div class="form-style1">
                                <label class="heading-color ff-heading fw500 mb10">Skills</label>
                                <input type="text" name="skill[]"  class="form-control" placeholder="" value="{{$serviceInformation->skill}}">

                                
                              </div>
                            </div>
                          </div>
                          
                          <div class="col-sm-6">
                            <div class="mb20">
                              <div class="form-style1">
                                <label class="heading-color ff-heading fw500 mb10">Tag</label>
                       
                                <input type="text" name="tag[]"  class="form-control" placeholder="" value="{{$serviceInformation->tag}}">

                                {{-- <input class="form-control" type="text" id="tag" name="tag[]" required /> --}}

                            

                              
                              </div>
                            </div>
                          </div>

               
                       
                      
                      
                          <div class="col-md-12">
                            <div class="mb10">
                              {{-- <div id="privacy" style="height: 400px;"> {!! $privacySetting->description !!}</div>
                              <input type="hidden" name="description" id="description-input"> --}}

                              <label class="heading-color ff-heading fw500 mb10">Services Detail</label>

                              <div id="privacy" style="height: 400px;"> {!! $serviceInformation->service_detail !!}   </div>
                              <input type="hidden" name="service_detail" id="description-input" >
                              {{-- <textarea cols="30" rows="6" placeholder="Description" required name="service_detail"></textarea> --}}
                            </div>
                          </div>

                          <div class="col-sm-12">
                            <div class="mb20">
                              <label class="heading-color ff-heading fw500 mb10">Meta Title</label>
                              <input type="text" class="form-control" placeholder="i will" required name="meta_title" value="{{$serviceInformation->meta_title}}">
                            </div>
                          </div>
                        
                          <div class="col-md-12">
                            <div class="mb10">
                              <label class="heading-color ff-heading fw500 mb10">Meta Description</label>
                              <textarea cols="30" rows="6" placeholder="Description" required name="meta_description">
                                {{$serviceInformation->meta_description}}
                              </textarea>
                            </div>
                          </div>

                          <div class="col-md-12">
                            <div class="text-start">
                              <button type="submit" class="ud-btn btn-thm" href="">Update<i class="fal fa-arrow-right-long"></i></button>
                              <a  class="ud-btn btn-thm mt-5" href="{{ route('service.faq.update', ['id' => $serviceInformation->id]) }}" style="position: relative;top:24px;left:20px;">
                                Next
                                <i class="fal fa-arrow-right-long"></i>
                            </a>
                            </div>
                          </div>

                        </div>
                      </form>
                    </div>
                  </div>
              
           

           

            
                </div>
              </div>
            

             
                
               
        </div>
         
        
       

        
         <!-- Modal for Viewing User Details -->



    


@endsection
@section('footer_script')
<!-- Include the Quill library -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<!-- Include stylesheet -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<!-- Initialize Quill editor -->
<script>
  var quill = new Quill('#privacy', {
      theme: 'snow',
      placeholder: 'Write something amazing...',
  });
  
  var descriptionInput = document.getElementById('description-input');
  
  quill.on('text-change', function() {
      descriptionInput.value = quill.root.innerHTML;
  });
  
  $('form').submit(function(event) {
      // Ensure the Quill content is updated before form submission
      descriptionInput.value = quill.root.innerHTML;
  });
  </script>


<script>

$(document).ready(function() {
    // Initialize Bootstrap Tags Input
    $('input[name="tag[]"]').tagsinput({
        trimValue: true,
        confirmKeys: [13, 44, 32],
        focusClass: 'my-focus-class'
    });

    // Initialize Select2 for tag input
    $('#tag').select2();
});
$(document).ready(function() {
    // Initialize Bootstrap Tags Input
    $('input[name="skill[]"]').tagsinput({
        trimValue: true,
        confirmKeys: [13, 44, 32],
        focusClass: 'my-focus-class'
    });

    // Initialize Select2 for tag input
    $('#skill').select2();
});
// $(document).ready(function(){
//   $('#tag').select2();
// });

</script>
<!-- Bootstrap Tags Input CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">

<!-- Select2 CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/css/select2.min.css">

<!-- Bootstrap Tags Input JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/js/select2.min.js"></script>

@endsection