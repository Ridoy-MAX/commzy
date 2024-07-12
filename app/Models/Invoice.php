<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = ['client_id', 'seller_id', 'order_id', 'proposal_id', 'checkout_id', 'service_name','service_price','commision','status'];
}
