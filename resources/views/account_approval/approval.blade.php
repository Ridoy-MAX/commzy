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
                            <h2>User List</h2>
    
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="search_area dashboard-style m-2">
                            <form action="{{ route('account.approval') }}" method="GET">
                                <label><span class="flaticon-loupe"></span></label>
                                <input type="text" name="search" class="form-control border-0 w-100" placeholder="Search" aria-autocomplete="list">
                               
                            </form>
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
                                            <th scope="col"> Name</th>
                                     
                                            <th scope="col">Email</th>
                                        
                                            <th scope="col">State </th>
                                            <th scope="col">Create Date </th>
                                            <th scope="col">Actions </th>
                                        </tr>
                                    </thead>
                                    <tbody class="t-body">
                                        @foreach ($approvalusers as $key => $approvaluser) 
                                        <tr>
                                            <th scope="row"> #{{ $key+1 }}</th>
                                            <td class="vam">{{ $approvaluser->rel_to_user->name }}</td>
                                       
                                            <td class="vam">{{ $approvaluser->rel_to_user->email }}</td>
                                            <td class="vam">
                                            
                                                @if($approvaluser->approval == 'approved')
                                                <span class="pending-style style2">{{ $approvaluser->approval }}</span>
                                                @else
                                                <span class="pending-style style3">{{ $approvaluser->approval }}</span>
                                                @endif

                                      
                                              
                                             
                                            </td>
                                            
                                            <td class="vam">
                                                {{ \Carbon\Carbon::parse($approvaluser->created_at)->format('m, M, Y') }}
                                            </td>
                                            <td class="vam d-flex">
                                              
                                            
                                                <li> 
                                                    
                                                    @if($approvaluser->approval == 'approved')
                                                    <span class="pending-style style2">    Account approved</span>
                                                    @else
                                                        <a href="" class="btn " style="background-color: #E34A6F; color: white;" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal{{ $key }}">
                                                            <i class="fa-solid fa-plus"></i>
                                                        Account approval
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
                                                                <form class="form-style1" action="{{ route('users.approved', $approvaluser->id) }}" method="POST">
                                                                    @csrf
                                                                    <div class="row">       
                                                                        <div class="mb20">
                                                                            <div class="form-style1">
                                                                                <label class="heading-color ff-heading fw500 mb10">Account approved as</label>
                                                                                <select class="selectpicker" name="role">
                                                                                 
                                                                                    <option value="">seller</option>
                                                                                  
                                                                                    </select>
                                                                            </div>

                                                                            <input type="hidden" name="approval" value="approved">
                                                                        </div>
                                                                     
                                                                       
                                                                  
                                                                        <div class="col-md-12">
                                                                            <div class="text-start">
                                                                                <button type="submit" class="ud-btn btn-thm" href="">Approved <i
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
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mbp_pagination text-center mt30">
                                    <ul class="page_navigation">
                                        @for ($i = 1; $i <= $approvalusers->lastPage(); $i++)
                                            <li class="page-item {{ ($approvalusers->currentPage() == $i) ? 'active' : '' }}">
                                                <a class="page-link" href="{{ $approvalusers->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endfor
                                    </ul>
                                    <p class="mt10 mb-0 pagination_page_count text-center">
                                        {{ $approvalusers->firstItem() }} – {{ $approvalusers->lastItem() }} of {{ $approvalusers->total() }} records
                                    </p>
                                </div>
                            </div>
                        </div>
    
                    </div>
                </div>

          

            </div>
           
        </div>

        
         <!-- Modal for Viewing  Details -->


      
     




@endsection
@section('footer_script')


@endsection