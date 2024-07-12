<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Checkout;
use App\Models\Order;
use App\Models\Invoice;
use App\Notifications\ActiveOrderNotification;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Models\User;
class PaypalController extends Controller
{

    public function handlePayment(Request $request)
    {
        // dd($request->order_id);
        $order = Order::findOrFail($request->order_id);
        $service_price = Checkout::where('id', $order->checkout_id)->value('service_price');
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('success.payment', $request->order_id),
                "cancel_url" => route('cancelled'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $service_price,
                    ]
                ]
            ]
        ]);
        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            return redirect()
                ->route('cancelled')
                ->with('error', 'Something went wrong.');
        } else {
            return redirect()
                ->route('service.checkout', $request->order_id)
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    public function paymentCancel()
    {
        return redirect()
            ->route('payment.cancel')
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }

    public function paymentSuccess(Request $request)
    {
        // dd("Capture the payment.");
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $order = Order::find($request->order_id);
            $order->update([
                'status' => 'in process',
            ]);

            $orderId = $order->id;
            $seller = User::find($order->seller_id);
            $seller->notify(new ActiveOrderNotification($orderId,$seller));

            $invoice = Invoice::where('proposal_id', $order->proposal_id)->first();

            if ($invoice) {
                // Update the invoice status to 'Completed'
                $invoice->update([
                    'status' => 'Completed',
                ]);
            }

            return redirect()
                ->route('confirm.order', $request->order_id)
                ->with('success', 'Transaction complete.');
        } else {
            return redirect()
                ->route('cancelled')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }
}
