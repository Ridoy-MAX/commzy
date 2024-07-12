<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{

    use HasFactory;
    protected $fillable = ['user_id', 'service_information_id','faq_id','gallery_id','status'];

    function rel_to_user(){
        return $this->belongsTo(User::class,'user_id');
    }

}
