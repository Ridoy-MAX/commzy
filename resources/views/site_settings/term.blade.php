@extends('layouts.dashboard')
@section('content')

<div class="dashboard__content hover-bgc-color">
            <div class="row pb40">
                <div class="col-lg-12">
                @include('components.main_component.dashboard_navigation')
                  
                </div>
            </div>
        <div class="row align-items-center justify-content-between ">

            @if(session('term'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('term') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="col-lg-12">
              <div class="card">
                     <form method="POST" action="{{ route('term.update') }}">
                        <div class="card-header">
                            <h2>Terms of Service</h2>
                        </div>
                    
                        <div class="card-body">
                                @csrf <!-- Add this line to include CSRF token -->
                                <div class="mb10">
                                    <label class="heading-color ff-heading fw500 mb10">Description</label>
                                <div id="term" style="height: 400px;">{!! $termSetting->description ?? '' !!}</div>

                                    <input type="hidden" name="description" id="description-input">
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                </div>  
                                
                                <div class="text-start pt-3">
                                    <button type="submit" class="ud-btn btn-thm">Save<i class="fal fa-arrow-right-long"></i></button>
                                </div>
                        </div>

                  

                   </form>
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
var quill = new Quill('#term', {
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