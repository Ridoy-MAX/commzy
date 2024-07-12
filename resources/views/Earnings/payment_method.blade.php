@extends('layouts.dashboard')
@section('content')


        <div class="dashboard__content hover-bgc-color">
            <div class="row pb40">
                <div class="col-lg-12">
                @include('components.main_component.dashboard_navigation')
                </div>
            </div>
            <div class="row align-items-center justify-content-between ">
             
            </div>

            <div class="row pb40">
                <div class="col-lg-12">
               
                </div>
              
              </div>

              <div class="ps-widget bgc-white bdrs4 p30 mb30 position-relative">
                <div class="row">
                  <div class="col-lg-9">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                  @endif
                  @if(session('error'))
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                          {{ session('error') }}
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                  @endif
                    <div class="bdrb1 pb15">
                      <h5 class="list-title">Payout Methods</h5>
                    </div>
                    <div class="widget-wrapper mt35">
                      @if ($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif
                      
                    </div>
                    <h5 class="mb15">   Withdrawn funds</h5>
                    <div class="navpill-style1 payout-style">
                      <ul class="nav nav-pills align-items-center justify-content-center mb30" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link fw500 dark-color" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Paypal</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link fw500 dark-color active" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="true">Bank Transfer</button>
                        </li>
                      
                      </ul>
                      <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                          <form class="form-style1" action="{{ route('withdrawn.request')}}" method="POST">
                            @csrf
                            <div class="row">
                              <div class="col-sm-6">
                                <div class="mb20">
                                  <label class="heading-color ff-heading fw500 mb-1"> Transfer to </label>
                                  <input type="text" class="form-control" placeholder="Paypal" disabled>
                                  <input type="hidden" class="form-control" value="Paypal" name="payment_method">

                                  <input  type="hidden" name="user_id" value="{{ Auth::id() }}">

                                </div>
                              </div>
                              <div class="col-sm-6">
                               
                              </div>

                              <div class="col-sm-6">
                                <label class="heading-color ff-heading fw500 mb-1">Account details</label>
                                  <textarea type="text" class="form-control" placeholder="" name="details" required>
                                  </textarea>
                              </div>
                              <div class="col-sm-6">
                         
                              </div>
                              <div class="col-sm-6">
                                <div class="mb20">
                                  <label class="heading-color ff-heading fw500 mb-1">Amount</label>
                                  <input type="text" class="form-control" placeholder="$" name="amount" required>
                                </div>
                              </div>
                            
                              
                            
                            </div>
                            <div class="row">
                              <div class="col-md-12">
                                <div class="text-start">
                                  <button type="submit" class="ud-btn btn-thm" >Confirm & 
                                    Withdrawn<i class="fal fa-arrow-right-long"></i></button>
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                        <div class="tab-pane fade active show" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                          <form class="form-style1" action="{{ route('withdrawn.request')}}" method="POST">
                            @csrf
                            <div class="row">
                              <div class="col-sm-6">
                                <div class="mb20">
                                  <label class="heading-color ff-heading fw500 mb-1"> Transfer to</label>
                                  <input type="text" class="form-control" placeholder="Bank Transfer" disabled>
                                  <input type="hidden" class="form-control" value="Bank Transfer" name="payment_method">

                                  <input  type="hidden" name="user_id" value="{{ Auth::id() }}">

                                </div>
                              </div>
                              <div class="col-sm-6">
                         
                              </div>
                              <div class="col-sm-6">
                                <label class="heading-color ff-heading fw500 mb-1">Account details</label>
                                  <textarea type="text" class="form-control" placeholder="" name="details" required>
                                  </textarea>
                              </div>
                              <div class="col-sm-6">
                         
                              </div>
                              <div class="col-sm-6">
                                <div class="mb20">
                                  <label class="heading-color ff-heading fw500 mb-1">Amount</label>
                                  <input type="text" class="form-control" placeholder="$" name="amount" required>
                                </div>
                              </div>
                            
                              
                            
                            </div>
                            <div class="row">
                              <div class="col-md-12">
                                <div class="text-start">
                                  <button type="submit" class="ud-btn btn-thm" >Confirm & 
                                    Withdrawn<i class="fal fa-arrow-right-long"></i></button>
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
              
            


          
             

        </div>

        

        
         <!-- Modal for Viewing User Details -->


  
     





@endsection
@section('footer_script')


@endsection