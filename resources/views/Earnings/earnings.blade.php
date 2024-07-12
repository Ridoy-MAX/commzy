@extends('layouts.dashboard')
@section('content')
<style>


#pendingPaymentsTable {
    width: 100%; /* Make the DataTable fill its container */
}
#pendingPaymentsTable_filter label{
  float: right;
  display: flex;
  margin-bottom: 20px;
  align-items: center;
  font-size: 17px;
  font-weight: 500;
}
#pendingPaymentsTable_info{
  margin-bottom: 30px;
}
#payouts_info{
  margin-bottom: 30px;
}
#pendingPaymentsTable_filter input[type="search"] {
    width: 300px; /* Set width for the search input */
    border: 1px solid #ccc; /* Add border to the search input */
    border-radius: 5px; /* Optional: Add border-radius to the search input */
    padding: 10px; /* Add padding to the search input */
    float: right;
    margin: 10px
}

#pendingPaymentsTable_length select {
    width: 80px; /* Set width for the page length dropdown */
    border: 1px solid #ccc; /* Add border to the dropdown */
    border-radius: 5px; /* Optional: Add border-radius to the dropdown */
    padding: 5px; /* Add padding to the dropdown */
}
#pendingPaymentsTable_paginate{
  display: flex;
  justify-content: center;
  align-items: center;
}

#pendingPaymentsTable_previous{

  display: none;
}
#pendingPaymentsTable_next{
  display: none;
}
#pendingPaymentsTable_paginate .paginate_button {
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


#pendingPaymentsTable_paginate .paginate_button.current {
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



#payouts_paginate{
  display: flex;
  justify-content: center;
  align-items: center;
}


#payouts_previous{

  display: none;
}
#payouts_next{
  display: none;
}
#payouts_paginate .paginate_button {
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


#payouts_paginate .paginate_button.current {
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
            </div>

            <div class="row pb40">
                <div class="col-lg-12">
               
                </div>
                <div class="col-lg-12">
                  <div class="dashboard_title_area">
                    <h2>Earnings</h2>
                    {{-- <p class="text">Lorem ipsum dolor sit amet, consectetur.</p> --}}
                  </div>
                </div>
            </div>
              
            <div class="row">
                <div class="col-sm-6 col-xxl-3">
                  <div class="d-flex align-items-center justify-content-between statistics_funfact" style="height: 200px">
                    <div class="details">
                      <div class="fz15">Net Income</div>
                      <div class="title">${{$netIncome}} </div>
                      <div class="text fz14">Total<span class="text-thm"> {{$netIncomeCount}} </span> payments</div>
                    </div>
                    <div class="icon text-center"><i class="flaticon-income"></i></div>
                  </div>
                </div>

                <div class="col-sm-6 col-xxl-3">
                  <div class="d-flex align-items-center justify-content-between statistics_funfact" style="height: 200px">
                    <div class="details">
                      <div class="fz15">Withdrawn</div>
                      <div class="title">${{$withdrawm}} </div>
                      {{-- <div class="text fz14"><span class="text-thm">80+</span> New Completed</div> --}}
                    </div>
                    <div class="icon text-center"><i class="flaticon-withdraw"></i></div>
                  </div>
                </div>

                <div class="col-sm-6 col-xxl-3">
                  <div class="d-flex align-items-center justify-content-between statistics_funfact" style="height: 200px">
                    <div class="details">
                      <div class="fz15">Pending Clearance</div>
                      <div class="title">${{$totalPendingPayments}}</div>
                      <div class="text fz14"><span class="text-thm">{{$pendingPaymentsCount}} </span>  payments pending</div>
                    </div>
                    <div class="icon text-center"><i class="flaticon-review"></i></div>
                  </div>
                </div>

                <div class="col-sm-6 col-xxl-3">
                  <div class="d-flex align-items-center justify-content-between statistics_funfact" style="height: 200px">
                    <div class="details">
                      <div class="fz15">Available for Withdrawal</div>
                      <div class="title mb-2">${{$mainbalance}} </div>

                      {{-- @if($Payments->balance == 0)
                      <div class="text fz14">
                          <p style="color:#E34A6F">Insufficient balance.</p>
                      </div>
                  @else
                      <div class="text fz14">
                          <a href="{{ route('withdrawn') }}" class="pending-style style4" style="background:#E34A6F">Withdrawal balance</a>
                      </div>
                  @endif --}}
                  <div class="text fz14">
                    <a href="{{ route('withdrawn') }}" class="pending-style style4" style="background:#E34A6F">Withdrawal balance</a>
                </div>
                  
                    </div>
                    <div class="icon text-center"><i class="flaticon-review-1"></i></div>
                  </div>
                </div>
            </div>


              <div class="navtab-style1 card p-3">
                <nav class="">
                  <div class="nav nav-tabs mb30" id="nav-tab2" role="tablist">
                      <button class="nav-link active fw500 ps-0"
                              id="nav-item1-tab" data-bs-toggle="tab" data-bs-target="#nav-item1"
                              type="button" role="tab" aria-controls="nav-item1" aria-selected="true">
                          Pending Clearance
                      </button>
                      <button class="nav-link fw500" id="nav-item2-tab" data-bs-toggle="tab"
                              data-bs-target="#nav-item2" type="button" role="tab"
                              aria-controls="nav-item2" aria-selected="false">
                          Payouts
                      </button>
                  </div>
              </nav>

                <div class="tab-content" id="nav-tabContent">
                  
                  <div class="tab-pane fade show active" id="nav-item1" role="tabpanel" aria-labelledby="nav-item1-tab">
                    <div class="row">
                   
                      @include('Earnings.pending_payment')
                 
                    
              
                  
              
                  
                    </div>
                  
                  </div>

                  <div class="tab-pane fade" id="nav-item2" role="tabpanel" aria-labelledby="nav-item2-tab">
                    <div class="row">
                    
                      @include('Earnings.payouts')


                      

                 
            
                      

             
                    </div>
                  </div>
                
                </div>
              </div>


          
             

        </div>

        

        
         <!-- Modal for Viewing User Details -->


  
     


        =

@endsection
@section('footer_script')

<script>
  $(document).ready(function() {
      $('#pendingPaymentsTable').DataTable({
          "paging": true, // Enable pagination
          "searching": true, // Enable search bar
          "lengthChange": false, // Disable the ability to change the number of rows displayed per page
          "pageLength": 5, // Number of rows per page
          "ordering": false, // Disable initial sorting
          "language": {
              "paginate": {
                  "previous": "", // Remove the previous button text
                  "next": "" // Remove the next button text
              },
              "lengthMenu": "Show _MENU_ entries",
              "search": "Search:"
          }
      });
  });
  </script>
  
<script>
  $(document).ready(function() {
      $('#payouts').DataTable({
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
  
<!-- DataTables CSS -->
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"> --}}

<!-- jQuery -->


<!-- DataTables JavaScript -->


@endsection