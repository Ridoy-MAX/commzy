<div class="">
  <div class="packages_table table-responsive">
    <table class="table-style3 table at-savesearch" id="payouts">
      <thead class="t-head" >
        <tr>
          <th scope="col">Date</th>
          <th scope="col">Payment Status</th>
          <th scope="col">Payout Method</th>
          <th scope="col">Amount</th>
          <th scope="col">Action</th>
  
      
      
        </tr>
      </thead>
      <tbody class="t-body">

        @foreach($payments as $paymentWithdraw)
        <tr>
          <td class="vam"> {{ \Carbon\Carbon::parse($paymentWithdraw->created_at)->format('F j, Y') }} </td>
          <td class="vam">

            @if($paymentWithdraw->status == 'Pending')
   
            <span class="pending-style style1">{{$paymentWithdraw->status}} </span>
            
            @else
            <span class="pending-style style2">{{$paymentWithdraw->status}} </span>
            @endif
            
         
          
          </td>
          <td class="vam">{{$paymentWithdraw->payment_method}}</td>
          <td scope="row">${{$paymentWithdraw->amount}}</td>
       
            
          <td class="vam d-flex">

            @if($paymentWithdraw->status == 'Pending')
 
        
            <li> 
                  <a href="#" class="view-user icon" data-bs-toggle="modal" data-bs-target="#exampleModal{{$paymentWithdraw->id}}" data-name="Straw hat luffy" data-username="ridoy123" data-email="ridoy@gmail.com">
                      <i class="fa-regular fa-eye"></i>
                  </a>

                  <div class="modal fade" id="exampleModal{{$paymentWithdraw->id}}" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered modal-lg">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="exampleModalLabel">View Account</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                  <div class="ps-widget bgc-white bdrs4 p30 overflow-hidden position-relative">
                                      <div class="col-xl">
                                          <form class="form-style1">
                                              <div class="row">
                                                  <div class="mb20">
                                                      <label class="heading-color ff-heading fw500 mb10">Payout Method</label>
                                                      <p>{{$paymentWithdraw->payment_method}}</p>
                                                  </div>
                                                  <div class="mb20">
                                                      <label class="heading-color ff-heading fw500 mb10">Account details</label>
                                                      <p>{{$paymentWithdraw->details}} </p>
                                                  </div>
                                                  <div class="mb20">
                                                      <label class="heading-color ff-heading fw500 mb10">Price</label>
                                                      <p>${{$paymentWithdraw->amount}}</p>
                                                  </div>
                                                  <div class="mb20">
                                                      <label class="heading-color ff-heading fw500 mb10">Status</label>
                                                      <span class="pending-style style2">{{$paymentWithdraw->status}}</span>
                                                  </div>
                                                  <div class="mb20">
                                                      <label class="heading-color ff-heading fw500 mb10">Created Date</label>
                                                      <p>{{ \Carbon\Carbon::parse($paymentWithdraw->created_at)->format('F j, Y') }}  </p> 
                                                  </div>
                                              </div>
                                          </form>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>

              
              </li>


            <li> 
                  <a href="" class="icon ms-2" data-bs-toggle="modal" data-bs-target="#updateUserModal{{$paymentWithdraw->id}}">
                      <i class="fa-regular fa-pen-to-square ms-2 me-2"></i>
                  </a>

                    <!-- user edit  -->
                   <!-- Update User Modal -->
                  <div class="modal fade" id="updateUserModal{{$paymentWithdraw->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered modal-lg">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="exampleModalLabel">Update </h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                  <div class="ps-widget bgc-white bdrs4 p30 overflow-hidden position-relative">
                                      <form method="POST" action="{{ route('update.payment.withdraw', $paymentWithdraw->id) }}">
                                        @csrf
                                                                                                          
                                          <div class="mb20">
                                              <label class="heading-color ff-heading fw500 mb10">Payout Method</label>
                                              <input type="text"  class="form-control" value="{{$paymentWithdraw->payment_method}} " disabled>
                                          </div>
                                          <div class="mb20">
                                              <label class="heading-color ff-heading fw500 mb10">Account details</label>
                                              <textarea name="details" id="" cols="30" rows="10"  class="form-control" style="height: 200px">
                                                {{$paymentWithdraw->details}} 
                                              </textarea>
                                     
                                          </div>
                                         
                                          <div class="col-md-12">
                                              <div class="text-start">
                                                  <button type="submit" class="ud-btn btn-thm">Update </button>
                                              </div>
                                          </div>
                                      </form>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>

             </li>
            
            @else
       
            <li> 
              <a href="#" class="view-user icon" data-bs-toggle="modal" data-bs-target="#exampleModal{{$paymentWithdraw->id}}" data-name="Straw hat luffy" data-username="ridoy123" data-email="ridoy@gmail.com">
                <i class="fa-regular fa-eye"></i>
            </a>

            <div class="modal fade" id="exampleModal{{$paymentWithdraw->id}}" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">View Account</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="ps-widget bgc-white bdrs4 p30 overflow-hidden position-relative">
                                <div class="col-xl">
                                    <form class="form-style1">
                                        <div class="row">
                                            <div class="mb20">
                                                <label class="heading-color ff-heading fw500 mb10">Payout Method</label>
                                                <p>{{$paymentWithdraw->payment_method}}</p>
                                            </div>
                                            <div class="mb20">
                                                <label class="heading-color ff-heading fw500 mb10">Account details</label>
                                                <p>{{$paymentWithdraw->details}} </p>
                                            </div>
                                            <div class="mb20">
                                                <label class="heading-color ff-heading fw500 mb10">Price</label>
                                                <p>${{$paymentWithdraw->amount}}</p>
                                            </div>
                                            <div class="mb20">
                                                <label class="heading-color ff-heading fw500 mb10">Status</label>
                                                <span class="pending-style style2">{{$paymentWithdraw->status}}</span>
                                            </div>
                                            <div class="mb20">
                                                <label class="heading-color ff-heading fw500 mb10">Created Date</label>
                                                <p>{{ \Carbon\Carbon::parse($paymentWithdraw->created_at)->format('F j, Y') }}  </p> 
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

          
           </li>

            @endif



      
        
        </td>
        </tr>
        @endforeach
      
      </tbody>
    </table>
  
  </div>
</div>