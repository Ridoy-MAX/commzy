<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CancelOrder extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','order_id','reason','status'];

    function rel_to_order(){
        return $this->belongsTo(Order::class,'order_id');
    }
}
