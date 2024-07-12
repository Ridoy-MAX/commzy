<?php

namespace App\Notifications;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CompleteOrderNotification extends Notification
{
    public $orderId;
    public $sellerId;

    public function __construct($orderId,$sellerId)
    {
        $this->orderId = $orderId;
        $this->sellerId = $sellerId;
    }

    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //         ->line('Hello, ' . $this->sellerId->name . '!') 
    //         ->line(' Order has been completed.') // Customize your email content here
    //         ->action('View Order', url('order/details/'. $this->orderId )) // Add a link to view the proposal
    //         ->line('Thank you for using our application!');
    // }



    public function toMail($notifiable)
    {
        $url = url('order/details/'. $this->orderId ); // Replace this with your actual URL or use the $proposalUrl variable
        return (new MailMessage)
            ->view('email.complete', [
             
                'sellerId' => $this->sellerId,
                'url' => $url, // Pass the URL variable to the email template
            ])
            ->action('View order', $url) // Set the action button URL
            ->subject('Order has been completed.');
    }

    public function toDatabase($notifiable)
    {
        return [
            'order_id' => $this->orderId,
            // Add other data you want to store in the notifications table
        ];
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }


    // public function sendCustomEmail($orderId)
    // {
    //     // Retrieve the order instance based on $orderId
    //     $order = Order::find($orderId);

    //     // Send the notification
    //     $user = $order->user; // Assuming the order has a user relationship
    //     $user->notify(new CompleteOrderNotification($order));

    //     // You can also queue the notification for better performance
    //     // $user->notify((new CompleteOrderNotification($order))->delay(now()->addSeconds(5)));

    //     return redirect()->back()->with('success', 'Custom email sent successfully.');
    // }
}
