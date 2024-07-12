<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use Carbon\Carbon;

class UpdateOrderStatus extends Command
{
    protected $signature = 'orders:update-status';
    protected $description = 'Update order status based on delivery days';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $orders = Order::where('status', 'in process')->get();

        foreach ($orders as $order) {
            $deliveryDate = Carbon::parse($order->created_at)->addDays($order->rel_to_proposal->delivery_time);
            $remainingDays = Carbon::now()->diffInDays($deliveryDate, false);

            // Update order status based on remaining days
            if ($remainingDays <= 0) {
                $order->status = 'in process';
                $order->save();
            }

            // Output the remaining days in the console
            $this->info("Order ID: {$order->id} - Remaining Days: {$remainingDays}");
        }

        $this->info('Order statuses updated successfully.');
    }
}
