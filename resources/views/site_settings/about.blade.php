@extends('layouts.dashboard')
@section('content')

<div class="dashboard__content hover-bgc-color">
            <div class="row pb40">
                <div class="col-lg-12">
                @include('components.main_component.dashboard_navigation')
                  
                </div>
            </div>
        <div class="row align-items-center justify-content-between ">

            @if(session('about'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('about') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="col-lg-12">
              <div class="dashboard_title_area card" style="height: 70vh;">

                   <div class="card-header">
                       <h2>About Us</h2>
                   </div>
  
                   <div class="card-body">
                      <form method="POST" action="{{ route('about.update') }}">
                            @csrf <!-- Add this line to include CSRF token -->
                            <div class="mb10">
                                <label class="heading-color ff-heading fw500 mb10">Description</label>
                            <div id="about" style="height: 400px;">{!! $aboutSetting->description ?? '' !!}</div>

                                <input type="hidden" name="description" id="description-input">
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            </div>
                            <div class="text-start">
                                <button type="submit" class="ud-btn btn-thm">Save<i class="fal fa-arrow-right-long"></i></button>
                            </div>
                        </form>
                   </div>
          
              
              </div>
            </div>


        </div>
</div>


<!-- Create the editor container -->
<!-- <div id="editor">
  <p>Hello World!</p>
  <p>Some initial <strong>bold</strong> text</p>
  <p><br></p>
</div>
 -->


@endsection
@section('footer_script')
<!-- Include the Quill library -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<!-- Include stylesheet -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<!-- Initialize Quill editor -->
<script>
var quill = new Quill('#about', {
  theme: 'snow',
  modules: {
    toolbar: [
      [{ 'font': [] }],
      [{ 'list': 'ordered'}, { 'list': 'bullet' }],
      ['bold', 'italic', 'underline', 'strike'],
      [{ 'color': [] }, { 'background': [] }],
      ['link', 'image', 'video'],
      ['clean']
    ],
    clipboard: {
      matchVisual: false // Disable pasting as plain text
    },
    history: {
      delay: 2000, // Set the delay for history snapshots
      maxStack: 500 // Set the maximum history stack size
    }
  },
  placeholder: 'Write something amazing...', // Set a placeholder text
  formats: [
    'font', 'list', 'bold', 'italic', 'underline', 'strike',
    'color', 'background', 'link', 'image', 'video'
  ]
});

// Add a custom handler for text change event
var descriptionInput = document.getElementById('description-input');

quill.on('text-change', function () {
    descriptionInput.value = quill.root.innerHTML;
});
</script>


@endsection