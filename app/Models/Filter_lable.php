<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filter_lable extends Model
{
    protected $table = "filter_lables";
    protected $guarded = [];

    public function translation(){
        return $this->hasMany('App\Models\Filter_translation','filter_id','filter_id');
    }

    

}
