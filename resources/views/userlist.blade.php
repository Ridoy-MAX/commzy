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


          
             
          
            @error('name')
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
               <div class="text-danger">    {{ $message }}</div>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @enderror
            @error('username')
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
               <div class="text-danger">    {{ $message }}</div>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @enderror
            @error('email')
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
               <div class="text-danger">    {{ $message }}</div>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @enderror
            @error('password')
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
               <div class="text-danger">    {{ $message }}</div>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @enderror

         

         <!-- Your user creation form goes here -->


          

              
                <div class="col-lg-3">
                    <div class="text-lg-end">
                        
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="ps-widget bgc-white bdrs4 p30 mb60 overflow-hidden position-relative">
                        <div class="packages_table table-responsive">
                            <a class="ud-btn  default-box-shadow2 mb-3" data-bs-toggle="modal" href=''
                            data-bs-target="#exampleModal" style="background-color: #E34A6F; color: white; float:right;">Create User
                            <i class="fa-regular fa-square-plus"></i>
                        </a>
                            <table class="table-style3 table at-savesearch" id="UserTable">
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
                                @foreach($users as $key => $user)
                               

                                    <tr>
                                        <th scope="row"> #{{ $key + 1 }}</th>
                                        <td class="vam">{{ $user->name }}</td>
                                        <td class="vam">{{ $user->username }}</td>
                                        <td class="vam">{{ $user->email }}</td>
                                        <td class="vam"><span class="pending-style style2">Active</span>
                                        <td class="vam">
                                        {{ $user->created_at }}
                                        </td>

                                    <td class="vam d-flex">
                                            <li> 
                                                <a href="#" class="view-user icon" data-bs-toggle="modal" data-bs-target="#exampleModal2{{ $key + 1 }}"
                                                    data-name="{{ $user->name }}" data-username="{{ $user->username }}" data-email="{{ $user->email }}">
                                                    <i class="fa-regular fa-eye"></i>
                                                </a>

                                            <div class="modal fade" id="exampleModal2{{ $key + 1 }}" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
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
                                                                                <span class="pending-style style3">Active</span>
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
                                                <a class="icon ms-2" href="" data-bs-toggle="modal" data-bs-target="#updateUserModal{{ $key + 1 }}" >
                                                    <i class="fa-regular fa-pen-to-square ms-2 me-2"></i>
                                                </a>

                                                   <!-- user edit  -->
                                            <!-- Update User Modal -->
                                                <div class="modal fade" id="updateUserModal{{ $key + 1 }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Update User</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="ps-widget bgc-white bdrs4 p30 overflow-hidden position-relative">
                                                                    <form  method="POST" action="{{ route('user.update', ['id' => $user->id]) }}">
                                                                        @csrf
                                                                        @method('PUT') 
                                                                        <div class="mb20">
                                                                            <label class="heading-color ff-heading fw500 mb10">Name</label>
                                                                            <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                                                                        </div>
                                                                        <div class="mb20">
                                                                            <label class="heading-color ff-heading fw500 mb10">Username</label>
                                                                            <input type="text" name="username" class="form-control" value="{{ $user->username }}">
                                                                        </div>
                                                                        <div class="mb20">
                                                                            <label class="heading-color ff-heading fw500 mb10">Email</label>
                                                                            <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                                                                        </div>
                                                                        <div class="mb20">
                                                                            <label class="heading-color ff-heading fw500 mb10">Password</label>
                                                                            <input type="password" name="password" class="form-control" value="">
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="text-start">
                                                                                <button type="submit" class="ud-btn btn-thm">Update User</button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </li>
                                            <li>
                                                <form id="blockForm" action="{{ route('user.block', ['id' => $user->id]) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('POST')
                                                </form>
                                                
                                                <a href="#" class="icon ms-2" onclick="event.preventDefault(); blockUser();">
                                                    <i class="fa-solid fa-lock"></i>
                                                </a>
                                                
                                                <script>
                                                    function blockUser() {
                                                        var form = document.getElementById('blockForm');
                                                        form.submit();
                                                    }
                                                </script>
                                            </li>
                                        </td>
                                    </tr>
                                @endforeach

                                  
                                 
                                </tbody>
                            </table>

                      

                        </div>
                    </div>

                </div>
            </div>
        </div>

        
         <!-- Modal for Viewing User Details -->


        <!-- user add  -->
        <div class="modal fade" id="exampleModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Create Acccount</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="ps-widget bgc-white bdrs4 p30  overflow-hidden position-relative">
                        
                            <div class="col-xl">
                                <form class="form-style1" method="post" action="{{ route('user.create') }}" >
                                @csrf
                                    <div class="row">

                                        <div class="mb20">
                                            <label class="heading-color ff-heading fw500 mb10">Name</label>
                                            <input type="text" name="name" class="form-control" placeholder="john">
                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                        </div>
                                        <div class="mb20">
                                            <label class="heading-color ff-heading fw500 mb10">Username</label>
                                            <input type="text" name="username" class="form-control" placeholder="john123">
                                            <x-input-error :messages="$errors->get('username')" class="mt-2" />
                                        </div>
                                        <div class="mb20">
                                            <label class="heading-color ff-heading fw500 mb10">Email</label>
                                            <input type="email" name="email" class="form-control" placeholder="@gmail.com">
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>
                                        <div class="mb20">
                                            <label class="heading-color ff-heading fw500 mb10">Password</label>
                                            <input type="password" name="password" class="form-control" placeholder="@gmail.com">
                                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                        </div>
                        
                                        <div class="col-md-12">
                                            <div class="text-start">
                                                <button class="ud-btn btn-thm" type="submit" >Create Account<i
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