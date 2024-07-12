<div class="col-xl-12">
  <div class="ps-widget bgc-white bdrs4 p30 mb30 overflow-hidden position-relative">
    <div class="packages_table table-responsive">
      <table class="table-style3 table at-savesearch" id="modified">
        <thead class="t-head">
          <tr>
            <th scope="col">Users </th>
            <th scope="col">Service</th>
            <th scope="col">Cost </th>
            <th scope="col">Status </th>
            <th scope="col">Action </th>

          </tr>
        </thead>
        <tbody class="t-body">
        @foreach($modifiedProposals as $key => $proposal)
          <tr>
            <th class="ps-0" scope="row">
              <div class="freelancer-style1 p-0 mb-0 box-shadow-none">
                <div class="d-lg-flex align-items-lg-center">
                  <div class="thumb w60 position-relative rounded-circle mb15-md">
                    @php
                    $client = \App\Models\User::find($proposal->client_id);
                   @endphp

                    @if($proposal->rel_to_service->rel_to_user->profile_pic)

                    <img class=" rounded-circle wa-xs" src="{{ asset($proposal->rel_to_service->rel_to_user->profile_pic) }}" alt="Profile Picture" style="height: 60px; width: 60px;">
                    @else
                    <img class=" rounded-circle wa-xs" src="/avatar.jpg" alt="user.png" style="height: 60px; width: 60px;">

                    @endif

                    {{-- <img class="rounded-circle mx-auto" src="images/team/client-1.png" alt=""> --}}
                    <span class="online-badge2"></span>
                  </div>
                  <div class="details ml15 ml0-md mb15-md">
                    <h5 class="title mb-2">{{$proposal->rel_to_service->rel_to_user->name}}</h5>
                    <p class="mb-0 fz14 list-inline-item mb5-sm pe-1">
                      {{"@"}}{{$proposal->rel_to_service->rel_to_user->username}}</p>


                  </div>
                </div>
              </div>
            </th>
            <th class="ps-0" scope="row">
              <div class="freelancer-style1 p-0 mb-0 box-shadow-none">
                <div class="d-lg-flex align-items-lg-center">
                <a href="{{ route('service.details', $proposal->rel_to_service->slug)}}">
                  <div class="details ml15 ml0-md mb15-md">
                    <h5 class="title mb-2"> {{$proposal->rel_to_service->service_title}} </h5>
                    <p class="mb-0 fz14 list-inline-item mb5-sm pe-1"><i class="flaticon-place fz16 vam text-thm2 me-1"></i>
                      {{ \App\Models\Country::find($proposal->rel_to_service->rel_to_user->country)->name }}
                    </p>
                    <p class="mb-0 fz14 list-inline-item mb5-sm pe-1">
                      <i class="flaticon-30-days fz16 vam text-thm2 me-1 bdrl1 pl15 pl0-xs bdrn-xs"></i>
                      @if($proposal->updated_at)
                      {{$proposal->updated_at->diffForHumans()}}
                  @else
                      N/A
                  @endif
                  </p>
                    {{-- <p class="mb-0 fz14 list-inline-item mb5-sm"><i class="flaticon-contract fz16 vam text-thm2 me-1 bdrl1 pl15 pl0-xs bdrn-xs"></i>  Received</p> --}}
                    {{-- <p class="mb-0 fz14 list-inline-item mb5-sm"><i class="flaticon-contract fz16 vam text-thm2 me-1 bdrl1 pl15 pl0-xs bdrn-xs"></i> 1 Received</p> --}}
                  </div>
                </a>
                </div>
              </div>
            </th>
            <td class="vam"><h5 class="mb-0">${{$proposal->price}} </h5></td>
            <td class="vam"><span class="pending-style style2">{{$proposal->status}}</span></td>
            <td>
              <div class="d-flex">




                <form action="{{ route('modify.proposal.accept', ['id' => $proposal->id])}}" method="POST">
                  @csrf

                  <input type="hidden" value="{{$proposal->rel_to_service->id}}" name="service_information_id">
                  <input type="hidden" value="{{$proposal->client_id}}" name="client_id">
                  <input type="hidden" value="{{$proposal->seller_id}}" name="seller_id">

                  <button type="submit" class="ud-btn " style="padding: 1px 8px; border: 2px solid black; font-size: 12px;background:#fcf9f0ce;">Accept</button>

              </form>

              
              <form action="{{ route('proposal.decline.send', $proposal->id) }}" method="POST">
                @csrf
                <button type="submit" class="ud-btn ms-2" style="padding: 1px 8px; font-size: 12px;background:#fcf9f0ce;">Decline</button>
            </form>


                <a href="" class="ud-btn ms-2"
                  data-bs-toggle="modal" data-bs-target="#detailModal{{$proposal->id}}"
                 style="padding: 1px 8px; font-size: 12px;    border: 2px solid black;background:#fcf9f0ce;">Details</a>





                {{-- <button type="button" class="ud-btn ms-3" data-bs-dismiss="modal" style="padding: 1px 8px; font-size:12px;"> Accept</button> --}}
                {{-- <button type="button" class="ud-btn ms-3" data-bs-dismiss="modal" style="padding: 1px 8px; font-size:12px;"> Modefiy</button> --}}

              </div>
            </td>

          </tr>


          <div class="modal fade" id="detailModal{{$proposal->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel"> Proposal details</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>


                  <div class="modal-body">
                    <div class="col-sm-12">
                      <div class="mb25">
                      <h6 class="mb15">Price</h6>
                      <p>${{$proposal->price}}</p>
                      </div>
                    </div>

                    <div class="col-sm-12">
                      <div class="mb25">
                      <h4 class="mb15" class="mb15">Submitted requirement</h4>

                      <p>   {{$proposal->description}}</p>

                      </div>
                  </div>

                    <div class="col-sm-12">
                      <div class="mb25">
                      <h4 class="mb15" class="mb15">Delivery Time</h4>

                      <p>   {{$proposal->delivery_time}} days</p>

                      </div>
                  </div>




                  </div>



                </form>
              </div>
            </div>
          </div>
        @endforeach

        </tbody>
      </table>
  
    </div>
  </div>
</div>
