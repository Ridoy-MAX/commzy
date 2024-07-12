<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ServiceInformation extends Model
{
    use HasFactory,SoftDeletes;
    // function rel_to_service(){
    //     return $this->belongsTo(Service::class,'service_id');
    //   }
    function rel_to_user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function rel_to_review()
    {
        return $this->hasMany(Review::class, 'service_information_id', 'id');
    }
    
    public function rel_to_gallery()
    {
        return $this->hasMany(Gallery::class, 'service_information_id', 'id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country');
    }
    

    public function rel_to_faq()
    {
        return $this->hasMany(Faq::class, 'service_information_id');
    }

      protected $fillable = ['user_id','service_title', 'price', 'category_id', 'delivery_time', 'skill', 'tag', 'service_detail', 'meta_title', 'meta_description','status','country','languages','slug'];

}
