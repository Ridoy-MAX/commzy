<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class Permission extends Model
{
    protected $fillable = ['name', 'guard_name'];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}