<?php

namespace App\Notifications;


use Illuminate\Notifications\Notification;

class ProposalModifyAcceptedNotification extends Notification
{
    public $proposal;
    public $order;
   

    public function __construct($proposal, $order)
    {
        $this->proposal = $proposal;
        $this->order = $order;
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
        return ['database'];
    }
}
