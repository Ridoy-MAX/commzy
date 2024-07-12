<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliverWork extends Model
{
    use HasFactory;

    protected $fillable = ['client_id','seller_id','order_id','file','comment','status'];

    function rel_to_order(){
        return $this->belongsTo(Order::class,'order_id');
    }
  
}
