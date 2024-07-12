@extends('layouts.index')
@section('content')
    <!-- Home Banner Style V1 -->





    <!-- Popular Artist -->
    <section class=" pb100">
        <div class="container">
            <div class="row align-items-center wow fadeInUp">

          
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif


            </div>

        </div>
    </section>





    <section class="breadcumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcumb-style1">
                        <div class="breadcumb-list">
                            <a href="#">Home</a>
                            <a href="#">Services</a>
                            <a href="#">Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pt40 pb0">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-title">
                        <h2 class="title"> Checkout</h2>
                        <p class="text mb-0">Give your visitor a smooth online experience </p>
                    </div>
                    @if (session()->has('success'))
                    <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Checkout Area -->
    <section class="shop-checkout pt-0">
        <div class="container">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('checkout.store', $order->id) }}" method="POST">
                @csrf

                <div class="row wow fadeInUp" data-wow-delay="300ms">
                    <div class="col-md-7 col-lg-8">
                    <div class="checkout_form">
                        <h4 class="title mb30">Billing details</h4>
                        <div class="checkout_coupon">
                        <form class="form2" id="coupon_form" name="contact_form" method="post">
                            <div class="row">
                            <div class="col-sm-6">
                                <div class="mb25">
                                <h6 class="mb15">Name</h6>
                                <input class="form-control" type="text" value="{{ \App\Models\User::find($order->client_id)->name }}" name="name" required>
                                @error('name')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                  @enderror

                                {{-- <input class="form-control" type="hidden"  value="{{$service->id}}" name="service_information_id" required>
                                <input class="form-control" type="hidden"  value="{{$proposal->id}}" name="proposal_id" required> --}}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb25">
                                <h6 class="mb15"> Email</h6>
                                <input class="form-control" type="text" value="{{ \App\Models\User::find($order->client_id)->email }}" name="email" disabled required>

                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="mb25">
                                <h6 class="mb15">Company Name</h6>
                                <input class="form-control" type="text" placeholder="" name="company">
                                @error('company')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                 @enderror
                                </div>
                            </div>
                        
                            <div class="col-lg-6">
                                <div class="mb25">
                                <h6 class="mb15">Country / Region *</h6>

                                <select class="form-select p-2" name="country" id="country" required>
                                @php
                                $countries = App\Models\Country::all();
                            
                                $selectedCountryId = isset($_GET['country']) ? $_GET['country'] : null;
                            
                                @endphp   
                                <option >Select Country</option>
                                
                                @foreach($countries as $country)
                                <option value="{{ $country->id }}" >
                                        {{ $country->name }}
                                    </option>
                                @endforeach

                                </select>
                                </div>
                                @error('country')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <div class="mb20">
                                    <label class="heading-color ff-heading fw500 mb10">Town / City *</label>
                                    <select  class="form-select p-2" aria-label="Default select example" id="city" name="city" required>
                                

                                    
                            
                                    
                                    </select>
                            
                                </div>

                                @error('city')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-12">
                                <div class="mb25">
                                <h6 class="mb15">State *</h6>
                                <input class="form-control" type="text" placeholder="" name="state" required>
                                @error('state')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="mb25">
                                <h6 class="mb15">House number and street name</h6>
                                <input class="form-control" type="text" placeholder="" name="house">
                                @error('house')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="mb25">
                                <h6 class="mb15">Apartment, suite, unit, etc. (optional)</h6>
                                <input class="form-control" type="text" placeholder="" name="apartment">
                                @error('apartment')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                                </div>
                            </div>
                        
                        
                    
                        
                            <div class="col-sm-12">
                                <div class="mb25">
                                <h6 class="mb15">Phone *</h6>
                                <input class="form-control" type="text" placeholder="" name="phone" required>
                                @error('phone')
                                 <div class="alert alert-danger mt-2">{{ $message }}</div>
                                  @enderror
                                </div>
                            </div>
                        
                            <div class="col-sm-12">
                                <div class="mb25">
                                <h4 class="mb15" class="mb15">Additional information</h4>
                                <h6>Order Notes (optional)</h6>
                                <textarea  class="" rows="7" placeholder="Description" name="additional"></textarea>
                                </div>
                            </div>

                                      
                                        <input type="hidden" value="{{ $order->rel_to_service->service_title }}"
                                            name="service_name">
                                        <input type="hidden" value="{{ $order->rel_to_proposal->price }}"
                                            name="service_price">
                                        <input type="hidden" value="{{ $order->rel_to_proposal->id }}"
                                            name="proposal_id">
                                        <input type="hidden" value="15" name="shipping_price">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-lg-4">
                        <div class="shop-sidebar ms-md-auto">
                            <div class="order_sidebar_widget mb30 default-box-shadow1">
                                <h4 class="title">Your Order</h4>
                                <ul class="p-0 mb-0">
                                    <li class="bdrb1 mb20">
                                        <h6>Service <span class="float-end">Subtotal</span></h6>
                                    </li>
                                    <li class="mb20 d-flex">
                                        <p class="body-color">{{ $order->rel_to_service->service_title }} </p>
                                        <span class="float-end ms-3">${{ $order->rel_to_proposal->price }}</span>
                                    </li>
                                    <li>
                                        <h6>Total <span class="float-end">${{ $order->rel_to_proposal->price }}</span>
                                        </h6>
                                    </li>
                                </ul>
                            </div>
                            <div class="payment_widget default-box-shadow1">
                                <h4 class="title">Payment</h4>
                                <div class="radio-element">
                                    <div class="form-check d-flex align-items-center mb15">
                                        <input class="form-check-input" type="radio" name="payment_method" id="flexRadioDefault1" checked="checked" value="ccbill">
                                        <label class="form-check-label" for="flexRadioDefault1">CCBILL</label>
                                    </div>
                                    <div class="form-check d-flex align-items-center mb15">
                                        <input class="form-check-input" type="radio" name="payment_method" id="flexRadioDefault2" name="crypto" value="crypto">
                                        <label class="form-check-label" for="flexRadioDefault2">Crypto</label>
                                    </div>

                                    <div class="form-check d-flex align-items-center">
                                        <input class="form-check-input" type="radio" name="payment_method" id="flexRadioDefault4" value="paypal">
                                        <label class="form-check-label" for="flexRadioDefault4">PayPal</label>
                                    </div>
                                </div>
                            </div>
                            <div class="d-grid">
                                <a href="#">
                                    <button type="submit" class="ud-btn btn-thm">
                                        Place Order<i class="fal fa-arrow-right-long"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </section>
    

@endsection
@section('footer_script')
    <script type="text/javascript">
        $('#country').change(function() {
            var country_id = $(this).val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: '/getId',
                data: {
                    'country_id': country_id
                },
                success: function(data) {
                    // alert(data);
                    $('#city').html(data);
                }
            });

        });
    </script>
@endsection
