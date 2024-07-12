<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trust extends Model
{
    use HasFactory;
  protected $fillable = ['user_id', 'image_one', /* other fillable fields */];

    function rel_to_user(){
        return $this->belongsTo(User::class,'user_id');
      }
}
