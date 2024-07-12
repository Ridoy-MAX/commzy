<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FeedbackNotification extends Notification
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
    //         ->line(' You have received a new feedback on your service.') // Customize your email content here
    //         ->action('View reviews', url('/service/review/list' )) // Add a link to view the proposal
    //         ->line('Thank you for using our application!');
    // }





    public function toMail($notifiable)
    {
        $url = url('/service/review/list' ); // Replace this with your actual URL or use the $proposalUrl variable
        return (new MailMessage)
            ->view('email.feedback', [
             
                'seller' => $this->seller,
                'url' => $url, // Pass the URL variable to the email template
            ])
            ->action('View reviews', $url) // Set the action button URL
            ->subject('You have received a new feedback on your service.');
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
