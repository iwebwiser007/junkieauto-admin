<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Make extends Model
{
    protected $table = 'categories';
    protected $guarded = [];

    public function brands(){
        return $this->hasMany('App\Models\Category_translation','caregory_id','id')->where('language',user()->language);
    }

    public function models(){
        return $this->hasMany('App\Models\Category_translation','caregory_id','id')->where('language',user()->language);
    }

    public function cars(){
        return $this->hasMany('App\Models\Auction','make','id');
    }

}
