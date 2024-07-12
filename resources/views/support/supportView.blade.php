@extends('layouts.dashboard')
@section('content')


      
<div class="dashboard__content hover-bgc-color">
    <div class="row pb40">
        <div class="col-lg-12">
        @include('components.main_component.dashboard_navigation')
          
        </div>
    </div>
<div class="row align-items-center justify-content-between ">

    @if(session('support'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('support') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="col-lg-12">
      
        <div class="row align-items-center justify-content-between ">
            <div class="col-lg-6">
                <div class="dashboard_title_area">
                    <h2>Support</h2>

                </div>
            </div>
            <div class="col-lg-6">
             
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="ps-widget bgc-white bdrs4 p30 mb60 overflow-hidden position-relative">
                    <div class="packages_table table-responsive">
                        <table class="table-style3 table at-savesearch">
                            <thead class="t-head">
                                <tr>
                                    
                         
                                    <th scope="col">Subject</th>
                                    <th scope="col">Priority </th>
                                    <th scope="col">Status </th>
                                    <th scope="col">Created Date </th>
                                    <th scope="col">Update Date  </th>
                                </tr>
                            </thead>
                            <tbody class="t-body">
                                <tr>
                                
                                
                                    <td class="vam">{{$supports->subject}}</td>
                                    <td class="vam">{{$supports->priority}}</td>
                                    <td class="vam"><span class="pending-style style1">{{$supports->status}}</span>
                                    <td class="vam">
                                      {{$supports->created_at->diffForHumans()}}
                                      {{-- {{$supports->created_at}} --}}
                                    </td>
                                    <td class="vam">
                                      {{-- {{$supports->updated_at}} --}}
                                      {{$supports->updated_at->diffForHumans()}}
                                    </td>
                                </tr>
                               

                            </tbody>
                        </table>
                     
                    </div>
                    <div class="row">
                        <div class="col-md-10">
                            <label class="heading-color ff-heading fw500 mb10">Description</label>
                            <p>
                              {{$supports->description}}
                            </p>

                            <label class="heading-color ff-heading fw500 mb10">attachment</label>
                       
                                <!-- Display other support information -->
{{-- 
                                <span class="">Open</span> --}}
                                @if($supports->attachment)
                                <a href="{{ asset($supports->attachment) }}" class="pending-style style2" download>Download Attachment</a>
                                @else
                                No attachment uploaded.
                                 @endif
                            
                        </div>
                      
                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 m-auto">
                <div class="message_container mt30-md m-2 " >
                  <div class="user_heading px-0 mx30" >
                    <div class="wrap">
                      <img class="img-fluid mr10" src="/avatar.jpg" alt="ms3.png" style="height: 55px; width: 55px; position: relative; top: 0px;">
                      <div class="meta d-sm-flex justify-content-sm-between align-items-center">
                        <div class="authors">
                          <h6 class="name mb-0">Admin</h6>
                 
                          <p class="preview">{{$supports->status}}</p>
                        </div>
                        <div>
                        
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="inbox_chatting_box" style="margin-bottom: 110px">
                    <ul class="chatting_content">

                      @foreach($support_chats as $key => $support_chat)

                          @if($support_chat->user_id == Auth::user()->id)
                          <!-- Messages from authenticated user (left side) -->
                          <li class="reply float-end">
                            <div class="d-flex align-items-center justify-content-end mb15">
                              <div class="title fz15"><small class="mr10">{{ $support_chat->created_at->diffForHumans() }}</small> You</div>
    
                              @if(Auth::user()->profile_pic)
                              <img class=" img-fluid rounded-circle align-self-end ml10" src="{{ asset(Auth::user()->profile_pic) }}" alt="Profile Picture" style="height: 55px; width: 55px; position: relative; top: 0px;">
                              @else
                              <img class="img-fluid rounded-circle align-self-end ml10" src="/avatar.jpg" alt="user.png" style="height: 55px; width: 55px; position: relative; top: 0px;"> 
                                
                              @endif
        
                              {{-- <img class="img-fluid rounded-circle align-self-end ml10" src="images/inbox/ms5.png" alt="ms5.png"> --}}
                            </div>
                            <p>{{ $support_chat->message }}</p>

                            @if($support_chat->attachment)
                            <a href="{{ asset($support_chat->attachment) }}" class="pending-style style2" download>Download Attachment</a>
                            @else
                           
                             @endif

                            
                          </li>

                           
                          @else
                            <!-- Messages from other users (right side) -->
                            <li class="sent float-start">
                              <div class="d-flex align-items-center mb15">

                                @if($support_chat->rel_to_user->profile_pic)

                                <img class=" rounded-circle wa-xs me-2" src="{{ asset($support_chat->rel_to_user->profile_pic) }}" alt="Profile Picture"
                                 style="height: 60px; width: 60px;">
                                @else
                                <img class=" rounded-circle wa-xs" src="/avatar.jpg" alt="user.png" style="height: 60px; width: 60px;"> 
                                  
                                @endif


                                {{-- @if( $support_chat->rel_to_user->profile_pic )
                                  <img class=" img-fluid rounded-circle align-self-end ml10" 
                                  src="{{ $support_chat->rel_to_user->profile_pic }}" alt="Profile Picture" 
                                  style="height: 55px; width: 55px; position: relative; top: 0px;">
                                  @else
                                  <img class="img-fluid rounded-circle align-self-end ml10" src="/avatar.jpg" alt="user.png"
                                   style="height: 55px; width: 55px; position: relative; top: 0px;"> 
                                
                                @endif --}}

                                {{-- <img class="img-fluid rounded-circle align-self-start mr10" src="/avatar.jpg" alt="ms3.png" style="height: 55px; width: 55px; position: relative; top: 0px;"> --}}
                                <div class="title fz15">{{ $support_chat->rel_to_user->name }}<small class="ml10">  {{ $support_chat->created_at->diffForHumans() }}</small></div>
                              </div>
                              <p>{{ $support_chat->message }}</p>
                       
                              @if($support_chat->attachment)
                              <a href="{{ asset($support_chat->attachment) }}" class="pending-style style2" download>Download Attachment</a>
                              @else
                             
                               @endif
                              
                            </li>
                           @endif
                      @endforeach


                   



                    </ul>
                  </div>


                  @if($supports->status == 'Open')
                  <div class="mi_text">
                    <div class="message_input">
                      <form class="d-flex align-items-center" action="{{ route('support.chat' ,['id' => $supports->id] )}}" method="POST"  enctype="multipart/form-data" >
                        @csrf
                        {{-- <div class="col">
                          <textarea name="" id="" cols="30" rows="2" name="message"></textarea>
                        </div> --}}
                        <div class="col-md-9">
                          <input class="form-control" type="text"  placeholder="Type a Message" name="message" 
                          style="background: transparent !important;outline: none;" >
                        </div>
                        


                        <div class="col-md-3">
                          {{-- <input   type="file" placeholder="" 
                          name="attachment"> --}}
                          <a href=" me-5 p-5" data-bs-toggle="modal" data-bs-target="#exampleModal">  <i class="fa-solid fa-plus m-3"></i> </a>
                          <button class="btn ud-btn btn-thm m-2"   ><i class="fa-regular fa-paper-plane"></i></button>
                  
                        </div>
                    
                        
 
                      </form>
                    </div>
                  </div>
                  @else
                  <div class="mi_text">
                    <div class="message_input p-3">
                      <span class="pending-style style1">Support Closed</span>
                    </div>
                  </div>
                    
                  @endif

                 
                </div>
              </div>
        </div>
    </div>


</div>
</div>








<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form  action="{{ route('support.chat' ,['id' => $supports->id] )}}" method="POST"  enctype="multipart/form-data" >
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">File add</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <label for=""> Add file</label>
          <input   type="file" placeholder="" 
          name="attachment">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn ud-btn btn-thm" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn ud-btn btn-thm">Save changes</button>
        </div>
      </div>
    </form>
   
  </div>
</div>
@endsection
@section('footer_script')


@endsection