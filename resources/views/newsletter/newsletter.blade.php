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
                            <h3>News letter subscriber </h3>
                        </a>
                            <table class="table-style3 table at-savesearch" id="UserTable">
                                <thead class="t-head">
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Email</th>
                                
                                        <th scope="col">Created Date </th>
                                   
                                    </tr>
                                </thead>
                                <tbody class="t-body">
                                @foreach($newsLetter as $key => $user)
                               

                                    <tr>
                                        <th scope="row"> #{{ $key + 1 }}</th>
                                        <td class="vam">{{ $user->email }}</td>
                                
                                        <td class="vam">
                                        {{ $user->created_at }}
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