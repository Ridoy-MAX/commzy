<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LanguageList extends Model
{
    use HasFactory;
    protected $guarded =['id'];
    // protected $fillable = [
    //     'user_id',
    //     'languages',
    //     'languages_level',
   
      
    // ];
    
    
    function rel_to_user(){
        return $this->belongsTo(User::class,'user_id');
      }
}
