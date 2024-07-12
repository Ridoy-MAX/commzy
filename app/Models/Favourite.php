<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'service_information_id'];

    public function rel_to_user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function rel_to_service()
    {
        return $this->belongsTo(ServiceInformation::class, 'service_information_id');
    }
}
