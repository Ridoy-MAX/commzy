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
    @if(session('support_update'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('support_update') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @canAny(['administration-power'])
    <div class="col-lg-12">
        <div class="row align-items-center justify-content-between ">
            <div class="col-lg-6">
                <div class="dashboard_title_area">
                    <h2>All Supports</h2>

                </div>
            </div>
            <div class="col-lg-6">
                <div class="text-lg-end">
                    <a href="" class="ud-btn  " data-bs-toggle="modal"
                        data-bs-target="#exampleModal" style="background-color: #E34A6F; color:aliceblue;">Add Ticket
                        <i class="fa-regular fa-square-plus"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="ps-widget bgc-white bdrs4 p30 mb60 overflow-hidden position-relative">
                    <div class="packages_table table-responsive">
                        <table class="table-style3 table at-savesearch">
                            <thead class="t-head">
                                <tr>
                                    <th scope="col">Id</th>
                                 
                                    <th scope="col">Subject</th>
                                    <th scope="col">Priority </th>
                                    <th scope="col">Status </th>
                                    <th scope="col">Create Date </th>
                                    <th scope="col">Actions </th>
                                </tr>
                            </thead>
                            <tbody class="t-body">

                                @foreach($adminsupports as $key => $support)
                                <tr>
                                    <th scope="row"> #{{ $key + 1 }}</th>
                                  
                                    <td class="vam">{{ $support->subject }}</td>
                                    <td class="vam">{{ $support->priority }}</td>
                                    <td class="vam">

                                        @if($support->status == 'Close')
                                        <span class="pending-style style1">{{$support->status}}</span>
                                        @endif
                                        @if($support->status == 'Open')
                                        <span class="pending-style style2">{{$support->status}}</span>
                                        @endif
                                     

                                        
                                        {{-- <span class="pending-style style1">{{ $support->status }}</span> --}}
                                    <td class="vam">
                                        {{$support->created_at->diffForHumans()}}
                                        {{-- {{ $support->created_at }} --}}
                                    </td>
                                    <td class="vam d-flex">
                                        <li> 
                                            <a href="{{ route('support.view' , ['id' => $support->id] ) }}" class="icon "><i class="fa-regular fa-eye"></i></a> 
                                        </li>
                                        <li> 
                                            <a 
                                            data-bs-toggle="modal" data-bs-target="#exampleModal{{ $key + 1 }}"
                                            class="icon ms-2"
                                            >
                                            <i class="fa-regular fa-pen-to-square ms-2 me-2"></i>
                                           </a>
                                        </li>

                                    

                                    </td>
                                </tr>
                         
                                
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $key + 1 }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                  
                                        <div class="modal-body">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Close Ticket</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="ps-widget bgc-white bdrs4 p30  overflow-hidden position-relative">
                                                
                                                    <div class="col-xl">
                                                        <form class="form-style1" method="POST" action="{{ route('support.update',['id'=> $support->id])}}" enctype="multipart/form-data" >
                                                            @csrf
                                                            <div class="row">


                                                              
                                                                <div class="mb20">
                                                                    <div class="form-style1">
                                                                        <label class="heading-color ff-heading fw500 mb10">Status:</label>
                                                                        <div class="">

                                                                            <div class="dropdown ">
                                                                                <select class="form-control" name="status">
                                                                                <option> Open</option>                                                                               
                                                                                <option> Close </option>
                                                                                </select>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            
                                                            
                                                          
                                                                <div class="col-md-12">
                                                                    <div class="text-start">
                                                                        <button type="submit" class="ud-btn btn-thm" href="page-contact.html">Save<i
                                                                                class="fal fa-arrow-right-long"></i></button>
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
                                </div>



                                      <!-- Delete Button (Using Bootstrap Modal for Confirmation) -->
                          

                            
                                @endforeach
                               
                            </tbody>
                        </table>

                        <div class="mbp_pagination text-center mt30">
                            <ul class="page_navigation">
                                @for ($i = 1; $i <= $supports->lastPage(); $i++)
                                    <li class="page-item {{ ($supports->currentPage() == $i) ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $supports->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                            </ul>
                            <p class="mt10 mb-0 pagination_page_count text-center">
                                {{ $supports->firstItem() }} – {{ $supports->lastItem() }} of {{ $supports->total() }} records
                            </p>
                        </div>

                    
                    </div>
                </div>

            </div>
        </div>
    </div>
    @endcan

    @canAny(['client'])
    <div class="col-lg-12">
        <div class="row align-items-center justify-content-between ">
            <div class="col-lg-6">
                <div class="dashboard_title_area">
                    <h2>Support</h2>

                </div>
            </div>
            <div class="col-lg-6">
                <div class="text-lg-end">
                    <a href="" class="ud-btn  " data-bs-toggle="modal"
                        data-bs-target="#exampleModal" style="background-color: #E34A6F; color:aliceblue;">Add Ticket
                        <i class="fa-regular fa-square-plus"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="ps-widget bgc-white bdrs4 p30 mb60 overflow-hidden position-relative">
                    <div class="packages_table table-responsive">
                        <table class="table-style3 table at-savesearch">
                            <thead class="t-head">
                                <tr>
                                    <th scope="col">Id</th>
                                 
                                    <th scope="col">Subject</th>
                                    <th scope="col">Priority </th>
                                    <th scope="col">Status </th>
                                    <th scope="col">Create Date </th>
                                    <th scope="col">Actions </th>
                                </tr>
                            </thead>
                            <tbody class="t-body">

                                @foreach($supports as $key => $support)
                                <tr>
                                    <th scope="row"> #{{ $key + 1 }}</th>
                                  
                                    <td class="vam">{{ $support->subject }}</td>
                                    <td class="vam">{{ $support->priority }}</td>
                                    <td class="vam">

                                        @if($support->status == 'Close')
                                        <span class="pending-style style1">{{$support->status}}</span>
                                        @endif
                                        @if($support->status == 'Open')
                                        <span class="pending-style style2">{{$support->status}}</span>
                                        @endif
                                     

                                        
                                        {{-- <span class="pending-style style1">{{ $support->status }}</span> --}}
                                    <td class="vam">
                                        {{$support->created_at->diffForHumans()}}
                                        {{-- {{ $support->created_at }} --}}
                                    </td>
                                    <td class="vam d-flex">
                                        <li> 
                                            <a href="{{ route('support.view' , ['id' => $support->id] ) }}" class="icon "><i class="fa-regular fa-eye"></i></a> 
                                        </li>
                                        <li> 
                                            <a 
                                            data-bs-toggle="modal" data-bs-target="#exampleModal{{ $key + 1 }}"
                                            class="icon ms-2"
                                            >
                                            <i class="fa-regular fa-pen-to-square ms-2 me-2"></i>
                                           </a>
                                        </li>

                                    

                                    </td>
                                </tr>
                         
                                
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $key + 1 }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                  
                                        <div class="modal-body">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Close Ticket</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="ps-widget bgc-white bdrs4 p30  overflow-hidden position-relative">
                                                
                                                    <div class="col-xl">
                                                        <form class="form-style1" method="POST" action="{{ route('support.update',['id'=> $support->id])}}" enctype="multipart/form-data" >
                                                            @csrf
                                                            <div class="row">


                                                              
                                                                <div class="mb20">
                                                                    <div class="form-style1">
                                                                        <label class="heading-color ff-heading fw500 mb10">Status:</label>
                                                                        <div class="bootselect-multiselect">

                                                                            <div class="dropdown ">
                                                                                <select class="form-control" name="status">
                                                                                <option> Open</option>                                                                               
                                                                                <option> Close </option>
                                                                                </select>
                                                                            </div>


                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            
                                                            
                                                          
                                                                <div class="col-md-12">
                                                                    <div class="text-start">
                                                                        <button type="submit" class="ud-btn btn-thm" href="page-contact.html">Save<i
                                                                                class="fal fa-arrow-right-long"></i></button>
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
                                </div>



                                      <!-- Delete Button (Using Bootstrap Modal for Confirmation) -->
                          

                            
                                @endforeach
                               
                            </tbody>
                        </table>

                        <div class="mbp_pagination text-center mt30">
                            <ul class="page_navigation">
                                @for ($i = 1; $i <= $supports->lastPage(); $i++)
                                    <li class="page-item {{ ($supports->currentPage() == $i) ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $supports->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                            </ul>
                            <p class="mt10 mb-0 pagination_page_count text-center">
                                {{ $supports->firstItem() }} – {{ $supports->lastItem() }} of {{ $supports->total() }} records
                            </p>
                        </div>

                    
                    </div>
                </div>

            </div>
        </div>
    </div>
    @endcan
    @canAny([' seller'])
    <div class="col-lg-12">
        <div class="row align-items-center justify-content-between ">
            <div class="col-lg-6">
                <div class="dashboard_title_area">
                    <h2>Support</h2>

                </div>
            </div>
            <div class="col-lg-6">
                <div class="text-lg-end">
                    <a href="" class="ud-btn  " data-bs-toggle="modal"
                        data-bs-target="#exampleModal" style="background-color: #E34A6F; color:aliceblue;">Add Ticket
                        <i class="fa-regular fa-square-plus"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="ps-widget bgc-white bdrs4 p30 mb60 overflow-hidden position-relative">
                    <div class="packages_table table-responsive">
                        <table class="table-style3 table at-savesearch">
                            <thead class="t-head">
                                <tr>
                                    <th scope="col">Id</th>
                                 
                                    <th scope="col">Subject</th>
                                    <th scope="col">Priority </th>
                                    <th scope="col">Status </th>
                                    <th scope="col">Create Date </th>
                                    <th scope="col">Actions </th>
                                </tr>
                            </thead>
                            <tbody class="t-body">

                                @foreach($supports as $key => $support)
                                <tr>
                                    <th scope="row"> #{{ $key + 1 }}</th>
                                  
                                    <td class="vam">{{ $support->subject }}</td>
                                    <td class="vam">{{ $support->priority }}</td>
                                    <td class="vam">

                                        @if($support->status == 'Close')
                                        <span class="pending-style style1">{{$support->status}}</span>
                                        @endif
                                        @if($support->status == 'Open')
                                        <span class="pending-style style2">{{$support->status}}</span>
                                        @endif
                                     

                                        
                                        {{-- <span class="pending-style style1">{{ $support->status }}</span> --}}
                                    <td class="vam">
                                        {{$support->created_at->diffForHumans()}}
                                        {{-- {{ $support->created_at }} --}}
                                    </td>
                                    <td class="vam d-flex">
                                        <li> 
                                            <a href="{{ route('support.view' , ['id' => $support->id] ) }}" class="icon "><i class="fa-regular fa-eye"></i></a> 
                                        </li>
                                        <li> 
                                            <a 
                                            data-bs-toggle="modal" data-bs-target="#exampleModal{{ $key + 1 }}"
                                            class="icon ms-2"
                                            >
                                            <i class="fa-regular fa-pen-to-square ms-2 me-2"></i>
                                           </a>
                                        </li>

                                    

                                    </td>
                                </tr>
                         
                                
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $key + 1 }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                  
                                        <div class="modal-body">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Close Ticket</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="ps-widget bgc-white bdrs4 p30  overflow-hidden position-relative">
                                                
                                                    <div class="col-xl">
                                                        <form class="form-style1" method="POST" action="{{ route('support.update',['id'=> $support->id])}}" enctype="multipart/form-data" >
                                                            @csrf
                                                            <div class="row">


                                                              
                                                                <div class="mb20">
                                                                    <div class="form-style1">
                                                                        <label class="heading-color ff-heading fw500 mb10">Status:</label>

                                                                        <div class="dropdown ">
                                                                            <select class="form-control" name="status">
                                                                            <option> Open</option>                                                                               
                                                                            <option> Close </option>
                                                                            </select>
                                                                        </div>


                                                                    </div>
                                                                </div>

                                                            
                                                            
                                                          
                                                                <div class="col-md-12">
                                                                    <div class="text-start">
                                                                        <button type="submit" class="ud-btn btn-thm" href="page-contact.html">Save<i
                                                                                class="fal fa-arrow-right-long"></i></button>
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
                                </div>



                                      <!-- Delete Button (Using Bootstrap Modal for Confirmation) -->
                          

                            
                                @endforeach
                               
                            </tbody>
                        </table>

                        <div class="mbp_pagination text-center mt30">
                            <ul class="page_navigation">
                                @for ($i = 1; $i <= $supports->lastPage(); $i++)
                                    <li class="page-item {{ ($supports->currentPage() == $i) ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $supports->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                            </ul>
                            <p class="mt10 mb-0 pagination_page_count text-center">
                                {{ $supports->firstItem() }} – {{ $supports->lastItem() }} of {{ $supports->total() }} records
                            </p>
                        </div>

                    
                    </div>
                </div>

            </div>
        </div>
    </div>
    @endcan
    


</div>
</div>


   <!-- Modal add ticket -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Ticket</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="ps-widget bgc-white bdrs4 p30  overflow-hidden position-relative">
                   
                    <div class="col-xl">
                        <form class="form-style1"  method="post" action="{{ route('support.create') }}" enctype="multipart/form-data" >
                            @csrf
                            <div class="row">

                             

                                <div class="mb20">
                                    <label class="heading-color ff-heading fw500 mb10">Subject</label>
                                    <input type="text" class="form-control" placeholder="" name="subject" required>
                                </div>
                                <div class="mb20">
                                    <div class="form-style1">
                                        <label class="heading-color ff-heading fw500 mb10">Priority:</label>
                                        <div class="bootselect-multiselect">
                                            <div class="dropdown bootstrap-select">
                                                <select class="selectpicker" name="priority" required>
                                                    <option>Select</option>
                                                    <option>High</option>
                                                    <option>Medium</option>
                                                    <option>Low</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb20">
                                    <div class="form-style1">
                                        <label class="heading-color ff-heading fw500 mb10">Status:</label>
                                        <div class="bootselect-multiselect">
                                            <div class="dropdown bootstrap-select">
                                                <select class="selectpicker" name="status" required>
                                                    {{-- <option>Select</option> --}}
                                                    <option>Open</option>
                                                    {{-- <option>Close</option>
                                                    <option>Pending</option> --}}
                                                   
                                                </select>
                                              
                                              
                                            </div>
                                        </div>
                                    </div>
                                </div>

                             
                               
                                <div class="col-md-12">
                                    <div class="mb10">
                                        <label class="heading-color ff-heading fw500 mb10">Description</label>
                                        <textarea cols="30" rows="3" placeholder="Description" name="description" required></textarea>
                                    </div>
                                </div>

                                <div class="mb20">
                                    <label class="heading-color ff-heading fw500 mb10">attachment</label>
                                    <input type="file" class="form-control" name="attachment" >
                                </div>
                                <div class="col-md-12">
                                    <div class="text-start">
                                        <button class="ud-btn btn-thm" type="submit">Save<i
                                                class="fal fa-arrow-right-long"></i></button>
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