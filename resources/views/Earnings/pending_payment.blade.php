<div class="">
  <div class="packages_table table-responsive">
    <table id="pendingPaymentsTable" class="table-style3 table at-savesearch">
      <thead class="t-head">
          <tr>
              <th scope="col">Date</th>
              <th scope="col">Detail</th>
              <th scope="col">Order</th>
              <th scope="col">From</th>
              <th scope="col">Status</th>
              <th scope="col">Amount</th>
          </tr>
      </thead>
      <tbody class="t-body">
          @foreach($pendingPayments as $payment)
          @php
          $client = \App\Models\User::find($payment->client_id);
          @endphp
          <tr>
              <td>{{ \Carbon\Carbon::parse($payment->created_at)->format('F j, Y') }}</td>
              <td class="vam">
                  @if($payment->days == '0')
                  Payment clear
                  @else
                  Payment clear in {{ $payment->remaining_days }} days
                  @endif
              </td>
              <td class="vam">#0{{ $payment->order_id }}</td>
              <td class="vam">{{ $client->name }}</td>
              @if($payment->status == 'complete')
              <td class="vam"><span class="pending-style style2">{{ $payment->status }}</span></td>
              @endif
              @if($payment->status == 'pending')
              <td class="vam"><span class="pending-style style1">{{ $payment->status }}</span></td>
              @endif
              <td class="vam">${{ $payment->amount }}</td>
          </tr>
          @endforeach
      </tbody>
      
  </table>
  

  
  </div>
</div>