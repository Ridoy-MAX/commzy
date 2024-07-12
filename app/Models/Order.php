<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Order extends Model
{
    use HasFactory,Notifiable;

    protected $fillable = ['client_id','seller_id', 'service_information_id','proposal_id','checkout_id','status','role' /* other fillable fields */];
    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }
    
    function rel_to_user(){
        return $this->belongsTo(User::class,'user_id');
    }
    function rel_to_proposal(){
        return $this->belongsTo(Proposal::class,'proposal_id');
    }
    function rel_to_service(){
        return $this->belongsTo(ServiceInformation::class,'service_information_id');
    }
    function rel_to_checkout(){
        return $this->belongsTo(Checkout::class,'checkout_id');
    }
    function rel_to_deliverwork(){
        return $this->belongsTo(DeliverWork::class,'deliver_work_id');
    }
}
