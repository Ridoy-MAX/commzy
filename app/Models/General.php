<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class General extends Model
{
    use HasFactory;
    protected $guarded =['id'];
    protected $fillable = [
        'user_id',
        'site_title',
        'meta_title',
        'meta_description',
        'site_logo',
    ];
    
    
    function rel_to_user(){
        return $this->belongsTo(User::class,'user_id');
      }
}
