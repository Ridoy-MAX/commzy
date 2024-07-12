<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawnRequest extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','payout_id', 'payment_method','details','status', 'amount'];

    function rel_to_user(){
        return $this->belongsTo(User::class,'user_id');
      }
}
