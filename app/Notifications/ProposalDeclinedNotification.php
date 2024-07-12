<?php

namespace App\Notifications;


use Illuminate\Notifications\Notification;

class ProposalDeclinedNotification extends Notification
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
