<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountApproval extends Model
{
    use HasFactory;

    protected $table = 'account_approvals';
    protected $fillable = ['user_id', 'approval'];

   function rel_to_user()
  {
      return $this->belongsTo(User::class, 'user_id', 'id');
  }

}