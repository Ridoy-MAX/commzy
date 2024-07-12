<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ServiceInformation;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\General;
use App\Models\Category;
use App\Models\Invoice;
use App\Models\Proposal;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Notifications\NewProposalNotification;
use App\Notifications\ProposalDeclinedNotification;
use App\Notifications\ProposalAcceptedNotification;
use App\Notifications\ProposalModifyAcceptedNotification;
use App\Notifications\ProposalModifiedNotification;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Http\Controllers\PaypalController;


class ProposalController extends Controller
{
    //
    public function proposal(){
        $proposal = Proposal::paginate(10);
        // $acceptedProposals = Proposal::where('status', 'accept')->paginate(10);

        $acceptedProposals = Proposal::where('status', 'accept')
                                    ->where(function($query) {
                                        $query->where('seller_id', auth()->id())
                                              ->orWhere('client_id', auth()->id());
                                    })
                                    ->latest()->get();

        $declinedProposals = Proposal::where('status', 'decline')
                                    ->where(function($query) {
                                        $query->where('seller_id', auth()->id())
                                              ->orWhere('client_id', auth()->id());
                                    })
                                    ->latest()->get();
    
        $pendingProposals = Proposal::where('status', 'pending')
                                    ->where('seller_id', auth()->id())
                                    ->latest()->get();
    
        $sendProposals = Proposal::where(function($query) {
            $query->where(function($subquery) {
                $subquery->where('status', 'pending')
                        ->where('client_id', auth()->id());
            })
            ->orWhere(function($subquery) {
                $subquery->where('status', 'modify')
                        ->where('seller_id', auth()->id());
            });
        })
        ->latest()->get();

        $modifiedProposals = Proposal::where('status', 'modify')
                                ->where('client_id', auth()->id())
                                ->latest()->get();

        return view('proposal.proposal_list', compact('proposal', 'acceptedProposals', 'declinedProposals', 'pendingProposals', 'modifiedProposals', 'sendProposals'));
    }



    public function proposal_sent(Request $request)
    {
        // Validate the form data
        $request->validate([
            'price' => 'required|numeric',
            'description' => 'nullable',
            'service_information_id' => 'required',
            'delivery_time' => 'required',
        ]);
    
        // Get the authenticated user ID (client)
        $user_id = Auth::user()->id;
    
        // Process the form data and save it to the database (create a new proposal)
        $proposal = Proposal::create([
            'client_id' => $user_id,
            'seller_id' => $request->input('seller_id'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'service_information_id' => $request->input('service_information_id'),
            'delivery_time' => $request->input('delivery_time'),
            'status' => 'pending',
        ]);
    
        // Dispatch the notification
        $general = General::first();
        $logoFilename = $general->site_logo;
        $sellerID = User::find($request->input('seller_id'));
        $seller = $sellerID->name;

        $logoUrl = asset('public/' . $logoFilename);
    
        // if (!$seller) {
        //     \Log::error('Seller not found with ID: ' . $request->input('seller_id'));
        //     return back()->withErrors('Seller not found with the given ID.');
        // }
        $sellerID->notify(new NewProposalNotification($proposal,$seller));
    
        // Redirect or return a response as needed
        return back()->with('proposal', 'Proposal sent successfully!');
    }

    public function acceptProposal(Request $request,$id)
    {
            $request->validate([
                'client_id' => 'required|numeric',
                'seller_id' => 'required|numeric',
                'service_information_id' => 'required',
            ]);
            // Find the proposal by its ID
            $proposal = Proposal::findOrFail($id);
            // Get proposal ID from the request
            $proposal_id = $request->input('proposal_id');

            // Create a new order using the Order model
            $order = Order::create([
                'client_id' => $request->input('client_id'),
                'seller_id' => $request->input('seller_id'),
                'service_information_id' => $request->input('service_information_id'),
                'proposal_id' => $id,
                'status' => 'pending',
                'role' => 'seller',
            ]);

            // $paypalController = new PaypalController();
            // $response = $paypalController->createOrder(30, $proposal->price);
            // dd($response);

            $invoice = Invoice::create([
            'client_id' => $request->input('client_id'),
            'seller_id' => $request->input('seller_id'),
            'proposal_id' => $id,
            'status' => 'pending',
            ]);



        // Update the status to 'accept'
        $proposal->update(['status' => 'accept']);


        $client = User::find($proposal->client_id);
        $clientname = $client->name;
        $client->notify(new ProposalAcceptedNotification($proposal,$order,$clientname));

        // Redirect or return a response as needed
        return back()->with('success', 'Proposal accepted successfully.');
    }
    public function modifyacceptProposal(Request $request,$id)
    {
            $request->validate([
                'client_id' => 'required|numeric',
                'seller_id' => 'required|numeric',
                'service_information_id' => 'required',
            ]);
            // Find the proposal by its ID
            $proposal = Proposal::findOrFail($id);
            // Get proposal ID from the request
            $proposal_id = $request->input('proposal_id');

            // Create a new order using the Order model
            $order = Order::create([
                'client_id' => $request->input('client_id'),
                'seller_id' => $request->input('seller_id'),
                'service_information_id' => $request->input('service_information_id'),
                'proposal_id' => $id,
                'status' => 'pending',
                'role' => 'seller',
            ]);

            // $paypalController = new PaypalController();
            // $response = $paypalController->createOrder(30, $proposal->price);
            // dd($response);

            $invoice = Invoice::create([
            'client_id' => $request->input('client_id'),
            'seller_id' => $request->input('seller_id'),
            'proposal_id' => $id,
            'status' => 'pending',
            ]);


         $id = $order->id;
        // Update the status to 'accept'
        $proposal->update(['status' => 'accept']);


        $seller = User::find($proposal->seller_id);
        $seller->notify(new ProposalModifyAcceptedNotification($proposal,$order));

        // Redirect or return a response as needed
        return redirect()->route('service.checkout', $order->id)->with('success', 'Proposal modified successfully. Proceed to checkout.');
    }

    public function declineProposal($id)
    {
        // Find the proposal by its ID
        $proposal = Proposal::findOrFail($id);

        // Update the status to 'accept'
        $proposal->update(['status' => 'decline']);

        $client = User::find($proposal->client_id);
        $client->notify(new ProposalDeclinedNotification($proposal));

       

        // Redirect or return a response as needed
        return back()->with('success', 'Proposal decline successfully.');
    }


    public function declineProposalsend($id)
    {
        // Find the proposal by its ID
        $proposal = Proposal::findOrFail($id);

        // Update the status to 'accept'
        $proposal->update(['status' => 'decline']);


       

        // Redirect or return a response as needed
        return back()->with('success', 'Proposal decline successfully.');
    }


    public function proposal_modify(Request $request,$id )
    {
        // Validate the form data
        $request->validate([
            'price' => 'required|numeric',
            'description' => 'nullable',
            'service_information_id' => 'required',
            'delivery_time' => 'required',
        ]);

        // Find the proposal by service_information_id
        $proposal = Proposal::findOrFail($id);

        if ($proposal) {
            // Update the proposal data
            $proposal->update([
                'price' => $request->input('price'),
                'description' => $request->input('description'),
                'service_information_id' => $request->input('service_information_id'),
                'delivery_time' => $request->input('delivery_time'),
                'status' => 'modify',
            ]);

            $client = User::find($proposal->client_id);
       
            $client->notify(new ProposalModifiedNotification($proposal));

            // Redirect or return a response as needed
            return back()->with('success', 'Proposal modified successfully!');
        }

    

        // Handle case when the proposal is not found
        return back()->with('error', 'Proposal not found!');
    }


}
