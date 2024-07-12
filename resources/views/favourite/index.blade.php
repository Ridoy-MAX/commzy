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
            @error('role')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror


                <div class="row align-items-center justify-content-between ">
                    <div class="col-lg-6">
                        <div class="dashboard_title_area">
                            <h2>Favourites List</h2>

                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="search_area dashboard-style m-2">
                            <form action="{{ route('account.approval') }}" method="GET">
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
                                <table class="table-style3 table at-savesearch">
                                    <thead class="t-head">
                                        <tr>
                                            <th scope="col">No.</th>
                                            <th scope="col">Service Title</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Delivery Time</th>
                                            <th scope="col">Status </th>
                                            <th scope="col">Actions </th>
                                        </tr>
                                    </thead>
                                    <tbody class="t-body">
                                        @foreach ($favourites as $key => $favourite)
                                         @php
                                           $service = DB::table('service_information')->where('id', $favourite->service_information_id)->first();
                                         @endphp
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $service->service_title }}</td>
                                                <td>${{ $service->price }}</td>
                                                <td>{{ $service->delivery_time }}</td>
                                                <td> <span class="pending-style style2">{{ $service->status }}</span> </td>
                                                <td>
                                                    <a href="" title="Remove From Favorite" class="icon"> <i class="fa-regular fa-remove"></i> </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                                <div class="mbp_pagination text-center mt30">
                                    <ul class="page_navigation">
                                        @for ($i = 1; $i <= $favourites->lastPage(); $i++)
                                            <li class="page-item {{ ($favourites->currentPage() == $i) ? 'active' : '' }}">
                                                <a class="page-link" href="{{ $favourites->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endfor
                                    </ul>
                                    <p class="mt10 mb-0 pagination_page_count text-center">
                                        {{ $favourites->firstItem() }} – {{ $favourites->lastItem() }} of {{ $favourites->total() }} records
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>



            </div>

        </div>


         <!-- Modal for Viewing  Details -->








@endsection
@section('footer_script')


@endsection
