     
                <li class=" d-sm-block" >
                    <a class="text-center mr5 text-thm2 dropdown-toggle fz20 position-relative" type="button" data-bs-toggle="dropdown" href="#">
                      <span class="flaticon-notification"> </span>

                      <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 13px; padding: 3px;" >
                           {{ auth()->user()->unreadNotifications->count() }}
                        <span class="visually-hidden">unread messages</span>
                      </span>
                      <span class="badge text-bg-secondary ms-1"></span>
                    
                    </a>


                    <div class="dropdown-menu">
                      <div class="dboard_notific_dd px30 pt10 pb15" style="max-height: 500px; overflow-y: scroll; ">
                      
                          @if(auth()->user()->unreadNotifications->isEmpty())
                            <div class="alert alert-info">There are no notifications.</div>
                          @else
                          
                          @foreach(auth()->user()->unreadNotifications as $notification)
                            
                                @if($notification->type === 'App\Notifications\ProposalDeclinedNotification')
                                      @php
                                          $proposal = \App\Models\Proposal::find($notification->data['proposal_id']);
                                          $seller = \App\Models\User::find($proposal->seller_id);
                                      @endphp


                                  

                                      
                                    <a href="{{ route('proposal')}} " class="w-100 bdrb1">

                                          <div class="d-lg-flex align-items-lg-center m-2">
                                              <div class="thumb w60 position-relative rounded-circle mb15-md">

                                            

                                                @if($seller->profile_pic)

                                                <img class=" rounded-circle wa-xs" src="{{ asset($seller->profile_pic) }}" alt="Profile Picture" style="height: 50px; width: 50px;">
                                                @else
                                                <img class=" rounded-circle wa-xs" src="/avatar.jpg" alt="user.png" style="height: 50px; width: 50px;">
                                                @endif

                                              </div>
                                              <div class="details ml15 ml0-md mb15-md">

                                          
                                                <p class="mb-0 fz14 list-inline-item mb5-sm pe-1">
                                                  <span style="font-weight: 600">{{ $seller->name }}  </span> decline your proposal .
                                                  <span style="color: rgb(197, 43, 43)"> {{$notification->created_at->diffForHumans()}}  </span> 
                                                  
                                                </p>
                                            


                                              </div>
                                            </div>

                                        </a>
                                @endif

                                @if($notification->type === 'App\Notifications\NewProposalNotification')
                                      @php
                                          $proposal = \App\Models\Proposal::find($notification->data['proposal_id']);
                                          $client = \App\Models\User::find($proposal->client_id);
                                      @endphp


                                    <a href="{{ route('proposal')}}" class="w-100 bdrb1">
                                        <div class="d-lg-flex align-items-lg-center m-2">
                                            <div class="thumb w60 position-relative rounded-circle mb15-md">
                        
                                          
                        
                                              @if($client->profile_pic)
                        
                                              <img class=" rounded-circle wa-xs" src="{{ asset($client->profile_pic) }}" alt="Profile Picture" style="height: 50px; width: 50px;">
                                              @else
                                              <img class=" rounded-circle wa-xs" src="/avatar.jpg" alt="user.png" style="height: 50px; width: 50px;">
                                              @endif
                                  
                                            </div>
                                            <div class="details ml15 ml0-md mb15-md">
                                      
                                        
                                              <p class="mb-0 fz14 list-inline-item mb5-sm pe-1">
                                                <span style="font-weight: 600">{{ $client->name }}  </span> sent you a proposal .
                                                <span style="color: rgb(197, 43, 43)"> {{$notification->created_at->diffForHumans()}}  </span> 
                                                
                                              </p>
                                          
            
            
                                            </div>
                                          </div>

                                    </a>
                                @endif

                                @if($notification->type === 'App\Notifications\ProposalAcceptedNotification')
                                      @php
                                          $proposalId = $notification->data['proposal_id'];
                                          $orderId = $notification->data['order_id'];
                               

                                          $proposal = \App\Models\Proposal::find($notification->data['proposal_id']);
                                          $order = \App\Models\Order::find($notification->data['order_id']);
                                
                                          $seller = \App\Models\User::find($proposal->seller_id);
                                      @endphp



                                        <a href="{{ route('order.details',$order->id)}}" class="w-100 bdrb1">
                                          <div class="d-lg-flex align-items-lg-center m-2">
                                              <div class="thumb w60 position-relative rounded-circle mb15-md">

                                        


                                                @if($seller->profile_pic)

                                                <img class=" rounded-circle wa-xs" src="{{ asset($seller->profile_pic) }}" alt="Profile Picture" style="height: 50px; width: 50px;">
                                                @else
                                                <img class=" rounded-circle wa-xs" src="/avatar.jpg" alt="user.png" style="height: 50px; width: 50px;">
                                                @endif

                                              </div>
                                              <div class="details ml15 ml0-md mb15-md">

                                          
                                                <p class="mb-0 fz14 list-inline-item mb5-sm pe-1">
                                                  <span style="font-weight: 600">{{ $seller->name }}  </span> accepted your proposal .
                                                  <span style="color: rgb(197, 43, 43)"> {{$notification->created_at->diffForHumans()}}  </span> 
                                                  
                                                </p>
                                            


                                              </div>
                                            </div>

                                        </a>
                                @endif
                                @if($notification->type === 'App\Notifications\ProposalModifyAcceptedNotification')
                                      @php
                                          $proposalId = $notification->data['proposal_id'];
                                          $orderId = $notification->data['order_id'];
                               

                                          $proposal = \App\Models\Proposal::find($notification->data['proposal_id']);
                                          $order = \App\Models\Order::find($notification->data['order_id']);
                                
                                          $client = \App\Models\User::find($proposal->client_id);
                                      @endphp



                                        <a href="{{ route('order.details',$order->id)}}" class="w-100 bdrb1">
                                          <div class="d-lg-flex align-items-lg-center m-2">
                                              <div class="thumb w60 position-relative rounded-circle mb15-md">

                                        


                                                @if($client->profile_pic)

                                                <img class=" rounded-circle wa-xs" src="{{ asset($client->profile_pic) }}" alt="Profile Picture" style="height: 50px; width: 50px;">
                                                @else
                                                <img class=" rounded-circle wa-xs" src="/avatar.jpg" alt="user.png" style="height: 50px; width: 50px;">
                                                @endif

                                              </div>
                                              <div class="details ml15 ml0-md mb15-md">

                                          
                                                <p class="mb-0 fz14 list-inline-item mb5-sm pe-1">
                                                  <span style="font-weight: 600">{{ $client->name }}  </span> accepted your modified proposal .
                                                  <span style="color: rgb(197, 43, 43)"> {{$notification->created_at->diffForHumans()}}  </span> 
                                                  
                                                </p>
                                            


                                              </div>
                                            </div>

                                        </a>
                                @endif



                                @if($notification->type === 'App\Notifications\ProposalModifiedNotification')
                                      @php
                                     
                               

                                          $proposal = \App\Models\Proposal::find($notification->data['proposal_id']);
                              
                                
                                          $seller = \App\Models\User::find($proposal->seller_id);
                                      @endphp



                                        <a href="{{ route('proposal')}}" class="w-100 bdrb1">
                                          <div class="d-lg-flex align-items-lg-center m-2">
                                              <div class="thumb w60 position-relative rounded-circle mb15-md">

                                        


                                                @if($seller->profile_pic)

                                                <img class=" rounded-circle wa-xs" src="{{ asset($seller->profile_pic) }}" alt="Profile Picture" style="height: 50px; width: 50px;">
                                                @else
                                                <img class=" rounded-circle wa-xs" src="/avatar.jpg" alt="user.png" style="height: 50px; width: 50px;">
                                                @endif

                                              </div>
                                              <div class="details ml15 ml0-md mb15-md">

                                          
                                                <p class="mb-0 fz14 list-inline-item mb5-sm pe-1">
                                                  <span style="font-weight: 600">{{ $seller->name }}
                                                    </span> send you modified proposal .
                                                    <span style="color: rgb(197, 43, 43)"> {{$notification->created_at->diffForHumans()}}  </span> 
                                                  
                                                </p>
                                            


                                              </div>
                                            </div>

                                        </a>
                                @endif


                                @if($notification->type === 'App\Notifications\ActiveOrderNotification')
                                      @php
                                          $order = \App\Models\Order::find($notification->data['order_id']);
                              
                                
                                          $client = \App\Models\User::find($order->client_id);
                                      @endphp



                                        <a href="{{ route('order.details',$order->id)}}" class="w-100 bdrb1">
                                          <div class="d-lg-flex align-items-lg-center m-2">
                                              <div class="thumb w60 position-relative rounded-circle mb15-md">

                                        


                                                @if($client->profile_pic)

                                                <img class=" rounded-circle wa-xs" src="{{ asset($client->profile_pic) }}" alt="Profile Picture" style="height: 50px; width: 50px;">
                                                @else
                                                <img class=" rounded-circle wa-xs" src="/avatar.jpg" alt="user.png" style="height: 50px; width: 50px;">
                                                @endif

                                              </div>
                                              <div class="details ml15 ml0-md mb15-md">

                                          
                                                <p class="mb-0 fz14 list-inline-item mb5-sm pe-1">
                                                  <span style="font-weight: 600">{{ $client->name }}
                                                    </span> paid for your order and   your order has been active.
                                                    <span style="color: rgb(197, 43, 43)"> {{$notification->created_at->diffForHumans()}}  </span> 
                                                  
                                                </p>
                                            


                                              </div>
                                            </div>

                                        </a>
                                @endif

                                
                                @if($notification->type === 'App\Notifications\DeliverOrderNotification')
                                      @php
                                          $order = \App\Models\Order::find($notification->data['order_id']);
                              
                                
                                          $seller = \App\Models\User::find($order->seller_id);
                                      @endphp



                                        <a href="{{ route('order.details',$order->id)}}" class="w-100 bdrb1">
                                          <div class="d-lg-flex align-items-lg-center m-2">
                                              <div class="thumb w60 position-relative rounded-circle mb15-md">

                                        


                                                @if($seller->profile_pic)

                                                <img class=" rounded-circle wa-xs" src="{{ asset($seller->profile_pic) }}" alt="Profile Picture" style="height: 50px; width: 50px;">
                                                @else
                                                <img class=" rounded-circle wa-xs" src="/avatar.jpg" alt="user.png" style="height: 50px; width: 50px;">
                                                @endif

                                              </div>
                                              <div class="details ml15 ml0-md mb15-md">

                                          
                                                <p class="mb-0 fz14 list-inline-item mb5-sm pe-1">
                                                  <span style="font-weight: 600">{{ $seller->name }}
                                                    </span> deliver your service. 
                                                    <span style="color: rgb(197, 43, 43)"> {{$notification->created_at->diffForHumans()}}  </span> 
                                                  
                                                </p>
                                            


                                              </div>
                                            </div>

                                        </a>
                                @endif


                                @if($notification->type === 'App\Notifications\CompleteOrderNotification')
                                      @php
                                          $order = \App\Models\Order::find($notification->data['order_id']);
                              
                                
                                          $client = \App\Models\User::find($order->client_id);
                                      @endphp



                                        <a href="{{ route('order.details',$order->id)}}" class="w-100 bdrb1">
                                          <div class="d-lg-flex align-items-lg-center m-2">
                                              <div class="thumb w60 position-relative rounded-circle mb15-md">

                                        


                                                @if($client->profile_pic)

                                                <img class=" rounded-circle wa-xs" src="{{ asset($client->profile_pic) }}" alt="Profile Picture" style="height: 50px; width: 50px;">
                                                @else
                                                <img class=" rounded-circle wa-xs" src="/avatar.jpg" alt="user.png" style="height: 50px; width: 50px;">
                                                @endif

                                              </div>
                                              <div class="details ml15 ml0-md mb15-md">

                                          
                                                <p class="mb-0 fz14 list-inline-item mb5-sm pe-1">
                                                  <span style="font-weight: 600">{{ $client->name }}
                                                    </span> received your service and your order completed.    
                                                            <span style="color: rgb(197, 43, 43)"> {{$notification->created_at->diffForHumans()}}  </span> 
                                                  
                                                </p>
                                            


                                              </div>
                                            </div>

                                        </a>
                                @endif
                                @if($notification->type === 'App\Notifications\FeedbackNotification')
                                      @php
                                          $order = \App\Models\Order::find($notification->data['order_id']);
                              
                                
                                          $client = \App\Models\User::find($order->client_id);
                                      @endphp



                   
                                          <div class="d-lg-flex align-items-lg-center m-2 pb-2 bdrb1">
                                              <div class="thumb w60 position-relative rounded-circle mb15-md">

                                        


                                                @if($client->profile_pic)

                                                <img class=" rounded-circle wa-xs" src="{{ asset($client->profile_pic) }}" alt="Profile Picture" style="height: 50px; width: 50px;">
                                                @else
                                                <img class=" rounded-circle wa-xs" src="/avatar.jpg" alt="user.png" style="height: 50px; width: 50px;">
                                                @endif

                                              </div>
                                              <div class="details ml15 ml0-md mb15-md">
                                               <a href="{{ route('reviews')}}" class="w-100">

                                                <p class="mb-0 fz14 list-inline-item mb5-sm pe-1">
                                                  <span style="font-weight: 600">
                                                    {{ $client->name }}
                                                  </span>
                                                    reviewed your service. 
                                                    
                                                    <span style="color: rgb(197, 43, 43)"> {{$notification->created_at->diffForHumans()}}  </span> 
                                                  
                                                </p>
                                            
                                               </a>
                                          
                                          


                                              </div>
                                            </div>

                             
                                @endif

                           
                                {{-- {{ $notification->markAsRead() }} --}}

                              
                          @endforeach
  
                          <button id="markAllAsReadBtn" class="ud-btn btn-thm w-100 mt-3" style="padding: 8px 13px; font-size: 12px; border: 2px solid rgba(0, 0, 0, 0.356);">
                            Mark all as read <i class="fal fa-arrow-right-long"></i>
                        </button>
                 
                 
                      </div>
                    </div>
                </li>



                <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

                <script>
                  // Event listener for the "Mark all as read" button
                  document.getElementById('markAllAsReadBtn').addEventListener('click', function() {
                      markAllNotificationsAsRead();
                  });
              
                  function markAllNotificationsAsRead() {
                      // Make an Axios POST request to mark all notifications as read
                      axios.post('{{ route('notifications.markAllAsRead') }}')
                          .then(response => {
                              // Handle success, e.g., update UI, display a message, etc.
                              console.log(response.data.message);

                              window.location.reload();
                              // Optionally, update the UI to indicate that all notifications are now read
                          })
                          .catch(error => {
                              // Handle error, e.g., display an error message
                              console.error(error.response.data.error);
                          });
                  }
              </script>


@endif










<style>
@media only screen and (max-width: 575px) {

  #markAllAsReadBtn{
  padding: 4px 1px;
    font-size: 15px;
    border: 2px solid rgba(0, 0, 0, 0.356);
    height: 50px;
    line-height: 38px;
}
.d-lg-flex{
  display: flex;
}

.thumb{
  margin-right: 10px;
  margin-top: -4px;
}

.badge{
  top: 22px !important;
}
}

</style>