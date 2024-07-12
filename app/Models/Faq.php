<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Faq extends Model
{
    use HasFactory,SoftDeletes;
    protected $dates = ['deleted_at'];

    public function serviceInformation()
    {
        return $this->belongsTo(ServiceInformation::class, 'service_information_id');
    }

  
      protected $fillable = ['service_information_id', 'question', 'answer' ];
}
