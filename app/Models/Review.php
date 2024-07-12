<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

     function rel_to_user(){
        return $this->belongsTo(User::class,'client_id');
      }
      protected $fillable = ['seller_id','client_id','order_id', 'service_information_id','rating','comment'];

   
}
