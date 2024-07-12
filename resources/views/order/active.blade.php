<div class="col-xl-12">
  <div class="ps-widget bgc-white bdrs4 p30 mb30 overflow-hidden position-relative">
    <div class="packages_table table-responsive">
      <table class="table-style3 table at-savesearch" id="ActiveOrder">
        <thead class="t-head">
          <tr>
            <th scope="col">Users </th>
            <th scope="col">Service</th>
            <th scope="col" >Order date</th>
            <th scope="col" >Deliver date</th>
            <th scope="col">Cost </th>
            <th scope="col">Status </th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody class="t-body">
          @foreach($activeorder as $key => $order)
          <tr>
            <th class="ps-0" scope="row">
              <div class="freelancer-style1 p-0 mb-0 box-shadow-none">
                <div class="d-lg-flex align-items-lg-center">
                  <div class="thumb w60 position-relative rounded-circle mb15-md">
                    @php
                    // $client = \App\Models\User::find($proposal->client_id);
                   @endphp


                    @if($order->rel_to_service->rel_to_user->profile_pic)

                    <img class=" rounded-circle wa-xs" src="{{ asset($order->rel_to_service->rel_to_user->profile_pic) }}" alt="Profile Picture"
                     style="height: 60px; width: 60px;">
                    @else
                    <img class=" rounded-circle wa-xs" src="/avatar.jpg" alt="user.png" style="height: 60px; width: 60px;"> 
                      
                    @endif

                    {{-- <img class="rounded-circle mx-auto" src="images/team/client-1.png" alt=""> --}}
                    <span class="online-badge2"></span>
                  </div>
                  <div class="details ml15 ml0-md mb15-md">
                    @if($order->rel_to_service->rel_to_user->id == auth()->id())
                        <h5 class="title mb-2">You</h5>
                    @else
                        <h5 class="title mb-2">{{$order->rel_to_service->rel_to_user->name}}</h5>
                    @endif
                    <p class="mb-0 fz14 list-inline-item mb5-sm pe-1">
                      <i class="fa-solid fa-user-tie"></i>
                        {{$order->role}}
                    </p>
                </div>
                
                </div>
              </div>
            </th>
            <th class="ps-0" scope="row" style="padding: 14px !important;width: 300px !important">
              <div class="freelancer-style1 p-0 mb-0 box-shadow-none" style="">
                <div class="d-lg-flex align-items-lg-center">
                <a >
                  <div class="details ml15 ml0-md mb15-md">
                    <h5 class="title mb-2" style="width: 300px">   {{$order->rel_to_service->service_title}}</h5>
                    <p class="mb-0 fz14 list-inline-item mb5-sm pe-1">
                      <i class="flaticon-place fz16 vam text-thm2 me-1"></i> 
                      {{ \App\Models\Country::find($order->rel_to_service->rel_to_user->country)->name }}
                  </p>

               

                    <p class="mb-0 fz14 list-inline-item mb5-sm"><i class="flaticon-contract fz16 vam text-thm2 me-1 bdrl1 pl15 pl0-xs bdrn-xs"></i>  Received</p>
                    {{-- <p class="mb-0 fz14 list-inline-item mb5-sm"><i class="flaticon-contract fz16 vam text-thm2 me-1 bdrl1 pl15 pl0-xs bdrn-xs"></i> 1 Received</p> --}}
                  </div>
                </a>
                </div>
              </div>
            </th>
            <th class="" scope="row">
              <p class="mb-0 fz14 list-inline-item mb5-sm pe-1">
                <i class="flaticon-30-days fz16 vam text-thm2 me-1 "></i> {{ $order->created_at->format('M d y') }}
             </p>
            </th>
            <th class="" scope="row">
              <p class="mb-0 fz14 list-inline-item mb5-sm pe-1">
                  <i class="flaticon-30-days fz16 vam text-thm2 me-1 "></i>  {{ $order->created_at->addDays($order->rel_to_proposal->delivery_time)->format('M d y') }}
                </p> 
            </th>
            <td class="vam"><h5 class="mb-0">${{$order->rel_to_proposal->price}}  </h5></td>

            <td class="vam" style="padding: 4px !important">
              <span class="pending-style style2">{{$order->status}}</span>

              <td>
         
              <div class="d-flex">
                {{-- <form action="{{ route('proposal.accept', $proposal->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="ud-btn" style="padding: 1px 8px; font-size: 12px;">Accept</button>
                </form> --}}
                   {{-- 
                <a href="" class="ud-btn" 
                style="padding: 1px 8px; font-size: 12px;    border: 2px solid black;background:#fcf9f0ce;">Details</a> --}}

              

                {{-- <form action="{{ route('order.cancel', $order->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="ud-btn ms-3" style="padding: 1px 8px; font-size: 12px;background:#fcf9f0ce;">Cancel</button>
                </form> --}}
            

                <a href="{{ route('order.details',$order->id)}}"
                   class="ud-btn ms-3"          style="padding: 1px 8px; font-size: 12px;    border: 2px solid black;background:#fcf9f0ce;"> 
                  Details
                </a>

                {{-- <button type="button" class="ud-btn ms-3" data-bs-toggle="modal" data-bs-target="#exampleModal" style="padding: 1px 8px; font-size:12px;background:#fcf9f0ce;"> Modefiy</button> --}}
        
              </div>
            </td>
          </tr>

          @endforeach


       
   
       
        </tbody>
      </table>



    
    </div>
  </div>
</div>