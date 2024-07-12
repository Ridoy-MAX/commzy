<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtendDelivery extends Model
{
    use HasFactory;

    protected $fillable = ['client_id','seller_id','order_id','delivery_time','reason','status','new_delivery_time'];

    function rel_to_order(){
        return $this->belongsTo(Order::class,'order_id');
    }
}
