<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class PendingPaymentModel extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'days', 'order_id', 'client_id', 'amount', 'status','clearance_date'];

    public function getRemainingDaysAttribute()
    {
        $clearanceDate = Carbon::parse($this->clearance_date);
        $remainingDays = now()->diffInDays($clearanceDate, false);
        return max(0, $remainingDays);
    }
}
