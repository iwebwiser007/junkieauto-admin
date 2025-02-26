<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    
    protected $table = "categories";
    protected $guarded = [];

    public function brands(){
        return $this->hasMany('App\Models\Category_translation','caregory_id','id')->where('language',user()->language);
    }

    public function models(){
        return $this->hasMany('App\Models\Category_translation','caregory_id','id')->where('language',user()->language);
    }

    public function cars(){
        return $this->hasMany('App\Models\Auction','make','id')->whereNotIn('status',['1']);
    }

    public function cars_model(){
        return $this->hasMany('App\Models\Auction','model','id');
    }

    public function sub_cat()
    {
        return $this->hasMany(Category::class,'is_parent','id');   
    }

}
