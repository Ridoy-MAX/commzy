@extends('layouts.dashboard')
@section('content')


        <div class="dashboard__content hover-bgc-color">
                <div class="row pb40">
                    <div class="col-lg-12">
                    @include('components.main_component.dashboard_navigation')
                    </div>
                </div>


                 <div class="row mb30">
                    <div class="col-lg-12">
                      <div class="float-end">
                        {{-- <a href="index.html" class="ud-btn btn-thm invoice_down_print">Download this invoice<i class="fal fa-arrow-right-long"></i></a> --}}
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-12">
                      <div class="invoice_table">
                        <div class="wrapper">
                          <div class="row mb20 align-items-center">
                            <div class="col-lg-7">
                              <div class="main_logo mb30-md">
                                <img src="{{ asset('images/newlogo.svg')}}" alt="Header Logo" style="width: 150px;">
                            </div>
                            </div>
                            <div class="col-lg-5">
                              <div class="invoice_deails">
                                <h3 class="float-start dark-color">Invoice #0{{$invoice->id}}</h3>
                                <h5 class="float-end"></h5>
                              </div>
                            </div>
                          </div>

                          
                          @php
                          $proposal = \App\Models\Proposal::find($invoice->proposal_id);
                          @endphp

                          <div class="row mt55">
                            <div class="col-sm-6 col-lg-7">
                              <div class="invoice_date mb60">
                                <div class="title mb5 ff-heading dark-color">Invoice date:</div>
                                <h6 class="fw500 mb0">{{ \Carbon\Carbon::parse($invoice->created_at)->format('F j, Y') }}</h6>
                              </div>
                              <div class="invoice_address">
                                @php
                                $seller = \App\Models\User::find($invoice->seller_id);
                                @endphp

                                @php
                                $country = \App\Models\Country::find($seller->country);
                                @endphp
                                @php
                                $city = \App\Models\City::find($seller->city);
                                @endphp

                                <h4 class="mb20">Seller</h4>
                                <h6 class="fw500"> {{$seller->name}}</h6>
                                <p class="dark-color ff-heading">{{$country->name}},{{$city->name}}</p>
                              </div>
                            </div>
                            <div class="col-sm-6 col-lg-5">
                              <div class="invoice_date mb60">
                                <div class="title mb5 ff-heading dark-color">Delivery date:</div>
                                <h6 class="fw500 mb0">
                                    {{ $invoice->created_at->addDays($proposal->delivery_time)->format('M d y') }}
                                    </h6>
                              </div>
                              <div class="invoice_address">

                                @php
                                $client = \App\Models\User::find($invoice->client_id);
                                @endphp

                                @php
                                $client_country = \App\Models\Country::find($client->country);
                                @endphp
                                @php
                                $client_city = \App\Models\City::find($client->city);
                                @endphp

                                <h4 class="mb20">Client</h4>
                                <h6 class="fw500"> {{$client->name}}</h6>
                                <p class="dark-color ff-heading">

                                  @if($client->country == 'Select Country')
         
      
                                  @elseif($client->country)  
                                    {{$client_country->name}}
                                 @endif

                                  @if($client->city == 'Select City')
                               
      
                                  @elseif($client->city)  
                                    ,{{$client_city->name}}
                                 @endif


{{-- 
                                  {{$client_country->name}},{{$client_city->name}}</p> --}}
                              </div>


                            </div>
                          </div>
                          <div class="row mt50">
                            <div class="col-lg-12">
                              <div class="table-responsive invoice_table_list">
                                <table class="table table-borderless">
                                  <thead class="thead-light">
                                    <tr class="tblh_row">
                                      <th class="tbleh_title" scope="col">Description</th>
                                      <th class="tbleh_title" scope="col">Status</th>
                                      <th class="tbleh_title" scope="col">Price</th>
                            
                             
                               
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr class="bdrb1">
                                      <th class="tbl_title" scope="row">{{$proposal->rel_to_service->service_title}}</th>
                                      <td class="tbl_title">       <span class="pending-style style1">{{$invoice->status}}</span></td>
                                      <td class="tbl_title">${{$proposal->price}}</td>
                           
                                 
                                  
                                    </tr>
                                   
                                    <tr>
                                      <th scope="row" class="tblp_title">Total Due</th>
                                      <td></td>
                             
                          
                                      <td class="tblp_title">${{$proposal->price }} </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="invoice_footer">
                          <div class="row justify-content-center">
                            <div class="col-auto">
                              <div class="invoice_footer_content text-center">
                                <a class="ff-heading" href="#">www.commzey.com</a>
                              </div>
                            </div>
                            <div class="col-auto">
                              <div class="invoice_footer_content text-center">
                                <a class="ff-heading" href="#">invoice@commzey.com</a>
                              </div>
                            </div>
                            <div class="col-auto">
                              <div class="invoice_footer_content text-center">
                                <a class="ff-heading" href="#">(123) 123-456</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

           

            

           
        </div>
         
        
       

        
         <!-- Modal for Viewing User Details -->


   





 
         

@endsection
@section('footer_script')


@endsection