<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProposalAcceptedNotification extends Notification
{
    public $proposal;
    public $order;
    public $clientname;
   

    public function __construct($proposal, $order,$clientname)
    {
        $this->proposal = $proposal;
        $this->order = $order;
        $this->clientname = $clientname;
    }

    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //         ->line('Hello, ' . $this->clientname . '!') 
    //         ->line('Your proposal has been received') // Customize your email content here
    //         ->action('View Order', url('order/details/'. $this->order->id )) // Add a link to view the proposal
    //         ->line('Thank you for using our application!');
    // }



    public function toMail($notifiable)
    {
        $url = url('order/details/'. $this->order->id ); // Replace this with your actual URL or use the $proposalUrl variable
        return (new MailMessage)
            ->view('email.accepted', [
             
                'clientname' => $this->clientname,
                'url' => $url, // Pass the URL variable to the email template
            ])
            ->action('View Proposal', $url) // Set the action button URL
            ->subject('Your proposal has been received');
    }

    public function toDatabase($notifiable)
    {
        return [
            'proposal_id' => $this->proposal->id,
            'order_id' => $this->order->id,
            // Add other data you want to store in the notifications table
        ];
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }
}
