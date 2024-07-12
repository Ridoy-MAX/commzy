<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProposalModifiedNotification extends Notification
{
    public $proposal;

    public function __construct($proposal)
    {
        $this->proposal = $proposal;
    }

    public function toDatabase($notifiable)
    {
        return [
            'proposal_id' => $this->proposal->id,
            // Add other data you want to store in the notifications table
        ];
    }

    public function via($notifiable)
    {
        return ['database'];
    }
}
