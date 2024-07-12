<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    public function serviceInformation()
    {
        return $this->belongsTo(ServiceInformation::class, 'service_information_id');
    }

 
    
      protected $fillable = ['service_information_id', 'image'];
}
