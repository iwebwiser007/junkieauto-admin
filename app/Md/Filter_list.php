<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filter_list extends Model
{
    protected $table = "filter_lists";
    protected $guarded = [];

    
    public function label(){
        return $this->hasOne('App\Models\Filter_lable','id','filter_id')->where('language',user()->language);
    }

    public function translation(){
        return $this->hasMany('App\Models\Filter_translation','id','filter_id')->where('language',user()->language);
    }
}
