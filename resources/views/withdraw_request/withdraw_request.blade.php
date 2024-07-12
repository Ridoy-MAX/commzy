@extends('layouts.dashboard')
@section('content')


        <div class="dashboard__content hover-bgc-color">
            <div class="row pb40">
                <div class="col-lg-12">
                @include('components.main_component.dashboard_navigation')
                </div>
            </div>
            <div class="row align-items-center justify-content-between ">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @error('role')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

           
                <div class="row align-items-center justify-content-between ">
                    <div class="col-lg-6">
                        <div class="dashboard_title_area">
                            <h2>Withdraw request List</h2>
    
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="search_area dashboard-style m-2">
                            {{-- <form action="{{ route('account.approval') }}" method="GET">
                                <label><span class="flaticon-loupe"></span></label>
                                <input type="text" name="search" class="form-control border-0 w-100" placeholder="Search" aria-autocomplete="list">
                               
                            </form> --}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="ps-widget bgc-white bdrs4 p30 mb60 overflow-hidden position-relative">
                            <div class="packages_table table-responsive">
                                <table class="table-style3 table at-savesearch" id="UserTable">
                                    <thead class="t-head">
                                        <tr>
                                     
                                            <th scope="col">User</th>
                                            <th scope="col"> Payment method</th>
                                     
                                            <th scope="col">Account Details</th>
                                        
                                            <th scope="col">State </th>
                                            <th scope="col">Amount </th>
                                            <th scope="col">Date </th>
                                            <th scope="col">Actions </th>
                                        </tr>
                                    </thead>
                                    <tbody class="t-body">
                                        @foreach ($WithdrawnRequest as $key => $Requestuser) 
                                        <tr>
                                          
                                            <td class="vam">

                                                <div class="freelancer-style1 p-0 mb-0 box-shadow-none">
                                                    <div class="d-lg-flex align-items-lg-center">
                                                      <div class="thumb w60 position-relative rounded-circle mb15-md">
                                  
                                                        @if($Requestuser->rel_to_user->profile_pic)
                                  
                                                        <img class=" rounded-circle wa-xs" src="{{ asset($Requestuser->rel_to_user->profile_pic) }}" 
                                                        alt="Profile Picture" style="height: 50px; width: 50px;">
                                                        @else
                                                        <img class=" rounded-circle wa-xs" src="/avatar.jpg" alt="user.png" style="height: 50px; width: 50px;">
                                  
                                                        @endif
                                  
                                                        {{-- <img class="rounded-circle mx-auto" src="images/team/client-1.png" alt=""> --}}
                                                        <span class="online-badge2"></span>
                                                      </div>
                                                      <div class="details ml15 ml0-md mb15-md">
                                                        <h5 class="title mb-2">{{$Requestuser->rel_to_user->name}}</h5>
                                                        <p class="mb-0 fz14 list-inline-item mb5-sm pe-1">
                                                       {{$Requestuser->rel_to_user->email}}</p>
                                  
                                  
                                                      </div>
                                                    </div>
                                                  </div>


                                  
                                          </td>
                                       
                                            <td class="vam">{{ $Requestuser->payment_method}}</td>
                                            <td class="vam">{{ $Requestuser->details}}</td>
                                            <td class="vam">
                                            
                                                @if($Requestuser->status == 'Pending')
                                                <span class="pending-style style3">{{ $Requestuser->status }}</span>
                                                @else
                                                <span class="pending-style style2">{{ $Requestuser->status }}</span>
                                                @endif

                                      
                                              
                                             
                                            </td>

                                            <td class="vam">${{ $Requestuser->amount}}</td>
                                            
                                            <td class="vam">
                                                {{ \Carbon\Carbon::parse($Requestuser->created_at)->format('m, M, Y') }}
                                            </td>
                                            <td class="vam ">
                                              
                                            
                                                <li> 
                                                    
                                                    @if($Requestuser->status == 'completed')
                                                    <a  class="btn " style="background-color: #4ae39c; color: white;"  >
                                                    
                                                       approved
                                                    </a>

                                    
                                                    @else
                                                        <a href="" class="btn " style="background-color: #E34A6F; color: white;" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal{{ $key }}">
                                                            {{-- <i class="fa-solid fa-plus"></i> --}}
                                                          Accept  Request 
                                                        </a>
                                                    @endif

                                                  
                                                </li>
                                            </td>
                                        </tr>



                                        <div class="modal fade" id="exampleModal{{ $key }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="ps-widget bgc-white bdrs4 p30  overflow-hidden position-relative">
                                                           
                                                            <div class="col-xl">
                                                                <form class="form-style1" action="{{ route('withdrawn.request.accept')}}" method="POST">
                                                                    @csrf
                                                                    <div class="row">       
                                                                        <div class="mb20">
                                                                            <div class="form-style1">
                                                                            <label class="heading-color ff-heading fw500 mb10"> Are you sure to Approved ? </label>
                                                                           
                                                                            </div>

                                                                            <input type="hidden" name="payout_id" value="{{ $Requestuser->payout_id}}">
                                                                            <input type="hidden" name="withdrawnrequest_id" value="{{ $Requestuser->id}}">
                                                                        </div>
                                                                     
                                                                       
                                                                  
                                                                        <div class="col-md-12">
                                                                            <div class="text-start">
                                                                                <button type="submit" class="ud-btn btn-thm" href="">Approved <i
                                                                                        class="fal fa-arrow-right-long"></i>
                                                                                </button>

                                                                                {{-- <button type="button" class="btn btn-secondary" >
                                                                                    Close
                                                                                </button> --}}

                                                                                <button type="button" class="ud-btn btn-thm" data-bs-dismiss="modal">Cancel <i
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
                                        @endforeach
                                    </tbody>
                                </table>
                            
                            </div>
                        </div>
    
                    </div>
                </div>

          

            </div>
           
        </div>

        
         <!-- Modal for Viewing  Details -->


      
        <style>

         #UserTable_filter label {
            float: left;
            display: flex;
            margin-bottom: 20px;
            align-items: center;
            font-size: 17px;
            font-weight: 500;
        } 
              #UserTable_paginate{
          display: flex;
          justify-content: center;
          align-items: center;
        }
        
        #UserTable_filter input[type="search"] {
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            float: right;
            margin: 10px;
        }
        #UserTable_previous{
        
          display: none;
        }
        #UserTable_next{
          display: none;
        }
        #UserTable_paginate .paginate_button {
          padding: 8px 15px !important;
          font-weight: 600;
          border-radius:100%; 
          font-weight: 500;
          font-size: 15px;
          height: 40px !important;
          line-height: 40px;
          overflow: hidden;
          padding: 0;
          text-align: center;
          background: #f8f8f8;
          color: #000000;
           margin-left: 10px;
           margin-top: 0px;
           font-weight: 500;
           cursor: pointer;
           border: 1px solid #474747; 
        }
        
        
        #UserTable_paginate .paginate_button.current {
          font-weight: 600;
          border-radius:100%; 
          font-weight: 500;
          font-size: 15px;
          height: 40px !important;
          line-height: 40px;
          overflow: hidden;
          padding: 0;
          text-align: center;
          width: 40px !important;
            background-color: #E34A6F; /* Set background color for the active page button */
            color: #ffffff; /* Set text color for the active page button */
            border: 1px solid #E34A6F; /* Set border color for the active page button */
        }
        </style>


@endsection
@section('footer_script')
<script>
    $(document).ready(function() {
    $('#UserTable').DataTable({
        "paging": true, // Enable pagination
        "searching": true, // Enable search bar
        "lengthChange": false, // Disable the ability to change the number of rows displayed per page
        "pageLength": 5, // Number of rows per page
        "order": false, // Disable initial sorting
        "language": {
            "paginate": {
                "previous": "",
                "next": ""
            },
            "lengthMenu": "Show _MENU_ entries",
            "search": "Search:"
        }
    });
});
</script>

@endsection