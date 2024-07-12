<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Proposal;
use App\Models\PendingPaymentModel;
use App\Models\EarningModel;
use App\Models\User;
use App\Models\Payout;
use App\Models\WithdrawnRequest;
use Illuminate\Http\Request;

class EarningController extends Controller
{
    //
    public function earning()
    {
        // Retrieve completed orders with related proposals where status is 'complete'
        $orders = Order::where('status', 'complete')->with('rel_to_proposal')->get();

        $payments = WithdrawnRequest::where('user_id', auth()->id() )->get();
    
        // Retrieve pending payments for the authenticated user
        $pendingPayments = PendingPaymentModel::where('user_id', auth()->id() )->get(); 

        $pendingClearance = PendingPaymentModel::where('user_id', auth()->id())->where('status', 'pending')->get();

        $Payments = EarningModel::where('user_id', auth()->id() )->get(); 

        // $user_id = auth()->id();
        // Calculate total income based on the price in related proposals
       
    
        // Calculate total pending payments for the authenticated user
        $totalPendingPayments = $pendingClearance->sum('amount');
        $pendingPaymentsCount = $pendingClearance->count();
                             
        $netIncome = $Payments->sum('net_income');
        $withdrawm = $Payments->sum('withdrawn');
        $netIncomeCount = $Payments->count();

        $mainbalance = $Payments->sum('balance');
    
        // Calculate total earnings (completed orders - pending payments)
        // $netEarnings = $totalIncome - $totalPendingPayments;
    
        return view('Earnings.earnings', compact('totalPendingPayments','pendingPaymentsCount','pendingPayments','netIncome','netIncomeCount','mainbalance','payments','Payments','withdrawm'));
    }
    
    public function earning_request(){
        $WithdrawnRequest = WithdrawnRequest::all();
        return view('withdraw_request.withdraw_request', compact('WithdrawnRequest'));
    }
    
    
    


    public function earning_total()
    {
        // Calculate total income from proposals where status is 'accept'
        $totalIncome = Proposal::where('status', 'accept')->sum('price');
        
    
        // Redirect back with success message including total income
        return back()->with('success', 'Order completed successfully! Total income: $' . number_format($totalIncome, 2));
    }

    public function payment_method()
    {
        // Calculate total income from proposals where status is 'accept'
     $payments = Payout::where('user_id', auth()->id() )->paginate(5); 
     return view('Earnings.payment_method',compact('payments'));
    }

    // public function withdrawn_balance(Request $request)
    // {
    //     // dd($request);
    //     // Validate the form data
    //     $request->validate([
    //         'payment_method' => 'required|string',
    //         'amount' => 'required|numeric',
    //         // 'price' => 'required|numeric',
    //     ]);
    
    //     $user_id =  $request->input('user_id');
    //     // $amount = $request->input('amount');

    //     Payout::create([
    //         'user_id' => $user_id,
    //         'payment_method' => $request->input('payment_method'),
    //         'status' => 'pending', // Set initial status to 'pending'
    //         'amount' => $request->input('amount'),
    //     ]);

    //    return back();
     
    // }

    public function withdrawn_balance(Request $request)
    {
        // dd($request);
        // Validate the form data
        $request->validate([
            'payment_method' => 'required|string',
            'amount' => 'required|numeric',
            // 'price' => 'required|numeric',
        ]);
    
        $user_id =  $request->input('user_id');
        $amount = $request->input('amount');
    
        // Get the user's earnings record
        $earning = EarningModel::where('user_id', $user_id)->first();
    
        if ($earning && $earning->balance >= $amount) {
            // Calculate new balance and withdrawn amount
            $newBalance = $earning->balance - $amount;
            $newWithdrawn = $earning->withdrawn + $amount;
    
            // Update EarningModel record with new balance and withdrawn amount
            $earning->update([
                'balance' => $newBalance,
                'withdrawn' => $newWithdrawn,
            ]);
    
            // Create a payout record
            Payout::create([
                'user_id' => $user_id,
                'payment_method' => $request->input('payment_method'),
                'status' => 'Transferred successfully', // Set initial status to 'pending'
                'amount' => $amount,
            ]);
    
            // Redirect or return a response as needed
            return redirect()->back()->with('success', 'Withdrawal request submitted successfully.');
        } else {
            // Handle insufficient balance error
            return redirect()->back()->with('error', 'Insufficient balance.');
        }
    }
    


    public function withdrawn_request(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|string',
            'amount' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'details' => 'required',
        ]);
    
        $user_id = $request->input('user_id');
        $amount = number_format($request->input('amount'), 2, '.', ''); // Ensure two decimal places
    
        $earning = EarningModel::where('user_id', $user_id)->first();
    
        if ($earning && $earning->balance >= $amount) {
            $newBalance = $earning->balance - $amount;
    
            $earning->update([
                'balance' => $newBalance,
            ]);
    
            $payout = Payout::create([
                'user_id' => $user_id,
                'payment_method' => $request->input('payment_method'),
                'status' => 'Pending',
                'amount' => $amount,
            ]);
    
            $payout_id = $payout->id;
    
            WithdrawnRequest::create([
                'user_id' => $user_id,
                'payout_id' => $payout_id,
                'payment_method' => $request->input('payment_method'),
                'details' => $request->input('details'),
                'status' => 'Pending',
                'amount' => $amount,
            ]);
    
            return redirect()->back()->with('success', 'Withdrawal request submitted successfully.');
        } else {
            return redirect()->back()->with('error', 'Insufficient balance.');
        }
    }
    

    
    public function withdrawn_request_accept(Request $request)
    {
        // Validate the request if necessary
    
        $payoutId = $request->input('payout_id');
        $WithdrawnRequestId = $request->input('withdrawnrequest_id');
        $payout = Payout::find($payoutId);
        $WithdrawnRequest = WithdrawnRequest::find($WithdrawnRequestId);

    
        if ($payout) {
            // Update the payout status to completed
            $payout->update([
                'status' => 'completed'
            ]);
    
            $WithdrawnRequest->update([
                'status' => 'completed'
            ]);
    
            // Get the user's earnings record
            $user_id = $payout->user_id;
            $earning = EarningModel::where('user_id', $user_id)->first();
    
            // Calculate new balance and withdrawn amount
            // $newBalance = $earning->balance - $payout->amount;
            $newWithdrawn = $earning->withdrawn + $WithdrawnRequest->amount;
    
            // Update EarningModel record with new balance and withdrawn amount
            $earning->update([
                // 'balance' => $newBalance,
                'withdrawn' => $newWithdrawn,
            ]);
    
            return redirect()->back()->with('success', 'Withdrawal request approved successfully.');
        } else {
            // Handle error if payout record not found
            return redirect()->back()->with('error', 'Payout record not found.');
        }
    }


    public function updatePaymentWithdraw(Request $request, $id)
    {
        // Validate the request if necessary

        $paymentWithdraw = WithdrawnRequest::findOrFail($id);
        $paymentWithdraw->update([
            'details' => $request->input('details'),
        ]);

        return redirect()->back()->with('success', 'Payment withdrawal details updated successfully.');
    }
    

}
