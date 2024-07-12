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
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="col-lg-12">
                <div class="dashboard_title_area">
                  <h2>My Orders</h2>
                  <p class="text">Manage your proposal list</p>
                </div>

                <div class="navtab-style1 card p-3">
                  
                    <nav>
                      <div class="nav nav-tabs mb30" id="nav-tab2" role="tablist">
                        <button class="nav-link active fw500 ps-0" id="nav-item1-tab" data-bs-toggle="tab" data-bs-target="#nav-item1" type="button" role="tab" aria-controls="nav-item1" aria-selected="true">Active Order</button>

                        <button class="nav-link  fw500 ps-0" id="nav-pending-tab" data-bs-toggle="tab" 
                        data-bs-target="#nav-pending" type="button" role="tab" aria-controls="nav-item1" aria-selected="true">Pending Order</button>

                        <button class="nav-link fw500" id="nav-item2-tab" data-bs-toggle="tab" data-bs-target="#nav-item2" type="button" role="tab" aria-controls="nav-item2" aria-selected="false">Complete order</button>

                        <button class="nav-link fw500" id="nav-item3-tab" data-bs-toggle="tab" data-bs-target="#nav-item3" type="button" role="tab" aria-controls="nav-item3" aria-selected="false">Cancel order</button>

                       
                      </div>
                    </nav>
                    <div class="tab-content " id="nav-tabContent">
                      
                      <div class="tab-pane fade show active" id="nav-item1" role="tabpanel" aria-labelledby="nav-item1-tab">
                        <div class="row">
                            @include('order.active')
                        </div>
                      
                      </div>

                      <div class="tab-pane fade" id="nav-pending" role="tabpanel" aria-labelledby="nav-pending-tab">
                        <div class="row">
                            @include('order.Pending')
                        </div>
                      
                      </div>

                      <div class="tab-pane fade" id="nav-item2" role="tabpanel" aria-labelledby="nav-item2-tab">
                        <div class="row">
                            @include('order.complete')
                        </div>
                      </div>



                      <div class="tab-pane fade" id="nav-item3" role="tabpanel" aria-labelledby="nav-item3-tab">
                        <div class="row">
                            @include('order.cancel')
                        </div>
                      </div>
                   
                    
                    </div>
                  </div>
              
            </div>

        </div>
</div>


<style>
  .table-style3 .t-body th {
    color: var(--headings-color);
    font-family: var(--title-font-family);
    font-weight: 500;
    font-size: 15px;
    padding: 13px !important;
    vertical-align: middle;
}
  /* ================active============= */

  #ActiveOrder_paginate{
  display: flex;
  justify-content: center;
  align-items: center;
}


#ActiveOrder_previous{

  display: none;
}
#ActiveOrder_next{
  display: none;
}
#ActiveOrder_paginate .paginate_button {
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


#ActiveOrder_paginate .paginate_button.current {
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
  /* ================PendingOrder============= */

  #PendingOrder_paginate{
  display: flex;
  justify-content: center;
  align-items: center;
}


#PendingOrder_previous{

  display: none;
}
#PendingOrder_next{
  display: none;
}
#PendingOrder_paginate .paginate_button {
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


#PendingOrder_paginate .paginate_button.current {
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
  /* ================CompleteOrder============= */

  #CompleteOrder_paginate{
  display: flex;
  justify-content: center;
  align-items: center;
}


#CompleteOrder_previous{

  display: none;
}
#CompleteOrder_next{
  display: none;
}
#CompleteOrder_paginate .paginate_button {
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


#CompleteOrder_paginate .paginate_button.current {
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
  /* ================CancelOrder============= */

  #CancelOrder_paginate{
  display: flex;
  justify-content: center;
  align-items: center;
}


#CancelOrder_previous{

  display: none;
}
#CancelOrder_next{
  display: none;
}
#CancelOrder_paginate .paginate_button {
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


#CancelOrder_paginate .paginate_button.current {
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
      $('#ActiveOrder').DataTable({
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
      $('#PendingOrder').DataTable({
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
      $('#CompleteOrder').DataTable({
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
      $('#CancelOrder').DataTable({
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