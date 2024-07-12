<?php

namespace App\Models;
// use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
  protected $fillable = ['user_id', 'name','title','descripton','image'];

  function rel_to_user(){
      return $this->belongsTo(User::class,'user_id');
    }
}
