<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DeliverOrderNotification extends Notification
{
    public $orderId;

    public function __construct($orderId)
    {
        $this->orderId = $orderId;
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
        return ['database'];
    }
}
