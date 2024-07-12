@extends('layouts.dashboard')
@section('content')


        <div class="dashboard__content hover-bgc-color">
                <div class="row pb40">
                    <div class="col-lg-12">
                    @include('components.main_component.dashboard_navigation')
                    </div>
                </div>


                <div class="row align-items-center justify-content-between pb40">
                    <div class="col-xl-4">
                      <div class="dashboard_title_area">
                        <h2>Invoice</h2>
                        <p class="text">All invoice list</p>
                      </div>
                    </div>
                    <div class="col-xl-4">
                      {{-- <div class="dashboard_search_meta">
                        <div class="search_area">
                          <input type="text" class="form-control bdrs4" placeholder="Search Invoice">
                          <label><span class="far fa-magnifying-glass"></span></label>
                        </div>
                      </div> --}}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xl-12">
                      <div class="ps-widget bgc-white bdrs4 p30 mb30 overflow-hidden position-relative">
                        <div class="packages_table table-responsive">
                          <table class="table-style3 table at-savesearch">
                            <thead class="t-head">
                              <tr>
                                <th scope="col">Invoice ID</th>
                                <th scope="col">Purchase Date</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Payment Status</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody class="t-body">

                                @foreach($invoices as $key => $invoice)
                        

                                @php
                                $proposal = \App\Models\Proposal::find($invoice->proposal_id);
                                @endphp

                                {{-- @php
                                $proposal = \App\Models\Proposal::find($invoice->proposal_id);
                                @endphp --}}


                                <tr>
                                    <th scope="row">
                                      <div>#0{{ $invoice->id }} <span class="ms-3">{{$proposal->rel_to_service->service_title}}</span></div>
                                    </th>
                                    <td class="vam">{{ \Carbon\Carbon::parse($invoice->created_at)->format('F j, Y') }}</td>

                                    <td class="vam">${{$proposal->price}}</td>
                                    <td class="vam">

                                        @if($invoice->status == 'Completed')
                                        <span class="pending-style style2">{{$invoice->status}}</span>
                                        @endif
                                        @if($invoice->status == 'pending')
                                        <span class="pending-style style1">{{$invoice->status}}</span>
                                        @endif
                                        @if($invoice->status == 'cancel')
                                        <span class="pending-style style3">{{$invoice->status}}</span>
                                        @endif
                                     
                                    
                                    </td>
                                    <td class="vam">
                                      <a href="{{ route('invoice.view',$invoice->id)}} " class="table-action fz15 fw500 text-thm2" data-bs-toggle="tooltip" data-bs-placement="top" title="View"><span class="flaticon-website me-2 vam"></span> View</a>
                                    </td>
                                  </tr>
                                @endforeach

                       
                            


                            </tbody>
                          </table>
                          <div class="mbp_pagination text-center mt30">
                            <ul class="page_navigation">
                                @for ($i = 1; $i <= $invoices->lastPage(); $i++)
                                    <li class="page-item {{ ($invoices->currentPage() == $i) ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $invoices->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                            </ul>
                            <p class="mt10 mb-0 pagination_page_count text-center">
                                {{ $invoices->firstItem() }} – {{ $invoices->lastItem() }} of {{ $invoices->total() }} records
                            </p>
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