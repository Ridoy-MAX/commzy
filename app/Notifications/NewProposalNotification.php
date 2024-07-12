<?php

namespace App\Notifications;
use App\Models\Proposal;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewProposalNotification extends Notification
{
    public $proposal;
    public $seller;

    public function __construct($proposal,$seller)
    {
        $this->proposal = $proposal;
        $this->seller = $seller;
    }

    public function toMail($notifiable)
    {
        $url = url('/service/proposal/list'); // Replace this with your actual URL or use the $proposalUrl variable
        return (new MailMessage)
            ->view('email.email', [
                'proposal' => $this->proposal,
                'seller' => $this->seller,
                'url' => $url, // Pass the URL variable to the email template
            ])
            ->action('View Proposal', $url) // Set the action button URL
            ->subject('You have received a new proposal');
    }
    
    public function toDatabase($notifiable)
    {
        return [
            'proposal_id' => $this->proposal->id,
            // 'client_id' => $this->proposal->client_id,
            // Add other data you want to store in the notifications table
        ];
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }
}
