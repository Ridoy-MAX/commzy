<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EarningModel extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'net_income', 'withdrawn', 'pending_clearance', 'balance'];
}
