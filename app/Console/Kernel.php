<?php

namespace App\Console;
use App\Console\Commands\ClearPendingPayments;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('payments:clear')->everyMinute();
        $schedule->command('orders:update-status')->everyMinute(); // Adjust the time as needed
        // You can adjust the scheduling frequency and time according to your needs
    }
    
    
    protected $commands = [
        // 'App\Console\Commands\ClearPendingPayments',
        Commands\ClearPendingPayments::class,
        Commands\UpdateOrderStatus::class,
    ];
    
    
    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
