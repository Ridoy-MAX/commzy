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
                <div class="dashboard_title_area">
                  <h2>My Proposals</h2>
                  <p class="text">Manage your proposal list</p>
                </div>

                <div class="navtab-style1 card p-3">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <nav>
                      <div class="nav nav-tabs mb30" id="nav-tab2" role="tablist">
                        <button class="nav-link active fw500 ps-0" id="nav-item1-tab" data-bs-toggle="tab" data-bs-target="#nav-item1" type="button" role="tab" aria-controls="nav-item1" aria-selected="true">Received Proposal</button>

                        <button class="nav-link fw500" id="nav-item2-tab" data-bs-toggle="tab" data-bs-target="#nav-item2" type="button" role="tab" aria-controls="nav-item2" aria-selected="false">Send Proposal</button>

                        <button class="nav-link fw500" id="nav-item4-tab" data-bs-toggle="tab" data-bs-target="#nav-item4" type="button" role="tab" aria-controls="nav-item2" aria-selected="false">Modified Proposal</button>

                        <button class="nav-link fw500" id="nav-item3-tab" data-bs-toggle="tab" data-bs-target="#nav-item3" type="button" role="tab" aria-controls="nav-item2" aria-selected="false">Decline Proposal</button>

                        <button class="nav-link fw500" id="nav-item4-tab" data-bs-toggle="tab" data-bs-target="#nav-item5" type="button" role="tab" aria-controls="nav-item2" aria-selected="false">Accepted Proposal</button>
                    
                       
                      </div>
                    </nav>
                    <div class="tab-content " id="nav-tabContent">
                      
                      <div class="tab-pane fade show active" id="nav-item1" role="tabpanel" aria-labelledby="nav-item1-tab">
                        <div class="row">
                            @include('proposal.pending')
                        </div>
                      
                      </div>

                      <div class="tab-pane fade" id="nav-item2" role="tabpanel" aria-labelledby="nav-item2-tab">
                        <div class="row">
                            @include('proposal.send')
                        </div>
                      </div>



                      <div class="tab-pane fade" id="nav-item3" role="tabpanel" aria-labelledby="nav-item3-tab">
                        <div class="row">
                            @include('proposal.decline')
                        </div>
                      </div>

                      <div class="tab-pane fade" id="nav-item5" role="tabpanel" aria-labelledby="nav-item4-tab">
                        <div class="row">
                            @include('proposal.accepted')
                        </div>
                      </div>
                      <div class="tab-pane fade" id="nav-item4" role="tabpanel" aria-labelledby="nav-item4-tab">
                        <div class="row">
                            @include('proposal.modified')
                        </div>
                      </div>
                    
                    </div>
                  </div>
                <div class="row">
                 
                </div>
            </div>

        </div>
</div>


<style>
  /* ================pending============= */
  #pending_paginate{
  display: flex;
  justify-content: center;
  align-items: center;
}


#pending_previous{

  display: none;
}
#pending_next{
  display: none;
}
#pending_paginate .paginate_button {
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


#pending_paginate .paginate_button.current {
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
/* ================accepted============= */

  #accepted_paginate{
  display: flex;
  justify-content: center;
  align-items: center;
}


#accepted_previous{

  display: none;
}
#accepted_next{
  display: none;
}
#accepted_paginate .paginate_button {
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


#accepted_paginate .paginate_button.current {
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
/* ================send============= */

  #send_paginate{
  display: flex;
  justify-content: center;
  align-items: center;
}


#send_previous{

  display: none;
}
#send_next{
  display: none;
}
#send_paginate .paginate_button {
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


#send_paginate .paginate_button.current {
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
/* ================decline============= */

  #decline_paginate{
  display: flex;
  justify-content: center;
  align-items: center;
}


#decline_previous{

  display: none;
}
#decline_next{
  display: none;
}
#decline_paginate .paginate_button {
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


#decline_paginate .paginate_button.current {
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
/* ================modified============= */

  #modified_paginate{
  display: flex;
  justify-content: center;
  align-items: center;
}


#modified_previous{

  display: none;
}
#modified_next{
  display: none;
}
#modified_paginate .paginate_button {
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


#modified_paginate .paginate_button.current {
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
      $('#pending').DataTable({
          "paging": true, // Enable pagination
          "searching": false, // Enable search bar
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
  $(document).ready(function() {
      $('#send').DataTable({
          "paging": true, // Enable pagination
          "searching": false, // Enable search bar
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
  $(document).ready(function() {
      $('#decline').DataTable({
          "paging": true, // Enable pagination
          "searching": false, // Enable search bar
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
  $(document).ready(function() {
      $('#accepted').DataTable({
          "paging": true, // Enable pagination
          "searching": false, // Enable search bar
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
  $(document).ready(function() {
      $('#modified').DataTable({
          "paging": true, // Enable pagination
          "searching": false, // Enable search bar
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