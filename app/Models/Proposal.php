<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
class Proposal extends Model
{
    use HasFactory,SoftDeletes,Notifiable;
    
    protected $fillable = ['client_id','seller_id','price','description','service_information_id','status','delivery_time'];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    function rel_to_user(){
        return $this->belongsTo(User::class,'client_id','seller_id');
    }
    function rel_to_service(){
        return $this->belongsTo(ServiceInformation::class,'service_information_id');
    }
    function rel_to_country(){
        return $this->belongsTo(Country::class,'country');
    }
}
