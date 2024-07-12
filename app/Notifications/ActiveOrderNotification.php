<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ActiveOrderNotification extends Notification
{
    public $orderId;
    public $seller;

    public function __construct($orderId,$seller)
    {
        $this->orderId = $orderId;
        $this->seller = $seller;
    }

    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //         ->line('Hello, ' . $this->seller->name . '!') 
    //         ->line('You order has been active now.') // Customize your email content here
    //         ->action('View Order', url('order/details/'. $this->orderId )) // Add a link to view the proposal
    //         ->line('Thank you for using our application!');
    // }

    public function toMail($notifiable)
    {
        $url = url('order/details/'. $this->orderId ); // Replace this with your actual URL or use the $proposalUrl variable
        return (new MailMessage)
            ->view('email.active', [
             
                'seller' => $this->seller,
                'url' => $url, // Pass the URL variable to the email template
            ])
            ->action('View Proposal', $url) // Set the action button URL
            ->subject('You order has been active now.');
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
}
