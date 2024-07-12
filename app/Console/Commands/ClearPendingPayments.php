<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PendingPaymentModel;
use App\Models\EarningModel;
use Carbon\Carbon;

class ClearPendingPayments extends Command
{
    protected $signature = 'payments:clear';
    protected $description = 'Clear pending payments and update earnings';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Get pending payments that are ready to be cleared
        $pendingPayments = PendingPaymentModel::where('status', 'pending')
            ->whereDate('clearance_date', '<=', now()) // Filter based on date
            ->get();
    
        foreach ($pendingPayments as $payment) {
            // Calculate remaining days for payment clearance
            $clearanceDate = \Carbon\Carbon::parse($payment->clearance_date);
            $remainingDays = now()->diffInDays($clearanceDate, false);
    
            // Update pending payment status and remaining days
            $payment->update([
                'status' => 'complete',
                'days' => max(0, $remainingDays) // Ensure days remaining is not negative
            ]);
    
            // Check if the user already has an existing EarningModel record
            $earning = EarningModel::where('user_id', $payment->user_id)->first();
    
            if (!$earning) {
                // If no existing record, create a new one
                EarningModel::create([
                    'user_id' => $payment->user_id,
                    'net_income' => $payment->amount,
                    'balance' => $payment->amount, // Assuming balance starts with the cleared amount
                    'created_at' => now(),
                ]);
            } else {
                // If there's an existing record, update the balance
                $newBalance = $earning->balance + $payment->amount;
                $earning->update([
                    'net_income' => $earning->net_income + $payment->amount,
                    'balance' => $newBalance,
                ]);
            }
        }
    
        $this->info('Pending payments cleared successfully.');
    }
    
    
    
}
