<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category_translation extends Model
{
    protected $table = "category_translations";
    protected $guarded = [];

    public function cars_make(){
        return $this->hasMany('App\Models\Auction','make','caregory_id');
    }

    public function cars_model(){
        return $this->hasMany('App\Models\Auction','model','caregory_id')->whereNotIn('status',['1']);
    }

    public function make_models(){
        return $this->hasOne('App\Models\Category','id','caregory_id');
    }

}
