<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Country;
use App\Models\Checkout;
use App\Models\Proposal;
use App\Models\Review;
use App\Models\Invoice;
use App\Models\PendingPaymentModel;
use App\Models\Commission;
use App\Models\Footer;
use App\Models\CancelOrder;
use App\Models\ExtendDelivery;
use App\Models\DeliverWork;
use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Notifications\DeliverOrderNotification;
use App\Notifications\CompleteOrderNotification;
use App\Notifications\FeedbackNotification;
class OrderController extends Controller
{
    //

    public function deliverWork(Request $request)
    {

        // dd($request);
        // Validate the form data
        $request->validate([
            'file' => 'required|file|max:1024', // Max 1 GB file size
            'comment' => 'required|string',
        ]);

        // Retrieve order and other data from the form
        $orderId = $request->input('order_id');
        $sellerId = $request->input('seller_id');
        $clientId = $request->input('client_id');
        $comment = $request->input('comment');

        // Handle file upload
        if ($request->hasFile('file')) {
            // Store the attachment in the 'public' disk under 'deliverwork' directory
            $filename = time().'.'.$request->file('file')->getClientOriginalExtension();
            $filePath = $request->file('file')->move('deliverwork', $filename,  'public');



        } else {
            $attachmentPath = null; // Set to null if no attachment is provided
        }

        // Create a new DeliverWork record
        DeliverWork::create([
            'order_id' => $orderId,
            'seller_id' => $sellerId,
            'client_id' => $clientId,
            'status' => 'pending',
            'comment' => $comment,
            'file' => $filePath, // Save the attachment path
            'created_at' => Carbon::now(),
        ]);

        $client = User::find($clientId);
        $client->notify(new DeliverOrderNotification($orderId));

        // Redirect or return a response as needed
        return redirect()->back()->with('DeliverWork', 'Your service delivered successfully wait until client accept your request ');
    }



    public function deliverWork_cancel($id)
    {
        $order = DeliverWork::findOrFail($id);
    
        $order->update([
            'status' => 'cancel',
            'created_at' => now(),
        ]);
    
        return back()->with('success', 'Delivery request canceled successfully!');
    }
    



    public function order_list (){
        $orderlist = Order::where('status', 'in process')->latest()->get();

        $pendingorder = Order::where('status', 'pending')
        ->where(function($query) {
            $query->where('seller_id', auth()->id())
                  ->orWhere('client_id', auth()->id());
        })
        ->latest()->get();

        // $activeorder = Order::where('status', 'in process')
        // ->where(function($query) {
        //     $query->where('seller_id', auth()->id())
        //           ->orWhere('client_id', auth()->id());
        // })
        // ->paginate(10);

        $activeorder = Order::where(function ($query) {
            $query->where('status', 'in process')
                  ->orWhere('status', 'late');
        })
        ->where(function ($query) {
            $query->where('seller_id', auth()->id())
                  ->orWhere('client_id', auth()->id());
        })
        ->latest()->get();

        

        $completedeorder = Order::where('status', 'complete')
        ->where(function($query) {
            $query->where('seller_id', auth()->id())
                  ->orWhere('client_id', auth()->id());
        })
        ->latest()->get();

        $cancelorderlist = Order::where('status', 'cancel')
        ->where(function($query) {
            $query->where('seller_id', auth()->id())
                  ->orWhere('client_id', auth()->id());
        })
        ->latest()->get();




        return view('order.order_list',compact('orderlist','cancelorderlist','pendingorder','activeorder','completedeorder'));
    }

    public function order_cancel(Request $request,$id)
    {
        $order = Order::findOrFail($id);
    
        $order->update([
            'status' => 'cancel',
            'created_at' => now(),
        ]);
    
        $proposal_id = $order->proposal_id;
    
        // Find the invoice based on the proposal_id
        $invoice = Invoice::where('proposal_id', $proposal_id)->first();
    
        if ($invoice) {
            // Update the invoice status to 'Cancelled'
            $invoice->update([
                'status' => 'cancel',
            ]);
        } else {
            // Handle the case where the invoice with the given proposal_id is not found
            // You can log an error, return a response, or perform other actions based on your application's requirements.
        }
    
        return back()->with('success', 'Order cancelled successfully!');
    }
    

    public function order_cancel_reject(Request $request, $id)
    {
        // Validate the request if needed
        // $request->validate([...]);
    
        $cancelOrder = CancelOrder::findOrFail($id);
    
        $cancelOrder->update([
            'status' => 'cancel',
            'created_at' => now(),
        ]);
    
        return back()->with('success', 'Order cancel request rejected successfully!');
    }

 
    public function order_complete($id)
    {
        $order = Order::findOrFail($id);
        $commission = Commission::get()->first();
        $user_id = auth()->id();
        $total_amount = $order->rel_to_proposal->price;


        $commissionPercentage = $commission ? $commission->commission : 0;
        $commissionAmount = $total_amount * ($commissionPercentage / 100);
        $servicePriceAfterCommission = $total_amount - $commissionAmount;


        // Calculate clearance date
        $clearanceDate = now()->addDays($commission->pending_clearance);

        // Create a new PendingPaymentModel instance
        $pendingPayment = new PendingPaymentModel();
        $pendingPayment->user_id = $order->seller_id;
        $pendingPayment->days = $commission->pending_clearance;
        $pendingPayment->order_id = $order->id;
        $pendingPayment->client_id = $order->client_id;
        $pendingPayment->amount = $servicePriceAfterCommission;
        $pendingPayment->status = 'pending';
        $pendingPayment->clearance_date = $clearanceDate;
        $pendingPayment->save();

        // Update order status
        $order->update([
            'status' => 'complete',
            'created_at' => now(),
        ]);


        $orderId = $id;
        $sellerId = $order->seller_id;

        $sellerId = User::find($sellerId);
        $sellerId->notify(new CompleteOrderNotification($orderId,$sellerId));

        return back()->with('success', 'Order completed successfully!');
    }


    public function order_cancel_request(Request $request)
    {
        // Validate the form data
        $request->validate([
            'reason' => 'required',
        ]);

        // $deliveryTime = $request->input('delivery_time');

        $orderId = $request->input('order_id');
        $reason = $request->input('reason');
        $user_id = auth()->id();

        // Create a new CancelOrder record
        CancelOrder::create([

            'user_id' => $user_id,
            'order_id' => $orderId,
            'reason' => $reason,
            'status' => 'pending',
            'created_at' => now(), // Set initial status to 'pending'
        ]);

        // Redirect or return a response as needed
        return redirect()->route('order.details',$orderId)->with('success', 'Cancel request submitted successfully.');
        // return back()->with('success', 'Cancel request submitted successfully.');
    }





    public function order_details($id) {
        // Retrieve the order with the given ID
        $order = Order::find($id);
        $deliverWork = DeliverWork::where('order_id', $id)->latest()->first();
        $extenddelivery = ExtendDelivery::where('order_id', $id)->latest()->first();
        $cancelorder = CancelOrder::where('order_id', $id)->latest()->first();
        $approvedelivery = ExtendDelivery::where('order_id', $id)
        ->where('status', 'approve')
        ->latest()
        ->get();

        $deliveryDate = Carbon::parse($order->created_at)->addDays($order->rel_to_proposal->delivery_time);
        $remainingDays = Carbon::now()->diffInDays($deliveryDate, false);
       

        // Check if the order exists
        if (!$order) {
            // Handle the case where the order does not exist, for example, redirect to an error page
            return redirect()->route('error.page')->with('error', 'Order not found.');
        }



        // Return the order details to a view
        return view('order.order_details', compact('order','deliverWork','extenddelivery','approvedelivery','cancelorder','remainingDays'));
    }

    public function order_resulation($id) {
        // Retrieve the order with the given ID
        $order = Order::find($id);

        // Check if the order exists
        if (!$order) {
            // Handle the case where the order does not exist, for example, redirect to an error page
            return redirect()->route('error.page')->with('error', 'Order not found.');
        }

        // Now you can use the $order variable to access the order details
        // For example: $order->name, $order->service_information_id, etc.

        // Return the order details to a view
        return view('order.order_resulation', compact('order'));
    }

    public function order_extend_time($id) {
        // Retrieve the order with the given ID
        $order = Order::find($id);

        // Check if the order exists
        if (!$order) {
            // Handle the case where the order does not exist, for example, redirect to an error page
            return redirect()->route('error.page')->with('error', 'Order not found.');
        }

        // Now you can use the $order variable to access the order details
        // For example: $order->name, $order->service_information_id, etc.

        // Return the order details to a view
        return view('order.extend_time', compact('order'));
    }

 
    public function order_extend_time_cancel($id) {
        // Retrieve the order with the given ID
        $extendDelivery = ExtendDelivery::find($id);

        // Check if the order exists
        if (!$extendDelivery) {
            // Handle the case where the order does not exist, for example, redirect to an error page
            return redirect()->route('error.page')->with('error', 'Order not found.');
        }

        $extendDelivery->update([
            'status' => 'cancel',
            'created_at' => now(),
        ]);

        // Return the order details to a view or redirect back with a success message
        return back()->with('success', 'Extend delivery request canceled successfully!');
    }


    public function order_extend_time_approve(Request $request, $id) {
        $delivery_time = $request->input('delivery_time');
        $proposal_daivery_time = $request->input('proposal_daivery_time');
        $proposal_id = $request->input('proposal_id');

        $proposal = Proposal::find($proposal_id);

        $proposal->update([
            'delivery_time' => $proposal_daivery_time+$delivery_time,
        ]);

        // Retrieve the order with the given ID
        $order = ExtendDelivery::find($id);

        // Check if the order exists
        if (!$order) {
            // Handle the case where the order does not exist, for example, redirect to an error page
            return redirect()->route('error.page')->with('error', 'Order not found.');
        }

        $order->update([

            'status' => 'approve',
            'new_delivery_time' => $proposal_daivery_time+$delivery_time,
            'created_at' => now(),
        ]);

        // Now you can use the $order variable to access the order details
        // For example: $order->name, $order->service_information_id, etc.

        // Return the order details to a view
        return back()->with('success', 'Extend delivery request approve   successfully!');
    }

    public function order_extend_time_store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'delivery_time' => 'required|integer', // Ensure the selected delivery time is a positive integer
            'client_id' => 'required|integer',
            'seller_id' => 'required|integer',
            'order_id' => 'required|integer',
            'reason' => 'required|string',
        ]);

        // Retrieve data from the form
        $deliveryTime = $request->input('delivery_time');
        $clientId = $request->input('client_id');
        $sellerId = $request->input('seller_id');
        $orderId = $request->input('order_id');
        $reason = $request->input('reason');


            // Create a record in the database for order extension
            ExtendDelivery::create([
                'order_id' => $orderId,
                'client_id' => $clientId,
                'seller_id' => $sellerId,
                'delivery_time' => $deliveryTime,
                'reason' => $reason,
                'status' => 'pending', // Set the initial status as pending, you can update this based on your workflow
            ]);

            // Redirect to a success page or show a success message



            // Handle the case where the order does not exist
            return redirect()->route('order.details',$orderId)->with('success', 'Request send successfully ! for extend the delivery time');

    }

    public function reviews()
    {
        // Get reviews where seller_id or client_id match the authenticated user's ID with pagination
        $reviews = Review::where(function ($query) {
            $query->where('seller_id', auth()->id())
                ->orWhere('client_id', auth()->id());
        })->latest()->paginate(5);

        // Pass the paginated reviews data to the view
        return view('review.review', compact('reviews'));
    }




    public function service_review(Request $request)
    {
        // Validate the form data
        $request->validate([
            'comment' => 'required|string',
            'service_information_id' => 'required|string',
        ]);

        // Check if a review already exists for the client and service
        $existingReview = Review::where('client_id', $request->input('client_id'))
            ->where('service_information_id', $request->input('service_information_id'))
            ->where('order_id', $request->input('order_id'))
            ->first();

        if ($existingReview) {
            // Review already exists, handle the situation (redirect back with an error message)
            return redirect()->back()->with('success', 'You have already reviewed this service.');
        }

        // Create a new review
        Review::create([
            'seller_id' => $request->input('seller_id'),
            'client_id' => $request->input('client_id'),
            'order_id' => $request->input('order_id'),
            'service_information_id' => $request->input('service_information_id'),
            'rating' => $request->input('rating'),
            'comment' => $request->input('comment'),
        ]);

        $sellerId = $request->input('seller_id');
        $orderId = $request->input('order_id');

        $seller = User::find($sellerId);
        $seller->notify(new FeedbackNotification($orderId,$seller));
        // Redirect or return a response based on your requirements
        return redirect()->back()->with('success', 'Review submitted successfully!');
    }




}
