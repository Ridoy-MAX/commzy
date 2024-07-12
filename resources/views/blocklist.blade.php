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


          
             
          
         

         <!-- Your user creation form goes here -->


          

                <div class="col-lg-9">
                    <div class="dashboard_title_area">
                        <h2>Block List</h2>

                    </div>
                </div>
                
                <div class="col-lg-3">
                    <div class="search_area dashboard-style m-2">
                        <form action="{{ route('blocklist') }}" method="GET">
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
                            <table class="table-style3 table at-savesearch ">
                                <thead class="t-head">
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Email </th>
                                        <th scope="col">Status </th>
                                        <th scope="col">Created Date </th>
                                        <th scope="col">Actions </th>
                                    </tr>
                                </thead>
                                <tbody class="t-body">
                                @foreach($blockusers as $key => $user)
                               

                                    <tr>
                                        <th scope="row"> #{{ $key + 1 }}</th>
                                        <td class="vam">{{ $user->name }}</td>
                                        <td class="vam">Kellie123</td>
                                        <td class="vam">{{ $user->email }}</td>
                                        <td class="vam"><span class="pending-style style3">Block</span>
                                        <td class="vam">
                                        {{ $user->created_at }}
                                        </td>
                                        <td class="vam d-flex">
                                            <li> 
                                                <a href="#" class="view-user icon" data-bs-toggle="modal" data-bs-target="#exampleModal2"
                                                    data-name="{{ $user->name }}" data-username="{{ $user->username }}" data-email="{{ $user->email }}">
                                                    <i class="fa-regular fa-eye"></i>
                                                </a>

                                                <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">View Account</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="ps-widget bgc-white bdrs4 p30 overflow-hidden position-relative">
                                                                    <div class="col-xl">
                                                                        <form class="form-style1">
                                                                            <div class="row">
                                                                                <div class="mb20">
                                                                                    <label class="heading-color ff-heading fw500 mb10">Name</label>
                                                                                    <p>{{ $user->name }}</p>
                                                                                </div>
                                                                                <div class="mb20">
                                                                                    <label class="heading-color ff-heading fw500 mb10">Username</label>
                                                                                    <p>{{ $user->username }}</p>
                                                                                </div>
                                                                                <div class="mb20">
                                                                                    <label class="heading-color ff-heading fw500 mb10">Email</label>
                                                                                    <p>{{ $user->email }}</p>
                                                                                </div>
                                                                                <div class="mb20">
                                                                                    <label class="heading-color ff-heading fw500 mb10">Status</label>
                                                                                    <span class="pending-style style3">Block</span>
                                                                                </div>
                                                                                <div class="mb20">
                                                                                    <label class="heading-color ff-heading fw500 mb10">Created Date</label>
                                                                                    <p>{{ $user->created_at }} </p> 
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        
                                            <li>
                                          
                                             <!-- Include this inside your Blade file -->
                                                <form id="restoreForm" action="{{ route('users.restore') }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('POST')
                                                    <input type="hidden" name="id" id="userIdInput">
                                                </form>

                                                <a href="#" class="icon ms-2" onclick="event.preventDefault(); restoreUser('{{ $user->id }}');">
                                                    <i class="fa-solid fa-unlock-keyhole"></i>
                                                </a>

                                                <script>
                                                    function restoreUser(userId) {
                                                        var form = document.getElementById('restoreForm');
                                                        form.querySelector('#userIdInput').value = userId;
                                                        form.submit();
                                                    }
                                                </script>

                                         

                                            
                                            </li>
                                        </td>
                                    </tr>
                                @endforeach

                                  
                                 
                                </tbody>
                            </table>

                            <div class="mbp_pagination text-center mt30">
                                <ul class="page_navigation">
                                    @for ($i = 1; $i <= $blockusers->lastPage(); $i++)
                                        <li class="page-item {{ ($blockusers->currentPage() == $i) ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $blockusers->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor
                                </ul>
                                <p class="mt10 mb-0 pagination_page_count text-center">
                                    {{ $blockusers->firstItem() }} – {{ $blockusers->lastItem() }} of {{ $blockusers->total() }} records
                                </p>
                            </div>

                            <!-- <div class="mbp_pagination text-center mt30">
                                <ul class="page_navigation">
                                    <li class="page-item">
                                        <a class="page-link" href="#"> <span
                                                class="fas fa-angle-left"></span></a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item active" aria-current="page">
                                        <a class="page-link" href="#">2 <span
                                                class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                                    <li class="page-item"><a class="page-link" href="#">...</a></li>
                                    <li class="page-item"><a class="page-link" href="#">20</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#"><span
                                                class="fas fa-angle-right"></span></a>
                                    </li>
                                </ul>
                                <p class="mt10 mb-0 pagination_page_count text-center">1 – 20 of 300+
                                    property available</p>
                            </div> -->
                        </div>
                    </div>

                </div>
            </div>
        </div>

        
<!-- Modal for Viewing User Details -->





@endsection
@section('footer_script')


@endsection